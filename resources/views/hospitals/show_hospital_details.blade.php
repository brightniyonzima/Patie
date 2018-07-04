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

    <div class="container">
        <div class="row">
        	<div class="col-md-8 col-md-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-body">
	                    <table  class="display" id="patie-data-table">
                            <tr style="background-color: #eee">
                                <th style="width: 50%"><small>Parameter</small></th>
                                <th style="width: 50%"><small>Points</small></th>
                            </tr>
		                    @foreach($param_scores as $name => $score)
		                        @if(!in_array($name, ['id','hospital_id','createdby','created_at','updated_at']))
		                        <tr>
		                        	<td>
		                        	    {{ str_replace('_', ' ', $name) }} 
		                        	</td>
		                        	<td> {{ $score }} <small><font style="color: #19ccce;"> {{ get_comment($name,$score) }} </font></small></td>
		                        </tr>
		                        @endif
		                    @endforeach
		                    <tr>
		                    	<td> distance </td>
		                    	<td> {{ $distance }}</td>
		                    </tr>
		                    <tr>
		                    	<td><b>Cost Effectiveness Score</b> <small></small></td>
		                    	<td><b>{{ calculate_single_hospital_point_with_distace($hospital->id,$distance) }}</b></td>
		                    </tr>
		                </table>
	                </div>
	            </div>
	        </div>
        </div>
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
	article, aside, figure, footer, header, hgroup, section {
	    display: block;
	}
</style>