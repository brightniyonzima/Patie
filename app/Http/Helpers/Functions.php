<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\District;

function get_sub_region($district) {
    $sub_region = District::where(['id'=>$district])->pluck('sub_region')->first();
    return $sub_region;
}

function get_region($district) {
    $region = District::where(['id'=>$district])->pluck('region')->first();
    return $region;
}

function formatShuriDateFormat($day,$month,$year)
{
    $day = strlen($day)==1 ? '0'.$day : $day;
    $month = strlen($month)==1 ? '0'.$month : $month;
    $formatted_date = $year.$month.$day;
    return $formatted_date;
}

function get_district_name($district_id)
{
	$region = District::where(['id'=>$district_id])->pluck('name')->first();
    return $region;
}

function calculate_hopital_score($hospital_id)
{
    //select from hospital_parameter_scores where 
}

?>