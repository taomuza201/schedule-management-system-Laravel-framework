@extends('dashboard.base')

@section('content')



<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12col-xl-12  ">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>จัดการข้อมูลวิทยากร</div>
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
                            เพิ่มวิทยากร
                        </button>

                        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">เพิ่มข้อมูลวิทยากร
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{route('lecturers.store')}}" id="form_modal">

                                            @csrf
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">คำนำหน้า</label>

                                                <select name="lecturers_prefix" id="lecturers_prefix" required
                                                    class="col-form-label">
                                                    <option value="">กรุณาเลือกคำนำหน้า</option>
                                                    <option value="นาย">นาย</option>
                                                    <option value="นาง">นาง</option>
                                                    <option value="นางสาว">นางสาว</option>
                                                    <option value="ผู้ช่วยศาสตร์จารย์">ผู้ช่วยศาสตร์จารย์</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">ชื่อ:</label>
                                                <input type="text" class="form-control" id="lecturers_fname"
                                                    name="lecturers_fname" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">นามสกุล:</label>
                                                <input type="text" class="form-control" id="lecturers_lname"
                                                    name="lecturers_lname" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">เบอร์โทร:</label>

                                                <input type="number" class="form-control" id="lecturers_tel"
                                                    name="lecturers_tel" maxlength="10">
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name"
                                                    class="col-form-label">ข้อมูลยามพาหนะ:</label>
                                                <input type="text" class="form-control" id="lecturers_license_plate"
                                                    name="lecturers_license_plate" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="recipient-name"
                                                    class="col-form-label">ความเชี่ยวชาญ:</label>
                                                <textarea type="text" class="form-control" id="lecturers_expertise"
                                                    rows="4" name="lecturers_expertise" required></textarea>
                                            </div>


                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">ประเภทวิทยากร</label>

                                                <select name="lecturer_types_id" id="lecturer_types_id" required
                                                    class="col-form-label">
                                                    <option value="">กรุณาเลือกประเภทวิทยากร</option>

                                                    @foreach ($lecturer_type as $item)
                                                    <option value="{{$item->lecturer_types_id }}">
                                                        {{$item->lecturer_types_name}}</option>
                                                    @endforeach



                                                </select>
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
                                    <th>คำนำหน้า</th>
                                    <th>ชื่อ</th>
                                    <th>นามสกุล</th>
                                    <th>เบอร์โทร</th>
                                    <th>ข้อมูลยามพาหนะ</th>
                                    <th>ความเชี่ยวชาญ</th>
                                    <th>ประเภทวิทยากร</th>
                                    <th>จัดการข้อมูล</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lecturer as $row)
                                <tr>
                                    <td class="no_number"></td>
                                    <td>{{ $row->lecturers_prefix  }}</td>
                                    <td>{{ $row->lecturers_fname	  }}</td>
                                    <td>{{ $row->lecturers_lname  }}</td>
                                    <td>{{ $row->lecturers_tel  }}</td>
                                    <td>{{ $row->lecturers_license_plate  }}</td>
                                    <td>

                                        <div data-toggle="tooltip" data-placement="top"
                                            title=" {{$row->lecturers_expertise}}">
                                            {{ \Illuminate\Support\Str::limit($row->lecturers_expertise, 25, $end='...') }}

                                        </div>
                                    </td>
                                    <td>{{ $row->lecturer_types_name }}</td>


                                    <td>
                                        <center>
                                            <button class="btn btn-info" type="button" onclick="edit(this)"
                                                data-id="{{$row->lecturers_id}}">ดู/แก้ไขข้อมูล</button>
                                            <a class="btn btn-danger"
                                                href="{{URL('lecturers/delete/'.$row->lecturers_id)}}"
                                                onclick="return confirm('คุณต้องการลบ {{ $row->lecturers_fname  }} {{ $row->lecturers_lname  }}?')">ลบข้อมูล</a>
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
