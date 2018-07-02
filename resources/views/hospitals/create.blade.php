@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register a new hospital</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('hospitals.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Hospital Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Location</label>

                            <div class="col-md-6">
                                {{ Form::select('location',$districts,'',['class' => 'form-control','id' => 'location','onchange' => 'showCounties(this.value)','onclick' => 'showCounties(this.value)']) }}

                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('county') ? ' has-error' : '' }}" id="county-group" style="display: none;">
                            <label for="county" class="col-md-4 control-label">County</label>

                            <div class="col-md-6" id="counties">

                                @if ($errors->has('county'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('county') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('subcounty') ? ' has-error' : '' }}" id="subcounty-group" style="display: none;">
                            <label for="subcounty" class="col-md-4 control-label">Sub County</label>

                            <div class="col-md-6" id="subcounties">

                                @if ($errors->has('subcounty'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subcounty') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('parish') ? ' has-error' : '' }}" id="parish-group" style="display: none;">
                            <label for="parish" class="col-md-4 control-label">Parish</label>

                            <div class="col-md-6" id="parishes">

                                @if ($errors->has('parish'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('parish') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
    function showCounties(chosen_value) {
        $.ajax({
            url: '/get_counties?district_id=' + chosen_value,
            type: 'get',
            success: function(response){  
                $('#county-group').show();
                document.getElementById('counties').innerHTML = response;
            },
            error: function(response){
                console.log('there was an error getting the service price');
            }
        });
    }

    function showSubCounties(chosen_value) {
        $.ajax({
            url: '/get_subcounties?county_id=' + chosen_value,
            type: 'get',
            success: function(response){  
                $('#subcounty-group').show();
                document.getElementById('subcounties').innerHTML = response;
            },
            error: function(response){
                console.log('there was an error getting the service price');
            }
        });
    }

    function showParishes(chosen_value) {
        $.ajax({
            url: '/get_parishes?subcounty_id=' + chosen_value,
            type: 'get',
            success: function(response){  
                $('#parish-group').show();
                document.getElementById('parishes').innerHTML = response;
            },
            error: function(response){
                console.log('there was an error getting the service price');
            }
        });
    }
</script>
