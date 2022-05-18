@extends('dashboard.base_calenar')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@section('content')

<style>
    .popper,
    .tooltip {
        position: absolute;
        z-index: 9999;
        background: #FFC107;
        color: black;
        width: 200px;
        border-radius: 3px;
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
        padding: 10px;
        text-align: center;
    }

    .style5 .tooltip {
        background: #1E252B;
        color: #FFFFFF;
        max-width: 200px;
        width: auto;
        font-size: .8rem;
        padding: .5em 1em;
    }

    .popper .popper__arrow,
    .tooltip .tooltip-arrow {
        width: 0;
        height: 0;
        border-style: solid;
        position: absolute;
        margin: 5px;
    }

    .tooltip .tooltip-arrow,
    .popper .popper__arrow {
        border-color: #FFC107;
    }

    .style5 .tooltip .tooltip-arrow {
        border-color: #1E252B;
    }

    .popper[x-placement^="top"],
    .tooltip[x-placement^="top"] {
        margin-bottom: 5px;
    }

    .popper[x-placement^="top"] .popper__arrow,
    .tooltip[x-placement^="top"] .tooltip-arrow {
        border-width: 5px 5px 0 5px;
        border-left-color: transparent;
        border-right-color: transparent;
        border-bottom-color: transparent;
        bottom: -5px;
        left: calc(50% - 5px);
        margin-top: 0;
        margin-bottom: 0;
    }

    .popper[x-placement^="bottom"],
    .tooltip[x-placement^="bottom"] {
        margin-top: 5px;
    }

    .tooltip[x-placement^="bottom"] .tooltip-arrow,
    .popper[x-placement^="bottom"] .popper__arrow {
        border-width: 0 5px 5px 5px;
        border-left-color: transparent;
        border-right-color: transparent;
        border-top-color: transparent;
        top: -5px;
        left: calc(50% - 5px);
        margin-top: 0;
        margin-bottom: 0;
    }

    .tooltip[x-placement^="right"],
    .popper[x-placement^="right"] {
        margin-left: 5px;
    }

    .popper[x-placement^="right"] .popper__arrow,
    .tooltip[x-placement^="right"] .tooltip-arrow {
        border-width: 5px 5px 5px 0;
        border-left-color: transparent;
        border-top-color: transparent;
        border-bottom-color: transparent;
        left: -5px;
        top: calc(50% - 5px);
        margin-left: 0;
        margin-right: 0;
    }

    .popper[x-placement^="left"],
    .tooltip[x-placement^="left"] {
        margin-right: 5px;
    }

    .popper[x-placement^="left"] .popper__arrow,
    .tooltip[x-placement^="left"] .tooltip-arrow {
        border-width: 5px 0 5px 5px;
        border-top-color: transparent;
        border-right-color: transparent;
        border-bottom-color: transparent;
        right: -5px;
        top: calc(50% - 5px);
        margin-left: 0;
        margin-right: 0;
    }

    @media print {
        .card-body {
        width: 3500px; 
        } 

    }


</style>



