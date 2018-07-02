@extends('layouts.app')

@section('content')
<div style="margin-left: 20px;">
    <a href="{{ url()->previous() }}"> 
        <span class="glyphicons glyphicons-arrow-left"><b> Go Back to previous page </b></span> 
    </a> 
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="destination">
                        <br><br>
                        <b>Ratings of hospitals in : <font color="green">{{ get_district_name($preferred_screening_location) }}</font></b>
                        <table  class="display" id="patie-data-table">
                            <tr style="background-color: #eee">
                                <th style="width: 40%"><small>Hospital Name</small></th>
                                <th style="width: 40%"><small>Cost Effectiveness Score</small></th>
                                <th style="width: 20%"><small>Rating</small></th>
                            </tr>

                            @if(!is_null($hospitals_in_preferred_area))
                                @foreach($hospitals_in_preferred_area as $hospital)
                                    @php 
                                        $points = 0; 
                                        $distance_points = distance_points($current_parish,$preferred_screening_parish,$current_location,$preferred_screening_location);
                                        $points = calculate_single_hospital_point_with_distace($hospital->id,$distance_points);
                                    @endphp
                                <tr>
                                    <td><a href="/hospitals/{{ $hospital->id }}?distance={{$distance_points}}">{{ $hospital->name }} <small> {{ get_parish_name($hospital->parish_id) }} </small></a></td>
                                    <td>
                                        {{ $points }}
                                    </td>
                                    <td>
                                        @if($points <= 5 && $points > 4)
                                           <span class="label label-success">Very High</span>
                                        @elseif($points <= 4 && $points > 3)
                                            <span class="label label-primary">High</span>
                                        @elseif($points <= 3 && $points > 2)
                                            <span class="label label-default">Average</span>
                                        @elseif($points <= 2 && $points > 1)
                                            <span class="label label-warning">Low</span>
                                        @else
                                            <span class="label label-danger">Poor</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">No records in the db</td>
                                </tr>
                            @endif
                        </table>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="graph">                  
                       <div id="chart-container" style="width: 300px; height: 200px; margin: 0 auto; margin-top: 80px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="/js/js/jquery3.2.1.min.js"></script>
<script src="/js/js/highcharts.js"></script>
<script src="/js/js/exporting.js"></script>
<script type="text/javascript">
    /*code below is necessary for creating a column*/
    $(document).ready(function() {  
        var hospitals_array = {!! json_encode($hospitals_array) !!} ;
        var hospitals_score_array = {!! json_encode($hospitals_score_array) !!} ;
        console.log('loaded fine');

        var chart = {
            type: 'column'
        };
        var title = {
            text: 'Hospitals Cost Effectiveness'   
        };
        var subtitle = {
            text: 'compiled by Patie model'  
        };
        var xAxis = {
            categories: hospitals_array,
            crosshair: true
        };
        var yAxis = {
            min: 0,
            title: {
                text: 'Scores'         
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
                name: 'CCECSTA Score',
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
    });
    
    function myFunction() {
      // Declare variables 
      var input, filter, table, tr, td, i;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("shuri-data-table");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        } 
      }
    }
</script>
<style type="text/css">
    #myInput {
        background-image: url('/css/searchicon.png'); /* Add a search icon to input */
        background-position: 10px 12px; /* Position the search icon */
        background-repeat: no-repeat; /* Do not repeat the icon image */
        width: 100%; /* Full-width */
        font-size: 16px; /* Increase font-size */
        padding: 12px 20px 12px 40px; /* Add some padding */
        border: 1px solid #ddd; /* Add a grey border */
        margin-bottom: 12px; /* Add some space below the input */
    }
</style>
@endpush
