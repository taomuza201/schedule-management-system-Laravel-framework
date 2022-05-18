@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12col-xl-12  ">
                <div class="card">
                    <div class="card-header">
                       <h4>  ขั้นตอนการจัดส่งเอกสารตามคณะ</h4></div>
                    <div class="card-body">

                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif




                        
                        <div class="table-responsive">
                            <table class="table table-responsive-sm table-striped table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th>ลำดับที่</th>
                                        <th>คณะ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($faculties as $row)
                                    <tr data-href="{{ url('document_steps/step/'.$row->faculties_id ) }}">
                                    <td class="no_number"> </td>
                                    <td> {{ $row->faculties_name }}</td>
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
                "targets": ['2'],
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


    $('*[data-href]').on("click", function () {
        window.location = $(this).data('href');
        return false;
    });

</script>

@endsection
