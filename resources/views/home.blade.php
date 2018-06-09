@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container" style="padding: 1em;">
                        <div class='row'>
                            <div class="col-sm-2"><div class="home-links home" onclick="go('#')"><br><img src="/images/hospital.png" style="font-size:55px; width: 55px; height: 55px;"><br><br>HOSPITALS</div></div> 
                            <div class="col-sm-2"><div class="home-links home" onclick="go('#')"><br><img src="/images/sick-person.png" style="font-size:55px; width: 55px; height: 55px;"><br><br>PATIENTS</div></div> 
                            <div class="col-sm-2"><div class="home-links home" onclick="go('#')"><br><img src="/images/scale.png" style="font-size:55px; width: 55px;height: 55px;"><br><br>PARAMETERS</div></div>
                            <div class="col-sm-2"><div class="home-links home" onclick="go('#')"><br><img src="/images/reports-folder.png" style="font-size:55px; width: 55px;height: 55px;"><br><br>REPORTS</div></div>
                        </div>
                    </div>

                    <!-- You are logged in! Now put whatever you want the patient to see on login -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
