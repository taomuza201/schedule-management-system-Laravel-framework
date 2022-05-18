@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12col-xl-12  ">
                <div class="card">
                    <div class="card-header">
                       <h4> จัดการข้อมูลขั้นตอนการจัดส่งเอกสาร {{$faculties->faculties_name }}</h4></div>
                    <div class="card-body">

                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif



                        <button type="button" class="btn btn-primary mb-3" id="adddata">
                            เพิ่มขั้นตอนการจัดส่งเอกสาร
                        </button>

                        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">เพิ่มข้อมูลขั้นตอนการจัดส่งเอกสาร
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{route('document_steps.store')}}" id="form_modal">

                                            @csrf
                                            <div class="form-group">
                                                <label for="recipient-name"
                                                    class="col-form-label">ที่จัดส่งเอกสาร:</label>
                                                <input type="text" class="form-control" id="document_steps_name"
                                                    name="document_steps_name" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="recipient-name"
                                                    class="col-form-label">อัพโหลดไฟล์:</label>
                                                <input type="checkbox" class="form-control" id="document_steps_upload" value="1"
                                                    name="document_steps_upload" >
                                            </div>


                                            <input type="hidden" value="{{$id}}" name="faculties_id">

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
                                    <th>ขั้นตอนที่</th>
                                    <th>ที่จัดส่งเอกสาร</th>
                                    <th>อัพโหลดไฟล์</th>
                                    <th>จัดการข้อมูล</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($document_steps as $row)
                                <tr>
                                    <td class="no_number"></td>
                                    <td  class="no_number">{{ $row->document_steps_no }}</td>
                                    <td>{{ $row->document_steps_name }}</td>
                                    <td> 
                                    @if ($row->document_steps_upload == 1 )
                                       <center> <i class="cil-check" style="font-size: 36px;">   </i></center> 
                                    @else
                                        <center> <i class="cil-x" style="font-size: 36px;">   </i></center> 
                                    @endif
                                
                            </td>

                                    <td>
                                        <center>
                                            <button class="btn btn-info" type="button" onclick="edit(this)"
                                                data-id="{{$row->document_steps_id}}">ดู/แก้ไขข้อมูล</button>
                                            <a class="btn btn-danger"
                                                href="{{URL('document_steps/delete/'.$row->document_steps_id)}}">ลบข้อมูล</a>
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
    function edit(data) {
        let id = $(data).data("id");
        $('#Modal').modal('show');


        axios.get('{{URL("document_steps/edit")}}' + '/' + id)
            .then(function (response) {

                $('#ModalLabel').text('แก้ไขข้อมูลขั้นตอนการจัดส่งเอกสาร');
                $('#document_steps_name').val(response.data.document_steps_name);
                // $('#document_steps_upload').val(response.data.document_steps_upload);
                if(response.data.document_steps_upload == 1){
                    $('#document_steps_upload').prop('checked', true);
                }else{
                    $('#document_steps_upload').prop('checked', false);
                }
               
                $('#btn_submit').text('แก้ไขข้อมูล');
                $('#form_modal').attr('action', 'document_steps/update/' + id);

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
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
                "targets": [3],
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


        $('#adddata').click(function () {
            $('#ModalLabel').text('เพิ่มข้อมูลขั้นตอนการจัดส่งเอกสาร');
            $('#form_modal').attr('action', "{{route('document_steps.store')}}");
            $('#document_steps_name').val('');
            $('#document_steps_upload').prop('checked', false);
            $('#Modal').modal('show');


        });

    });

</script>

@endsection
