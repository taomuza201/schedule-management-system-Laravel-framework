@extends('dashboard.base')

@section('content')



<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xl-12  ">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>จัดทำเอการ</div>
                    <div class="card-body">


                        @foreach ($document_type as $item)
                        <div class="row p-3 align-middle ">
                            <div class="col-12 btn  btn-lg vertical-center span"
                                style="background-color: {{$item->document_types_color}};height: 100px;text-align: center;color:#fff;"
                                onclick="window.location='{{URL('document/make/'.$item->document_types_id)}}'"
                                
                                >
                               {{$item->document_types_name }}
                            </div>
                        </div>
                        @endforeach
                      

                        
                        
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

</script>

@endsection
