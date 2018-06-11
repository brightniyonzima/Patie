@extends('layouts.app')
@section('content')

<div class="container">
	<div>
	    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

	    <table  class="display" id="patie-data-table">
	        <tr style="background-color: #eee">
				<th><small>Hospital Name</small></th>
				<th><small>District</small></th>
				<th><small>Region</small></th>
				<th></th>
			</tr>

			@if(!is_null($hospitals))
				@foreach($hospitals as $hospital)
				<tr>
					<td>{{ $hospital->name }}</td>
					<td>{{ $hospital->location }}</td>
					<td> {{ get_region($hospital->location) }} </td>
					<td align="center">
						<div class="btn-group">
							<button type="button" 
									class="btn btn-primary btn-xs dropdown-toggle"
									style="font-size: 1.1em; float:right" 
									data-toggle="dropdown" aria-expanded="false">Action<span class="caret"></span>						
							</button>
							<ul class="dropdown-menu pull-right worksheet_actions" 	role="menu">
								<li><a 	action="edit" 	worksheet="id"	href="/hospitals/{{ $hospital->id }}/"><span class="glyphicon glyphicon-pencil pull-left">&nbsp;</span>Enter CCASTA Scores</a></li>							
								<li class="divider"></li>
								<li><a 	action="edit" 	worksheet="id"	href="/hospitals/{{ $hospital->id }}/edit"><span class="glyphicon glyphicon-pencil pull-left">&nbsp;</span>Edit</a></li>							
								<li class="divider"></li>
								<li><a 	action="delete"	worksheet="id"	href="#"><span class="glyphicon glyphicon-remove pull-left" style="color:red;" >&nbsp;</span>Delete</a></li>
							</ul>
						<div class="btn-group">
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