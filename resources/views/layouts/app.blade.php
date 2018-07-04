<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('images/coa2.png') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    @guest
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    @else
                        @if(Auth::user()->name == 'brightniyonzima' || Auth::user()->name == 'PatienceAmanya')
                            <a class="navbar-brand" href="{{ url('/home') }}">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                            <a class="navbar-brand" href="{{ url('/hospitals') }}" style="color: #3097d1;">
                                <small>Hospitals</small>
                            </a>
                            <a class="navbar-brand" href="{{ url('/hospitals/create') }}" style="color: #3097d1;">
                                <small>Add hospital</small>
                            </a>
                            <a class="navbar-brand" href="{{ url('/patients') }}" style="color: #3097d1;">
                                <small>Patients</small>
                            </a>
                            <a class="navbar-brand" href="{{ url('/hospital_scores') }}" style="color: #3097d1">
                                <small>Cost-effectiveness</small>
                            </a>
                            <a class="navbar-brand" href="{{ url('/ccecsta_results_column_graph') }}" target="_blank" style="color: #3097d1">
                                <small>Cost-effectiveness Graph</small>
                            </a>
                        @endif
                    @endguest
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="logout-link" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret" id="caret-user"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <link rel="stylesheet" type="text/css" href="/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/css/datatables.min.css">
    <script src="/js/js/jquery3.2.1.min.js"></script>
    <script src="/js/js/select2.min.js"></script>
    <script type="text/javascript" src="/js/js/datatables.min.js"></script>
    <script src="/js/js/highcharts.js"></script>
    <script src="/js/js/exporting.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            /*call datatable plugin*/
            if (window.location.pathname === "/send_locations" ) {
                var hospitals_array = <?php if(isset($hospitals_array)){ ?>{!! json_encode($hospitals_array) !!} ; <?php } else { ?> 0; <?php } ?>
                var hospitals_score_array = <?php if(isset($hospitals_score_array)){ ?> {!! json_encode($hospitals_score_array) !!} ; <?php } else { ?> 0; <?php } ?>
                console.log('loaded fine');

                var chart = {
                    type: 'column'
                };
                var title = {
                    text: 'Hospitals\' Cost Effectiveness'   
                };
                var subtitle = {
                    text: ''  
                };
                var xAxis = {
                    categories: hospitals_array,
                    crosshair: true,
                    title:{
                        text: 'Hospitals'
                    }
                };
                var yAxis = {
                    min: 0,
                    title: {
                        text: 'CE Scores'         
                    }      
                };
                var tooltip = {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                       '<td style="padding:0"><b>{point.y:.1f} points</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                };
                var plotOptions = {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                };  
                var credits = {
                   enabled: false
                };
               
                var series= [ 
                    {
                        name: 'CE Score',
                        data: hospitals_score_array
                    }
                ];     
                  
               var json = {};   
               json.chart = chart; 
               json.title = title;   
               json.subtitle = subtitle; 
               json.tooltip = tooltip;
               json.xAxis = xAxis;
               json.yAxis = yAxis;  
               json.series = series;
               json.plotOptions = plotOptions;  
               json.credits = credits;
               $('#chart-container').highcharts(json);
            }

            $('#patie-data-table').DataTable({
                "searching": true
            });
            $('#patie-data-table2').DataTable({
                "searching": true
            });
            $('#view_hospitals').click(function(e){
                e.preventDefault();
                $('#hospital_results').show();
            });
            $('#caret-user,#logout-link').click(function(e){
                e.preventDefault();
                $('.dropdown-menu').show();
            });
        });
    </script>
</body>
</html>
