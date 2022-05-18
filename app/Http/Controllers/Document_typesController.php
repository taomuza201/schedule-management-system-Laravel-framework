<?php

namespace App\Http\Controllers;

use App\Models\Document_type;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Data;

class Document_typesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $document_types = Document_type::all();
        return view('octuslog.document_types.index',compact('document_types'));
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
         $data =new Document_type();
         $data->document_types_name  =$request->document_types_name ;
         $data->document_types_color =$request->document_types_color;
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
         $data = Document_type::find($id);
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
        $data = Document_type::find($id);
        $data->document_types_name  =$request->document_types_name ;
        $data->document_types_color =$request->document_types_color;
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
        $data = Document_type::find($id);
        $data->delete();
        return redirect()->back()->withsuccess(__('ลบไขข้อมูลสำเร็จ.'));
    }
}
