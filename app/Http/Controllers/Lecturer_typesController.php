<?php

namespace App\Http\Controllers;

use App\Models\Lecturer_type;
use Illuminate\Http\Request;

class Lecturer_typesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lecturer_types =  Lecturer_type::all();
        return view('octuslog.lecturer.lecturer_types.index',compact('lecturer_types'));
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
        $data = new Lecturer_type();
        $data->lecturer_types_name =$request->lecturer_types_name;
        $data->lecturer_types_rate =$request->lecturer_types_rate;
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
        $data =  Lecturer_type::find($id);

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
        $data  = Lecturer_type::find($id);
        $data->lecturer_types_name =$request->lecturer_types_name;
        $data->lecturer_types_rate =$request->lecturer_types_rate;
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
        $data  = Lecturer_type::find($id);
        $data->delete();
        return redirect()->back()->withsuccess(__('ลบข้อมูลสำเร็จ.'));
    }
}
