@extends('dashboard.base')

@section('content')
<link href="{{ asset('mycss/flow.css') }}" rel="stylesheet">
<style>
    .pointer {
        cursor: pointer;
    }

    .dataTables_filter {
        display: none;
    }

    .modal-xl {
        padding-top: 2%;
        max-width: 80% !important;
        margin: auto;
    }

    body {
        background: #f5f3e7;
    }

    .read-only {
        pointer-events: none;
        opacity: 0.3;
    }

</style>

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12col-xl-12  ">
                <div class="card">
                    <div class="card-header">
                        <h4> ติดตามและจัดเก็บไฟล์เอกสาร </h4>
                    </div>
                    <div class="card-body">

                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif


                        <!-- Large modal -->


                        <div class="row align-items-center">
                            <div class="col-12 col-md-7">

                                <button type="button" class="btn btn-primary mb-3" id="adddata">

                                    เพิ่มข้อมูลเอกสาร
                                </button>

                                <button type="button" class="btn btn-warning mb-3" id="download">
                                    รายงานการติดตามเอกสาร
                                </button>

                                <div class="modal fade" id="warningModal" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-warning modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">รายงานการติดตามเอกสาร</h4>
                                                <button class="close" type="button" data-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="recipient-name"
                                                        class="col-form-label">เลือกตำบล:</label>
                                                    <select class="form-control" id="download_districts_id"
                                                        name="download_districts_id">

                                                        <option value="">กรุณาเลือกตำบล</option>
                                                        <option value="all">ทุกตำบล</option>

                                                        @foreach ($districts as $item)
                                                        <option value="{{$item->districts_id}}">
                                                            {{$item->districts_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @php

                                                $data_month =
                                                DB::table("trackings")->select(DB::raw('count(trackings_id) as `data`'),
                                                DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as
                                                monthyear"),)->groupby('monthyear')->orderBy('monthyear','desc')->get();
                                                @endphp

                                                <div class="form-group">
                                                    <label for="recipient-name"
                                                        class="col-form-label">เลือกเดือน:</label>
                                                    <select class="form-control" id="download_month"
                                                        name="download_month">
                                                        <option value="">กรุณาเลือกเดือน</option>
                                                        <option value="all">ทุกช่วงเวลา</option>
                                                        @foreach ($data_month as $item)
                                                        <option value="{{$item->monthyear}}">{{ formatDatemonth("01-".$item->monthyear)}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <center><button class="btn btn-success btn-block" type="button"
                                                            id="btn_download">ดาวน์โหลด</button></center>


                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-dismiss="modal">Close</button>
                                                {{-- <button class="btn btn-warning" type="button">Save changes</button> --}}
                                            </div>
                                        </div>
                                        <!-- /.modal-content-->
                                    </div>
                                    <!-- /.modal-dialog-->
                                </div>



                            </div>
                            <div class="col-12 col-md-5  text-right">

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">


                                            <select class="form-control" id="time" name="time">
                                                <option value="all">ทุกช่วงเวลา</option>
                                                @php
                                                $check_date = '';
                                                @endphp
                                                @foreach ($tracking_date as $item)

                                                @if ($check_date == formatDatemonth($item->created_at))
                                                @else
                                                <option value="{{formatDatemonth($item->created_at)}}">
                                                    {{formatDatemonth($item->created_at)}}
                                                </option>
                                                @endif

                                                @php
                                                $check_date = formatDatemonth($item->created_at);
                                                @endphp
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input-group-prepend">


                                            <select class="form-control" name="type" id="type" required>
                                                <option value="all">ทั้งหมด</option>

                                                <option value="districts">ตำบล</option>
                                                <option value="title">เรื่อง</option>
                                                <option value="mhesi">เลขที่ อว.</option>
                                            </select>
                                        </div>






                                        <input type="text" class="form-control" placeholder="ค้นหาเอกสาร" id="search">

                                    </div>

                                </div>


                            </div>
                        </div>

                        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel"> ติดตามและจัดเก็บไฟล์เอกสาร
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{route('tracking.store')}}" id="form_modal">

                                            @csrf
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">รูปแบบเอกสาร:</label>
                                                <select class="form-control" id="document_patterns_id"
                                                    name="document_patterns_id" required>

                                                    <option value="">กรุณาเลือกรูปแบบเอกสาร</option>

                                                    @foreach ($document_patterns as $item)
                                                    <option value="{{$item->document_patterns_id}}">
                                                        {{$item->document_patterns_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>



                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">ตำบล:</label>
                                                <select class="form-control" id="districts_id" name="districts_id"
                                                    required>

                                                    <option value="">กรุณาเลือกตำบล</option>

                                                    @foreach ($districts as $item)
                                                    <option value="{{$item->districts_id}}">
                                                        {{$item->districts_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">วันที่เอกสารออก
                                                    :</label>
                                                <input class="form-control" id="created_at" type="date"
                                                    name="created_at" required>
                                            </div>


                                            {{-- <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">ลักษณะของเอกสาร
                                                    :</label>
                                                <div class="form-check ml-5">
                                                    <input class="form-check-input" id="checktracking_old" type="radio"
                                                        value="old" name="checktracking" checked>
                                                    <label class="form-check-label">เอกสารเก่า</label>
                                                </div>
                                                <div class="form-check ml-5">
                                                    <input class="form-check-input" id="checktracking_newS" type="radio"
                                                        value="new" name="checktracking">
                                                    <label class="form-check-label">เอกสารใหม่</label>
                                                </div>

                                            </div> --}}

                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">ที่ อว. :</label>
                                                <input type="text" class="form-control" id="trackings_mhesi"
                                                    name="trackings_mhesi" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">ลงวันที่ :</label>
                                                <input class="form-control" id="trackings_mhesi_date" type="month"
                                                    name="trackings_mhesi_date" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">เรื่อง :</label>
                                                <input type="text" class="form-control" id="trackings_name"
                                                    name="trackings_name" required>
                                            </div>



                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">ถึง :</label>
                                                <input class="form-control" id="trackings_to" type="text" value=""
                                                    name="trackings_to" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">รายละเอียด :</label>
                                                <textarea class="form-control" id="trackings_detail" rows="5"
                                                    name="trackings_detail" required></textarea>
                                            </div>


                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">รวมเป็นเงินทั้งสิ้น
                                                    :</label>
                                                <input class="form-control" id="trackings_money" type="number" min="1"
                                                    step="any" maxlength="8" value="0"
                                                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                    name="trackings_money" required>
                                            </div>



                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">ยกเลิก</button>
                                        <button type="submit" class="btn btn-primary"
                                            id="btn_submit">ติดตามและจัดเก็บไฟล์เอกสาร</button>
                                    </div>

                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="trackings_modal" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">สถานะการติดตามเอกสาร</h4>
                                        <button class="close" type="button" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <p></p>
                                        <div id="trackings_rander">
                                            @include('octuslog.tracking.type.type1')
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button"
                                                data-dismiss="modal">Close</button>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-responsive-sm table-striped table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th>ลำดับที่</th>
                                        <th>ตำบล</th>
                                        <th>เลขทะเบียนส่ง</th>
                                        <th>เลขที่ อว.</th>
                                        {{-- <th>ลงวันที่</th> --}}
                                        <th>จาก</th>
                                        <th style="width: 10%"> ถึง</th>
                                        <th style="width: 20%">เรื่อง</th>
                                        <th>การปฎิบัติ</th>
                                        <th style="width: 15%">รายละเอียด</th>
                                        <th>วันที่หนังสือออก</th>
                                        <th>จัดการข้อมูล</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <div id="fetch"> --}}

                                    @foreach ($tracking as $row)

                                    <tr>
                                        <td class="no_number">
                                        </td>
                                        <td>
                                            {{$row->districts_name }}
                                        </td>
                                        <td>
                                            {{$row->districts_initials }}/{{ date('m', strtotime($row->created_at))}}.{{$row->trackings_number }}
                                        </td>
                                        <td>
                                            {{$row->trackings_mhesi }}
                                        </td>

                                        <td>
                                            {{$row->districts_prefix }} {{$row->districts_fname }}
                                            {{$row->districts_lname }}
                                        </td>
                                        <td>
                                            {{-- {{$row->trackings_to }} --}}
                                            <div data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="{{$row->trackings_to}}">
                                                {{ \Illuminate\Support\Str::limit($row->trackings_to, 50, $end='...') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="{{$row->trackings_name}}">
                                                {{ \Illuminate\Support\Str::limit($row->trackings_name, 75, $end='...') }}
                                        </td>

                                        <td>
                                            @include('octuslog.tracking.type.step')
                                        </td>
                                        <td>
                                            <div data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="{{$row->trackings_detail}}">
                                                {{ \Illuminate\Support\Str::limit($row->trackings_detail, 30, $end='...') }}
                                            </div>
                                        </td>
                                        <td>
                                            {{ formatDatemonth($row->created_at) }}
                                        </td>
                                        <td>
                                            <center>
                                                <button class="btn btn-info mb-1" type="button"
                                                    data-trackings-id="{{$row->trackings_id}}"
                                                    onclick="viewstatus(this)"
                                                    data-target="#primaryModal">ตรวจสอบสถานะ</button>
                                            </center>
                                        </td>
                                    </tr>


                                    {{-- </div> --}}
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection


@section('javascript')
<script src="{{ asset('js/tooltips.js') }}"></script>
{{-- <script src="{{ asset('js/tooltips.js') }}"></script> --}}
<script>
    $('#download').click(function () {
        $('#warningModal').modal('show');

    });

    $('#btn_download').click(function () {
        let download_month = $('#download_month').val();
        let download_districts_id = $('#download_districts_id').val();

        if (download_districts_id == '' || download_month == '') {
            alert('กรุณากรอกข้อมูลให้ครบ !');
        } else {

            window.location.href = '{{URL("tracking/download")}}' + '/' + download_month + '/' +
                download_districts_id;

        }
    })



    function viewstatus(data) {
        let trackings_id = $(data).data('trackings-id');


        rander_trackings(trackings_id)
        $('#trackings_modal').modal('show');
    }


    function rander_trackings(id) {

        $.ajax({
            url: '{{URL("tracking/tracking_find")}}' + '/' + id,
            success: function (data) {
                $('#trackings_rander').html('');
                $('#trackings_rander').html(data);
            },
            error: function (error) {
                console.log('Error: ' + error);
            }
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
                    "targets": ['3', '4', '5'],
                    "searchable": false,
                },
                {
                    "targets": 0,
                    "className": "text-center",
                },
                {
                    "targets": [1, 4, 9],
                    "visible": false
                }
            ],

        });


        table.on('order.dt search.dt', function () {
            table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });

        }).draw();


        $('#time').change(function () {

            let date = $(this).val();

            if ($(this).val() == 'all') {
                table.search('').columns().search('').draw();
            } else {
                table.columns(9).search(this.value).draw();
            }
        })



        $('#type').change(function () {

             $('#search').val('');
             let date = $('#time').children("option:selected").val();
             if(date == 'all'){
                table.columns(9).search('').draw();
             }else{
                table.columns(9).search(date).draw();
             }
             
        })

        $('#search').keyup(function () {

            let type = $('#type').children("option:selected").val();


            let date = $('#time').children("option:selected").val();


            console.log(type);
            if (type == 'all') {
                table.columns(9).search(date).draw();
            } else if (type == 'districts') {
                table.columns(1).search(this.value).draw();
            } else if (type == 'title') {
                table.columns(6).search(this.value).draw();
            } else if (type == 'mhesi') {
                table.columns(3).search(this.value).draw();
            }

        })



    });

    $('#adddata').click(function () {
        $('#ModalLabel').text('เพิ่มข้อมูลเอกสาร');
        $('#form_modal').attr('action', "{{route('tracking.store')}}");
        $('#document_patterns_id').val('');
        $('#trackings_mhesi').val('');
        $('#trackings_mhesi_date').val('');
        $('#trackings_name').val('');
        $('#trackings_to').val('');
        $('#districts_id').val('');
        $('#Modal').modal('show');

    });


    // $('#Modal').on('hidden.bs.modal', function () {
    //     location.reload();
    //     alert('asd');
    // })

</script>

@endsection
