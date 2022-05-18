<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Lecturer_type;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lecturer_type = Lecturer_type::all();
        $lecturer = Lecturer::select('*')->join('lecturer_types','lecturers.lecturer_types_id','=','lecturer_types.lecturer_types_id')->get();
        return view('octuslog.lecturer.lecturer.index',compact('lecturer_type','lecturer'));
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
        $data = new Lecturer();
        $data->lecturers_prefix = $request->lecturers_prefix;
        $data->lecturers_fname = $request->lecturers_fname;
        $data->lecturers_lname = $request->lecturers_lname;
        $data->lecturers_tel = $request->lecturers_tel;
        $data->lecturers_license_plate = $request->lecturers_license_plate;
        $data->lecturers_expertise = $request->lecturers_expertise;
        $data->lecturer_types_id  = $request->lecturer_types_id ;
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
        
        $data = Lecturer::find($id);
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
        $data = Lecturer::find($id);
        $data->lecturers_prefix = $request->lecturers_prefix;
        $data->lecturers_fname = $request->lecturers_fname;
        $data->lecturers_lname = $request->lecturers_lname;
        $data->lecturers_tel = $request->lecturers_tel;
        $data->lecturers_license_plate = $request->lecturers_license_plate;
        $data->lecturers_expertise = $request->lecturers_expertise;
        $data->lecturer_types_id  = $request->lecturer_types_id ;
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
        $data = Lecturer::find($id);
        $data->delete();
        return redirect()->back()->withsuccess(__('ลบข้อมูลสำเร็จ.'));
    }
}
