@extends('dashboard.base')

@section('content')



<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12col-xl-12  ">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>จัดการข้อมูลบันทึกการประชุม</div>
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
                                    <th>เรื่อง</th>
                                    <th>วันที่ประชุม</th>
                                    {{-- <th>สถานะ</th> --}}
                                
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($agendas as $item)

                                <tr data-href="{{ url('agenda/book/'.$item->agendas_id   ) }}">
                                    <td class="no_number"></td>
                                    <td>{{$item->agendas_title}}</td>
                                    <td>{{ formatDateThat(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->agendas_date)->format('d-m-Y') )}}</td>
                                    {{-- <td></td> --}}
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

    $('*[data-href]').on("click", function () {
        window.location = $(this).data('href');
        return false;
    });


</script>

@endsection
