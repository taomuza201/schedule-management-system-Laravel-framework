@extends('dashboard.base')

@section('content')


<style>
    th {
        text-align: center;
    }

</style>

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12col-xl-12  ">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>จัดการข้อมูลคณะและข้อมูลหัวหน้าโครงการ</div>
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
                            เพิ่มข้อมูลคณะ
                        </button>

                        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">เพิ่มข้อมูลคณะ
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{route('faculties.store')}}" id="form_modal">

                                            @csrf
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">ชื่อคณะ:</label>
                                                <input type="text" class="form-control" id="faculties_name"
                                                    name="faculties_name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">เลข อว .คณะ:</label>
                                                <input type="text" class="form-control" id="faculties_number"
                                                    name="faculties_number" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">วันที่อ้างอิง เลข อว .คณะ:</label>
                                                <input type="date" class="form-control" id="faculties_date"
                                                    name="faculties_date" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">เบอร์โทรศัพท์:</label>
                                                <input type="number" class="form-control" id="faculties_tel"
                                                    name="faculties_tel" required>
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
                                    <th>ชื่อคณะ</th>
                                    <th>เลข อว .คณะ</th>
                                    <th>วันที่อ้างอิง เลข อว .คณะ</th>
                                    <th>เบอร์โทรศัพท์</th>
                                    <th>จัดการข้อมูล</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($faculties as $row)
                                <tr>
                                    <td></td>
                                    <td>{{$row->faculties_name }}</td>
                                    <td style="text-align: right">{{ $row->faculties_number  }}</td>
                                    <td>{{ formatDateThat($row->faculties_date)  }}</td>
                                    <td>{{$row->faculties_tel }}</td>
                                    
                          
                                    <td>
                                        <center>
                                            <button class="btn btn-info" type="button"  onclick="edit(this)"
                                                data-id="{{$row->faculties_id }}">ดู/แก้ไขข้อมูล</button>
                                            <a class="btn btn-danger"
                                                href="{{URL('faculties/delete/'.$row->faculties_id )}}" onclick="return confirm('คุณต้องการลบ {{ $row->faculties_name  }} ?')">ลบข้อมูล</a>
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
     let table =   $('#table').DataTable({
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
        $('#ModalLabel').text('เพิ่มข้อมูลคณะ');
        $('#form_modal').attr('action', "{{route('faculties.store')}}");
        $('#faculties_name').val('');
        $('#faculties_number').val('');
        $('#faculties_tel').val('');
        $('#faculties_date').val('');
        $('#Modal').modal('show');

    });
    function edit(data) {

        let id = $(data).data("id");
        $('#Modal').modal('show');


        axios.get('{{URL("faculties/edit")}}' + '/' + id)
            .then(function (response) {

                $('#ModalLabel').text('แก้ไขข้อมูลคณะ');
                $('#faculties_name').val(response.data.faculties_name);
                $('#faculties_number').val(response.data.faculties_number);
                $('#faculties_tel').val(response.data.faculties_tel);

                
                $('#faculties_date').val(response.data.faculties_date);
                $('#btn_submit').text('แก้ไขข้อมูล');
                $('#form_modal').attr('action', 'faculties/update/' + id);

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });


    };

</script>

@endsection
