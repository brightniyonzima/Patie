<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\District;
use App\HealthUnit;
use App\HospitalParameterScore;

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

function check_if_hospital_is_rated($hospital_id)
{
    $hospital_score = HospitalParameterScore::where(['hospital_id' => $hospital_id])->first();
    if (is_null($hospital_score) || !isset($hospital_score->id)) {
        return true;
    }
    else{
        return false;
    }
}

function calculate_single_hospital_point($hospital_id)
{
    $hospital_param_points = HospitalParameterScore::where(['hospital_id' => $hospital_id])->first(['time_waiting','cost_of_service','number_of_treatment_methods','user_fee','trained_manpower','screening_tools_available','screening_tools_in_use','testing_equipment_available','testing_equipment_in_use','treatment_equipment_available','treatment_equipment_in_use','counselling_services','patient_follow_up']);
    if (!is_null($hospital_param_points)) {
        $hospital_param_points_array = $hospital_param_points->toArray();
        $values_array = array_values($hospital_param_points_array);
        $weight_points = [];
        for ($i=0; $i < count($values_array) ; $i++) { 
            $weight_points[] = $values_array[$i] * 5;
        }
        $number_of_params = count($weight_points);
        $ccecsta_score = array_sum($weight_points)/($number_of_params*5);
        $ccecsta_score = round($ccecsta_score,1);
        return $ccecsta_score;
    }
    //1.select from hospital_parameter_scores where hospital_id=$hospital_id
    //2.loop thru each param score and multiply it by 5 to get total weight
    //3.sum up value at stage 2 then divide that sum by count(params*5)
    //4.take note that distance isnt added here coz its not stored in the table and so its calculated on the fly
}
function add_distance_parameter($destination,$current)
{
    //if destination subregion == current subregion then distance will score 4
    //if destination subregion(west_1) != current subregion(west_2) then distance will score be 3
    //if destination subregion(west_1) != current subregion(west_3) then distance will score be 2  
    //bordering districts of each different sub region can get a score of 5
}
?>