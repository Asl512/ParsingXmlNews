<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/country.css') }}">
        <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">

        <!-- Подключение библиотеки графиков -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="http://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
        <script src="http://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>

        @yield('title')

    </head>
    <body>
    <div id = 'menu'>
            <div class = 'button_mune'>
                <a class = 'elem_menu' href = '/'><button class = 'button_cub home'></button></a>
                <a class = 'elem_menu' href = 'https://www.google.com/search?client=opera&q=короновирус&sourceid=opera&ie=UTF-8&oe=UTF-8'><button class = 'button_cub internet'></button></a>
                <a class = 'elem_menu' href = '#'><button class = 'button_cub flag_button'></button></a>
            </div>
        <div id = 'block_serch_contry'>
            <input type="text" id ="contry_input" list="country" placeholder = 'Название страны'>
            <datalist id="country">
                @foreach($countryes as $country)
                    <option value="{{$country}}">{{$country}}</option>
                @endforeach
            </datalist>
            <a id = 'transition_in_contry'><button class = 'button_cub forward'></button></a>
        </div>
    </div>    

    <script> 
        document.getElementById('contry_input').oninput = function()
        {
            var value = document.getElementById('contry_input').value;
            document.getElementById('transition_in_contry').href = 'contry?name='+value;
        }
    </script>

        
        <div id = 'content'>
            @yield('content')
            
            <!-- Графики -->
            <div class= 'blocks_grafiks'>
                <div class = 'block_grafik'>
                    <h1 class = title_block_grafik>Выявлено случаев:</h1>
                    <div class = 'data_block_grafik'>
                        <div class="circle circle_blue"></div>
                        <p>{{number_format($dataJson->cases, 0, '.', ' ')}}
                            <span>+ {{number_format($dataJson->todayCases, 0, '.', ' ')}}</span>
                            </p>
                    </div>

                    <div class="container-chart">
                        <div class="chart1 ct-chart ct-golden-section"></div>
                    </div>
                </div>

                <div class = 'block_grafik'>
                    <h1 class = title_block_grafik>Выздоровило:</h1>
                    <div class = 'data_block_grafik'>
                        <div class="circle circle_green"></div>
                        <p>{{number_format($dataJson->recovered, 0, '.', ' ')}}
                        <span>+ {{number_format($dataJson->todayRecovered, 0, '.', ' ')}}</span>
                        </p>
                    </div>

                    <div class="container-chart">
                        <div class="chart ct-chart2 ct-golden-section"></div>
                    </div>
                </div>

                <div class = 'block_grafik'>
                    <h1 class = title_block_grafik>Умерло:</h1>
                    <div class = 'data_block_grafik'>
                        <div class="circle circle_red"></div>
                        <p>{{number_format($dataJson->deaths, 0, '.', ' ')}}
                        <span>+ {{number_format($dataJson->todayDeaths, 0, '.', ' ')}}</span>
                        </p>
                    </div>

                    <div class="container-chart">
                        <div class="chart ct-chart3 ct-golden-section"></div>
                    </div>
                </div>
            </div>

            @yield('aftercontent')

        </div>

        <div class='footer'>
            <p>Разработал: Кучербаев Аслан</p>
        </div>

        <script src="js/sitehere-script1.js"></script>
    </body>
</html>