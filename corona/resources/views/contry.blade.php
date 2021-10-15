@extends('layouts.layout')
@section('title')
<title>{{$header}}</title>
@endsection

@section('content')
    <div class = 'header'>
        <div class = 'data_cantry'>
            <img class = 'flag' src = '{{$dataJson->countryInfo->flag}}'>
            <h1 class = 'name_contry'>{{$header}}</h1>
        </div>
        <div class = 'population'>
            <h1 class = 'number_population'>{{number_format($dataJson->population, 0, '.', ' ')}}</h1>
            <p class = 'text_population'>Численность<br>населения</p>
        </div>
    </div>
@endsection    

@section('aftercontent')
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

    <div class='world_grafik_title'>
        <h1>Соотношение с миром:</h1>
        <div class= 'blocks_grafiks'>
            <div class = 'block_grafik'>

                <div class="container-chart container-chart-big">
                    <div class="chart ct-chart5 ct-golden-section"></div>
                </div>
            </div>

            <div class = 'block_grafik'>

                <div class="container-chart container-chart-big">
                    <div class="chart ct-chart6 ct-golden-section"></div>
                </div>
            </div>

            <div class = 'block_grafik'>

                <div class="container-chart container-chart-big">
                    <div class="chart ct-chart7 ct-golden-section"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        //график случаи
        var casesCountry = '{{$dataJson->cases}}';
        var casesWorld = '{{$dataJsonWorld->cases}}';
        var cto_cases = Number(casesCountry) + Number(casesWorld);

        var procentCasesCountrycases = Math.round(Number(casesCountry)*100/cto_cases);
        var procentCasesWorldcases = 100 - procentCasesCountrycases;

        var data_cases = {series: [procentCasesCountrycases, procentCasesWorldcases]};

        new Chartist.Pie('.ct-chart5', data_cases, {
        labelInterpolationFnc: function(value) 
        {
            return Math.round(value) + '%';
        }});

        //график воздоровело
        var recoveredCountry = '{{$dataJson->recovered}}';
        var recoveredWorld = '{{$dataJsonWorld->recovered}}';
        var cto_recovered = Number(recoveredCountry) + Number(recoveredWorld);

        var procentCasesCountryrecovered = Math.round(Number(recoveredCountry)*100/cto_recovered);
        var procentCasesWorldrecovered = 100 - procentCasesCountryrecovered;

        var data_recovered = {series: [procentCasesCountryrecovered, procentCasesWorldrecovered]};

        new Chartist.Pie('.ct-chart6', data_recovered, {
        labelInterpolationFnc: function(value) 
        {
            return Math.round(value) + '%';
        }});

        //график умерло
        var deathsCountry = '{{$dataJson->deaths}}';
        var deathsWorld = '{{$dataJsonWorld->deaths}}';
        var cto_deaths = Number(deathsCountry) + Number(deathsWorld);

        var procentCasesCountrydeaths = Math.round(Number(deathsCountry)*100/cto_deaths);
        var procentCasesWorlddeaths = 100 - procentCasesCountrydeaths;

        var data_deaths = {series: [procentCasesCountrydeaths, procentCasesWorlddeaths]};

        new Chartist.Pie('.ct-chart7', data_deaths, {
        labelInterpolationFnc: function(value) 
        {
            return Math.round(value) + '%';
        }});
    </script>

    <div class= 'blocks_grafiks'>
        <div class = 'block_grafik'>
            <h1 class = title_block_grafik>Общий график:</h1>

            <div class="container-chart container-chart-big">
                <div class="chart1 ct-chart4 ct-golden-section"></div>
            </div>
        </div>
    </div>

    <script>
        //Общий график
        new Chartist.Bar('.ct-chart4', {
        labels: days,
        series: [
            [
                Number(data_dat[6][0]), 
                Number(data_dat[5][0]),
                Number(data_dat[4][0]), 
                Number(data_dat[3][0]), 
                Number(data_dat[2][0]), 
                Number(data_dat[1][0]),
                Number(data_dat[0][0])
            ],

            [
                Number(data_dat[6][1]),
                Number(data_dat[5][1]),
                Number(data_dat[4][1]), 
                Number(data_dat[3][1]), 
                Number(data_dat[2][1]), 
                Number(data_dat[1][1]), 
                Number(data_dat[0][1])
            ],

            [
                Number(data_dat[6][2]), 
                Number(data_dat[5][2]),
                Number(data_dat[4][2]), 
                Number(data_dat[3][2]), 
                Number(data_dat[2][2]), 
                Number(data_dat[1][2]),
                Number(data_dat[0][2])
            ]
        ]
        }, {
        seriesBarDistance: 10,
        axisX: {
            offset: 60
        },
        axisY: {
            offset: 80,
            labelInterpolationFnc: function(value) {
            return value
            },
            scaleMinSpace: 15
        }
        });
    </script>
@endsection