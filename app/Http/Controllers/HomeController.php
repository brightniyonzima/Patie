<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\county;
use App\Subcounty;
use App\Parish;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = DB::table('districts')->orderBy('name','asc')->pluck('name','id')->toArray();
        $districts = array_prepend($districts, '- select district-', '');
        return view('home',compact('districts'));
    }

    public function get_current_parishes()
    {
        $district_id = $_GET['district_id'];
        $counties_in_district = county::where(['district_id'=>$district_id])->get();
        $parishes_select = [];
        $responseText = "";
        $responseText .= "<select class='form-control' id='current_parish' name='current_parish'>";
        $responseText .= "<option value='' selected='selected'>- select parish-</option>";
        foreach ($counties_in_district as $county) {
            $subcounties_in_county = Subcounty::where(['county_id'=>$county->id])->get();
            foreach ($subcounties_in_county as $subcounty) {
                $parishes = Parish::where(['subcounty_id'=>$subcounty->id])->get();
                foreach ($parishes as $parish) {
                    $responseText .= "<option value='".$parish->id."'>".$parish->name."</option>";
                }
            }
        }
        $responseText .= "</select>";
        return $responseText;
    }

    public function get_destination_parishes()
    {
        $district_id = $_GET['district_id'];
        $counties_in_district = county::where(['district_id'=>$district_id])->get();
        $parishes_select = [];
        $responseText = "";
        $responseText .= "<select class='form-control' id='destination_parish' name='destination_parish'>";
        $responseText .= "<option value='' selected='selected'>- select parish-</option>";
        foreach ($counties_in_district as $county) {
            $subcounties_in_county = Subcounty::where(['county_id'=>$county->id])->get();
            foreach ($subcounties_in_county as $subcounty) {
                $parishes = Parish::where(['subcounty_id'=>$subcounty->id])->get();
                foreach ($parishes as $parish) {
                    $responseText .= "<option value='".$parish->id."'>".$parish->name."</option>";
                }
            }
        }
        $responseText .= "</select>";
        return $responseText;
    }
}
