<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//$dataJson->country                     Название
//$dataJson->countryInfo->flag           ФЛАГ
//$dataJson->population                  Численность населения

//$dataJson->tests                       Тестировано

//$dataJson->cases                       Случаи
//$dataJson->todayCases                  Случаи сегодня
//$dataJson->deaths                      Смерти
//$dataJson->todayDeaths                 Смерти сегодня
//$dataJson->recovered                   Выздоровело
//$dataJson->todayRecovered              Выздоровело сегодня

//$dataJson->active                      Болеют
//$dataJson->critical                    Болеют критически

class MainController extends Controller
{
    public static $url_all = 'https://disease.sh/v3/covid-19/all'; //Все случаи в мире
    public static $url_all_continent = 'https://disease.sh/v3/covid-19/continents'; // Случаи по континентам

    public function Main()
    {
        $countryes = CountryController::GetCountryes();

        //$continent = 'Europe';
        //$url_continent = 'https://disease.sh/v3/covid-19/continents/'.$continent.'?strict=true'; // Случаи континента (нужно распарсить)

        $data = @file_get_contents(MainController::$url_all);
        $dataJson = json_decode($data);

        $country = ['USA','Russia','India','China','Kazakhstan'];

        $url = 'https://disease.sh/v3/covid-19/countries/';
        foreach($country as $country_one)
        {
            $url .= '%2C%20'.$country_one;
        }
        $data_c = @file_get_contents($url);
        $data_contrys = json_decode($data_c);

        $mass_data_yest = '';
        $data_i_1 = @file_get_contents('https://disease.sh/v3/covid-19/all?yesterday=1');
        $dataJson_i_1 = json_decode($data_i_1);
        $data_i_2 = @file_get_contents('https://disease.sh/v3/covid-19/all?twoDaysAgo=1');
        $dataJson_i_2 = json_decode($data_i_2);
        for($i=0; $i <= 6; $i++)
        {
            if($i == 0)
            {
                $data_str = $dataJson->todayCases.';'.$dataJson->todayRecovered.';'.$dataJson->todayDeaths;
                $mass_data_yest .= $data_str.'/';
            }
            else if($i == 1)
            {
                $data_str = $dataJson_i_1->todayCases.';'.$dataJson_i_1->todayRecovered.';'.$dataJson_i_1->todayDeaths;
                $mass_data_yest .= $data_str.'/';
            }
            else
            {
                $data_str = $dataJson_i_2->todayCases.';'.$dataJson_i_2->todayRecovered.';'.$dataJson_i_2->todayDeaths;
                $mass_data_yest .= $data_str.'/';
            }
        }

        return view('main')->with(['countryes'=>$countryes,'dataJson'=>$dataJson,'data_contrys'=>$data_contrys,'mass_data_yest'=>$mass_data_yest]);
    }
}