<?php

namespace App\Http\Controllers;

use App\Models\Districts;
use App\Models\Faculty;
use Illuminate\Http\Request;

class DistrictsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = Districts::select('*')->join('faculties','districts.faculties_id','=','faculties.faculties_id')->get();
        $faculties = Faculty::get();
        return view('octuslog.districts.index',compact('districts','faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $districts = new Districts();
        $districts->districts_name  = $request->districts_name;
        $districts->faculties_id   = $request->faculties_id;
        $districts->districts_faculty_branch  = $request->districts_faculty_branch;
        $districts->districts_prefix  = $request->districts_prefix;
        $districts->districts_fname  = $request->districts_fname;
        $districts->districts_lname  = $request->districts_lname;
        $districts->districts_license_plate  = $request->districts_license_plate;
        $districts->districts_distance  = $request->districts_distance;
        $districts->districts_pic  = $request->districts_pic;
        $districts->districts_map  = $request->districts_map;
        $districts->districts_initials  = $request->districts_initials;
        $districts->save();

        return redirect()->back()->withsuccess(__('เพิ่มข้อมูลสำเร็จ.'));
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $districts = Districts::find($id);
        return response()->json($districts);
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
        $districts = Districts::find($id);
        $districts->districts_name  = $request->districts_name;
        $districts->faculties_id   = $request->faculties_id;
        $districts->districts_faculty_branch  = $request->districts_faculty_branch;
        $districts->districts_prefix  = $request->districts_prefix;
        $districts->districts_fname  = $request->districts_fname;
        $districts->districts_lname  = $request->districts_lname;
        $districts->districts_license_plate  = $request->districts_license_plate;
        $districts->districts_distance  = $request->districts_distance;
        $districts->districts_pic  = $request->districts_pic;
        $districts->districts_map  = $request->districts_map;
        $districts->districts_initials  = $request->districts_initials;
        $districts->save();
        
        return redirect()->back()->withsuccess(__('แก้ไขข้อมูลสำเร็จ.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $districts = Districts::find($id);
        $districts->delete();
        return redirect()->back()->withsuccess(__('ลบข้อมูลสำเร็จ.'));
    }
}
