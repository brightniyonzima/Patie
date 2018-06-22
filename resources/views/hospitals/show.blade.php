@extends('layouts.app')
@section('content')
    <section class="hero profiles">
        <div class="hero-body">
            <div class="container">

                {{--page header--}}
                <header class="level is-mobile">
                    <article class="media" style="width: 50%">
                        <div class="row">
                        	<div class="col-md-4" style="margin-top: 1.5em;">
                        		<figure class="media-left">
		                            <p class="image is-96x96">
		                                <img src="/images/hospital.png" style="max-width: 100%;max-height: 100%">
		                            </p>
		                        </figure>
                        	</div>
                        	<div class="col-md-6" style="padding: 2rem;">
                        		<p class="customer-details">
                                    <strong>Hospital Name: </strong>{{ $hospital->name }} <br><br>
                                    <strong>Location: </strong> {{ get_district_name($hospital->location) }}<br><br>
                                    <strong>Region: </strong>{{ get_region($hospital->location) }}
                                </p>
                        	</div>
                        </div>
                    </article>
                </header>
            </div>
        </div>
    </section>

    <div class="container profiles">
        <article class="box" style="padding: 1em;">
            <h4 style="padding-left: 50px;">Enter Parameter scores for <font color="blue">{{ $hospital->name }}</font> that will be used to calculate its Cost Effectiveness using <strong>CECCSTA</strong></h4>
            <div class="row" style="padding-top: 15px">
	            <form class="form-horizontal" method="POST" action="{{ route('store_score') }}">
	                {{ csrf_field() }}
	                <input type="hidden" name="hospital_id" value="{{ $hospital->id }}" hidden>
	                <div class="col-md-8 col-md-offset-2">
	                    <div class="form-group{{ $errors->has('time_waiting') ? ' has-error' : '' }}">
	                        <label for="time_waiting" class="col-md-4 control-label">Time Spent Waiting</label>

	                        <div class="col-md-6">
	                            <!-- <input id="time" type="number" class="form-control" name="time" value="{{ old('time') }}" required autofocus> -->
	                            <select class="form-control" name="time_waiting" required>
	                            	<option value="">--select--</option>
	                            	<option value="5"> 1-30 mins</option>
	                            	<option value="4"> 31-60 mins</option>
	                            	<option value="3"> 61-120 mins</option>
	                            	<option value="2"> 121-180 mins</option>
	                            	<option value="1"> 181-240 mins</option>
	                            	<option value="0"> >240 mins</option>
	                            </select>

	                            @if ($errors->has('time'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('time') }}</strong>
	                                </span>
	                            @endif
	                        </div>
	                    </div>

	                    <div class="form-group{{ $errors->has('cost_of_service') ? ' has-error' : '' }}">
	                        <label for="cost_of_service" class="col-md-4 control-label">Cost of Service</label>

	                        <div class="col-md-6">
	                            <!-- <input id="cost_of_service" type="number" class="form-control" name="cost_of_service" value="{{ old('cost_of_service') }}" required autofocus> -->
	                            <select class="form-control" name="cost_of_service" required>
	                            	<option value="">--select--</option>
	                            	<option value="5"> < 0 Shs</option>
	                            	<option value="4"> 1-100,000 Shs</option>
	                            	<option value="3"> 110,000-200,000 Shs</option>
	                            	<option value="2"> 210,000-300,000 Shs</option>
	                            	<option value="1"> 310,000-400,000 Shs</option>
	                            	<option value="0"> >=410,000 Shs</option>
	                            </select>

	                            @if ($errors->has('cost_of_service'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('cost_of_service') }}</strong>
	                                </span>
	                            @endif
	                        </div>
	                    </div>

	                    <div class="form-group{{ $errors->has('number_of_treatment_methods') ? ' has-error' : '' }}">
	                        <label for="number_of_treatment_methods" class="col-md-4 control-label">Number of Screening Methods Used</label>

	                        <div class="col-md-6">
	                            <!-- <input id="number_of_treatment_methods" type="number" class="form-control" name="number_of_treatment_methods" value="{{ old('number_of_treatment_methods') }}" required autofocus> -->
	                            <select class="form-control" name="number_of_treatment_methods" required>
	                            	<option value="">--select--</option>
	                            	<option value="5"> >= 80% </option>
	                            	<option value="4"> 61-80%</option>
	                            	<option value="3"> 41-60%</option>
	                            	<option value="2"> 20-40%</option>
	                            	<option value="1"> 1-20%</option>
	                            	<option value="0"> <= 0%</option>
	                            </select>

	                            @if ($errors->has('number_of_treatment_methods'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('number_of_treatment_methods') }}</strong>
	                                </span>
	                            @endif
	                        </div>
	                    </div>

	                    <div class="form-group{{ $errors->has('user_fee') ? ' has-error' : '' }}">
	                        <label for="user_fee" class="col-md-4 control-label">User Fee</label>

	                        <div class="col-md-6">
	                            <!-- <input id="user_fee" type="number" class="form-control" name="user_fee" value="{{ old('user_fee') }}" required autofocus> -->
	                            <select class="form-control" name="user_fee" required>
	                            	<option value="">--select--</option>
	                            	<option value="5"> < 0 Shs</option>
	                            	<option value="4"> 1-5000 Shs</option>
	                            	<option value="3"> 5001-20000 Shs</option>
	                            	<option value="2"> 20001-35000 Shs</option>
	                            	<option value="1"> 35001-50000 Shs</option>
	                            	<option value="0"> >50000 Shs</option>
	                            </select>

	                            @if ($errors->has('user_fee'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('user_fee') }}</strong>
	                                </span>
	                            @endif
	                        </div>
	                    </div>

	                    <div class="form-group{{ $errors->has('trained_manpower') ? ' has-error' : '' }}">
	                        <label for="trained_manpower" class="col-md-4 control-label">Trained Man power</label>

	                        <div class="col-md-6">
	                            <!-- <input id="trained_manpower" type="number" class="form-control" name="trained_manpower" value="{{ old('trained_manpower') }}" required autofocus> -->
	                            <select class="form-control" name="trained_manpower" required>
	                            	<option value="">--select--</option>
	                            	<option value="5"> >= 80% </option>
	                            	<option value="4"> 61-80%</option>
	                            	<option value="3"> 41-60%</option>
	                            	<option value="2"> 20-40%</option>
	                            	<option value="1"> 1-20%</option>
	                            	<option value="0"> <= 0%</option>
	                            </select>

	                            @if ($errors->has('trained_manpower'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('trained_manpower') }}</strong>
	                                </span>
	                            @endif
	                        </div>
	                    </div>

	                    <div class="form-group{{ $errors->has('screening_tools_available') ? ' has-error' : '' }}">
	                        <label for="screening_tools_available" class="col-md-4 control-label">Screening Tools Available</label>

	                        <div class="col-md-6">
	                            <!-- <input id="screening_tools_available" type="number" class="form-control" name="screening_tools_available" value="{{ old('screening_tools_available') }}" required autofocus> -->
	                            <select class="form-control" name="screening_tools_available" required>
	                            	<option value="">--select--</option>
	                            	<option value="5"> >= 80% </option>
	                            	<option value="4"> 61-80%</option>
	                            	<option value="3"> 41-60%</option>
	                            	<option value="2"> 20-40%</option>
	                            	<option value="1"> 1-20%</option>
	                            	<option value="0"> <= 0%</option>
	                            </select>

	                            @if ($errors->has('screening_tools_available'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('screening_tools_available') }}</strong>
	                                </span>
	                            @endif
	                        </div>
	                    </div>

	                    <div class="form-group{{ $errors->has('screening_tools_in_use') ? ' has-error' : '' }}">
	                        <label for="screening_tools_in_use" class="col-md-4 control-label">Screening Tools in Use</label>

	                        <div class="col-md-6">
	                            <!-- <input id="screening_tools_in_use" type="number" class="form-control" name="screening_tools_in_use" value="{{ old('screening_tools_in_use') }}" required autofocus> -->
	                            <select class="form-control" name="screening_tools_in_use" required>
	                            	<option value="">--select--</option>
	                            	<option value="5"> >= 80% </option>
	                            	<option value="4"> 61-80%</option>
	                            	<option value="3"> 41-60%</option>
	                            	<option value="2"> 20-40%</option>
	                            	<option value="1"> 1-20%</option>
	                            	<option value="0"> <= 0%</option>
	                            </select>

	                            @if ($errors->has('screening_tools_in_use'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('screening_tools_in_use') }}</strong>
	                                </span>
	                            @endif
	                        </div>
	                    </div>

	                    <div class="form-group{{ $errors->has('testing_equipment_available') ? ' has-error' : '' }}">
	                        <label for="testing_equipment_available" class="col-md-4 control-label">Testing Equipment Available</label>

	                        <div class="col-md-6">
	                            <!-- <input id="testing_equipment_available" type="number" class="form-control" name="testing_equipment_available" value="{{ old('testing_equipment_available') }}" required autofocus> -->
	                            <select class="form-control" name="testing_equipment_available" required>
	                            	<option value="">--select--</option>
	                            	<option value="5"> >= 80% </option>
	                            	<option value="4"> 61-80%</option>
	                            	<option value="3"> 41-60%</option>
	                            	<option value="2"> 20-40%</option>
	                            	<option value="1"> 1-20%</option>
	                            	<option value="0"> <= 0%</option>
	                            </select>

	                            @if ($errors->has('testing_equipment_available'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('testing_equipment_available') }}</strong>
	                                </span>
	                            @endif
	                        </div>
	                    </div>

	                    <div class="form-group{{ $errors->has('testing_equipment_in_use') ? ' has-error' : '' }}">
	                        <label for="testing_equipment_in_use" class="col-md-4 control-label">Testing Equipment in Use</label>

	                        <div class="col-md-6">
	                            <!-- <input id="testing_equipment_in_use" type="number" class="form-control" name="testing_equipment_in_use" value="{{ old('testing_equipment_in_use') }}" required autofocus> -->
	                            <select class="form-control" name="testing_equipment_in_use" required>
	                            	<option value="">--select--</option>
	                            	<option value="5"> >= 80% </option>
	                            	<option value="4"> 61-80%</option>
	                            	<option value="3"> 41-60%</option>
	                            	<option value="2"> 20-40%</option>
	                            	<option value="1"> 1-20%</option>
	                            	<option value="0"> <= 0%</option>
	                            </select>

	                            @if ($errors->has('testing_equipment_in_use'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('testing_equipment_in_use') }}</strong>
	                                </span>
	                            @endif
	                        </div>
	                    </div>

	                    <div class="form-group{{ $errors->has('treatment_equipment_available') ? ' has-error' : '' }}">
	                        <label for="treatment_equipment_available" class="col-md-4 control-label">Treatment Equipment Available</label>

	                        <div class="col-md-6">
	                            <!-- <input id="treatment_equipment_available" type="number" class="form-control" name="treatment_equipment_available" value="{{ old('treatment_equipment_available') }}" required autofocus> -->
	                            <select class="form-control" name="treatment_equipment_available" required>
	                            	<option value="">--select--</option>
	                            	<option value="5"> >= 80% </option>
	                            	<option value="4"> 61-80%</option>
	                            	<option value="3"> 41-60%</option>
	                            	<option value="2"> 20-40%</option>
	                            	<option value="1"> 1-20%</option>
	                            	<option value="0"> <= 0%</option>
	                            </select>

	                            @if ($errors->has('treatment_equipment_available'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('treatment_equipment_available') }}</strong>
	                                </span>
	                            @endif
	                        </div>
	                    </div>

	                    <div class="form-group{{ $errors->has('treatment_equipment_in_use') ? ' has-error' : '' }}">
	                        <label for="treatment_equipment_in_use" class="col-md-4 control-label">Treatment Equipment in Use</label>

	                        <div class="col-md-6">
	                            <!-- <input id="treatment_equipment_in_use" type="number" class="form-control" name="treatment_equipment_in_use" value="{{ old('treatment_equipment_in_use') }}" required autofocus> -->
	                            <select class="form-control" name="treatment_equipment_in_use" required>
	                            	<option value="">--select--</option>
	                            	<option value="5"> >= 80% </option>
	                            	<option value="4"> 61-80%</option>
	                            	<option value="3"> 41-60%</option>
	                            	<option value="2"> 20-40%</option>
	                            	<option value="1"> 1-20%</option>
	                            	<option value="0"> <= 0%</option>
	                            </select>

	                            @if ($errors->has('treatment_equipment_in_use'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('treatment_equipment_in_use') }}</strong>
	                                </span>
	                            @endif
	                        </div>
	                    </div>

	                    <div class="form-group{{ $errors->has('counselling_services') ? ' has-error' : '' }}">
	                        <label for="counselling_services" class="col-md-4 control-label">Counselling Services</label>

	                        <div class="col-md-6">
	                            <!-- <input id="counselling_services" type="number" class="form-control" name="counselling_services" value="{{ old('counselling_services') }}" required autofocus> -->
	                            <div style="padding-top: 5px;">
	                            <input type="radio" name="counselling_services" value="5" required>Yes &nbsp;
                                <input type="radio" name="counselling_services" value="0" required>No
                                </div>

	                            @if ($errors->has('counselling_services'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('counselling_services') }}</strong>
	                                </span>
	                            @endif
	                        </div>
	                    </div>

	                    <div class="form-group{{ $errors->has('patient_follow_up') ? ' has-error' : '' }}">
	                        <label for="patient_follow_up" class="col-md-4 control-label">Patient Follow Up</label>

	                        <div class="col-md-6">
	                            <!-- <input id="patient_follow_up" type="number" class="form-control" name="patient_follow_up" value="{{ old('patient_follow_up') }}" required autofocus> -->
	                            <div style="padding-top: 5px;">
	                            <input type="radio" name="patient_follow_up" value="5" required>Yes &nbsp;
                                <input type="radio" name="patient_follow_up" value="0" required>No
                                </div>

	                            @if ($errors->has('patient_follow_up'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('patient_follow_up') }}</strong>
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
	                </div>
                </form>

            	<!-- <div class="col-md-4">
            		<h3>Enter Parameter scores for this hosptal</h3>
            	</div>
            	<div class="col-md-6">
            	    <div style="padding: 1rem;">
            	        <strong>Latest Results: </strong> 19 points
            	    </div>
            	    <div style="padding: 1rem;">
		                <strong>Fees Balance: </strong> 400/=
		            </div>
		            <div style="padding: 1rem;">
		                <strong>Year of Admission: </strong>2009 <br>
		            </div>
            	</div>
            	<div class="col-md-2">
					<button type="button" class="btn btn-success btn-xs" style="font-size: 1.1em; float:right" data-toggle="dropdown" aria-expanded="false" onclick="window.location.pathname='/hospitals'">Go Back						
					</button>
				</div> -->
            </div>
        </article>
    </div>