<div class="container-fluid" id="container">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12col-xl-12  ">
                <div class="card">
                    <!-- <div class="card-header">
                        <h4> สร้างเอกสาร </h4>
                    </div> -->
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
                                    เพิ่มกิจกรรม
                                </button>

                                <button type="button" class="btn  btn-warning mb-3" onclick="window.print()">
                                    พิมพ์ปฏิทิน
                                </button>
                                
                                <button type="button" class="btn  btn-info mb-3" onclick="print_report()">
                                    ดาวน์โหลดกำหนดการ
                                </button>


                                
                                    
                                    
                            </div>
                            <div class="col-12 col-md-5 ">

                                <div class="form-group float-right">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <select class="form-control" name="search" id="search" required>
                                                @if ($id =='')
                                                $id='all';
                                                @endif
                                                <option value="all" @if ($id=='all' ) selected @endif>ทั้งหมด</option>

                                                @foreach ($user as $item)
                                                <option value="{{$item->id}}" @if ($id==$item->id)
                                                    selected
                                                    @endif> {{$item->name}}</option>
                                                @endforeach


                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id='calendar'></div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel"> สร้างเอกสาร
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form_modal">

                    @csrf

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">ชื่อเรื่อง . :</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">รายละเอียด :</label>
                        <textarea type="text" class="form-control" id="description" name="description" rows="4"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">วันที่เริ่มต้น
                            :</label>
                        <input class="form-control" id="start" type="datetime-local" name="start" required>
                        {{-- <input class="form-control" id="start" type="date" name="start" required> --}}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">วันที่สิ้นสุด
                            :</label>
                        <input class="form-control" id="end" type="datetime-local" name="end" required>
                        {{-- <input class="form-control" id="end" type="date" name="end" required> --}}
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">สี :</label>
                        <input class="form-control" id="color" type="color" name="color" required>
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">หมอบหมายงาน :</label>
                        <select class="form-control" id="user_id" name="user_id[]" multiple="multiple"
                            style="width: 100%" required>
                            <option value="all">ทั้งหมด</option>
                            @foreach ($user as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">มีการประชุม :</label>
                        <input type="checkbox" name="status" id="status" value="1" class="form-control">
                    </div>


                    <div class="form-group" id="agenda">
                        <label for="recipient-name" class="col-form-label">วาระการประชุม :</label>
                        <a href="http://" id="agenda_url"> วาระการประชุม</a>
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">ทำซ้ำ :</label>
                        <select class="form-control" id="repeat" name="repeat" style="width: 100%" required>
                            <option value="none">ไม่เกิดซ้ำ</option>
                            <option value="month">เกิดซ้ำในรายเดือน</option>
                            <option value="year">เกิดซ้ำในรายปี</option>
                            <option value="custom">กำหนดเอง</option>
                        </select>
                        <div id="div_r_custom">
                            <label for="recipient-name" class="col-form-label">วันที่เริ่มต้น
                                :</label>
                            <input class="form-control" id="r_start" type="datetime-local" name="r_start">

                            <label for="recipient-name" class="col-form-label">วันที่สิ้นสุด
                                :</label>
                            <input class="form-control" id="r_end" type="datetime-local" name="r_end">
                        </div>

                    </div>

            </div>
            <div class="modal-footer">
                <a href="" id="delete" class="btn btn-danger" onclick="return confirm('คุณต้องการลบ ?')">ลบ</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-primary" id="btn_submit">บันทึก</button>
                <input type="text" name="calendars_id" id="calendars_id" value="" hidden>
            </div>

            </form>
        </div>
    </div>
</div>
{{-- <button onclick="fetch()">  asdad</button> --}}



@endsection




@section('javascript')


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css">


<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/locales-all.js"></script>

<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>


<script>


   

    window.onload = function () {
        $('.fc-toolbar.fc-header-toolbar').addClass('row col-lg-12');
    };

    $(document).ready(function () {
        $('#user_id').select2();
        $('#div_r_custom').hide();
    });


    // $('#end,#start').on('change', function () {
    //     let start = $('#start').val()
    //     let end = $('#end').val()
    //     start = start.split('T')[0];
    //     end = end.split('T')[0];
    //     if (start==end) {
    //         $('#repeat').prop( "disabled", false);
    //     }else{
    //         $('#repeat').prop( "disabled", true);
    //     }
    // });

    $('#repeat').on('change', function () {
        if ($(this).val() == 'custom') {
            $('#div_r_custom').show();
            $('#r_start').prop("required", true);
            $('#r_end').prop("required", true);
        } else {
            $('#div_r_custom').hide();
            $('#r_start').prop("required", false);
            $('#r_end').prop("required", false);
        }
    });

    // document.addEventListener('DOMContentLoaded', function () {
    var initialLocaleCode = 'th';
    var localeSelectorEl = document.getElementById('locale-selector');
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            right: 'prev,next today',
            center: 'title',
            left: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        locale: initialLocaleCode,
        buttonIcons: false, // show the prev/next text
        weekNumbers: true,
        navLinks: true, // can click day/week names to navigate views
        // editable: true,
        dayMaxEvents: true, // allow "more" link when too many events
        eventDidMount: function (info) {
            var tooltip = new Tooltip(info.el, {
                title: info.event.extendedProps.description,
                placement: 'top',
                trigger: 'hover',
                container: 'body'
            });
        },
        eventSources: [{!!$calendar!!}],
        eventClick: function (event) {
            // alert('Event: ' + event.event);

            // console.log(event.event);
            $('#ModalLabel').text('แก้ไขกิจกรรม');
            $('#title').val(event.event.title);


            let start = event.event.startStr.split('+')[0];
            $('#start').val(start);

            let endStr = event.event.endStr.split('+')[0];


            if (event.event.endStr == '') {

                $('#end').val(start);
            } else {
                $('#end').val(endStr);
            }

            if (event.event.extendedProps.status == 1) {
                $('#status').prop('checked', true);
            } else {
                $('#status').prop('checked', false);
            }


            $('#description').val(event.event.extendedProps.description);
            $('#color').val(event.event.borderColor);
            $("#user_id").removeAttr("multiple");


            if (event.event.extendedProps.user_id == null) {

                $('#user_id').val('all');
                $('#user_id').trigger('change');
            } else {
                $('#user_id').val(event.event.extendedProps.user_id);
                $('#user_id').trigger('change');
            }

            $('#calendars_id').val(event.event.extendedProps.calendars_id);


            $("#delete").show();



            if (event.event.extendedProps.status == 1) {
                $("#agenda").show();


                axios.get('{{URL("calendar/book")}}' + '/' + event.event.extendedProps.calendars_id)
                    .then(function (response) {

                        console.log(response.data)

                        $("#agenda_url").attr("href", "{{URL('agenda/book/')}}/" + response.data[
                            'agendas_id']);

                    })
                    .catch(function (error) {

                        console.log(error);
                    })
                    .then(function () {

                    });
            } else {
                $("#agenda").hide();
            }



            $("#delete").attr("href", "{{URL('calendar/delete')}}/" + event.event.extendedProps
                .calendars_id);

            $("#form_modal").attr("method", "post");
            $('#form_modal').attr('action', "{{ URL('calendar/update')}}/" + event.event.extendedProps
                .calendars_id);
            $('#Modal').modal('show');

        }
    });

    calendar.setOption('locale', 'th');
    calendar.render();

    // });


    $('#adddata').click(function () {
        $('#ModalLabel').text('เพิ่มกิจกรรม');
        $('#form_modal').attr('action', "{{route('calendar.store')}}");
        $('#title').val('');
        $('#start').val('');
        $('#end').val('');
        $('#description').val('');
        $('#color').val('');
        $('#user_id').attr('multiple', 'multiple');
        $('#user_id').val('');
        $('#user_id').trigger('change');
        $("#delete").hide();
        $("#agenda").hide();
        $('#status').prop('checked', false);
        $("#form_modal").attr("method", "post");
        $('#Modal').modal('show');

    })

    //     $('#search').on('input', function(){
    //         $('#calendar').fullCalendar('rerenderEvents');
    //   });


    $('#search').on('change', function () {

        var id = $(this).val();
        window.location = "{{URL('calendar')}}" + '?id=' + id;
    });


    function  print_report(){

    let user_id= $('#search').val();
    let date = calendar.getDate();

    d = new Date(date);
    let month_int = d.getMonth() +1;
    let year_int = d.getFullYear();

    let string = (month_int+1) +'-'+ year_int;


  


    console.log('เดือน:' + month_int);
    console.log('ปี:' + year_int);


    window.location.href = '{{URL("calendar/download")}}' +'/' +user_id +'/' + month_int + '/' +year_int ;
    }
</script>

@endsection
