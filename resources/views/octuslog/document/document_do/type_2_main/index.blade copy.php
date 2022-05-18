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
                                        class="h3">ส่วนราชการ</span>&nbsp&nbsp{{$document_title->faculties_name }}&nbsp&nbsp{{$document_title->faculties_name }}&nbsp&nbsp{{$document_title->districts_faculty_branch }}&nbsp&nbspโทร.{{$document_title->faculties_tel }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text">
                                    <span
                                        class="h3">ที่</span>&nbsp&nbsp{{$document_title->document_titles_mhesi}}&nbsp&nbsp<span
                                        class="h3">วันที่</span>&nbsp&nbsp{{formatDatemonth( $document_title->document_titles_date)  }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text">
                                    <span class="h3">เรื่อง</span>&nbsp&nbsp{{$document_title->document_titles_name }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text">
                                    <span class="h3">เรียน</span>&nbsp&nbspคณบดี{{$document_title->faculties_name }}
                                </div>
                            </div>
                            <hr>

                            <form action="" method="post">
                                <span class="h3">ส่วนที่ 1</span>
                                <textarea class="form-control mt-3 mb-3" id="text_part_1" name="text_part_1" rows="5"
                                    placeholder="ส่วนที่ 1...">ตามบันทึกข้อความสถานบันถ่ายทอดเทคโนโลยีสู่ชุมชน&nbsp&nbspที่&nbsp&nbsp{{$document_title->document_titles_mhesi}}&nbsp&nbspลงวันที่&nbsp&nbsp{{formatDateThat(Carbon\Carbon::now())}}&nbsp&nbspอนุมัติโครงการและงบประมาณสำหรับการดำเนินโครงการยกระดับเศรษฐกิจและสังคมรายตำบลแบบบูรณาการ&nbsp&nbspมทร.ล้านนา&nbsp&nbspความละอียดทราบแล้วนั้น</textarea>
                                <span class="h3">ส่วนที่ 2</span>
                                <textarea class="form-control mt-3 mb-3" id="text_part_2" name="text_part_2" rows="3"
                                    placeholder="ส่วนที่ 2...">ในการนี้โครงการยกระดับเศรษฐกิจและสังคมรายตำบลแบบบูรณาการ&nbsp&nbsp{{$document_title->districts_name}}&nbsp&nbspขออนุญาตเดินทางไปราชการเพื่อจัดกิจกรรมสร้างความเข้าใจโครงการฯ&nbsp&nbspโดยมีผู้เดินทางไปราชการครั้วนี้ระหว่างวันที่</textarea>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        จาก <input type="date" class="form-control">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        ถึง <input type="date" class="form-control">
                                    </div>
                                </div>
                                <br>
                                โดย
                                <ol>
                                    <li>
                                        <div class="row">
                                            <div class="col-6">
                                                <select name="lecturers_id[]" id="lecturers_id" required
                                                    class="form-control">
                                                    <option value="">กรุณาเลือกหัวหน้าโครงการ</option>
                                                    @foreach ($lecturers as $item)
                                                    <option value="{{$item->lecturers_id}}">{{$item->lecturers_fname}}
                                                        {{$item->lecturers_lname}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2">
                                              <input type="number" class="form-control" placeholder="จำนวนชั่วโมง" min="0">
                                            </div>
                                            <div class="col-4">
                                                <span class="center p-2">หัวหน้าโครงการ / ใช้ในการเบิกค่าใช้จ่าย</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-6">
                                                <select name="lecturers_id[]" id="lecturers_id" class="form-control">
                                                    <option value="">กรุณาเลือกวิทยากร</option>
                                                    @foreach ($lecturers as $item)
                                                    <option value="{{$item->lecturers_id}}">{{$item->lecturers_fname}}
                                                        {{$item->lecturers_lname}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-2">
                                                <input type="number" class="form-control" placeholder="จำนวนชั่วโมง" min="0"s>
                                              </div>
                                            <div class="col-4">
                                                <span class="center p-2">วิทยากร / ใช้ในการเบิกค่าใช้จ่าย</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-6">
                                                <select name="lecturers_id[]" id="lecturers_id" class="form-control">
                                                    <option value="">กรุณาเลือกวิทยากร</option>
                                                    @foreach ($lecturers as $item)
                                                    <option value="{{$item->lecturers_id}}">{{$item->lecturers_fname}}
                                                        {{$item->lecturers_lname}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <input type="number" class="form-control" placeholder="จำนวนชั่วโมง" min="0">
                                              </div>
                                            <div class="col-4">
                                                <span class="center p-2">วิทยากร</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-6">
                                                <select name="lecturers_id[]" id="lecturers_id" class="form-control">
                                                    <option value="">กรุณาเลือกวิทยากร</option>
                                                    @foreach ($lecturers as $item)
                                                    <option value="{{$item->lecturers_id}}">{{$item->lecturers_fname}}
                                                        {{$item->lecturers_lname}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <input type="number" class="form-control" placeholder="จำนวนชั่วโมง" min="0">
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
                                    placeholder="ส่วนที่ 3...">โดยขอเบิกค่าใช้จ่ายในการเดินทางไปราชการในครั้งนี้ตามสิทธิ์&nbsp&nbspดั้งต่อไปนี้</textarea>
                                <h4>ส่วนของอาหาร</h4>
                                <ol>
                                    <li>
                                        <div class="row p-1">
                                            <div class="col-6">
                                                <select name="costs[]" id="costs1" required class="form-control">
                                                    <option value="">กรุณาเลือกค่าใช่จ่าย</option>
                                                    @foreach ($costs as $item)
                                                    <option value="{{$item->costs_id}}"
                                                        data-rate="{{$item->costs_rate}}">{{$item->costs_name}} :
                                                        {{$item->costs_rate}} บาท</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <input type="number" name="rate[]" id="rate1" class="form-control"
                                                    min="1" value="0" style="text-align: right">
                                            </div>
                                            <div class="col-3">
                                                <input type="number" id="total1" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </li>
                                </ol>
                                <ol>
                                    <li>
                                        <div class="row p-1">
                                            <div class="col-6">
                                                <select name="costs[]" id="costs1" required class="form-control">
                                                    <option value="">กรุณาเลือกค่าใช่จ่าย</option>
                                                    @foreach ($costs as $item)
                                                    <option value="{{$item->costs_id}}"
                                                        data-rate="{{$item->costs_rate}}">{{$item->costs_name}} :
                                                        {{$item->costs_rate}} บาท</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <input type="number" name="rate[]" id="rate1" class="form-control"
                                                    min="1" value="0" style="text-align: right">
                                            </div>
                                            <div class="col-3">
                                                <input type="number" id="total1" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row p-1">
                                            <div class="col-6">
                                                <select name="costs[]" id="costs2" required class="form-control">
                                                    <option value="">กรุณาเลือกค่าใช่จ่าย</option>
                                                    @foreach ($costs as $item)
                                                    <option value="{{$item->costs_id}}">{{$item->costs_name}} :
                                                        {{$item->costs_rate}} บาท</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <input type="number" name="rate[]" id="rate2" class="form-control"
                                                    min="1" value="0" style="text-align: right">
                                            </div>
                                            <div class="col-3">
                                                <input type="number" id="total2" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row p-1">
                                            <div class="col-6">
                                                <select name="costs[]" id="costs3" required class="form-control">
                                                    <option value="">กรุณาเลือกค่าใช่จ่าย</option>
                                                    @foreach ($costs as $item)
                                                    <option value="{{$item->costs_id}}">{{$item->costs_name}} :
                                                        {{$item->costs_rate}} บาท</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <input type="number" name="rate[]" id="rate3" class="form-control"
                                                    min="1" value="0" style="text-align: right">
                                            </div>
                                            <div class="col-3">
                                                <input type="number" id="total3" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row p-1">
                                            <div class="col-6">
                                                <select name="costs[]" id="costs4" required class="form-control">
                                                    <option value="">กรุณาเลือกค่าใช่จ่าย</option>
                                                    @foreach ($costs as $item)
                                                    <option value="{{$item->costs_id}}">{{$item->costs_name}} :
                                                        {{$item->costs_rate}} บาท</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <input type="number" name="rate[]" id="rate4" class="form-control"
                                                    min="1" value="0" style="text-align: right">
                                            </div>
                                            <div class="col-3">
                                                <input type="number" id="total4" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row p-1">
                                            <div class="col-6">
                                                <select name="costs[]" id="costs5" required class="form-control">
                                                    <option value="">กรุณาเลือกค่าใช่จ่าย</option>
                                                    @foreach ($costs as $item)
                                                    <option value="{{$item->costs_id}}">{{$item->costs_name}} :
                                                        {{$item->costs_rate}} บาท</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <input type="number" name="rate[]" id="rate5" class="form-control"
                                                    min="1" value="0" style="text-align: right">
                                            </div>
                                            <div class="col-3">
                                                <input type="number" id="total5" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row p-1">
                                            <div class="col-6">
                                                <select name="costs[]" id="costs6" required class="form-control">
                                                    <option value="">กรุณาเลือกค่าใช่จ่าย</option>
                                                    @foreach ($costs as $item)
                                                    <option value="{{$item->costs_id}}">{{$item->costs_name}} :
                                                        {{$item->costs_rate}} บาท</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <input type="number" name="rate[]" id="rate6" class="form-control"
                                                    min="1" value="0" style="text-align: right">
                                            </div>
                                            <div class="col-3">
                                                <input type="number" id="total6" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row p-1">
                                            <div class="col-6">
                                                <select name="costs[]" id="costs7" required class="form-control">
                                                    <option value="">กรุณาเลือกค่าใช่จ่าย</option>
                                                    @foreach ($costs as $item)
                                                    <option value="{{$item->costs_id}}">{{$item->costs_name}} :
                                                        {{$item->costs_rate}} บาท</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <input type="number" name="rate[]" id="rate7" class="form-control"
                                                    min="1" value="0" style="text-align: right">
                                            </div>
                                            <div class="col-3">
                                                <input type="number" id="total7" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </li>
                                </ol>
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

        $("#costs1").change(function () {
            let rate = $(this).find(':selected').attr('data-rate')
            let rate = $(this).find(':selected').attr('data-rate')
            console.log(this.value);

        });

    </script>

    @endsection
