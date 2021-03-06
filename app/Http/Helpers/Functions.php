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

function get_parish_name($parish_id)
{
    $parish = \App\Parish::where(['id'=>$parish_id])->pluck('name')->first();
    return $parish;
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

function calculate_single_hospital_point_with_distace($hospital_id,$distance_points)
{
    $hospital_param_points = HospitalParameterScore::where(['hospital_id' => $hospital_id])->first(['time_waiting','cost_of_service','number_of_treatment_methods','user_fee','trained_manpower','screening_tools_available','screening_tools_in_use','testing_equipment_available','testing_equipment_in_use','treatment_equipment_available','treatment_equipment_in_use','counselling_services','patient_follow_up']);
    if (!is_null($hospital_param_points)) {
        $hospital_param_points_array = $hospital_param_points->toArray();
        $values_array = array_values($hospital_param_points_array);
        $weight_points = [];
        for ($i=0; $i < count($values_array) ; $i++) { 
            $weight_points[] = $values_array[$i] * 5;
        }
        $weight_points[] = $distance_points * 5; //add distance weight
        $number_of_params = count($weight_points);
        $ccecsta_score = array_sum($weight_points)/($number_of_params*5);
        $ccecsta_score = round($ccecsta_score,1);
        return $ccecsta_score;
    }
}

function calculate_mulitple_hospital_points($hospitals_ids_array)
{
    # this is essentially the average ccecsta score of those hospitals...
    /*sum up calculate_single_hospital_point of all hospitals/number of hospitals*/
    $sums = 0;
    for ($i=0; $i < count($hospitals_ids_array) ; $i++) { 
        $sums +=  calculate_single_hospital_point($i);
    }
    if (count($hospitals_ids_array)!=0) {
        $multiple_hospitals_ccecsta_score = $sums/count($hospitals_ids_array);
        return $multiple_hospitals_ccecsta_score;
    }
    return 0;    
}

function distance_points($current_village,$preferred_screening_village,$current_district,$preferred_district)
{
    /*select the hospitals location*/
    if (!is_null($preferred_screening_village)) {
        $destination_village = \App\Village::where(['id' => $preferred_screening_village])->first();
        $preferred_parish_id = $destination_village->parish_id;
        $destination_subcounty = \App\Parish::where(['id' => $preferred_parish_id])->first();
        $preferred_subcounty_id = $destination_subcounty->subcounty_id;
        $destination_county = \App\Subcounty::where(['id' => $preferred_subcounty_id])->first();
        $preferred_county_id = $destination_county->county_id;
        $destination_district = \App\county::where(['id' => $preferred_county_id])->first();
        $preferred_district_id = $destination_county->district_id;
        $destinationsubregion = \App\District::findOrFail($preferred_district);
        $destination_subregion = $destinationsubregion->sub_region;
    }
    else{
        $preferred_parish_id = null;
        $preferred_subcounty_id = null;
        $preferred_county_id = null;
        $destinationsubregion = \App\District::findOrFail($preferred_district);
        $destination_subregion = $destinationsubregion->sub_region;
    }

    $current_village = \App\Village::where(['id' => $current_village])->first();
    $current_parish_id = $current_village->parish_id;
    $current_subcounty = \App\Parish::where(['id' => $current_parish_id])->first();
    $current_subcounty_id = $current_subcounty->subcounty_id;
    $current_county = \App\Subcounty::where(['id' => $current_subcounty_id])->first();
    $current_county_id = $current_county->county_id;
    $current_districtz = \App\county::where(['id' => $current_county_id])->first();
    $current_districtz_id = $current_county->district_id;
    $currentsubregion = \App\District::findOrFail($current_district);
    $current_subregion = isset($currentsubregion->sub_region)?$currentsubregion->sub_region:"";

    //dd($current_district.' '.$preferred_district);

    if ($current_parish_id == $preferred_parish_id) {
        return 4;
    } 
    else if($current_subcounty_id == $preferred_subcounty_id){
        return 3;
    }
    else if($current_county_id == $preferred_county_id){
        return 2;
    }
    else if($current_district == $preferred_district){
        return 2;
    }
    else if($current_subregion == $destination_subregion){
        return 1;
    }
    else {
        return 0;
    }    
}

function get_comment($parameter,$score)
{
    if ($parameter == "time_waiting") {
        if ($score == 5) {
            return "(1-30 mins)";
        }
        elseif ($score == 4) {
            return "(1-60 mins)";
        }
        elseif ($score == 3) {
            return "(61-120 mins)";
        }
        elseif ($score == 2) {
            return "(121-180 mins)";
        }
        elseif ($score == 1) {
            return "(181-240 mins)";
        }
        elseif ($score == 0) {
            return "(>240 mins)";
        }
    }

    if ($parameter == "cost_of_service") {
        if ($score == 5) {
            return "(< 0 Shs)";
        }
        elseif ($score == 4) {
            return "(1-100,000 Shs)";
        }
        elseif ($score == 3) {
            return "(110,000-200,000 Shs)";
        }
        elseif ($score == 2) {
            return "(210,000-300,000 Shs)";
        }
        elseif ($score == 1) {
            return "(310,000-400,000 Shs)";
        }
        elseif ($score == 0) {
            return "(>=410,000 Shs)";
        }
    }

    if ($parameter == "user_fee") {
        if ($score == 5) {
            return "(< 0 Shs)";
        }
        elseif ($score == 4) {
            return "(1-5000 Shs)";
        }
        elseif ($score == 3) {
            return "(5001-20000 Shs)";
        }
        elseif ($score == 2) {
            return "(20001-35000 Shs)";
        }
        elseif ($score == 1) {
            return "(35001-50000 Shs)";
        }
        elseif ($score == 0) {
            return "(>50000 Shs)";
        }
    }

    if ($parameter == "counselling_services" || $parameter == "patient_follow_up") {
        if ($score == 5) {
            return "(Yes)";
        }
        elseif ($score == 0) {
            return "(No)";
        }
    }

    /*if ($parameter == "treatment_equipment_in_use" || $parameter == "treatment_equipment_available"  || $parameter == "testing_equipment_in_use" || $parameter == "testing_equipment_available" || $parameter == "screening_tools_in_use" || $parameter == "screening_tools_available" || $parameter == "screening_tools_in_use" || $parameter == "trained_manpower" || $parameter == "number_of_treatment_methods") {
        if ($score == 5) {
            return "(>= 80%)";
        }
        elseif ($score == 4) {
            return "(61-80%)";
        }
        elseif ($score == 3) {
            return "(41-60%)";
        }
        elseif ($score == 2) {
            return "(20-40%)";
        }
        elseif ($score == 1) {
            return "(1-20%)";
        }
        elseif ($score == 0) {
            return "(<= 0%)";
        }
    }*/
}
?>