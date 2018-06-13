@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">Gender</label>

                            <div class="col-md-6" style="padding-top: 5px;">
                                <input type="radio" name="gender" value="0" required>Male &nbsp;
                                <input type="radio" name="gender" value="1" required>Female

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        

                        <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                            <label for="date_of_birth" class="col-md-4 control-label">Date of Birth</label>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        {{ Form::selectRange('dobday', 1, 31,'' , ['class' => 'form-control']) }}
                                    </div>
                                    <div class="col-md-4">
                                        {{ Form::selectMonth('dobmonth',Carbon\Carbon::now()->month,['placeholder' => '--Select Month--','class' => 'form-control'])}}
                                    </div>
                                    <div class="col-md-4">
                                        {!! Form::selectYear('dobyear', date('Y'), 1915, [Carbon\Carbon::now()->year],['class'=>'form-control']) !!} 
                                    </div>
                                </div> 
                                @if ($errors->has('date_of_birth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('marital_status') ? ' has-error' : '' }}">
                            <label for="marital_status" class="col-md-4 control-label">Marital Status</label>

                            <div class="col-md-6" style="padding-top: 5px;">
                                <input type="radio" name="marital_status" value="1" required>Single &nbsp;
                                <input type="radio" name="marital_status" value="2" required>Married &nbsp;
                                <input type="radio" name="marital_status" value="3" required>Divorced &nbsp;
                                <input type="radio" name="marital_status" value="4" required>Other 
                                <!-- "1=single, 2=Married, 3=Divorced, 4=Other" -->

                                @if ($errors->has('marital_status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('marital_status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">District</label>

                            <div class="col-md-6">
                                <!-- <input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}" required autofocus> -->
                                {{ Form::select('location',['1'=>'Mbarara','2'=>'Bushenyi'],'',['class' => 'form-control','id' => 'location']) }}

                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('screened_before') ? ' has-error' : '' }}">
                            <label for="screened_before" class="col-md-4 control-label">Screened Before</label>

                            <div class="col-md-6" style="padding-top: 5px;">
                                <input type="radio" name="screened_before" value="0" required>No &nbsp;
                                <input type="radio" name="screened_before" value="1" required>Yes

                                @if ($errors->has('screened_before'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('screened_before') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Next
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
