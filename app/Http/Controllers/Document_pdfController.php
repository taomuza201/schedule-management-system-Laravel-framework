<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Districts;
use App\Models\Document_title;
use App\Models\Lecturer;
use App\Models\Lecturer_type;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use PHPUnit\Framework\Constraint\Count;

class Document_pdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function type_1(Request $request)
    {

        $costs_head = Cost::find(1);
        $costs_lecturer = Cost::find(2);
        $costs_lunch = Cost::find(3);
        $costs_dinner = Cost::find(4);
        $costs_snack = Cost::find(5);
        $costs_accommodation = Cost::find(12);

        $data = $request->all();
        $id = $request->title_id;
        $document_title = Document_title::join('districts', 'document_titles.districts_id', 'districts.districts_id')
            ->join('faculties', 'document_titles.faculties_id', 'faculties.faculties_id')
            ->join('document_patterns', 'document_titles.document_patterns_id', 'document_patterns.document_patterns_id')
            ->where('document_titles_id', $id)
            ->first();

        if ($document_title->document_patterns_id == 1) {
            $templateProcessor = new TemplateProcessor('doc/type1/type1.docx');
            $templateProcessor->setValue('faculties_name', $document_title->faculties_name);
            $templateProcessor->setValue('districts_faculty_branch', $document_title->districts_faculty_branch);
            $templateProcessor->setValue('faculties_tel', $document_title->faculties_tel);
            $templateProcessor->setValue('document_titles_number_faculties', $document_title->document_titles_number_faculties);
            $templateProcessor->setValue('document_titles_mhesi', $document_title->document_titles_mhesi);
            $templateProcessor->setValue('document_titles_mhesi_date', formatDateThat($document_title->document_titles_date));
            $templateProcessor->setValue('document_titles_date', formatDatemonth($document_title->document_titles_date));
            $templateProcessor->setValue('document_titles_name', $document_title->document_titles_name);
            $templateProcessor->setValue('text_part_one', $data['text_part_1']);
            $templateProcessor->setValue('text_part_two', $data['text_part_2']);
            $templateProcessor->setValue('date_start_part', date('d', strtotime($data['date_start_part2'])));
            $templateProcessor->setValue('date_end_part', formatDateThat($data['date_end_part2']));

            $lecturers_id = $data['lecturers_id'];
            $cal_lecturers_1 = 0;
            $cal_lecturers_2 = 0;
            $cal_lecturers_3 = 0;
            $cal_lecturers_4 = 0;

            $lecturers_count = count(array_filter($lecturers_id, function ($x) {return !empty($x);})) + 1;

            $lecturers_1_prefix = $document_title->districts_prefix;
            if ($lecturers_1_prefix == 'ผู้ช่วยศาสตร์จารย์') {
                $lecturers_1_prefix = 'ผศ.';
            }
            $lecturers_1_fname = $lecturers_1_prefix . $document_title->districts_fname;
            $lecturers_1_lname = $document_title->districts_lname;
            $templateProcessor->setValue('one_fname', $lecturers_1_fname);
            $templateProcessor->setValue('one_lname', $lecturers_1_lname);
            $Lecturer_1 = Lecturer_type::find(1);
            $cal_lecturers_1 = $Lecturer_1->lecturer_types_rate * $data['lecturers_hour1'];
            $templateProcessor->setValue('one_cal_lecturers', $cal_lecturers_1);

            $templateProcessor->setValue('head_license_plate', $document_title->districts_license_plate);

            $districts_head = $costs_head->costs_rate * $data['distance_head'];
            $templateProcessor->setValue('districts_head', $districts_head);
            $lecturers_2_data = Lecturer::where('lecturers_id', $lecturers_id[0])->join('lecturer_types', 'lecturers.lecturer_types_id', 'lecturer_types.lecturer_types_id')->first();
            if ($lecturers_2_data != '') {
                $lecturers_2_prefix = $lecturers_2_data->lecturers_prefix;
                if ($lecturers_2_prefix == 'ผู้ช่วยศาสตร์จารย์') {
                    $lecturers_2_prefix = 'ผศ.';
                }
                $lecturers_2_fname = $lecturers_2_prefix . $lecturers_2_data->lecturers_fname;
                $lecturers_2_lname = $lecturers_2_data->lecturers_lname;
                $templateProcessor->setValue('two_fname', $lecturers_2_fname);
                $templateProcessor->setValue('two_lname', $lecturers_2_lname);
                $cal_lecturers_2 = $lecturers_2_data->lecturer_types_rate * $data['lecturers_hour2'];
                $templateProcessor->setValue('two_cal_lecturers', $cal_lecturers_2);
                $templateProcessor->setValue('lecturer_license_plate', $lecturers_2_data->lecturers_license_plate);
                $districts_lecturer = $costs_lecturer->costs_rate * $data['distance_lecturer'];
                $templateProcessor->setValue('districts_lecturer', $districts_lecturer);
            } else {
                $templateProcessor->setValue('two_fname', '');
                $templateProcessor->setValue('two_lname', '');
                $templateProcessor->setValue('two_cal_lecturers', '');
                $cal_lecturers_2 = 0;
                $templateProcessor->setValue('lecturer_license_plate', '');
                $districts_lecturer = 0;
                $templateProcessor->setValue('districts_lecturer', 0);
            }

            $lecturers_3_data = Lecturer::where('lecturers_id', $lecturers_id[1])->join('lecturer_types', 'lecturers.lecturer_types_id', 'lecturer_types.lecturer_types_id')->first();
            if ($lecturers_3_data != '') {

                $lecturers_3_prefix = $lecturers_3_data->lecturers_prefix;
                if ($lecturers_3_prefix == 'ผู้ช่วยศาสตร์จารย์') {
                    $lecturers_3_prefix = 'ผศ.';
                }
                $lecturers_3_fname = $lecturers_3_prefix . $lecturers_3_data->lecturers_fname;
                $lecturers_3_lname = $lecturers_3_data->lecturers_lname;
                $templateProcessor->setValue('three_fname', $lecturers_3_fname);
                $templateProcessor->setValue('three_lname', $lecturers_3_lname);
                $cal_lecturers_3 = $lecturers_3_data->lecturer_types_rate * $data['lecturers_hour3'];
                $templateProcessor->setValue('three_cal_lecturers', $cal_lecturers_3);
            } else {
                $templateProcessor->setValue('three_fname', '');
                $templateProcessor->setValue('three_lname', '');
                $templateProcessor->setValue('three_cal_lecturers', '');
                $cal_lecturers_3 = 0;
            }

            $lecturers_4_data = Lecturer::where('lecturers_id', $lecturers_id[2])->join('lecturer_types', 'lecturers.lecturer_types_id', 'lecturer_types.lecturer_types_id')->first();
            if ($lecturers_4_data != '') {
                $lecturers_4_prefix = $lecturers_4_data->lecturers_prefix;
                if ($lecturers_4_prefix == 'ผู้ช่วยศาสตร์จารย์') {
                    $lecturers_4_prefix = 'ผศ.';
                }
                $lecturers_4_fname = $lecturers_4_prefix . $lecturers_4_data->lecturers_fname;
                $lecturers_4_lname = $lecturers_4_data->lecturers_lname;
                $templateProcessor->setValue('four_fname', $lecturers_4_fname);
                $templateProcessor->setValue('four_lname', $lecturers_4_lname);
                $cal_lecturers_4 = $lecturers_4_data->lecturer_types_rate * $data['lecturers_hour4'];
                $templateProcessor->setValue('four_cal_lecturers', $cal_lecturers_4);
            } else {
                $templateProcessor->setValue('four_fname', '');
                $templateProcessor->setValue('four_lname', '');
                $templateProcessor->setValue('four_cal_lecturers', '');
                $cal_lecturers_4 = 0;
            }

            $templateProcessor->setValue('lecturers_count', $lecturers_count);

            $sum_lecturers = $cal_lecturers_1 + $cal_lecturers_2 + $cal_lecturers_3 + $cal_lecturers_4;
            $sum_lecturers_t = $cal_lecturers_1 + $cal_lecturers_2 + $cal_lecturers_3 + $cal_lecturers_4;
            $sum_lecturers = number_format($sum_lecturers, 0, ".", ",");
            $templateProcessor->setValue('sum_lecturers', $sum_lecturers);

            $costs_accommodation_ = number_format($costs_accommodation->costs_rate, 0, ".", ",");
            $templateProcessor->setValue('costs_accommodation', $costs_accommodation_);

            $templateProcessor->setValue('room', $data['costs_accommodation_room']);
            $templateProcessor->setValue('accommodation', $data['costs_accommodation_number']);

            $total_accommodation = $costs_accommodation->costs_rate * $data['costs_accommodation_room'] * $data['costs_accommodation_number'];
            $templateProcessor->setValue('total_accommodation', number_format($total_accommodation, 0, ".", ","));

            $templateProcessor->setValue('costs_lunch_meal', $data['costs_lunch_meal']);
            $templateProcessor->setValue('costs_lunch_people', $data['costs_lunch_people']);
            $lunch = $costs_lunch->costs_rate * $data['costs_lunch_meal'] * $data['costs_lunch_people'];
            $templateProcessor->setValue('lunch', number_format($lunch, 0, ".", ","));
            $templateProcessor->setValue('costs_lunch', number_format($costs_lunch->costs_rate, 0, ".", ","));

            $templateProcessor->setValue('costs_dinner_meal', $data['costs_dinner_meal']);
            $templateProcessor->setValue('costs_dinner_people', $data['costs_dinner_people']);
            $dinner = $costs_dinner->costs_rate * $data['costs_dinner_meal'] * $data['costs_dinner_people'];
            $templateProcessor->setValue('dinner', number_format($dinner, 0, ".", ","));
            $templateProcessor->setValue('costs_dinner', number_format($costs_dinner->costs_rate, 0, ".", ","));

            $templateProcessor->setValue('costs_snack_meal', $data['costs_snack_meal']);
            $templateProcessor->setValue('costs_snack_peopl', $data['costs_snack_peopl']);
            $snack = $costs_snack->costs_rate * $data['costs_snack_meal'] * $data['costs_snack_peopl'];
            $templateProcessor->setValue('snack', number_format($snack, 0, ".", ","));
            $templateProcessor->setValue('costs_snack', number_format($costs_snack->costs_rate, 0, ".", ","));

            $total = $sum_lecturers_t + $districts_head + $districts_lecturer + $lunch + $dinner + $snack + $total_accommodation;
            $templateProcessor->setValue('total', number_format($total, 0, ".", ","));

            $districts = Districts::select('*')->where('districts_id', $document_title->districts_id)->first();
            // $templateProcessor->setImageValue('pic', asset('map/'.$districts->districts_pic));
            $templateProcessor->setImageValue('pic', array('path' => 'C:/xampp/htdocs/octus/public/map/' . $districts->districts_pic, 'width' => 550, 'height' => 400, 'ratio' => false));
            // $templateProcessor->setImageValue('pic', array('path' => asset('map/'.$districts->districts_pic), 'width' => 100, 'height' => 100, 'ratio' => false));
            $templateProcessor->setValue('map', $districts->districts_map);


            $templateProcessor->setValue('districts_name', $districts->districts_name);

            $fileName = 'บันทึกข้อความ';

            $templateProcessor->saveAs($fileName . '.docx');
        } else if ($document_title->document_patterns_id == 2) {

            $templateProcessor = new TemplateProcessor('doc/type2_main/index.docx');
            $templateProcessor->setValue('faculties_name', $document_title->faculties_name);
            $templateProcessor->setValue('districts_faculty_branch', $document_title->districts_faculty_branch);
            $templateProcessor->setValue('faculties_tel', $document_title->faculties_tel);
            $templateProcessor->setValue('document_titles_number_faculties', $document_title->document_titles_number_faculties);
            $templateProcessor->setValue('document_titles_mhesi', $document_title->document_titles_mhesi);
            $templateProcessor->setValue('document_titles_mhesi_date', formatDateThat($document_title->document_titles_date));
            $templateProcessor->setValue('document_titles_date', formatDatemonth($document_title->document_titles_date));
            $templateProcessor->setValue('document_titles_name', $document_title->document_titles_name);
            $templateProcessor->setValue('text_part_one', $data['text_part_1']);
            $templateProcessor->setValue('text_part_two', $data['text_part_2']);
            $templateProcessor->setValue('date_start_part', formatDateThat($data['date_start_part2']));

            // formatDateThat($data['date_end_part2']));

            $templateProcessor->setValue('distance_head', $data['distance_head']);

            $distance_sum = $costs_head->costs_rate * $data['distance_head'] * 2;
            $templateProcessor->setValue('distance_sum', $distance_sum);
            $templateProcessor->setValue('costs_head', $costs_head->costs_rate);
            $templateProcessor->setValue('head_license_plate', $document_title->districts_license_plate);

            $fname = $document_title->districts_prefix . ' ' . $document_title->districts_fname;
            $lname = $document_title->districts_lname;

            $templateProcessor->setValue('fname', $fname);
            $templateProcessor->setValue('lname', $lname);

            $templateProcessor->setValue('costs_lunch_meal', $data['costs_lunch_meal']);
            $templateProcessor->setValue('costs_lunch_people', $data['costs_lunch_people']);
            $lunch = $costs_lunch->costs_rate * $data['costs_lunch_meal'] * $data['costs_lunch_people'];
            $templateProcessor->setValue('lunch', number_format($lunch, 0, ".", ","));
            $templateProcessor->setValue('costs_lunch', number_format($costs_lunch->costs_rate, 0, ".", ","));

            $total = 7800 + $distance_sum + $lunch;

            $total_string = convertAmountToLetter($total);

            $templateProcessor->setValue('total_string', $total_string);
            $templateProcessor->setValue('total', number_format($total, 0, ".", ","));
            $templateProcessor->setValue('districts_name', $document_title->districts_name);


            $fileName = 'บันทึกข้อความ';

            $templateProcessor->saveAs($fileName . '.docx');

        } else if ($document_title->document_patterns_id == 3) {

            $templateProcessor = new TemplateProcessor('doc/type2_sub/index.docx');
            $templateProcessor->setValue('faculties_name', $document_title->faculties_name);
            $templateProcessor->setValue('districts_faculty_branch', $document_title->districts_faculty_branch);
            $templateProcessor->setValue('faculties_tel', $document_title->faculties_tel);
            $templateProcessor->setValue('document_titles_number_faculties', $document_title->document_titles_number_faculties);
            $templateProcessor->setValue('document_titles_mhesi', $document_title->document_titles_mhesi);
            $templateProcessor->setValue('document_titles_mhesi_date', formatDateThat($document_title->document_titles_date));
            $templateProcessor->setValue('document_titles_date', formatDatemonth($document_title->document_titles_date));
            $templateProcessor->setValue('document_titles_name', $document_title->document_titles_name);
            $templateProcessor->setValue('text_part_one', $data['text_part_1']);
            $templateProcessor->setValue('text_part_two', $data['text_part_2']);
            $templateProcessor->setValue('date_start_part', formatDateThat($data['date_start_part2']));

            $templateProcessor->setValue('distance_head', $data['distance_head']);

            $distance_sum = $costs_head->costs_rate * $data['distance_head'] * 2;
            $templateProcessor->setValue('distance_sum', $distance_sum);
            $templateProcessor->setValue('costs_head', $costs_head->costs_rate);

            $templateProcessor->setValue('head_license_plate', $document_title->districts_license_plate);

            $fname = $document_title->districts_prefix . ' ' . $document_title->districts_fname;
            $lname = $document_title->districts_lname;

            $templateProcessor->setValue('fname', $fname);
            $templateProcessor->setValue('lname', $lname);

            $templateProcessor->setValue('costs_dinner_meal', $data['costs_dinner_meal']);
            $templateProcessor->setValue('costs_dinner_people', $data['costs_dinner_people']);
            $templateProcessor->setValue('costs_dinner', $costs_dinner->costs_rate);
            $costs_dinner_total = $costs_dinner->costs_rate * $data['costs_dinner_meal'] * $data['costs_dinner_people'];
            $templateProcessor->setValue('costs_dinner_total', number_format($costs_dinner_total, 0, ".", ","));

            $total = 3300 + $distance_sum + $costs_dinner_total;

            $total_string = convertAmountToLetter($total);

            $templateProcessor->setValue('total_string', $total_string);
            $templateProcessor->setValue('total', number_format($total, 0, ".", ","));
            $templateProcessor->setValue('districts_name', $document_title->districts_name);
            $fileName = 'บันทึกข้อความ';

            $templateProcessor->saveAs($fileName . '.docx');
        }

        else if ($document_title->document_patterns_id == 4) {

            $templateProcessor = new TemplateProcessor('doc/type2_connect/index.docx');
            $templateProcessor->setValue('faculties_name', $document_title->faculties_name);
            $templateProcessor->setValue('districts_faculty_branch', $document_title->districts_faculty_branch);
            $templateProcessor->setValue('faculties_tel', $document_title->faculties_tel);
            $templateProcessor->setValue('document_titles_number_faculties', $document_title->document_titles_number_faculties);
            $templateProcessor->setValue('document_titles_mhesi', $document_title->document_titles_mhesi);
            $templateProcessor->setValue('document_titles_mhesi_date', formatDateThat($document_title->document_titles_date));
            $templateProcessor->setValue('document_titles_date', formatDatemonth($document_title->document_titles_date));
            $templateProcessor->setValue('document_titles_name', $document_title->document_titles_name);
            $templateProcessor->setValue('text_part_one', $data['text_part_1']);
            $templateProcessor->setValue('text_part_two', $data['text_part_2']);
            $templateProcessor->setValue('date_start_part', formatDateThat($data['date_start_part2']));

            $templateProcessor->setValue('distance_head', $data['distance_head']);

            $distance_sum = $costs_head->costs_rate * $data['distance_head'] * 2;
            $templateProcessor->setValue('distance_sum', $distance_sum);
            $templateProcessor->setValue('costs_head', $costs_head->costs_rate);

            $templateProcessor->setValue('head_license_plate', $document_title->districts_license_plate);

            $fname = $document_title->districts_prefix . ' ' . $document_title->districts_fname;
            $lname = $document_title->districts_lname;

            $templateProcessor->setValue('fname', $fname);
            $templateProcessor->setValue('lname', $lname);

            $templateProcessor->setValue('costs_allowance', $data['costs_allowance']);
            $total_costs_allowance =  $data['costs_allowance'] * 240;
            $templateProcessor->setValue('total_costs_allowance', number_format($total_costs_allowance, 0, ".", ","));

            $total =$distance_sum + $total_costs_allowance;

            $total_string = convertAmountToLetter($total);

            $templateProcessor->setValue('total_string', $total_string);
            $templateProcessor->setValue('total', number_format($total, 0, ".", ","));
            $templateProcessor->setValue('districts_name', $document_title->districts_name);
            $fileName = 'บันทึกข้อความ';

            $templateProcessor->saveAs($fileName . '.docx');
        }

        if ($document_title->document_patterns_id == 1) {
            $update = Document_title::find($id);
            $update->text_part1 = $data['text_part_1'];
            $update->text_part2 = $data['text_part_2'];
            $update->text_part3 = $data['text_part_3'];
            $update->date_start_part2 = $data['date_start_part2'];
            $update->date_end_part2 = $data['date_end_part2'];

            $update->distance_lecturer_1_part2 = $data['distance_head'];
            $update->hour_lecturer_1_part2 = $data['lecturers_hour1'];

            $update->lecturer_2_part2 = $lecturers_id[0];
            $update->distance_lecturer_2_part2 = $data['distance_lecturer'];
            $update->hour_lecturer_2_part2 = $data['lecturers_hour2'];

            $update->lecturer_3_part2 = $lecturers_id[1];
            $update->hour_lecturer_3_part2 = $data['lecturers_hour3'];

            $update->lecturer_4_part2 = $lecturers_id[2];
            $update->hour_lecturer_4_part2 = $data['lecturers_hour4'];

            $update->costs_lunch_meal = $data['costs_lunch_meal'];
            $update->costs_lunch_people = $data['costs_lunch_people'];
            $update->costs_dinner_meal = $data['costs_dinner_meal'];
            $update->costs_dinner_people = $data['costs_dinner_people'];
            $update->costs_snack_meal = $data['costs_snack_meal'];
            $update->costs_snack_peopl = $data['costs_snack_peopl'];
            $update->costs_accommodation_room = $data['costs_accommodation_room'];
            $update->costs_accommodation_number = $data['costs_accommodation_number'];

            $update->save();
        } else if ($document_title->document_patterns_id == 2) {
            $update = Document_title::find($id);
            $update->text_part1 = $data['text_part_1'];
            $update->text_part2 = $data['text_part_2'];
            // $update->text_part3 = $data['text_part_3'];
            $update->date_start_part2 = $data['date_start_part2'];
            // $update->date_end_part2 = $data['date_end_part2'];

            $update->distance_lecturer_1_part2 = $data['distance_head'];
            // $update->hour_lecturer_1_part2 = $data['lecturers_hour1'];

            $update->costs_lunch_meal = $data['costs_lunch_meal'];
            $update->costs_lunch_people = $data['costs_lunch_people'];

            $update->save();
        } else if ($document_title->document_patterns_id == 3) {
            $update = Document_title::find($id);
            $update->text_part1 = $data['text_part_1'];
            $update->text_part2 = $data['text_part_2'];
            // $update->text_part3 = $data['text_part_3'];
            $update->date_start_part2 = $data['date_start_part2'];
            // $update->date_end_part2 = $data['date_end_part2'];

            $update->distance_lecturer_1_part2 = $data['distance_head'];
            // $update->hour_lecturer_1_part2 = $data['lecturers_hour1'];

            $update->costs_dinner_meal = $data['costs_dinner_meal'];
            $update->costs_dinner_people = $data['costs_dinner_people'];

            $update->save();
        }

        else if ($document_title->document_patterns_id == 4) {
            $update = Document_title::find($id);
            $update->text_part1 = $data['text_part_1'];
            $update->text_part2 = $data['text_part_2'];
           
            $update->date_start_part2 = $data['date_start_part2'];
        

            $update->distance_lecturer_1_part2 = $data['distance_head'];
           

            $update->costs_allowance = $data['costs_allowance'];
            

            $update->save();
        }
        if ($request->action == 'พิมพ์/ดูตัวอย่างเอกสาร') {
            return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
        } else {
            $update = Document_title::find($id);
            $update->document_titles_status_within = 2; //พี่จอย หรือ อ. ตรวจสอบเอกสาร
            $update->save();

            return redirect('document/make');
        }

    }

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
}
