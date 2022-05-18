@extends('dashboard.base')

@section('content')



<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12col-xl-12  ">
                <div class="card">
                    <div class="card-header">


                        
                        <center>
                            <h3>บันทึกข้อคความเรื่อง : {{$document_title->document_titles_name}}</h3>
                        </center>
                        <div class="card-body">
                            <div class="row">
                                <div class="col text">
                                    <span
                                        class="h3">ส่วนราชการ</span>&nbsp;{{$document_title->faculties_name }}&nbsp;{{$document_title->faculties_name }}&nbsp;{{$document_title->districts_faculty_branch }}&nbsp;โทร.{{$document_title->faculties_tel }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text">
                                    <span
                                        class="h3">ที่</span>&nbsp;{{$document_title->document_titles_mhesi}}&nbsp;<span
                                        class="h3">วันที่</span>&nbsp;{{formatDatemonth( $document_title->document_titles_date)  }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text">
                                    <span class="h3">เรื่อง</span>&nbsp;{{$document_title->document_titles_name }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text">
                                    <span class="h3">เรียน</span>&nbsp;คณบดี{{$document_title->faculties_name }}
                                </div>
                            </div>
                            <hr>

                            <form action="type_1" method="post" id="myFormId">
                                <span class="h3">ส่วนที่ 1</span>
                                <textarea class="form-control mt-3 mb-3" id="text_part_1" name="text_part_1" rows="3" cols='30'
                                    placeholder="ส่วนที่ 1...">ตามบันทึกข้อความสถานบันถ่ายทอดเทคโนโลยีสู่ชุมชน&nbsp;ที่&nbsp;{{$document_title->document_titles_number_faculties}}&nbsp;ลงวันที่&nbsp;{{formatDateThat($document_title->document_titles_mhesi_date)}}&nbsp;อนุมัติโครงการและงบประมาณสำหรับการดำเนินโครงการยกระดับเศรษฐกิจและสังคมรายตำบลแบบบูรณาการ&nbsp;มทร.ล้านนา&nbsp;ความละอียดทราบแล้วนั้น</textarea>
                                <span class="h3">ส่วนที่ 2</span>
                                <textarea class="form-control mt-3 mb-3" id="text_part_2" name="text_part_2" rows="3"
                                    placeholder="ส่วนที่ 2...">ในการนี้ โครงการยกระดับเศรษฐกิจและสังคมรายตำบลแบบบูรณาการ&nbsp;{{$document_title->districts_name}}&nbsp;ขออนุญาตเดินทางไปราชการเพื่อจัดกิจกรรมสร้างความเข้าใจโครงการฯ&nbsp;โดยมีผู้เดินทางไปราชการครั้งนี้ระหว่างวันที่</textarea>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        จาก <input type="date" class="form-control" id="date_start_part2" name="date_start_part2" required value="{{$document_title->date_start_part2}}"> 
                                    </div>
                                    <div class="col-12 col-md-6">
                                        ถึง <input type="date" class="form-control" id="date_end_part2" name="date_end_part2" required value="{{$document_title->date_end_part2}}">
                                    </div>
                                </div>
                                <br>
                                โดย
                                <ol>
                                    <div class="row p-1">
                                        <div class="col-6">
                                            <center>ชื่อ - นามสกุล</center>
                                        </div>
                                        <div class="col-2">
                                            <center>จำนวนชั่วโมงในการอบรม</center>
                                        </div>
                                        <div class="col-4">
                                       
                                        </div>
                                    </div>
                                   
                                    <li>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" name="lecturers_id[]" id="lecturers_id1"
                                                    class="form-control" disabled
                                                    data-rate="{{$lecturers_type->lecturer_types_rate}}" required
                                                    value="{{$document_title->districts_fname}} {{$document_title->districts_lname}}">
                                            </div>
                                            <div class="col-2">
                                                <input type="number" class="form-control" id="lecturers_hour1"
                                                    name="lecturers_hour1" placeholder="จำนวนชั่วโมง" min="0" value="{{$document_title->hour_lecturer_1_part2}}" required
                                                    style="text-align: right" required>
                                            </div>
                                            <div class="col-4">
                                                <span class="center p-2">หัวหน้าโครงการ / ใช้ในการเบิกค่าใช้จ่าย</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-6">
                                                <select name="lecturers_id[]" id="lecturers_id2" class="form-control">
                                                    <option value="">กรุณาเลือกวิทยากร</option>
                                                    @foreach ($lecturers as $item)
                                                    <option value="{{$item->lecturers_id}}" @if ($document_title->lecturer_2_part2 == $item->lecturers_id)
                                                        selected 
                                                    @endif
                                                        data-rate="{{$item->lecturer_types_rate}}">
                                                        {{$item->lecturers_fname}}
                                                        {{$item->lecturers_lname}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-2">
                                                <input type="number" class="form-control" id="lecturers_hour2"
                                                    name="lecturers_hour2" placeholder="จำนวนชั่วโมง" min="0" value="{{$document_title->hour_lecturer_2_part2}}"
                                                    style="text-align: right">
                                            </div>
                                            <div class="col-4">
                                                <span class="center p-2">วิทยากร / ใช้ในการเบิกค่าใช้จ่าย</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-6">
                                                <select name="lecturers_id[]" id="lecturers_id3" class="form-control">
                                                    <option value="">กรุณาเลือกวิทยากร</option>
                                                    @foreach ($lecturers as $item)
                                                    <option value="{{$item->lecturers_id}}"  @if ($document_title->lecturer_3_part2 == $item->lecturers_id)
                                                        selected 
                                                    @endif
                                                        data-rate="{{$item->lecturer_types_rate}}">
                                                        {{$item->lecturers_fname}}
                                                        {{$item->lecturers_lname}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <input type="number" class="form-control" id="lecturers_hour3"
                                                    name="lecturers_hour3" placeholder="จำนวนชั่วโมง" min="0" value="{{$document_title->hour_lecturer_3_part2}}"
                                                    style="text-align: right">
                                            </div>
                                            <div class="col-4">
                                                <span class="center p-2">วิทยากร</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-6">
                                                <select name="lecturers_id[]" id="lecturers_id4" class="form-control">
                                                    <option value="">กรุณาเลือกวิทยากร</option>
                                                    @foreach ($lecturers as $item)
                                                    <option value="{{$item->lecturers_id}}"  @if ($document_title->lecturer_4_part2 == $item->lecturers_id)
                                                        selected 
                                                    @endif
                                                        data-rate="{{$item->lecturer_types_rate}}">
                                                        {{$item->lecturers_fname}}
                                                        {{$item->lecturers_lname}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <input type="number" id="lecturers_hour4" name="lecturers_hour4"
                                                    class="form-control" placeholder="จำนวนชั่วโมง" min="0" value="{{$document_title->hour_lecturer_4_part2}}"
                                                    style="text-align: right">
                                            </div>
                                            <div class="col-4">
                                                <span class="center p-2">วิทยากร</span>
                                            </div>
                                        </div>
                                    </li>
                                </ol>
                                <br>

                                <span class="h3">ส่วนที่ 3</span>
                                <textarea class="form-control mt-3 mb-3" id="text_part_3" name="text_part_3" rows="3"
                                    placeholder="ส่วนที่ 3...">โดยขอเบิกค่าใช้จ่ายในการเดินทางไปราชการในครั้งนี้ตามสิทธิ์&nbsp;ดั้งต่อไปนี้</textarea>

                                <ol>
                                    <h4>ส่วนของค่าตอบแทนและค่าชดเชย</h4>
                                    <div class="row p-1">
                                        <div class="col-6">
                                            <center>รายการ</center>
                                        </div>
                                        <div class="col-3">
                                            <center>จำนวนระยะทาง(กิโลเมตร)</center>
                                        </div>
                                        <div class="col-3">
                                            <center>จำนวนเงิน(บาท)</center>
                                        </div>
                                    </div>
                                    <li>
                                        <div class="row p-1">
                                            <div class="col-6">
                                                <input type="text" value="ค่าตอบแทนวิทยากรทั้งหมด" class="form-control"
                                                    disabled>
                                            </div>
                                            <div class="col-3">

                                            </div>
                                            <div class="col-3">
                                                <input type="number" id="lecturers_total" name="lecturers_total"
                                                    value="0" class="form-control" disabled style="text-align: right">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row p-1">
                                            <div class="col-6">
                                                <input type="text" value="ค่าชดเชยพยานพาหนะส่วนบุคคล (หัวหน้าโครงการ)"
                                                    class="form-control" disabled>
                                                <span>&emsp;&emsp;{{$document_title->districts_license_plate}}</span>
                                            </div>
                                            <div class="col-3">
                                                <input type="number" id="distance_head" name="distance_head" value="{{$document_title->districts_distance}}"
                                                    class="form-control" style="text-align: right" min="0">
                                            </div>
                                            <div class="col-3">
                                                <input type="number" id="vehicle_head" name="vehicle_head" value="0"
                                                    class="form-control" disabled style="text-align: right">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row p-1">
                                            <div class="col-6">
                                                <input type="text" value="ค่าชดเชยพยานพาหนะส่วนบุคคล (วิทยากร)"
                                                    class="form-control" disabled>
                                                <span id="show_lecturers_license_plate"> </span>
                                            </div>
                                            <div class="col-3">
                                                <input type="number" id="distance_lecturer" name="distance_lecturer"
                                                    value="{{$document_title->districts_distance}}" class="form-control" style="text-align: right" min="0">
                                            </div>
                                            <div class="col-3">
                                                <input type="number" id="vehicle_lecturer" name="vehicle_lecturer"
                                                    value="0" class="form-control" disabled style="text-align: right">
                                            </div>
                                        </div>
                                    </li>
                                    <h4>ส่วนของค่าอาหาร</h4>
                                    <div class="row p-1">
                                        <div class="col-6">
                                            <center>รายการ</center>
                                        </div>
                                        <div class="col-2">
                                            <center>จำนวนมื้อ</center>
                                        </div>
                                        <div class="col-2">
                                            <center>จำนวนคน</center>
                                        </div>
                                        <div class="col-2">
                                            <center>จำนวนเงิน(บาท)</center>
                                        </div>
                                    </div>
                                    <li>
                                        <div class="row p-1">
                                            <div class="col-6">
                                                <input type="text" value="ค่าอาหารกลางวัน" class="form-control"
                                                    disabled>
                                            </div>
                                            <div class="col-2">
                                                <input type="number" id="costs_lunch_meal" name="costs_lunch_meal" 
                                                    value="{{$document_title->costs_lunch_meal}}" class="form-control" style="text-align: right" min="0">
                                            </div>
                                            <div class="col-2">
                                                <input type="number" id="costs_lunch_people" name="costs_lunch_people"
                                                    value="{{$document_title->costs_lunch_people}}" class="form-control" style="text-align: right" min="0">
                                            </div>
                                            <div class="col-2">
                                                <input type="number" id="costs_lunch_total" name="costs_lunch_total"
                                                    value="0" class="form-control" disabled style="text-align: right">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row p-1">
                                            <div class="col-6">
                                                <input type="text" value="ค่าอาหารเย็น" class="form-control" disabled>
                                            </div>
                                            <div class="col-2">
                                                <input type="number" id="costs_dinner_meal" name="costs_dinner_meal"
                                                    value="{{$document_title->costs_dinner_meal}}" class="form-control" style="text-align: right" min="0">
                                            </div>
                                            <div class="col-2">
                                                <input type="number" id="costs_dinner_people" name="costs_dinner_people"
                                                    value="{{$document_title->costs_dinner_people}}" class="form-control" style="text-align: right" min="0">
                                            </div>
                                            <div class="col-2">
                                                <input type="number" id="costs_dinner_total" name="costs_dinner_total"
                                                    value="0" class="form-control" disabled style="text-align: right">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row p-1">
                                            <div class="col-6">
                                                <input type="text" value="ค่าอาหารว่างและเครื่องดื่ม"
                                                    class="form-control" disabled>
                                            </div>
                                            <div class="col-2">
                                                <input type="number" id="costs_snack_meal" name="costs_snack_meal"
                                                    value="{{$document_title->costs_snack_meal}}" class="form-control" style="text-align: right" min="0">
                                            </div>
                                            <div class="col-2">
                                                <input type="number" id="costs_snack_peopl" name="costs_snack_peopl"
                                                    value="{{$document_title->costs_snack_peopl}}" class="form-control" style="text-align: right" min="0">
                                            </div>
                                            <div class="col-2">
                                                <input type="number" id="costs_snack_total" name="costs_snack_total"
                                                    value="0" class="form-control" disabled style="text-align: right">
                                            </div>
                                        </div>
                                    </li>
                                    <h4>ส่วนของค่าที่พัก</h4>
                                    <div class="row p-1">
                                        <div class="col-6">
                                            <center>รายการ</center>
                                        </div>
                                        <div class="col-2">
                                            <center>จำนวนห้อง</center>
                                        </div>
                                        <div class="col-2">
                                            <center>จำนวนคืนที่พัก</center>
                                        </div>
                                        <div class="col-2">
                                            <center>จำนวนเงิน(บาท)</center>
                                        </div>
                                    </div>
                                    <li>
                                        <div class="row p-1">
                                            <div class="col-6">
                                                <input type="text" value="ค่าที่พัก"
                                                    class="form-control" disabled>
                                            </div>
                                            <div class="col-2">
                                                <input type="number" id="costs_accommodation_room" name="costs_accommodation_room"
                                                    value="{{$document_title->costs_accommodation_room}}" class="form-control" style="text-align: right" min="0">
                                            </div>
                                            <div class="col-2">
                                                <input type="number" id="costs_accommodation_number" name="costs_accommodation_number"
                                                    value="{{$document_title->costs_accommodation_number}}" class="form-control" style="text-align: right" min="0">
                                            </div>
                                            <div class="col-2">
                                                <input type="number" id="costs_accommodation_total" name="costs_accommodation_total"
                                                    value="0" class="form-control" disabled style="text-align: right">
                                            </div>
                                        </div>
                                    </li>
                                    {{-- <h4>ส่วนของค่าถ่ายเอกสาร</h4>
                                    <div class="row p-1">
                                        <div class="col-6">
                                        <center>รายการ</center>
                                        </div>
                                        <div class="col-3">
                                        <center>ราคา</center>
                                        </div>
                                        <div class="col-3">
                                            จำนวนเงิน(บาท)
                                        </div>
                                    </div>
                                    <li>
                                        <div class="row p-1">
                                            <div class="col-6">
                                                <input type="text" value="ค่าถ่ายเอกสาร"
                                                    class="form-control" disabled>
                                            </div>
                                            <div class="col-3">
                                                <input type="number" id="costs_paper" name="costs_paper"
                                                value="0" class="form-control" style="text-align: right" min="0">
                                            </div>
                                            <div class="col-3">
                                                <input type="number" id="costs_paper_total" name="costs_paper_total"
                                                    value="0" class="form-control" disabled style="text-align: right">
                                            </div>
                                        </div>
                                    </li>
                                    <h4>ส่วนของค่าวัสดุสำนักงาน</h4>
                                    <div class="row p-1">
                                        <div class="col-6">
                                        <center>รายการ</center>
                                        </div>
                                        <div class="col-3">
                                        <center>ราคา</center>
                                        </div>
                                        <div class="col-3">
                                            จำนวนเงิน(บาท)
                                        </div>
                                    </div>
                                    <li>
                                        <div class="row p-1">
                                            <div class="col-6">
                                                <input type="text" value="ค่าวัสดุสำนักงาน"
                                                    class="form-control" disabled>
                                            </div>
                                            <div class="col-3">
                                                <input type="number" id="costs_office_material" name="costs_office_material"
                                                value="0" class="form-control" style="text-align: right" min="0">
                                            </div>
                                            <div class="col-3">
                                                <input type="number" id="costs_office_material_total" name="costs_office_material_total"
                                                    value="0" class="form-control" disabled style="text-align: right">
                                            </div>
                                        </div>
                                    </li>
                                    <h4>ส่วนของค่าวัสดุสิ้นเปลือง</h4>
                                    <div class="row p-1">
                                        <div class="col-6">
                                        <center>รายการ</center>
                                        </div>
                                        <div class="col-3">
                                        <center>ราคา</center>
                                        </div>
                                        <div class="col-3">
                                            จำนวนเงิน(บาท)
                                        </div>
                                    </div>
                                    <li>
                                        <div class="row p-1">
                                            <div class="col-6">
                                                <input type="text" value="ค่าวัสดุสำนักงาน"
                                                    class="form-control" disabled>
                                            </div>
                                            <div class="col-3">
                                                <input type="number" id="costs_consumables" name="costs_consumables"
                                                value="0" class="form-control" style="text-align: right" min="0">
                                            </div>
                                            <div class="col-3">
                                                <input type="number" id="costs_consumables_total" name="costs_consumables_total"
                                                    value="0" class="form-control" disabled style="text-align: right">
                                            </div>
                                        </div>
                                    </li> --}}
                                </ol>
                                
                                <input type="hidden" name='title_id' value="{{$id}}">
                                @csrf
                                 <center>   
                                    <input type="submit" name="action" value="พิมพ์/ดูตัวอย่างเอกสาร"  class="btn btn-info"/>
                                    <input type="submit" name="action" value="ยื่นเอกสาร" class="btn btn-success"/ onclick="return confirm('คุณต้องการยื่นเอกสาร  ?')">
                                    
                                 
                                   </center> 
                            </form>

                          


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection


    @section('javascript')
    <script src="{{ asset('js/tooltips.js') }}"></script>
    <script>



$('#date_start_part2').change(function () {
    
    let date_start_part2 = $('#date_start_part2').val();
    let date_end_part2 = $('#date_end_part2').val();

    let text =  $('#text_part_2').val();

    let new_text = text.replace("ระหว่างวันที่", "วันที่");
    if( date_start_part2 ==  date_end_part2){

    }
  
})

$('#date_end_part2').change(function () {
    console.log('asd');
})

let check_id = "{{$document_title->lecturer_2_part2}}";
if( check_id != ''){
                 axios.get('{{URL("lecturers")}}' + '/' + check_id)
                .then(function (response) {
                    $('#show_lecturers_license_plate').text('\xa0\xa0\xa0\xa0\xa0\xa0' + response.data
                        .lecturers_license_plate);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
}
   

        function conn(){

            var queryString = $('#myFormId').serialize();
    axios.post('/confirm', {
    data: queryString
  })
  .then(function (response) {
    console.log(response);
  })
  .catch(function (error) {
    console.log(error);
  });


          
        }
        function btn_view(){
            $.post("type_1", function( data ) {
  
            });
        }
        $(document).ready(function () {
            let table = $('#table').DataTable({
                "ordering": false,
                "language": {
                    "search": "ค้นหา :",
                    "paginate": {
                        "first": "หน้าแรก",
                        "last": "หน้าสุดท้าย",
                        "next": "หน้าถัดไป",
                        "previous": "ก่อนหน้า",

                    },
                    "info": "แสดงข้อมูล _START_ ถึง _END_ จากข้อมูลทั้งหมด _TOTAL_ รายการ",
                    "lengthMenu": "แสดง _MENU_ รายการ",
                    "zeroRecords": "ไม่มีรายการ"
                },
                "columnDefs": [{
                    "targets": ['3', '4'],
                    "searchable": false
                }]

            });



            table.on('order.dt search.dt', function () {
                table.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });

            }).draw();

        
            let distance_head = $('#distance_head').val();
            let rate_distance_head = {{$costs_head->costs_rate}};
            $('#vehicle_head').val(distance_head * rate_distance_head);
        
    
            let distance_lecturer = $('#distance_lecturer').val();
            let rate_distance_lecturer = {{$costs_lecturer->costs_rate}};
            $('#vehicle_lecturer').val(distance_lecturer * rate_distance_lecturer);
    


            $("#lecturers_id1,#lecturers_id2,#lecturers_id3,#lecturers_id4,#lecturers_hour1,#lecturers_hour2,#lecturers_hour3,#lecturers_hour4")
            .change(function () {
                let rate1 = $('#lecturers_id1').attr('data-rate');
                let lecturers_hour1 = $('#lecturers_hour1').val();
                let rate2 = $("#lecturers_id2").find(':selected').attr('data-rate');
                let lecturers_hour2 = $('#lecturers_hour2').val();
                let rate3 = $("#lecturers_id3").find(':selected').attr('data-rate');
                let lecturers_hour3 = $('#lecturers_hour3').val();
                let rate4 = $("#lecturers_id4").find(':selected').attr('data-rate');
                let lecturers_hour4 = $('#lecturers_hour4').val();
                if (typeof rate1 === "undefined") {
                    rate1 = 0;
                }

                if (typeof rate2 === "undefined") {
                    rate2 = 0;
                }

                if (typeof rate3 === "undefined") {
                    rate3 = 0;
                }

                if (typeof rate4 === "undefined") {
                    rate4 = 0;
                }

                let total = (rate1 * lecturers_hour1) + (rate2 * lecturers_hour2) + (rate3 * lecturers_hour3) + (
                    rate4 * lecturers_hour4);
                $('#lecturers_total').val(total);
            }).trigger('change');


            $('#costs_lunch_meal,#costs_lunch_people').change(function () {
            let costs_lunch_meal = $('#costs_lunch_meal').val();
            let costs_lunch_people = $('#costs_lunch_people').val();
            let rate = {{$costs_lunch->costs_rate}};
            $('#costs_lunch_total').val(costs_lunch_meal * costs_lunch_people *rate);
        }).trigger('change');
        $('#costs_dinner_meal,#costs_dinner_people').change(function () {
            let costs_dinner_meal = $('#costs_dinner_meal').val();
            let costs_dinner_people = $('#costs_dinner_people').val();
            let rate = {{$costs_dinner->costs_rate}};
            $('#costs_dinner_total').val(costs_dinner_meal * costs_dinner_people *rate);
        }).trigger('change');
        $('#costs_snack_meal,#costs_snack_peopl').change(function () {
            let costs_snack_meal = $('#costs_snack_meal').val();
            let costs_snack_peopl = $('#costs_snack_peopl').val();
            let rate = {{$costs_snack->costs_rate}};
            $('#costs_snack_total').val(costs_snack_meal * costs_snack_peopl *rate);
        }).trigger('change');

        $('#costs_accommodation_room,#costs_accommodation_number').change(function () {
            let costs_accommodation_room = $('#costs_accommodation_room').val();
            let costs_accommodation_number = $('#costs_accommodation_number').val();
            let rate = {{$costs_accommodation->costs_rate}};
            $('#costs_accommodation_total').val(costs_accommodation_room * costs_accommodation_number *rate);
        }).trigger('change');
        });

        $('#adddata').click(function () {
            $('#ModalLabel').text('เพิ่มข้อมูลวิทยากร');
            $('#form_modal').attr('action', "{{route('lecturers.store')}}");
            $('#lecturers_prefix').val('');
            $('#lecturers_fname').val('');
            $('#lecturers_lname').val('');
            $('#lecturers_tel').val('');
            $('#lecturers_license_plate').val('');
            $('#lecturer_types_id ').val('');
            $('#lecturers_expertise ').val('');
            $('#Modal').modal('show');

        });

        function edit(data) {
            let id = $(data).data("id");
            $('#Modal').modal('show');


            axios.get('{{URL("lecturers/edit")}}' + '/' + id)
                .then(function (response) {

                    $('#ModalLabel').text('แก้ไขข้อมูลวิทยากร');
                    $('#lecturers_prefix').val(response.data.lecturers_prefix);
                    $('#lecturers_fname').val(response.data.lecturers_fname);
                    $('#lecturers_lname').val(response.data.lecturers_lname);
                    $('#lecturers_tel').val(response.data.lecturers_tel);
                    $('#lecturers_license_plate').val(response.data.lecturers_license_plate);
                    $('#lecturer_types_id').val(response.data.lecturer_types_id);
                    $('#lecturers_expertise').val(response.data.lecturers_expertise);
                    $('#btn_submit').text('แก้ไขข้อมูล');
                    $('#form_modal').attr('action', 'lecturers/update/' + id);

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
        }

        $("#lecturers_id1,#lecturers_id2,#lecturers_id3,#lecturers_id4,#lecturers_hour1,#lecturers_hour2,#lecturers_hour3,#lecturers_hour4")
            .change(function () {
                let rate1 = $('#lecturers_id1').attr('data-rate');
                let lecturers_hour1 = $('#lecturers_hour1').val();
                let rate2 = $("#lecturers_id2").find(':selected').attr('data-rate');
                let lecturers_hour2 = $('#lecturers_hour2').val();
                let rate3 = $("#lecturers_id3").find(':selected').attr('data-rate');
                let lecturers_hour3 = $('#lecturers_hour3').val();
                let rate4 = $("#lecturers_id4").find(':selected').attr('data-rate');
                let lecturers_hour4 = $('#lecturers_hour4').val();
                if (typeof rate1 === "undefined") {
                    rate1 = 0;
                }

                if (typeof rate2 === "undefined") {
                    rate2 = 0;
                }

                if (typeof rate3 === "undefined") {
                    rate3 = 0;
                }

                if (typeof rate4 === "undefined") {
                    rate4 = 0;
                }

                let total = (rate1 * lecturers_hour1) + (rate2 * lecturers_hour2) + (rate3 * lecturers_hour3) + (
                    rate4 * lecturers_hour4);
                $('#lecturers_total').val(total);
            });

        $('#lecturers_id2').change(function () {

            let id = $(this).val();
            axios.get('{{URL("lecturers")}}' + '/' + id)
                .then(function (response) {
                    $('#show_lecturers_license_plate').text('\xa0\xa0\xa0\xa0\xa0\xa0' + response.data
                        .lecturers_license_plate);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
        })

        $('#distance_head').change(function () {
            let distance_head = $('#distance_head').val();
            let rate = {{$costs_head->costs_rate}};
            $('#vehicle_head').val(distance_head * rate);
        })
        $('#distance_lecturer').change(function () {
            let distance_lecturer = $('#distance_lecturer').val();
            let rate = {{$costs_lecturer->costs_rate}};
            $('#vehicle_lecturer').val(distance_lecturer * rate);
        })
        $('#costs_lunch_meal,#costs_lunch_people').change(function () {
            let costs_lunch_meal = $('#costs_lunch_meal').val();
            let costs_lunch_people = $('#costs_lunch_people').val();
            let rate = {{$costs_lunch->costs_rate}};
            $('#costs_lunch_total').val(costs_lunch_meal * costs_lunch_people *rate);
        })
        $('#costs_dinner_meal,#costs_dinner_people').change(function () {
            let costs_dinner_meal = $('#costs_dinner_meal').val();
            let costs_dinner_people = $('#costs_dinner_people').val();
            let rate = {{$costs_dinner->costs_rate}};
            $('#costs_dinner_total').val(costs_dinner_meal * costs_dinner_people *rate);
        })
        $('#costs_snack_meal,#costs_snack_peopl').change(function () {
            let costs_snack_meal = $('#costs_snack_meal').val();
            let costs_snack_peopl = $('#costs_snack_peopl').val();
            let rate = {{$costs_snack->costs_rate}};
            $('#costs_snack_total').val(costs_snack_meal * costs_snack_peopl *rate);
        })

        $('#costs_accommodation_room,#costs_accommodation_number').change(function () {
            let costs_accommodation_room = $('#costs_accommodation_room').val();
            let costs_accommodation_number = $('#costs_accommodation_number').val();
            let rate = {{$costs_accommodation->costs_rate}};
            $('#costs_accommodation_total').val(costs_accommodation_room * costs_accommodation_number *rate);
        })


        $('#costs_paper').change(function () {
            $('#costs_paper_total').val(this.value);
        })
        $('#costs_office_material').change(function () {
            $('#costs_office_material_total').val(this.value);
        })
        $('#costs_consumables').change(function () {
            $('#costs_consumables_total').val(this.value);
        })
    </script>

    @endsection
