@extends('layouts.app')

@section('content')
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
                                <th style="width: 40%"><small>CCECSTA Score</small></th>
                                <th style="width: 20%"><small>Rating</small></th>
                            </tr>

                            @if(!is_null($hospitals_in_preferred_area))
                                @foreach($hospitals_in_preferred_area as $hospital)
                                <tr>
                                    <td><a href="/hospitals/{{ $hospital->id }}">{{ $hospital->name }}</a></td>
                                    <td>{{ calculate_single_hospital_point($hospital->id) }}</td>
                                    <td>
                                        @php $points = calculate_single_hospital_point($hospital->id); @endphp
                                        @if($points <= 5 && $points > 4)
                                           <span class="label label-success">Very High</span>
                                        @elseif($points <= 4 && $points > 3.1)
                                            <span class="label label-primary">High</span>
                                        @elseif($points <= 3.1 && $points > 2.2)
                                            <span class="label label-default">Average</span>
                                        @elseif($points <= 2.1 && $points > 1)
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
                    <div class="current" style="margin-top: 50px;">
                        <b>Ratings of hospitals in your current area: <font color="green">({{ get_district_name($current_location) }})</font></b>
                        <table  class="display" id="patie-data-table2" style="width: 100%">
                            <tr style="background-color: #eee">
                                <th style="width: 40%; padding: 8px 10px; box-sizing: content-box; vertical-align: inherit;"><small>Hospital Name</small></th>
                                <th style="width: 40%; padding: 8px 10px; box-sizing: content-box; vertical-align: inherit;"><small>CCECSTA</small></th>
                                <th style="width: 20%"><small>Rating</small></th>
                            </tr>

                            @if(!is_null($hospitals_in_current_area))
                                @foreach($hospitals_in_current_area as $hospital)
                                <tr>
                                    <td style="border-top: 1px solid #ddd; padding: 8px 10px; box-sizing: content-box; display: table-cell; vertical-align: inherit;"><a href="/hospitals/{{ $hospital->id }}">{{ $hospital->name }}</a></td>
                                    <td style="border-top: 1px solid #ddd; padding: 8px 10px; box-sizing: content-box; display: table-cell; vertical-align: inherit;">{{ calculate_single_hospital_point($hospital->id) }}</td>
                                    @php $points = calculate_single_hospital_point($hospital->id); @endphp
                                    <td style="border-top: 1px solid #ddd; padding: 8px 10px; box-sizing: content-box; display: table-cell; vertical-align: inherit;">
                                        @if($points <= 5 && $points > 4)
                                           <span class="label label-success">Very Good</span>
                                        @elseif($points <= 4 && $points > 2.5)
                                            <span class="label label-warning">Good</span>
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
</div>
@endsection
<script type="text/javascript">
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

