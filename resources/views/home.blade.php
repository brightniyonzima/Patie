@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><label class="btn-danger">&nbsp;&nbsp;&nbsp;Select a location where you would like to do your screening from to see the best nearby hospitals&nbsp;&nbsp;&nbsp;</label></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-horizontal" method="post" action="{{ url('/send_locations') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('current_location') ? ' has-error' : '' }}">
                            <label for="current_location" class="col-md-6 control-label">Select your current current Location </label>

                            <div class="col-md-4">
                                {{ Form::select('current_location',$districts,'',['class' => 'form-control','id' => 'current_location','required'=>'true','onchange'=>'showParishes(this.value)']) }}

                                <div id="parishes"></div>

                                @if ($errors->has('current_location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 

                        <br>

                        <div class="form-group{{ $errors->has('destination_location') ? ' has-error' : '' }}">
                            <label for="destination_location" class="col-md-6 control-label">Select where you would like to do screening? </label>

                            <div class="col-md-4">
                                {{ Form::select('destination_location',$districts,'',['class' => 'form-control','id' => 'destination_location','required'=>'true','onchange'=>'showDestinationParishes(this.value)']) }}

                                <div id="destination_parishes"></div>

                                @if ($errors->has('destination_location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('destination_location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                   

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-6">
                                <button type="submit" class="btn btn-primary">
                                    View Hospitals
                                </button>
                            </div>
                        </div>
                    </form> 

                    <!-- display the hspitals in that selected district -->
                    <div style="display: none;" id="hospital_results">
                        <label class="btn-success"> &nbsp;&nbsp;Hospitals in selected district &nbsp;&nbsp;&nbsp;</label>
                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">
                            Test Hospital &nbsp;&nbsp;&nbsp;
                            {{ Form::checkbox('test_hospital','',['class' => 'form-control','checked'=>'false']) }}
                            </label>

                            <!-- <div class="col-md-4">
                                {{ Form::checkbox('test_hospital','',['class' => 'form-control']) }}
                            </div> -->
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
    function showParishes(chosen_value) {
        $.ajax({
            url: '/get_current_parishes?district_id=' + chosen_value,
            type: 'get',
            success: function(response){
                $('#parish-group').show();
                document.getElementById('parishes').innerHTML = response;
            },
            error: function(response){
                console.log('there was an error getting the parishes');
            }
        });
    }

    function showDestinationParishes(chosen_value) {
        $.ajax({
            url: '/get_destination_parishes?district_id=' + chosen_value,
            type: 'get',
            success: function(response){
                document.getElementById('destination_parishes').innerHTML = response;
            },
            error: function(response){
                console.log('there was an error getting the parishes');
            }
        });
    }
</script>
