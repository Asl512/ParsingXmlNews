@extends('layouts.layout')
@section('title')
<link rel="stylesheet" href="{{ asset('css/map.css') }}">
<title>Главная</title>
@endsection

@section('content')
    <div class = 'header'>
        <div class = 'header_title_main'>
            <h1 class = 'title_main'>ОПЕРАТИВНЫЕ ДАННЫЕ<br>О ПАНДЕМИИ В МИРЕ</h1>
        </div>

        <img class = 'img_sor' src = 'https://proxy.imgsmail.ru/?email=aslan_vdit15%40mail.ru&e=1634504619&flags=0&h=0XUoRVWgbEyYkEBCJbvfNA&url173=c3RhdGljLnRpbGRhY2RuLmNvbS90aWxkMzgzNi0zNDY2LTQ1MzYtYjg2Ni0zNjYyMzczMzMxMzMvRnJhbWUyMDMzNjIzMC5wbmc~&is_https=1'>

    </div>
@endsection


<!-- Подключение библиотеки карты--> 
<script src="{{ asset('mapJs/jquery-1.8.2.js') }}"></script>
  <script src="{{ asset('mapJs/jquery-jvectormap.js') }}"></script>
  <script src="{{ asset('mapJs/jquery-mousewheel.js') }}"></script>
  <script src="{{ asset('mapJs/jvectormap.js') }}"></script>
  <script src="{{ asset('mapJs/abstract-element.js') }}"></script>
  <script src="{{ asset('mapJs/abstract-canvas-element.js') }}"></script>
  <script src="{{ asset('mapJs/abstract-shape-element.js') }}"></script>
  <script src="{{ asset('mapJs/svg-element.js') }}"></script>
  <script src="{{ asset('mapJs/svg-group-element.js') }}"></script>
  <script src="{{ asset('mapJs/svg-canvas-element.js') }}"></script>
  <script src="{{ asset('mapJs/svg-shape-element.js') }}"></script>
  <script src="{{ asset('mapJs/svg-path-element.js') }}"></script>
  <script src="{{ asset('mapJs/svg-circle-element.js') }}"></script>
  <script src="{{ asset('mapJs/svg-image-element.js') }}"></script>
  <script src="{{ asset('mapJs/svg-text-element.js') }}"></script>
  <script src="{{ asset('mapJs/vml-element.js') }}"></script>
  <script src="{{ asset('mapJs/vml-group-element.js') }}"></script>
  <script src="{{ asset('mapJs/vml-canvas-element.js') }}"></script>
  <script src="{{ asset('mapJs/vml-shape-element.js') }}"></script>
  <script src="{{ asset('mapJs/vml-path-element.js') }}"></script>
  <script src="{{ asset('mapJs/vml-circle-element.js') }}"></script>
  <script src="{{ asset('mapJs/vml-image-element.js') }}"></script>
  <script src="{{ asset('mapJs/map-object.js') }}"></script>
  <script src="{{ asset('mapJs/region.js') }}"></script>
  <script src="{{ asset('mapJs/marker.js') }}"></script>
  <script src="{{ asset('mapJs/vector-canvas.js') }}"></script>
  <script src="{{ asset('mapJs/simple-scale.js') }}"></script>
  <script src="{{ asset('mapJs/ordinal-scale.js') }}"></script>
  <script src="{{ asset('mapJs/numeric-scale.js') }}"></script>
  <script src="{{ asset('mapJs/color-scale.js') }}"></script>
  <script src="{{ asset('mapJs/legend.js') }}"></script>
  <script src="{{ asset('mapJs/data-series.js') }}"></script>
  <script src="{{ asset('mapJs/proj.js') }}"></script>
  <script src="{{ asset('mapJs/map.js') }}"></script>
  <script src="{{ asset('mapJs/jquery-jvectormap-world-mill-en.js') }}"></script>
  <script src="{{ asset('mapJs/clickRegion.js') }}"></script>

