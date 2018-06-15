@extends('layouts.app')
@section('content')

<div class="container">
	<div>
	    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

	    <table  class="display" id="patie-data-table">
	        <tr style="background-color: #eee">
				<th><small>Name</small></th>
				<th><small>Gender</small></th>
				<th><small>Marital Status</small></th>
				<th><small>Age</small></th>
				<th><small>District</small></th>
				<!-- <th></th> -->
			</tr>

			@if(!is_null($patients))
				@foreach($patients as $patient)
				<tr>
					<td>{{ $patient->first_name }} {{ $patient->last_name }}</td>
					@php
					    $gender = $patient->gender;
					    $marital = $patient->marital_status;
					    if($gender == 1){
					       $patientGender = "male";
					    }
					    else if($gender == 2){
					        $patientGender = "female";
					    }
					    else{
					        $patientGender = "Other";
					    }

					    if($marital == 1){
					       $patientmarital = "single";
					    }
					    else if($marital == 2){
					        $patientmarital = "married";
					    }
					    else if($marital == 3){
					        $patientmarital = "divorced";
					    }
					    else{
					        $patientmarital = "Other";
					    }

					    $dob = new Carbon\Carbon($patient->date_of_birth);
					@endphp
					<td>{{ $patientGender }}</td>
					<td>{{ $patientmarital }}</td>
					@php ; @endphp
					<td>{{ $dob->diffInYears(Carbon\Carbon::now()) }} years</td>
					<td>{{ get_district_name($patient->district) }}</td>
					<!-- <td align="right">
					    <a action="edit" class="btn btn-primary" href="/patients/{{ $patient->id }}/edit"><span class="glyphicon glyphicon-pencil pull-left">&nbsp;</span>Edit</a>
					    <a action="delete" class="btn btn-danger" href="/patients/{{ $patient->id }}/delete"><span class="pull-left">&nbsp;</span>Delete</a>
					</td> -->
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