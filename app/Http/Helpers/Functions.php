<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\District;

function get_sub_region($district) {
    $sub_region = District::where(['name'=>$district])->pluck('sub_region')->first();
    return $sub_region;
}

function get_region($district) {
    $region = District::where(['name'=>$district])->pluck('region')->first();
    return $region;
}

?>