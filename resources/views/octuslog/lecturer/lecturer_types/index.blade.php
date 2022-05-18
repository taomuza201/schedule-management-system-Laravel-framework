@extends('dashboard.base')

@section('content')



<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12col-xl-12  ">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>จัดการข้อมูลประเภทวิทยากร</div>
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

                        <button type="button" class="btn btn-primary mb-3" id="adddata">
                            เพิ่มประเภทวิทยากร
                        </button>

                        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">เพิ่มข้อมูลประเภทวิทยากร
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{route('lecturer_types.store')}}" id="form_modal">

                                            @csrf
                                            <div class="form-group">
                                                <label for="recipient-name"
                                                    class="col-form-label">ประเภทวิทยากร:</label>
                                                <input type="text" class="form-control" id="lecturer_types_name"
                                                    name="lecturer_types_name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name"
                                                    class="col-form-label">ราคาวิทยากรต่อชั่วโมง:</label>

                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="lecturer_types_rate" style="text-align: right"
                                                        name="lecturer_types_rate" required>
                                                    <div class="input-group-append"><span class="input-group-text">
                                                            บาท</span></div>
                                                </div>
                                            </div>



                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">ยกเลิก</button>
                                        <button type="submit" class="btn btn-primary"
                                            id="btn_submit">เพิ่มข้อมูล</button>
                                    </div>

                                    </form>
                                </div>
                            </div>
                        </div <div class="table-responsive">
                        <table class="table table-responsive-sm table-striped table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th>ลำดับที่</th>
                                    <th>ประเภทวิทยากร</th>
                                    <th>ราคาวิทยากรต่อชั่วโมง</th>
                                    <th>จัดการข้อมูล</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lecturer_types as $row)
                                <tr>
                                    <td class="no_number"></td>
                                    <td>{{ $row->lecturer_types_name  }}</td>
                                    <td style="text-align: right">{{ number_format($row->lecturer_types_rate, 2, ".", ",")}} บาท</td>
                                    <td>
                                        <center>
                                            <button class="btn btn-info" type="button" onclick="edit(this)"
                                                data-id="{{$row->lecturer_types_id}}">ดู/แก้ไขข้อมูล</button>
                                            <a class="btn btn-danger"
                                                href="{{URL('lecturer_types/delete/'.$row->lecturer_types_id)}}" onclick="return confirm('คุณต้องการลบ {{ $row->lecturer_types_name  }} ?')">ลบข้อมูล</a>
                                        </center>
                                    </td>
                                </tr>
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
                "targets": [2],
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
        $('#ModalLabel').text('เพิ่มข้อมูลประเภทวิทยากร');
        $('#form_modal').attr('action', "{{route('lecturer_types.store')}}");
        $('#lecturer_types_name').val('');
        $('#lecturer_types_rate').val('');
        $('#Modal').modal('show');

    });

    function edit(data) {
        let id = $(data).data("id");
        $('#Modal').modal('show');


        axios.get('{{URL("lecturer_types/edit")}}' + '/' + id)
            .then(function (response) {

                $('#ModalLabel').text('แก้ไขข้อมูลประเภทวิทยากร');
                $('#lecturer_types_name').val(response.data.lecturer_types_name);
                $('#lecturer_types_rate').val(response.data.lecturer_types_rate);
                $('#btn_submit').text('แก้ไขข้อมูล');
                $('#form_modal').attr('action', 'lecturer_types/update/' + id);

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
