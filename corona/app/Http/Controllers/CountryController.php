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

class CountryController extends Controller
{
    //Получение название всех стран в которых ведется анализ (в строковом виде)
    public static function GetCountryes()
    {
        $data = @file_get_contents(MainController::$url_all_continent);
        $countryes = array();
        if($data)
        {
            $dataJson = json_decode($data);
            for($i = 0; $i < count($dataJson); $i++)
            {
                for($j = 0; $j < count($dataJson[$i]->countries); $j++)
                {
                    $countryes[count($countryes)] = $dataJson[$i]->countries[$j];
                }
            }
        }
        return $countryes;
    }

    //Получение данных страны
    public static function GetDataContry($name)
    {
        $url_continent = 'https://disease.sh/v3/covid-19/countries/'.$name.'?strict=true';
        $data = @file_get_contents($url_continent);
        if($data)
        {
            $dataJson = json_decode($data);
            return $dataJson;
        }
        else
        {
            return null;
        }
    }

    //Загрузка страницы страны
    public function Contry()
    {
        if(isset($_GET['name']))
        {
            $countryes = CountryController::GetCountryes();

            $name_contry = $_GET['name'];
            $dataJson = CountryController::GetDataContry($name_contry);
            if($dataJson == null)
            {
                return redirect('/');
            }

            $mass_data_yest = '';
            $data_i_1 = @file_get_contents('https://disease.sh/v3/covid-19/countries/'.$name_contry.'?yesterday=1&strict=true');
            $dataJson_i_1 = json_decode($data_i_1);
            $data_i_2 = @file_get_contents('https://disease.sh/v3/covid-19/countries/'.$name_contry.'?yesterday=0&twoDaysAgo=1&strict=true');
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

            $dataAll = @file_get_contents(MainController::$url_all);
            $dataJsonWorld = json_decode($dataAll);
        
            return view('contry')->with(['header'=>$name_contry, 'dataJson'=>$dataJson,'countryes'=>$countryes,'mass_data_yest'=>$mass_data_yest,'dataJsonWorld'=>$dataJsonWorld]);
        }
        else
        {
            return redirect('/');
        }
    }
}