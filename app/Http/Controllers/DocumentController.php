<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Districts;
use App\Models\Document_pattern;
use App\Models\Document_step;
use App\Models\Document_title;
use App\Models\Document_type;
use App\Models\Faculty;
use App\Models\Lecturer;
use App\Models\Lecturer_type;
use Barryvdh\DomPDF\Facade;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $document_type = Document_type::all();
        return view('octuslog.document.show_document_type.index', compact('document_type'));
    }
    public function make()
    {
       
        $document_patterns = Document_pattern::select('*')->join('document_types', 'document_patterns.document_types_id', 'document_types.document_types_id')->get();

        $districts = Districts::all();

        $document_title = Document_title::join('districts', 'document_titles.districts_id', 'districts.districts_id')
            ->join('faculties', 'document_titles.faculties_id', 'faculties.faculties_id')
            ->join('document_patterns', 'document_titles.document_patterns_id', 'document_patterns.document_patterns_id')
            ->select('*')->orderBy('document_titles_id','asc')->get();

        $step = Document_step::all();
        $data = array();
        $data = Document_title::join('districts', 'document_titles.districts_id', 'districts.districts_id')
            ->join('faculties', 'document_titles.faculties_id', 'faculties.faculties_id')
            ->join('document_patterns', 'document_titles.document_patterns_id', 'document_patterns.document_patterns_id')
            ->select('*')->first();
        return view('octuslog.document.document_make.index', compact('document_patterns', 'document_title', 'districts', 'step', 'data'));
    }

    public function fetch()
    {


        // $document_title = Document_title::join('districts', 'document_titles.districts_id', 'districts.districts_id')
        //     ->join('faculties', 'document_titles.faculties_id', 'faculties.faculties_id')
        //     ->join('document_patterns', 'document_titles.document_patterns_id', 'document_patterns.document_patterns_id')
        //     ->select('*')->get();

        // $data = array();
        // $data = Document_title::join('districts', 'document_titles.districts_id', 'districts.districts_id')
        //     ->join('faculties', 'document_titles.faculties_id', 'faculties.faculties_id')
        //     ->join('document_patterns', 'document_titles.document_patterns_id', 'document_patterns.document_patterns_id')
        //     ->select('*')->first();
        // return view('octuslog.document.document_make.fetch', compact('document_title', 'data'))->render();
    }

    function do($id) {
        $document_title = Document_title::join('districts', 'document_titles.districts_id', 'districts.districts_id')
            ->join('faculties', 'document_titles.faculties_id', 'faculties.faculties_id')
            ->join('document_patterns', 'document_titles.document_patterns_id', 'document_patterns.document_patterns_id')
            ->where('document_titles_id', $id)
            ->first();
        $costs = Cost::all();
        $lecturers_type = Lecturer_type::find(1);
        $lecturers = Lecturer::select('*')->join('lecturer_types', 'lecturers.lecturer_types_id', 'lecturer_types.lecturer_types_id')->get();
        $districts_now = Districts::find(auth::user()->districts_id);
        $costs_head = Cost::find(1);
        $costs_lecturer = Cost::find(2);
        $costs_lunch = Cost::find(3);
        $costs_dinner = Cost::find(4);
        $costs_snack = Cost::find(5);
        $costs_accommodation = Cost::find(12);

        // print_r($document_title );

        if($document_title->document_patterns_id  == 1){
            return view('octuslog.document.document_do.type_1.index', compact('document_title', 'costs', 'lecturers', 'lecturers_type', 'costs_head', 'costs_lecturer', 'costs_lunch', 'costs_dinner', 'costs_snack', 'costs_accommodation', 'id', 'districts_now'));
        }else if($document_title->document_patterns_id  == 2){
            return view('octuslog.document.document_do.type_2_main.index', compact('document_title', 'costs', 'lecturers', 'lecturers_type', 'costs_head', 'costs_lecturer', 'costs_lunch', 'costs_dinner', 'costs_snack', 'costs_accommodation', 'id', 'districts_now'));
        }else if($document_title->document_patterns_id  == 3){
            return view('octuslog.document.document_do.type_2_sub.index', compact('document_title', 'costs', 'lecturers', 'lecturers_type', 'costs_head', 'costs_lecturer', 'costs_lunch', 'costs_dinner', 'costs_snack', 'costs_accommodation', 'id', 'districts_now'));
        }
        else if($document_title->document_patterns_id  == 4){
            return view('octuslog.document.document_do.type2_connect.index', compact('document_title', 'costs', 'lecturers', 'lecturers_type', 'costs_head', 'costs_lecturer', 'costs_lunch', 'costs_dinner', 'costs_snack', 'costs_accommodation', 'id', 'districts_now'));
        }

        


    }

    public function lecturers($id)
    {
        $data = Lecturer::find($id);
        return response()->json($data);
    }

    public function confirm()
    {

    }

    public function nextstep(Request $request)
    {
        $id = $request->get('id');
        $status = $request->get('status');
        $step = $request->get('step');

        if ($step == 'in') {
            if ($status == 2) {
                $data = Document_title::find($id);
                $data->document_titles_status = 1;
                $data->save();
            } else {
                $data = Document_title::find($id);
                $data->document_titles_status_within = $status + 1;
                $data->save();
            }

        } else {
            $data = Document_title::find($id);
            $data->document_titles_status = $status + 1;
            $data->save();
        }

        return response()->json([$id, $status, $step]);
    }

    public function cancelstep(Request $request)
    {

        $id = $request->get('id');
        $status = $request->get('status');
        $step = $request->get('step');

        if ($step == 'in') {
            $data = Document_title::find($id);
            $data->document_titles_status_within_cancel = $status;
            $data->document_titles_status_within = 1;
            $data->save();
        } else {
            $data = Document_title::find($id);
            $data->document_titles_status_within = 1;
            $data->document_titles_status = 0;
            $data->document_titles_cancel = $status;
            $data->document_titles_cancel_date = Carbon::parse(now())->format('Y-m-d');
            $data->save();
        }

    }

    public function upload(Request $request)
    {
        $status = $request->status;
        $id = $request->id;




        $fileName_now = time() . '_' . $request->file->extension();
        $fileName = time() . '_' . $request->file->getClientOriginalName();
        $filePath = $request->file('file_file')->move(public_path('upload/'), $fileName);
        $file_path = 'upload/' . $fileName;

        $data = Document_title::find($id);
        $data->document_titles_upload = $file_path;
        $data->document_titles_upload_name = $request->file->getClientOriginalName();

        $data->document_titles_status = $status + 1;


        $data->document_titles_mhesi = $request->document_titles_mhesi;
        $data->save();

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

    public function makestore(Request $request)
    {
        $faculties_id = Districts::where('districts_id', Auth::user()->districts_id)->first();

        $data_faculties = Districts::select('*')->where('districts_id',$request->districts_id)
        ->join('faculties', 'districts.faculties_id', 'faculties.faculties_id')
        ->first();


        $data = new Document_title();
        $data->users_id =  Auth::user()->id;
        $data->districts_id = $request->districts_id;
        $data->faculties_id = $data_faculties->faculties_id;
        $data->document_patterns_id = $request->document_patterns_id;
        $data->document_titles_mhesi = $request->document_titles_mhesi;
        $data->document_titles_mhesi_date = $data_faculties->faculties_date;
        $data->document_titles_name = $request->document_titles_name;
        $data->document_titles_number_faculties =  $data_faculties->faculties_number;
        $data->document_titles_date = Carbon::createFromFormat('Y-m', $request->document_titles_date);
        $data->save();
     

        return redirect()->back()->withsuccess(__('สร้างเอกสารสำเร็จ.'));
    }
    public function store(Request $request)
    {
        //
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
        $data = Document_title::where('document_titles_id', $id)->join('districts', 'document_titles.districts_id', 'districts.districts_id')
            ->join('faculties', 'document_titles.faculties_id', 'faculties.faculties_id')
            ->join('document_patterns', 'document_titles.document_patterns_id', 'document_patterns.document_patterns_id')->first();
        $step = Document_step::where('faculties_id', $data->faculties_id)->get();

        $data = array($data, $step);
        return response()->json($data);

    }

    public function render($id)
    {
        $data = Document_title::where('document_titles_id', $id)->join('districts', 'document_titles.districts_id', 'districts.districts_id')
            ->join('faculties', 'document_titles.faculties_id', 'faculties.faculties_id')
            ->join('document_patterns', 'document_titles.document_patterns_id', 'document_patterns.document_patterns_id')->first();
        $step = Document_step::where('faculties_id', $data->faculties_id)->get();

        return view('octuslog.document.document_make.render.index', compact('step', 'data'))->render();

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
        $data = Document_title::find($id);
        $data->users_id = Auth::user()->districts_id;
        $data->districts_id = $request->districts_id;
        $data->document_patterns_id = $request->document_patterns_id;
        $data->document_titles_mhesi = $request->document_titles_mhesi;

        $data->document_titles_name = $request->document_titles_name;

        $data->document_titles_date = Carbon::createFromFormat('Y-m', $request->document_titles_date);
        $data->save();
        return redirect()->back()->withsuccess(__('แก้ไขเอกสารสำเร็จ.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Document_title::find($id);
        $data->delete();
        return redirect()->back()->withsuccess(__('ลบเอกสารสำเร็จ.'));
    }
}
