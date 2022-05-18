<?php

namespace App\Http\Controllers;

use App\Models\Document_pattern;
use Illuminate\Http\Request;
use App\Models\Document_type;

class Document_patternsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $document_type = Document_type::all();
        $document_patterns = Document_pattern::join('document_types','document_patterns.document_types_id','=','document_types.document_types_id')->get();
        return view('octuslog.document_patterns.index',compact('document_type','document_patterns'));
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
        $document_types_id  =$request->document_types_id;
      
            $data = new Document_pattern();
          
            $data->document_patterns_name = $request->document_patterns_name;
            $data->document_types_id = $document_types_id;
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
        $document_patterns = Document_pattern::select('*')->where('document_types_id',$id)->get();

        return view('octuslog.document_patterns.step.index',compact('document_patterns','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Document_pattern::find($id);
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
        $data = Document_pattern::find($id);
        $data->document_patterns_name = $request->document_patterns_name;
        $data->document_types_id  = $request->document_types_id ;
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
         $data = Document_pattern::find($id);
         $data->delete();
        return redirect()->back()->withsuccess(__('ลบข้อมูลสำเร็จ.'));
    }
}
