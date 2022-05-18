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
                        <i class="fa fa-align-justify"></i>จัดการข้อมูลตำบลและข้อมูลหัวหน้าโครงการ</div>
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
                            เพิ่มข้อมูลตำบล
                        </button>

                        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">เพิ่มข้อมูลตำบลและข้อมูลหัวหน้าโครงการ
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{route('districts.store')}}" id="form_modal">

                                            @csrf
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">ชื่อตำบล:</label>
                                                <input type="text" class="form-control" id="districts_name"
                                                    name="districts_name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">สังกัดคณะ</label>

                                                <select name="faculties_id" id="faculties_id" required
                                                    class="col-form-label">
                                                    <option value="">กรุณาเลือกสังกัดคณะ</option>
                                                    @foreach ($faculties as $item)
                                                    <option value="{{$item->faculties_id}}">{{$item->faculties_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>



                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">วิชาเอก สาขา:</label>
                                                <input type="text" class="form-control" id="districts_faculty_branch"
                                                    name="districts_faculty_branch" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">คำนำหน้า</label>

                                                <select name="districts_prefix" id="districts_prefix" required
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
                                                <input type="text" class="form-control" id="districts_fname"
                                                    name="districts_fname" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">นามสกุล:</label>
                                                <input type="text" class="form-control" id="districts_lname"
                                                    name="districts_lname" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">ป้ายทะเบียนรถ:</label>
                                                <input type="text" class="form-control" id="districts_license_plate"
                                                    name="districts_license_plate" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">จำนวนระยะทางจาก มทร.ล้านไปยัง ตำบล :</label>
                                                <input type="number" class="form-control" id="districts_distance"
                                                    name="districts_distance" required>
                                            </div>

                                            
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">ที่อยู่รูปแผนที่</label>
                                                <input type="text" class="form-control" id="districts_pic"
                                                    name="districts_pic" required>
                                            </div>
                                       
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">สถานที่จากมทร.ล้านไปยัง ตำบล :</label>
                                                <textarea type="text" class="form-control" id="districts_map" rows="3"
                                                    name="districts_map" required></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">ชื่อ ย่อ :</label>
                                                <input type="text" class="form-control" id="districts_initials"
                                                    name="districts_initials" required>
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
                        <table class="table table-responsive-sm table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ลำดับที่</th>
                                    <th>ชื่อตำบล</th>
                                    <th>เลขคณะ</th>
                                    <th>คณะ</th>
                                    <th>วิชาเอก สาขา</th>
                                    <th>คำนำหน้า</th>
                                    <th>ชื่อ</th>
                                    <th>นามสกุล</th>
                                    <th>จัดการข้อมูล</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $number = 1;
                                @endphp
                                @foreach($districts as $row)
                                <tr>
                                    <td><center>{{$number }}</center></td>
                                    <td>{{ $row->districts_name  }}</td>
                                    <td>{{ $row->faculties_number }}</td>
                                    <td>{{ $row->faculties_name  }}</td>
                                    <td>{{ $row->districts_faculty_branch }}</td>
                                    <td>{{ $row->districts_prefix }}</td>
                                    <td>{{ $row->districts_fname }}</td>
                                    <td>{{ $row->districts_lname }}</td>
                                    <td>
                                        <center>
                                            <button class="btn btn-info" type="button" onclick="editdata(this)"
                                                data-id="{{$row->districts_id}}">ดู/แก้ไขข้อมูล</button>
                                            <a class="btn btn-danger"
                                                href="{{URL('districts/delete/'.$row->districts_id)}}" onclick="return confirm('คุณต้องการลบ {{ $row->districts_name  }} ?')">ลบข้อมูล</a>
                                        </center>
                                    </td>
                                </tr>

                                @php
                                $number ++;
                            @endphp
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
    $('#adddata').click(function () {
        $('#ModalLabel').text('เพิ่มไขข้อมูลตำบลและข้อมูลหัวหน้าโครงการ');
        $('#form_modal').attr('action', "{{route('districts.store')}}");
        $('#districts_name').val('');
        $('#districts_faculty_number').val('');
        $('#districts_faculty_name').val('');
        $('#districts_faculty_branch').val('');
        $('#districts_faculty_tel').val('');
        $('#districts_prefix').val('');
        $('#districts_fname').val('');
        $('#districts_lname').val('');
        $('#districts_license_plate').val('');
        $('#districts_distance').val('');
        $('#districts_pic').val('');
        $('#districts_map').val('');
        $('#districts_initials').val('');
        $('#Modal').modal('show');

    });


    function editdata(data){

        let id = $(data).data("id");
        $('#Modal').modal('show');


        axios.get('{{URL("districts/edit")}}' + '/' + id)
            .then(function (response) {

                $('#ModalLabel').text('แก้ไขข้อมูลตำบลและข้อมูลหัวหน้าโครงการ');
                $('#districts_name').val(response.data.districts_name);
                $('#faculties_id').val(response.data.faculties_id);
                $('#districts_faculty_number').val(response.data.districts_faculty_number);
                $('#districts_faculty_name').val(response.data.districts_faculty_name);
                $('#districts_faculty_branch').val(response.data.districts_faculty_branch);
                $('#districts_faculty_tel').val(response.data.districts_faculty_tel);
                $('#districts_prefix').val(response.data.districts_prefix);
                $('#districts_fname').val(response.data.districts_fname);
                $('#districts_lname').val(response.data.districts_lname);
                $('#districts_license_plate').val(response.data.districts_license_plate);
                $('#districts_distance').val(response.data.districts_distance);
                $('#districts_pic').val(response.data.districts_pic);
                $('#districts_map').val(response.data.districts_map);
                $('#districts_initials').val(response.data.districts_initials);
                $('#btn_submit').text('แก้ไขข้อมูล');
                $('#form_modal').attr('action', 'districts/update/' + id);

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });



    }
    $('#editdata').click(function () {

        
    });

</script>

@endsection
