@extends('layouts.app')
@section('content')

<div class="container">
	<div>
	    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for hospital..">

	    <table  class="display" id="patie-data-table">
	        <tr style="background-color: #eee">
				<th style="width: 30%"><small>Hospital Name</small></th>
				<th style="width: 30%"><small>District</small></th>
				<th style="width: 20%"><small style="color: #3097d1;;">CCECSTA Score</small></th>
				<th></th>
			</tr>

			@if(!is_null($hospitals))
				@foreach($hospitals as $hospital)
				<tr>
					<td>{{ $hospital->name }}</td>
					<td>{{ get_district_name($hospital->location) }}</td>
					<td style="color: #3097d1;">{{ calculate_single_hospital_point($hospital->id) }}</td>
					<td align="center">
					    <a action="delete" class="btn btn-danger" href="/hospitals/{{ $hospital->id }}/delete"><span class="pull-left">&nbsp;</span>Delete</a>
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
@endsection
<script type="text/javascript">
	function myFunction() {
	  // Declare variables 
	  var input, filter, table, tr, td, i;
	  input = document.getElementById("myInput");
	  filter = input.value.toUpperCase();
	  table = document.getElementById("patie-data-table");
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