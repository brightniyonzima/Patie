<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HealthUnit;
use App\HospitalParameterScore;
use DB;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hospitals = HealthUnit::all();
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
        return view('hospitals.show',compact('hospital'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $districts = DB::table('districts')->pluck('id','name')->toArray();
        return view('hospitals.edit',compact('districts'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /*save the parameter scroes of that hospital*/
    public function store_hospital_scores(Request $request)
    {
        //dd($request->all());
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
}