@section('aftercontent')

    <h1 class = 'title_map'>Карта мира:</h1>
    <div id="map"></div>

    <script>
        var data = '{{$mass_data_yest}}';
        data = data.split('/');
        
        var data_dat = [];
        for(var i = 0; i < data.length; i++)
        {
            data_dat[data_dat.length] = data[i].split(';');
        }

        function GetDayAgo(num)
        {
            var count = num * 86400000;
            return new Date(Date.now()-count);
        }

        var days = [GetDayAgo(6).getDate()+'/'+GetDayAgo(6).getMonth(), 
        GetDayAgo(5).getDate()+'/'+GetDayAgo(5).getMonth(), 
        GetDayAgo(4).getDate()+'/'+GetDayAgo(4).getMonth(),
        GetDayAgo(3).getDate()+'/'+GetDayAgo(3).getMonth(), 
        GetDayAgo(2).getDate()+'/'+GetDayAgo(2).getMonth(), 
        GetDayAgo(1).getDate()+'/'+GetDayAgo(1).getMonth(), 
        GetDayAgo(0).getDate()+'/'+GetDayAgo(0).getMonth()]

        new Chartist.Bar('.ct-chart', {
        labels: days,
        series: [Number(data_dat[6][0]), 
        Number(data_dat[5][0]), 
        Number(data_dat[4][0]), 
        Number(data_dat[3][0]), 
        Number(data_dat[2][0]), 
        Number(data_dat[1][0]), 
        Number(data_dat[0][0])]
        }, {
        distributeSeries: true
        });

        new Chartist.Bar('.ct-chart2', {
        labels: days,
        series: [Number(data_dat[6][1]), 
        Number(data_dat[5][1]), 
        Number(data_dat[4][1]), 
        Number(data_dat[3][1]), 
        Number(data_dat[2][1]), 
        Number(data_dat[1][1]), 
        Number(data_dat[0][1])]
        }, {
        distributeSeries: true
        });

        new Chartist.Bar('.ct-chart3', {
        labels: days,
        series: [Number(data_dat[6][2]), 
        Number(data_dat[5][2]), 
        Number(data_dat[4][2]), 
        Number(data_dat[3][2]), 
        Number(data_dat[2][2]), 
        Number(data_dat[1][2]), 
        Number(data_dat[0][2])]
        }, {
        distributeSeries: true
        });

    </script>

    <div class = 'table'>
        <h1>Сводная таблица стран:</h1>
        <table>
            <th>№</th>
            <th>Cтрана</th>
            <th class ='td_data'>Выявлено случаев</th>
            <th class ='td_data'>Выздоровели</th>
            <th class ='td_data'>Болеют</th>
            <th class ='td_data'>Умерло</th>
            @foreach($data_contrys as $index => $data_contry)
            <tr>
                <td class='td_num'><p>{{$index+1}}</p></td>
                <td class ='td_country'>
                    <a href = 'contry?name={{$data_contry->country}}' class ='a_country'>
                        <img class = 'flag_table' src = '{{$data_contry->countryInfo->flag}}'>
                        <p class='name_country_table'>{{$data_contry->country}}</p>
                    </a>
                </td>
                <td class ='td_data'><div><div class="circle circle_blue"></div><p>{{number_format($dataJson->cases, 0, '.', ' ')}}</p></div></td>
                <td class ='td_data'><div><div class="circle circle_green"></div><p>{{number_format($dataJson->recovered, 0, '.', ' ')}}</p></div></td>
                <td class ='td_data'><div><div class="circle circle_orange"></div><p>{{number_format($dataJson->active, 0, '.', ' ')}}</p></div></td>
                <td class ='td_data'><div><div class="circle circle_red"></div><p>{{number_format($dataJson->deaths, 0, '.', ' ')}}</p></div></td>
            <tr>
            @endforeach
        </table>
    </div>
@endsection