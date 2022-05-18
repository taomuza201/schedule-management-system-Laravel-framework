@extends('dashboard.base')

@section('content')

<style>
    .pointer {
        cursor: pointer;
    }

    .dataTables_filter {
        display: none;
    }

</style>

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12col-xl-12  ">
                <div class="card">
                    <div class="card-header">
                        <h4> สร้างเอกสาร </h4>
                    </div>
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
                                    สร้างเอกสาร
                                </button>
                            </div>
                            <div class="col-12 col-md-5  text-right">

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">

                                            {{-- <select
                                                class="form-control{{ $errors->has('districts_id') ? ' is-invalid' : '' }}"
                                                name="districts" id="districts" required>
                                                <option value="" data-districts_id="all">ทั้งหมด</option>
                                                @foreach ($districts as $row)
                                                <option value="{{$row->districts_name}}"
                                                    data-districts_id="{{$row->districts_id}}">{{$row->districts_name}}
                                                </option>
                                                @endforeach
                                            </select> --}}

                                            <select class="form-control"
                                              
                                                name="type" id="type" required>
                                                <option value="all"  >ทั้งหมด</option>
                                               
                                                <option value="districts">ตำบล</option>         
                                                <option value="title">เรื่อง</option>                                               
                                                <option value="mhesi">เลขที่ อว.</option>                                               
                                            </select>
                                        </div>

                                        <input type="text" class="form-control" placeholder="ค้นหาเอกสาร"
                                            id="search">

                                    </div>

                                </div>


                            </div>
                        </div>

                        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
                            aria-hidden="true">
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
                                        <form method="POST" action="{{route('document.makestore')}}" id="form_modal">

                                            @csrf
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">รูปแบบเอกสาร:</label>
                                                <select class="form-control" id="document_patterns_id"
                                                    name="document_patterns_id" required>

                                                    <option value="">กรุณาเลือกรูปแบบเอกสาร</option>

                                                    @foreach ($document_patterns as $item)
                                                    <option value="{{$item->document_patterns_id}}">
                                                        {{$item->document_patterns_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">ตำบล:</label>
                                                <select class="form-control" id="districts_id" name="districts_id"
                                                    required>

                                                    <option value="">กรุณาเลือกตำบล</option>

                                                    @foreach ($districts as $item)
                                                    <option value="{{$item->districts_id}}">
                                                        {{$item->districts_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                   
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">ที่ อว. :</label>
                                                <input type="text" class="form-control" id="document_titles_mhesi"
                                                    name="document_titles_mhesi" required>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">ที่ คณะ. :</label>
                                                <input type="text" class="form-control"
                                                    id="document_titles_number_faculties"
                                                    name="document_titles_number_faculties" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">วันที่ อ้างอิง อว.
                                                    :</label>
                                                <input class="form-control" id="document_titles_mhesi_date" type="date"
                                                    name="document_titles_mhesi_date" required>
                                            </div> --}}
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">เรื่อง :</label>
                                                <input type="text" class="form-control" id="document_titles_name" 
                                                    name="document_titles_name" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">วันที่:</label>
                                                <input class="form-control" id="document_titles_date" type="month"
                                                    name="document_titles_date" required>
                                            </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">ยกเลิก</button>
                                        <button type="submit" class="btn btn-primary"
                                            id="btn_submit">สร้างเอกสาร</button>
                                    </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table table-responsive-sm table-striped table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th>ลำดับที่</th>
                                    <th>ดูข้อมูล</th>
                                    <th>เลขที่ อว.</th>
                                    <th>เรื่อง</th>
                                    <th>ตำบล</th>
                                    <th>สถานะ</th>
                                    <th>จัดการข้อมูล</th>
                                </tr>
                            </thead>
                            <tbody >
                                <div id="fetch"> @include('octuslog.document.document_make.fetch')</div>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


{{-- <button onclick="fetch()">  asdad</button> --}}

<div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-warning modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">สถานะเอกสาร</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">


                @include('octuslog.document.document_make.render.index')


            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                {{-- <button class="btn btn-warning" type="button">Save changes</button> --}}
            </div>
        </div>
        <!-- /.modal-content-->
    </div>
    <!-- /.modal-dialog-->
</div>

@endsection


@section('javascript')
{{-- <script src="{{ asset('js/tooltips.js') }}"></script> --}}
<script>

    $('#document_patterns_id').change(function(){
    let text = $( "#document_patterns_id option:selected" ).text();

    let  string =   text.split('-')[0];

    let  string_new =  string.trim()

    console.log(string_new);
    $('#document_titles_name').val(string_new);


    })
    function rander(id) {


        axios.get('{{URL("document/render")}}' + '/' + id)
            .then(function (response) {
                $('#rander').html(response.data);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed


            });

    }




    // function fetch() {


    //     axios.get('{{URL("/document/fetch")}}')
    //         .then(function (response) {
    //             // $('#fetch').html(response.data);
    //             // console.log(response.data);
    //         })
    //         .catch(function (error) {
    //             // handle error
    //             console.log(error);
    //         })
    //         .then(function () {
    //             // always executed


    //         });

    // }
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
                "targets": ['3','4','5'],
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



        $('#search').keyup(function () {

            let  type =   $('#type').children("option:selected").val();
            console.log(type);
            if(type =='all'){
                table.search($(this).val()).draw();
            }else if(type =='districts'){
                table.columns(4).search(this.value).draw();
            }
            else if(type =='title'){
                table.columns(3).search(this.value).draw();
            } else if(type =='mhesi'){
                table.columns(2).search(this.value).draw();
            }
           
        })

      

        function status(data) {
            let id = $(data).data("id");
            var modal = document.getElementById("warningModal");
            $('#warningModal').modal('show');
            rander(id);
        }
    });

    $('#adddata').click(function () {
        $('#ModalLabel').text('เพิ่มเอกสาร');
        $('#form_modal').attr('action', "{{route('document.makestore')}}");
        $('#document_patterns_id').val('');
        $('#document_titles_mhesi').val('');
        $('#document_titles_date').val('');
        $('#document_titles_name').val('');
        $('#document_titles_mhesi_date').val('');
        $('#districts_id').val('');
        $('#document_titles_number_faculties').val('');
        $('#Modal').modal('show');

    });

    function edit(data) {
        let id = $(data).data("id");
        $('#Modal').modal('show');


        axios.get('{{URL("document/edit")}}' + '/' + id)
            .then(function (response) {

                $('#ModalLabel').text('แก้ไขเอกสาร');
                $('#document_patterns_id').val(response.data[0].document_patterns_id);
        
                $('#document_patterns_id').attr('disabled', true);
 
                $('#districts_id').val(response.data[0].districts_id);
                $('#document_titles_mhesi').val(response.data[0].document_titles_mhesi);
                $('#document_titles_mhesi_date').val(response.data[0].document_titles_mhesi_date);
                $('#document_titles_name').val(response.data[0].document_titles_name);
                $('#document_titles_date').val(response.data[0].document_titles_date);
                $('#document_titles_number_faculties').val(response.data[0].document_titles_number_faculties);
                //เซตข้อมูล เดือน 
                var str = response.data[0].document_titles_date;
                var res = str.slice(0, 7);
                // console.log(res);
                $('#document_titles_date').val(res);



                $('#btn_submit').text('แก้ไขข้อมูล');
                $('#form_modal').attr('action', 'update/' + id);


                console.log(response);

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });
    }



    $('*[data-href]').on("click", function () {
        window.location = $(this).data('href');
        return false;
    });

</script>

@endsection
