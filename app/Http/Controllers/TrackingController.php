<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tracking;
use App\Models\Districts;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TrackingsExport;
use App\Models\Document_pattern;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $document_patterns = Document_pattern::select('*')->join('document_types', 'document_patterns.document_types_id', 'document_types.document_types_id')->get();

        $districts = Districts::all();

        $tracking = Tracking::select('*', 'trackings.created_at')
            ->join('districts', 'trackings.districts_id', 'districts.districts_id')
            ->join('faculties', 'districts.faculties_id', 'faculties.faculties_id')
            ->get();

        $data = array();
        $data = Tracking::select('*')->join('districts', 'trackings.districts_id', 'districts.districts_id')
            ->join('faculties', 'districts.faculties_id', 'faculties.faculties_id')
            ->orderBy('trackings_id', 'asc')
            ->first();

        // $created_at = Tracking::select(DB::raw('count(trackings_id ) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupby('year', 'month')->get();

        // DB::table("trackings")->select("trackings_id" ,DB::raw("(COUNT(*)) as total_click"))->orderBy('created_at')->groupBy(DB::raw("MONTH(created_at)"))->get();

       
        $data_month = DB::table("trackings")->select(DB::raw('count(trackings_id) as `data`'), DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))->groupby('monthyear')->get();

        $tracking_date = Tracking::select('*', 'trackings.created_at')
        ->join('districts', 'trackings.districts_id', 'districts.districts_id')
        ->join('faculties', 'districts.faculties_id', 'faculties.faculties_id')
        ->orderBy('trackings.created_at', 'desc')
        ->get();

        // print_r($data_month);

        return view('octuslog.tracking.index', compact('document_patterns','districts','tracking','data','tracking_date'));
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

        $data = new Tracking();
        $data->users_id = Auth::user()->id;
        // $data->timestamp = false;
        $data->document_patterns_id = $request->document_patterns_id;
        $data->districts_id = $request->districts_id;
        $data->trackings_mhesi = $request->trackings_mhesi;
        $data->trackings_mhesi_date = Carbon::createFromFormat('Y-m', $request->trackings_mhesi_date);
        $data->trackings_name = $request->trackings_name;
        $data->trackings_to = $request->trackings_to;
        $data->trackings_detail = $request->trackings_detail;

        $data->trackings_main = 1;
        $data->trackings_main_date = now();
        
        $data->trackings_money = $request->trackings_money;

        $check_number = Tracking::where('districts_id', $request->districts_id)->orderBy('trackings_number', 'DESC')->first();

        if ($check_number == '') {
            $data->trackings_number = 1;
        } else {
            $data->trackings_number = $check_number->trackings_number + 1;
        }



        if( $request->created_at == ''){
            $data->created_at =now();
        }else{
            $data->created_at = $request->created_at;
        }

        $data->save();

        return redirect()->back();

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

    public function tracking_find($id)
    {
        $data = Tracking::select('*')
            ->where('trackings_id', $id)
            ->join('districts', 'trackings.districts_id', 'districts.districts_id')
            ->join('faculties', 'districts.faculties_id', 'faculties.faculties_id')
            ->first();
        return view('octuslog.tracking.type.type1', compact('data'))->render();

    }

    public function tracking_step($id, $step, $status, Request $request)
    {

        $chk_data = $data = Tracking::find($id);
        $data = Tracking::find($id);

        if ($status == 'step_main') {
            $data->trackings_main = $step;
            $data->trackings_main_date = now();

   
            if ($step == 2) {
                $data->trackings_mhesi = $request->get('trackings_mhesi');
            }

            if ($step == 5) {
                $data->trackings_recipient = $request->get('recipient');
            }

            if ($step < $chk_data->trackings_main) {
                $data->trackings_sub_2 = 0;
                $data->trackings_sub_2_date = now();
                $data->trackings_sub_3 = 0;
                $data->trackings_sub_3_date = now();
            }

        } else if ($status == 'step_sub1') {
            $data->trackings_sub_1 = $step;
            $data->trackings_sub_1_date = now();

            // if($step == 1){
            //     $data->trackings_main = 9;
            //     $data->trackings_main_date = now();
            // }
        } else if ($status == 'step_sub2') {
            $data->trackings_sub_2 = $step;
            $data->trackings_sub_2_date = now();
        } else if ($status == 'step_sub3') {
            $data->trackings_sub_3 = $step;
            $data->trackings_sub_3_date = now();
        }

        $data->save();
    }

    public function upload(Request $request)
    {

        $upload_at = $request->upload_at;
        $id = $request->id;

        $data = Tracking::find($id);
        $fileName_now = time() . '_' . $request->file->extension();
        $fileName = time() . '_' . $request->file->getClientOriginalName();
        $filePath = $request->file('file')->move(public_path('upload/'), $fileName);
        $file_path = 'upload/' . $fileName;

        if ($upload_at == 'upload1') {

            $data->trackings_upload_1 = $file_path;
            $data->trackings_upload_name_1 = $request->file->getClientOriginalName();
            $data->trackings_sub_1 = 4;
            $data->trackings_sub_1_date = now();

        } else if ($upload_at == 'upload2') {
            $data->trackings_upload_2 = $file_path;
            $data->trackings_upload_name_2 = $request->file->getClientOriginalName();

            // if($request->trackings_mhesi1 != '' && $request->trackings_mhesi1 != 'undefined'){
            //     $data->trackings_mhesi = $request->trackings_mhesi1;
            // }else if ($request->trackings_mhesi2 != '' && $request->trackings_mhesi2 != 'undefined'){
            //     $data->trackings_mhesi = $request->trackings_mhesi2;
            // }

            if ($request->trackings_mhesi_date1 != '' && $request->trackings_mhesi_date1 != 'undefined') {
                $data->trackings_mhesi_date = $request->trackings_mhesi_date1;
            } else if ($request->trackings_mhesi_date2 != '' && $request->trackings_mhesi_date2 != 'undefined') {
                $data->trackings_mhesi_date = $request->trackings_mhesi_date2;
            }

            $data->trackings_main = 10;
            $data->trackings_main_date = now();

        } else if ($upload_at == 'upload3') {
            $data->trackings_upload_3 = $file_path;
            $data->trackings_upload_name_3 = $request->file->getClientOriginalName();

            $data->trackings_sub_2 = 1;
            $data->trackings_sub_2_date = now();

        } else if ($upload_at == 'upload4') {
            $data->trackings_upload_4 = $file_path;
            $data->trackings_upload_name_4 = $request->file->getClientOriginalName();

            $data->trackings_sub_2 = 11;
            $data->trackings_sub_2_date = now();

        }

        $data->save();

        // $data->document_titles_upload = $file_path;
        // $data->document_titles_upload_name = $request->file->getClientOriginalName();

        return response()->json($upload_at);
    }

    public function cancel(Request $request)
    {
        $id = $request->id;
        $text = $request->text;
        $data = Tracking::find($id);
        $data->trackings_status = 1;
        $data->trackings_canceltext = $text;
        $data->trackings_status_cancel = now();
        $data->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    public function file_emty($id, $step, $status, Request $request)
    {

        
        $data = Tracking::find($id);

        if ($status == 'step_main') {
            // $data->trackings_main = $step;
            $data->trackings_main = 10;
            $data->trackings_main_date = now();
            $data->trackings_mhesi_date =  $request->get('trackings_mhesi_date');
            $data->trackings_sub_2 = 0;
            $data->trackings_sub_3 = 0;

            }
        $data->save();
    }

    public function download($month_year,$districts)
    {
        return Excel::download(new TrackingsExport($month_year,$districts), 'tracking.xlsx');

    }
}
