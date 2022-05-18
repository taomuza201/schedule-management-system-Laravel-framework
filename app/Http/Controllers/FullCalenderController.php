<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use DatePeriod;
use DateInterval;
use App\Models\User;
use App\Models\Agenda;
use App\Models\Calendar;
use Illuminate\Http\Request;
use App\Exports\CalendarExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class FullCalenderController extends Controller
{
    public function index(Request $request)
    {

        $id = $request->get('id');
        if ($id == 'all' || $id == '') {
            $calendar = Calendar::select('*')
            // ->join('users', 'calendars.user_id', '=', 'users.id')
            // ->join('agendas', 'calendars.calendars_id', '=', 'agendas.calendars_id')
                ->get();
        } else {
            $calendar = Calendar::select('*')
                ->leftJoin('users', 'calendars.user_id', '=', 'users.id')
                ->where('user_id', $id)
                ->orWhere('calendars.user_id', null )
                ->get();
        }

        $user = User::all();
        return view('octuslog.caledar.index', compact('calendar', 'user', 'id'));
    }
    public function select_book($id)
    {
        $agendas = Agenda::where('calendars_id', $id)->first();
        return response()->json($agendas);
    }

    public function create()
    {
        // return view('tasks.create');
    }

    public function store(Request $request)
    {

        // print_r($request->all());

        if ($request->repeat == 'month') {

            $day = date("l", strtotime($request->start));
            $month = date("m", strtotime($request->start));
            $year = date("Y", strtotime($request->start));
            $time_start = date("H:i:s", strtotime($request->start));
            $time_end = date("H:i:s", strtotime($request->end));
            $begin = new DateTime($year . '-' . $month . '-01 ' . $time_start);
            $end = new DateTime(date("$year-$month-t ".$time_end ));
            $end_period = new DateTime(date("$year-" . ($month + 1) . "-01" . $time_end));
            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($begin, $interval, $end_period);

            $num_start = new DateTime($request->start);
            $num_end = new DateTime($request->end);

            $count_interval = $num_start->diff($num_end);

            foreach ($period as $dt) {

              

                if ($dt->format("l") == $day) {

                    $new_endday = $dt->format("d") + $count_interval->format('%a');
                    $new_endday = $dt->format("$year-$month-" . $new_endday . " " . $time_end);

                    try {

                        $new_endday = new DateTime($new_endday);

                        if ($new_endday->format('Y-m-d') >= $dt->format("Y-m-t")) {
                            $new_last_day_end = $dt->format("Y-m-t " . $time_end);
                        } else {
                            $new_last_day_end = new DateTime($new_endday->format("Y-m-d " . $time_end));
                        }
    

                    } catch (\Exception $e) {
                        $new_last_day_end = $end;
                    }

                   
                    $isnull = '';
                    foreach ($request->user_id as $user) {
                        if ($user == 'all') {
                            $isnull = 'all';
                        }
                    }

                    if ($isnull == 'all') {

                        $user_id = '';

                        $calendar = new Calendar();
                        $calendar->title = $request->title;
                        $calendar->start = $dt->format("Y-m-d H:i:s");
                        $calendar->end = $new_last_day_end->format("Y-m-d H:i:s");
                        $calendar->description = $request->description;
                        $calendar->color = $request->color;

                        // $calendar->user_id = $user_id;

                        $calendar->status = $request->status;
                        $calendar->save();

                        if ($request->status == 1) {

                            $agenda = new Agenda();
                            $agenda->agendas_title = $request->title;
                            $agenda->agendas_description = null;

                            $calendar_last = Calendar::select('*')->orderBy('calendars_id', 'desc')->first();
                            $agenda->calendars_id = $calendar_last->calendars_id;
                            $agenda->agendas_date = $calendar_last->start;
                            $agenda->save();
                        }

                    } else {

                        foreach ($request->user_id as $user) {
                            $calendar = new Calendar();
                            $calendar->title = $request->title;
                            $calendar->start = $dt->format("Y-m-d H:i:s");
                            $calendar->end = $new_last_day_end->format("Y-m-d H:i:s");
                            $calendar->description = $request->description;
                            $calendar->color = $request->color;
                            $calendar->user_id = $user;
                            $calendar->status = $request->status;
                            $calendar->save();

                            if ($request->status == 1) {

                                $agenda = new Agenda();
                                $agenda->agendas_title = $request->title;
                                $agenda->agendas_description = null;

                                $calendar_last = Calendar::select('*')->orderBy('calendars_id', 'desc')->first();
                                $agenda->calendars_id = $calendar_last->calendars_id;
                                $agenda->agendas_date = $calendar_last->start;
                                $agenda->save();
                            }
                        }
                    }

                }

            }

        } else if ($request->repeat == 'year') {

            $day = date("l", strtotime($request->start));
            $month = date("m", strtotime($request->start));
            $year = date("Y", strtotime($request->start));
            $time_start = date("H:i:s", strtotime($request->start));
            $time_end = date("H:i:s", strtotime($request->end));
            $begin = new DateTime($year . '-01-01');
            $end = new DateTime($year . '-12-31');
            $end_period = new DateTime(($year+1). '-01-01');
            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($begin, $interval, $end_period);



            $num_start = new DateTime($request->start);
            $num_end = new DateTime($request->end);

            $count_interval = $num_start->diff($num_end);

            foreach ($period as $dt) {

                if ($dt->format("l") == $day) {


                    $getmonth_now =  $dt->format("m");
                    $getmonth_day_last =  $dt->format("t");
                    $getmonth_day_last_month =  $dt->format("Y-m-t ".$time_end);



                    $new_endday = $dt->format("d") + $count_interval->format('%a');
                    $new_endday = $dt->format("$year-$getmonth_now-".$new_endday." ".$time_end);


                    try {

                        $new_endday = new DateTime($new_endday);
                 
                        if ($new_endday->format('Y-m-d') >= $dt->format("Y-m-t")) {
                            $new_last_day_end =  new DateTime($getmonth_day_last_month);
                            echo 'มากกว่า';

                            echo  $new_last_day_end->format('Y-m-d');
                        } else {
                            $new_last_day_end = new DateTime($new_endday->format("Y-m-d ".$time_end));
                        }
    

                    } catch (\Exception $e) {

                
                      echo 'เกิด ปัญหา';
                        $new_last_day_end =  new DateTime($getmonth_day_last_month);
                        echo  $new_last_day_end ->format("Y-m-d");
                  
                    }

                    // print_r( $new_last_day_end);
                


                    $isnull = '';
                    echo '<br>';
                    foreach ($request->user_id as $user) {
                        if ($user == 'all') {
                            $isnull = 'all';
                        }
                    }

                    if ($isnull == 'all') {

                        $user_id = '';

                        $calendar = new Calendar();
                        $calendar->title = $request->title;
                        $calendar->start = $dt->format("Y-m-d H:i:s");
                        // $calendar->end = $dt->format("Y-m-d " . $time_end);
                        $calendar->end =  $new_last_day_end->format("Y-m-d H:i:s");
                        $calendar->description = $request->description;
                        $calendar->color = $request->color;

                        // $calendar->user_id = $user_id;

                        $calendar->status = $request->status;
                        $calendar->save();

                        if ($request->status == 1) {

                            $agenda = new Agenda();
                            $agenda->agendas_title = $request->title;
                            $agenda->agendas_description = null;

                            $calendar_last = Calendar::select('*')->orderBy('calendars_id', 'desc')->first();
                            $agenda->calendars_id = $calendar_last->calendars_id;
                            $agenda->agendas_date = $calendar_last->start;
                            $agenda->save();
                        }
                    } else {
                        foreach ($request->user_id as $user) {
                            $calendar = new Calendar();
                            $calendar->title = $request->title;
                            $calendar->start = $dt->format("Y-m-d H:i:s");
                            // $calendar->end = $dt->format("Y-m-d " . $time_end);
                            $calendar->end =  $new_last_day_end->format("Y-m-d H:i:s");
                            $calendar->description = $request->description;
                            $calendar->color = $request->color;
                            $calendar->user_id = $user;
                            $calendar->status = $request->status;
                            $calendar->save();

                            if ($request->status == 1) {

                                $agenda = new Agenda();
                                $agenda->agendas_title = $request->title;
                                $agenda->agendas_description = null;

                                $calendar_last = Calendar::select('*')->orderBy('calendars_id', 'desc')->first();
                                $agenda->calendars_id = $calendar_last->calendars_id;
                                $agenda->agendas_date = $calendar_last->start;
                                $agenda->save();
                            }
                        }
                    }
                }

            }

        } else if ($request->repeat == 'custom') {

            $day_of_week = date("l", strtotime($request->start));

            $day = date("l", strtotime($request->start));
            $month = date("m", strtotime($request->start));
            $year = date("Y", strtotime($request->start));


            $begin = new DateTime($request->r_start);
            $end = new DateTime($request->r_end);

            $time_start = date("H:i:s", strtotime($request->start));
            $time_end = date("H:i:s", strtotime($request->end));

            $new_end_day  = date("d", strtotime($request->r_end));
            $new_end_month =  date("m", strtotime($request->r_end));
            $new_end_year = date("Y", strtotime($request->r_end));

        

            $end_period = new DateTime(($year+1).'-01-01');
            $check_last_month = new DateTime($new_end_year.'-'.$new_end_month);

          

            if($end->format('Y-m-d') == $check_last_month->format('Y-m-t')){

                if($new_end_month ==12 ){
                    $end_period = new DateTime(($new_end_year+1)."-01-01");
                }
                else{
                    $end_period = new DateTime("$new_end_year-".($new_end_month+1)."-01");
                }

            }else{
                $end_period = new DateTime($new_end_year."-".$new_end_month."-".($new_end_day+1));
            }

            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($begin, $interval, $end_period);



            $num_start = new DateTime($request->start);
            $num_end = new DateTime($request->end);

            $count_interval = $num_start->diff($num_end);


            foreach ($period as $dt) {



                $getmonth_now =  $dt->format("m");
                $getmonth_day_last =  $dt->format("t");
                $getmonth_day_last_month =  $dt->format("Y-m-t ".$time_end);



                $new_endday = $dt->format("d") + $count_interval->format('%a');
                $new_endday = $dt->format("$year-$getmonth_now-".$new_endday." ".$time_end);


                try {

                    $new_endday = new DateTime($new_endday);
             
                    if ($new_endday->format('Y-m-d') >= $dt->format("Y-m-t")) {
                        $new_last_day_end =  new DateTime($getmonth_day_last_month);
                        echo 'มากกว่า';

                        echo  $new_last_day_end->format('Y-m-d');
                    } else {
                        $new_last_day_end = new DateTime($new_endday->format("Y-m-d ".$time_end));
                    }


                } catch (\Exception $e) {

            
                  echo 'เกิด ปัญหา';
                    $new_last_day_end =  new DateTime($getmonth_day_last_month);
                    echo  $new_last_day_end ->format("Y-m-d");
              
                }


                echo $dt->format("l Y-m-d H:i:s") . '<br>';

                if ($dt->format("l") == $day_of_week) {

                    // echo $dt->format("l Y-m-d H:i:s") . '<br>';

                    $isnull = '';
                    echo '<br>';
                    foreach ($request->user_id as $user) {
                        if ($user == 'all') {
                            $isnull = 'all';
                        }
                    }

                    if ($isnull == 'all') {

                        $user_id = '';

                        $calendar = new Calendar();
                        $calendar->title = $request->title;
                        $calendar->start = $dt->format("Y-m-d H:i:s");
                        // $calendar->end = $dt->format("Y-m-d " . $time_end);
                        $calendar->end =  $new_last_day_end->format("Y-m-d H:i:s");
                        $calendar->description = $request->description;
                        $calendar->color = $request->color;

                        // $calendar->user_id = $user_id;

                        $calendar->status = $request->status;
                        $calendar->save();

                        if ($request->status == 1) {

                            $agenda = new Agenda();
                            $agenda->agendas_title = $request->title;
                            $agenda->agendas_description = null;

                            $calendar_last = Calendar::select('*')->orderBy('calendars_id', 'desc')->first();
                            $agenda->calendars_id = $calendar_last->calendars_id;
                            $agenda->agendas_date = $calendar_last->start;
                            $agenda->save();
                        }

                    } else {
                        foreach ($request->user_id as $user) {
                            $calendar = new Calendar();
                            $calendar->title = $request->title;
                            $calendar->start = $dt->format("Y-m-d H:i:s");
                            // $calendar->end = $dt->format("Y-m-d " . $time_end);
                            $calendar->end =  $new_last_day_end->format("Y-m-d H:i:s");
                            $calendar->description = $request->description;
                            $calendar->color = $request->color;
                            $calendar->user_id = $user;
                            $calendar->status = $request->status;
                            $calendar->save();

                            if ($request->status == 1) {

                                $agenda = new Agenda();
                                $agenda->agendas_title = $request->title;
                                $agenda->agendas_description = null;

                                $calendar_last = Calendar::select('*')->orderBy('calendars_id', 'desc')->first();
                                $agenda->calendars_id = $calendar_last->calendars_id;
                                $agenda->agendas_date = $calendar_last->start;
                                $agenda->save();
                            }
                        }
                    }

                }

            }

        } else {

            $isnull = '';
            echo '<br>';
            foreach ($request->user_id as $user) {
                if ($user == 'all') {
                    $isnull = 'all';
                }
            }

            if ($isnull == 'all') {

                $user_id = '';

                $calendar = new Calendar();
                $calendar->title = $request->title;
                $calendar->start = $request->start;
                $calendar->end = $request->end;
                $calendar->description = $request->description;
                $calendar->color = $request->color;

                // $calendar->user_id = $user_id;

                $calendar->status = $request->status;
                $calendar->save();

                if ($request->status == 1) {

                    $agenda = new Agenda();
                    $agenda->agendas_title = $request->title;
                    $agenda->agendas_description = null;

                    $calendar_last = Calendar::select('*')->orderBy('calendars_id', 'desc')->first();
                    $agenda->calendars_id = $calendar_last->calendars_id;
                    $agenda->agendas_date = $calendar_last->start;
                    $agenda->save();
                }
            } else {
                foreach ($request->user_id as $user) {
                    $calendar = new Calendar();
                    $calendar->title = $request->title;
                    $calendar->start = $request->start;
                    $calendar->end = $request->end;
                    $calendar->description = $request->description;
                    $calendar->color = $request->color;
                    $calendar->user_id = $user;
                    $calendar->status = $request->status;
                    $calendar->save();

                    if ($request->status == 1) {

                        $agenda = new Agenda();
                        $agenda->agendas_title = $request->title;
                        $agenda->agendas_description = null;

                        $calendar_last = Calendar::select('*')->orderBy('calendars_id', 'desc')->first();
                        $agenda->calendars_id = $calendar_last->calendars_id;
                        $agenda->agendas_date = $calendar_last->start;
                        $agenda->save();
                    }
                }
            }

        }

        // $isnull = '';
        // echo '<br>';
        // foreach ($request->user_id as $user) {
        //     if ($user == 'all') {
        //         $isnull = 'all';
        //     }
        // }

        // if ($isnull == 'all') {

        //     $user_id = '';

        //     $calendar = new Calendar();
        //     $calendar->title = $request->title;
        //     $calendar->start = $request->start;
        //     $calendar->end = $request->end;
        //     $calendar->description = $request->description;
        //     $calendar->color = $request->color;

        //     $calendar->user_id = $user_id;

        //     $calendar->status = $request->status;
        //     $calendar->save();

        //     if ($request->status == 1) {

        //         $agenda = new Agenda();
        //         $agenda->agendas_title = $request->title;
        //         $agenda->agendas_description = null;

        //         $calendar_last = Calendar::select('*')->orderBy('calendars_id', 'desc')->first();
        //         $agenda->calendars_id = $calendar_last->calendars_id;
        //         $agenda->agendas_date = $calendar_last->start;
        //         $agenda->save();
        //     }
        // } else {
        //     foreach ($request->user_id as $user) {
        //         $calendar = new Calendar();
        //         $calendar->title = $request->title;
        //         $calendar->start = $request->start;
        //         $calendar->end = $request->end;
        //         $calendar->description = $request->description;
        //         $calendar->color = $request->color;
        //         $calendar->user_id = $user;
        //         $calendar->status = $request->status;
        //         $calendar->save();

        //         if ($request->status == 1) {

        //             $agenda = new Agenda();
        //             $agenda->agendas_title = $request->title;
        //             $agenda->agendas_description = null;

        //             $calendar_last = Calendar::select('*')->orderBy('calendars_id', 'desc')->first();
        //             $agenda->calendars_id = $calendar_last->calendars_id;
        //             $agenda->agendas_date = $calendar_last->start;
        //             $agenda->save();
        //         }
        //     }
        // }

        return redirect()->back();

    }

    public function update(Request $request, $id)
    {

        $status = '';

        if ($request->status == '') {
            $status = 0;
        } else {
            $status = $request->status;
        }

        $calendar = Calendar::find($request->input('calendars_id'));
        $calendar->title = $request->title;
        $calendar->start = $request->start;
        $calendar->end = $request->end;
        $calendar->description = $request->description;
        $calendar->color = $request->color;
        $calendar->user_id = $request->user_id[0];
        $calendar->status = $status;
        $calendar->save();

        if ($request->status == 0) {
            DB::table('agendas')->where('calendars_id', $request->input('calendars_id'))->delete();
        } else {

            $check_data = DB::table('agendas')->where('calendars_id', $request->input('calendars_id'))->first();

            if ($check_data == '') {
                $agenda = new Agenda();
                $agenda->agendas_title = $request->title;
                $agenda->agendas_description = null;
                $agenda->calendars_id = $request->input('calendars_id');
                $agenda->agendas_date = $request->start;
                $agenda->save();
            }

        }

        return redirect()->back();
    }

    public function delete($id)
    {
        $calendar = Calendar::find($id);

        $calendar->delete();

        DB::table('agendas')->where('calendars_id', $id)->delete();

        return redirect()->back();

    }
    public function download($id,$month,$year)
    {

        $file  ='';

        if($id == 'all'){
            $file  ='กำหนดการทั้งหมด.xlsx';
        }else{

            $str = User::find($id);
            $file  ='กำหนดการ '.$str->name.'.xlsx' ;

        }  
        return Excel::download(new CalendarExport($id,$month,$year), $file);
    }

}
