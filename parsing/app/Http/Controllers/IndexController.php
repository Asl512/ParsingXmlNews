<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\News;


class IndexController extends Controller
{
    public function Index()
    {
        //Считывание данных со страницы

        $url = 'http://static.feed.rbc.ru/rbc/logical/footer/news.rss';

        $parts = parse_url($url);
        $host = $parts['host'];
        $ch = curl_init();
        $header = array('GET /1575051 HTTP/1.1',
            "Host: {$host}",
            'Cache-Control:max-age=0',
            'Connection:keep-alive',
            'Host:adfoc.us',
            'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36'
        );

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $html = curl_exec($ch);
        curl_close($ch);

        //Парсинг

        $xml = simplexml_load_string($html);
        if(count(News::select()->get()) == 0) //если бд пустая (что бы выполнялось только один раз)
        {
            foreach($xml as $str)
            {
                foreach($str->item as $item)
                {

                    $data = ['title' => $item->title,
                            'link' => $item->link,
                            'description' => $item->description,
                            'date' => $item->pubDate];
                    if($item->author)
                    {
                        $data['autors'] = $item->author;
                    }
                    if($item->enclosure)
                    {
                        $data['image'] = $item->enclosure->attributes()->url;
                    }

                    News::create($data);
                }
            }
        }
        return view('index')->with(['xml'=>$xml]);
    }
}
