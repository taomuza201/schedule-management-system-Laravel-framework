@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12col-xl-12  ">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>จัดการข้อมูลรูปแบบเอกสาร</div>
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
                            เพิ่มรูปแบบเอกสาร
                        </button>

                        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">เพิ่มข้อมูลขั้นตอนกาารทำเอกสาร
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{route('document_patterns.store')}}" id="form_modal">

                                            @csrf
                                            <div class="form-group">
                                                <label for="recipient-name"
                                                    class="col-form-label">รูปแบบเอกสาร:</label>
                                                <input type="text" class="form-control" id="document_patterns_name"
                                                    name="document_patterns_name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name"
                                                    class="col-form-label">ประเภทเอกสาร:</label>
                                                <select " class="form-control" id="document_types_id"
                                                    name="document_types_id" required>
                                                    <option value="">กรุณาเลือกประเภทเอกสาร</option>

                                                    @foreach ($document_type as $item)
                                                    <option value="{{$item->document_types_id}}">{{$item->document_types_name }}</option>
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
                                    <th>รูปแบบเอกสาร</th>
                                    <th>ประเภทเอกสาร</th>
                                    <th>จัดการข้อมูล</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($document_patterns as $row)
                                <tr>
                                    <td class="no_number"  data-href="{{ url('document_patterns_details/'.$row->document_patterns_id ) }}"></td>
                                    <td data-href="{{ url('document_patterns_details/'.$row->document_patterns_id ) }}">{{$row->document_patterns_name}}</td>
                                    <td  data-href="{{ url('document_patterns_details/'.$row->document_patterns_id ) }}">{{ $row->document_types_name  }}</td>

                                    <td>
                                        <center>
                                            <button class="btn btn-info" type="button" onclick="edit(this)"
                                                data-id="{{$row->document_patterns_id}}">ดู/แก้ไขข้อมูล</button>
                                            <a class="btn btn-danger"
                                                href="{{URL('document_patterns/delete/'.$row->document_patterns_id)}}" onclick="return confirm('คุณต้องการลบ {{ $row->document_patterns_name  }} ?')">ลบข้อมูล</a>
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

        axios.get('{{URL("document_patterns/edit")}}' + '/' + id)
            .then(function (response) {

                $('#ModalLabel').text('แก้ไขข้อมูลขั้นตอนกาารทำเอกสาร');
                $('#document_patterns_name').val(response.data.document_patterns_name);
                $('#document_types_id').val(response.data.document_types_id);
                $('#btn_submit').text('แก้ไขข้อมูล');
                $('#form_modal').attr('action', '/document_patterns/update/' + id);

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


        $('#adddata').click(function () {
            $('#ModalLabel').text('เพิ่มข้อมูลขั้นตอนกาารทำเอกสาร');
            $('#form_modal').attr('action', "{{route('document_patterns.store')}}");
            $('#document_patterns_name').val('');
            $('#document_types_id ').val('');
            $('#Modal').modal('show');


        });

    });


    $('*[data-href]').on("click", function () {
        window.location = $(this).data('href');
        return false;
    });

</script>

@endsection