@endsection
<style type="text/css">
	section.profiles {
	    border-bottom: 1px solid #dbdbdb;
	    margin-bottom: 15px;
	}
	.profiles {
	    counter-reset: step;
	}
	.hero {
	    -webkit-box-align: stretch;
	    align-items: stretch;
	    background-color: white;
	    display: -webkit-box;
	    display: flex;
	    -webkit-box-orient: vertical;
	    -webkit-box-direction: normal;
	    flex-direction: column;
	    -webkit-box-pack: justify;
	    justify-content: space-between;
	}
	@media screen and (min-width: 769px)
	.level-right {
	    display: -webkit-box;
	    display: flex;
	}
	.level-right {
	    -webkit-box-align: center;
	    align-items: center;
	    -webkit-box-pack: end;
	    justify-content: flex-end;
	}
	@media screen and (min-width: 1192px)
	.container {
	    max-width: 1152px;
	}
	@media screen and (min-width: 1000px)
	.container {
	    margin: 0 auto;
	    max-width: 960px;
	}
	.container {
	    position: relative;
	}
	.profiles .box {
	    padding: 0;
	}
	.box:not(:last-child) {
	    margin-bottom: 1.5rem;
	}
	.box {
	    overflow: hidden;
	}
	article.box {
	    background-color: white;
	    border-radius: 5px;
	    box-shadow: 0 2px 3px rgba(10, 10, 10, 0.1), 0 0 0 1px rgba(10, 10, 10, 0.1);
	    display: block;
	    padding: 1.25rem;
	}
	.image.is-96x96 {
	    height: 96px;
	    width: 96px;
	}
	.level img {
    display: inline-block;
    vertical-align: top;
	}
	.image img {
	    display: block;
	    height: auto;
	    width: 100%;
	}
	/*.media-content {
	    flex-basis: auto;
	    -webkit-box-flex: 1;
	    flex-grow: 1;
	    flex-shrink: 1;
	    text-align: left;
	}
	.media-left {
	    margin-right: 1rem;
	}
	.media-left, .media-right {
	    flex-basis: auto;
	    -webkit-box-flex: 0;
	    flex-grow: 0;
	    flex-shrink: 0;
	}*/
	article, aside, figure, footer, header, hgroup, section {
	    display: block;
	}
</style>