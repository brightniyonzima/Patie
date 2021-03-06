<html>
<head>
    <script src="/js/js/jquery3.2.1.min.js"></script>
    <script src="/js/js/highcharts.js"></script>
    <script src="/js/js/exporting.js"></script>
</head>
<body>
    <ol>
        <li>
            <a href="/districts_graph" target="_blank">Districts Perfomance</a>
        </li>
    </ol>
    <div id="container" style="width: 550px; height: 400px; margin: 0 auto; margin-top: 80px;"></div>
    <script language="JavaScript">
    $(document).ready(function() {  
        var hospitals_array = {!! json_encode($hospitals_array) !!} ;
        var hospitals_score_array = {!! json_encode($hospitals_score_array) !!} ;

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
            title: {
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
       $('#container').highcharts(json);  
    });
    </script>
</body>
</html>

