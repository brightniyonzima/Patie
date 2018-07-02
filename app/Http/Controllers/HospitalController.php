<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HealthUnit;
use App\HospitalParameterScore;
use DB;

class HospitalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hospitals = HealthUnit::orderBy('name','asc')->get();
        return view('hospitals.index',compact('hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = DB::table('districts')->orderBy('name','asc')->pluck('name','id')->toArray();
        return view('hospitals.create',compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $health_unit = new HealthUnit;
        $health_unit->name = $request->name;
        $health_unit->location = $request->location;
        $health_unit->parish_id = $request->parish;
        $health_unit->created_by = auth()->user()->email;
        $health_unit->save();
        return redirect('/hospitals');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hospital = HealthUnit::findOrFail($id);
        $param_scores = HospitalParameterScore::where(['hospital_id'=>$id])->first();
        if (is_null($param_scores)) {
            return view('hospitals.show',compact('hospital'));
        }
        $param_scores = $param_scores->toArray();
        return view('hospitals.show_hospital_details',compact('hospital','param_scores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $districts = DB::table('districts')->pluck('name','id')->toArray();
        $hospital = HealthUnit::findOrFail($id);
        return view('hospitals.edit',compact('hospital','districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hospital = HealthUnit::findOrFail($id);
        $hospital->name = $request->name;
        $hospital->location = $request->location;
        if($hospital->update()){
            return redirect('/hospitals');
        }
        return back()->withErrors($validator)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hospital = HealthUnit::destroy($id);
        return redirect('hospitals');
    }

    public function get_counties()
    {
        $district_id = intval($_GET['district_id']);
        $sql = "SELECT * FROM counties WHERE district_id = '" . $district_id . "'";
        $results = DB::select($sql);
        $responseText = "";
        $responseText .= "<select class='form-control' id='county' onchange='showSubCounties(this.value)' onclick='showSubCounties(this.value)' name='county'>";
        foreach($results as $result) {
            $value = $result->id;
            $name = $result->name;
            $responseText .= "<option value='".$value."'>".$name."</option>";
        }
        $responseText .= "</select>";
        return $responseText;
    }

    public function get_subcounties()
    {
        $county_id = intval($_GET['county_id']);
        $sql = "SELECT * FROM subcounties WHERE county_id = '" . $county_id . "'";
        $results = DB::select($sql);
        $responseText = "";
        $responseText .= "<select class='form-control' id='subcounty' onchange='showParishes(this.value)' onclick='showParishes(this.value)' name='subcounty'>";
        foreach($results as $result) {
            $value = $result->id;
            $name = $result->name;
            $responseText .= "<option value='".$value."'>".$name."</option>";
        }
        $responseText .= "</select>";
        return $responseText;
    }

     public function get_parishes()
    {
        $subcounty_id = intval($_GET['subcounty_id']);
        $sql = "SELECT * FROM parishes WHERE subcounty_id = '" . $subcounty_id . "'";
        $results = DB::select($sql);
        $responseText = "";
        $responseText .= "<select class='form-control' id='subcounty' onchange='showVillages(this.value)' onclick='showVillages(this.value)' name='parish'>";
        foreach($results as $result) {
            $value = $result->id;
            $name = $result->name;
            $responseText .= "<option value='".$value."'>".$name."</option>";
        }
        $responseText .= "</select>";
        return $responseText;
    }

    /*save the parameter scroes of that hospital*/
    public function store_hospital_scores(Request $request)
    {
        $hospital_score = new HospitalParameterScore;
        $hospital_score->hospital_id = $request->hospital_id;
        $hospital_score->time_waiting = $request->time_waiting;
        $hospital_score->cost_of_service = $request->cost_of_service;
        $hospital_score->number_of_treatment_methods = $request->number_of_treatment_methods;
        $hospital_score->user_fee = $request->user_fee;
        $hospital_score->trained_manpower = $request->trained_manpower;
        $hospital_score->screening_tools_available = $request->screening_tools_available;
        $hospital_score->screening_tools_in_use = $request->screening_tools_in_use;
        $hospital_score->testing_equipment_available = $request->testing_equipment_available;
        $hospital_score->testing_equipment_in_use = $request->testing_equipment_in_use;
        $hospital_score->treatment_equipment_available = $request->treatment_equipment_available;
        $hospital_score->treatment_equipment_in_use = $request->treatment_equipment_in_use;
        $hospital_score->counselling_services = $request->counselling_services;
        $hospital_score->patient_follow_up = $request->patient_follow_up;
        $hospital_score->createdby = 'patie@gmail.com';
        if ($hospital_score->save()) {
            return redirect('hospitals');
        }
        return back()->withErrors($validator)->withInput();
    }
    /*
    send user location and preferred screening location
    */
    public function send_locations(Request $request)
    {
        $current_location = $request->current_location;
        $current_parish = $request->current_parish;
        $preferred_screening_location = $request->destination_location;
        $preferred_screening_parish = $request->destination_parish;

        $hospitals_in_preferred_area = HealthUnit::where(['location'=>$preferred_screening_location])->get();
        $hospitals_in_current_area = HealthUnit::where(['location'=>$current_location])->get();        
        //1.select all hospitals in the preferred area e.g HealthUnit::where(['location'=>preferred_location]) list them in score order
        //2.add distance points in accordance with how far from the current location e.g if same dist=5,sub_region=3
        //3.suggest near by hospitals with a good score basing hospitals in that same district or sub region
        //dd($hospitals_in_preferred_area);
        $hospitals_array = [];
        $hospitals_score_array = [];
        foreach ($hospitals_in_preferred_area as $hospital) {
            $hospitals_array[] = $hospital->name;
            $hospitals_score_array[] = calculate_single_hospital_point($hospital->id);
        }
        return view('hospitals.hospitals_in_area',compact('hospitals_in_preferred_area','preferred_screening_location','preferred_screening_parish','hospitals_in_current_area','current_location','current_parish','hospitals_array','hospitals_score_array'));
    }
    /*
    show ccecsta scores of a hospital
    */
    public function list_hospitals_ccecsta_scores()
    {
        $hospitals = HealthUnit::orderBy('name','asc')->get();
        return view('hospitals.hospitals_ccecsta_results',compact('hospitals'));
    }
    /*
     *show a graph of all hospital score
    */
    public function show_ccecsta_column_graph()
    {
        $hospitals = HealthUnit::orderBy('name','asc')->get();
        $hospitals_array = [];
        $hospitals_score_array = [];
        foreach ($hospitals as $hospital) {
            $hospitals_array[] = $hospital->name;
            $hospitals_score_array[] = calculate_single_hospital_point($hospital->id);
        }
        return view('hospitals.ccecsta_results_column_graph',compact('hospitals_array','hospitals_score_array'));
    }
    /*
     *show graph for hospitals per districts
    */
    public function show_ccecsta_column_graph_per_district()
    {
        $districts = \App\District::orderBy('name','asc')->get();
        $hospitals = [];
        $districts_array = [];
        $hospitals_score_array = [];
        foreach ($districts as $district) {
            $districts_array[] = $district->name;
            $hospital_ids_in_district = HealthUnit::where('location',$district->id)->pluck('id')->toArray();
            $hospitals_score_array[] = calculate_mulitple_hospital_points($hospital_ids_in_district);
        }
        return view('hospitals.ccecsta_districts_graph',compact('districts_array','hospitals_score_array'));
    }
    /*
      *function to generate an excel of all hospital score
    */
    public function generate_ccecsta_excel()
    {
        $hospitals = HealthUnit::orderBy('name','asc')->get();
        $hospitals_array = [];
        $hospitals_score_array = [];
        $data = [];
        $hospital_data = [];
        foreach ($hospitals as $hospital) {
            $data[$hospital->name] = calculate_single_hospital_point($hospital->id);
        }

        return Excel::create('ccecsta-points', function($excel) use ($data) {
            $excel->sheet('Hospital Points', function($sheet) use ($data)
            {
                $sheet->fromArray($data, null, 'A2', false, true);
                $sheet->mergeCells('A1:D1');
                $sheet->row(1, function ($row) {                
                    $row->setFontSize(12);
                });
                $sheet->row(1, array('ccecsta points'));
            });
        })->download('xls');
    }
}
