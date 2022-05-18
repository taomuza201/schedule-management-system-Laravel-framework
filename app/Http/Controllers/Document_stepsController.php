<?php

namespace App\Http\Controllers;

use App\Models\Document_step;
use App\Models\Faculty;
use Illuminate\Http\Request;

class Document_stepsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = Faculty::all();
        return view('octuslog.document_steps.index', compact('faculties'));
    }

    public function step($id)
    {    $faculties = Faculty::find($id);
        $document_steps = Document_step::where('faculties_id', $id)->select('*')->get();
        return view('octuslog.document_steps.step.index', compact('id', 'document_steps','faculties'));
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
        $faculties_id = $request->faculties_id;
        if($request->document_steps_upload == ''){
            $request->document_steps_upload  = 0;
        }

        $check_data = Document_step::where('faculties_id', $faculties_id)->select('*')->orderBy('document_steps_no','desc')->first();
        if($check_data == ''){
            $data = new Document_step();
            $data->document_steps_name = $request->document_steps_name;
            $data->document_steps_no = 1;
            $data->document_steps_upload =  $request->document_steps_upload;
            $data->faculties_id = $faculties_id;
            $data->save();
        }else{
            $data = new Document_step();
            $data->document_steps_name = $request->document_steps_name;
            $data->document_steps_no = $check_data->document_steps_no +1;
            $data->document_steps_upload =  $request->document_steps_upload;
            $data->faculties_id = $faculties_id;
            $data->save();
        }

      

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
        $document_steps = Document_step::select('*')->where('document_types_id', $id)->get();

        return view('octuslog.document_steps.step.index', compact('document_steps', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Document_step::find($id);
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
        if($request->document_steps_upload == ''){
            $request->document_steps_upload  = 0;
        }
        $data = Document_step::find($id);
        $data->document_steps_name = $request->document_steps_name;
        $data->document_steps_upload =  $request->document_steps_upload;
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
        $data = Document_step::find($id);
        $data->delete();
        return redirect()->back()->withsuccess(__('ลบข้อมูลสำเร็จ.'));
    }
}
