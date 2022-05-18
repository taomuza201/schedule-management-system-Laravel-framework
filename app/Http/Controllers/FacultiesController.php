<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = Faculty::all();
        return view('octuslog.faculties.index',compact('faculties'));
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
        $data = new Faculty();
        $data->faculties_name  =$request->faculties_name;
        $data->faculties_number  = $request->faculties_number;
        $data->faculties_tel  = $request->faculties_tel;
        $data->faculties_date  = $request->faculties_date;
        $data->save();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Faculty::find($id);
        return response()->json($data);
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
        $data =  Faculty::find($id);
        $data->faculties_name  =$request->faculties_name;
        $data->faculties_number  = $request->faculties_number;
        $data->faculties_tel  = $request->faculties_tel;
        $data->faculties_date  = $request->faculties_date;
        $data->save();
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
        $data = Faculty::find($id);
        $data->delete();
        return redirect()->back()->withsuccess(__('แก้ไขข้อมูลสำเร็จ.'));
    }
}
