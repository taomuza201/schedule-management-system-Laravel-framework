@extends('dashboard.base')
@section('title', "วาระการประชุม $agendas->agendas_title")
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
<script src="https://cdn.tiny.cloud/1/96knb3qrcnx6302vv67otnbrjsnch2xswg86g1d3flc4bhyb/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
<style>
        @font-face {
            font-family: 'THSarabunIT';
            font-style: normal;
            font-weight: normal;
            src: url("{{ asset('fonts/THSarabunIT/THSarabunIT.ttf')}}") format('truetype');

        }

        @font-face {
            font-family: 'THSarabunIT';
            font-style: normal;
            font-weight: bold;
            src: url("{{ asset('fonts/THSarabunIT/THSarabunIT Bold.ttf')}}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunIT';
            font-style: italic;
            font-weight: normal;
            src: url("{{ asset('fonts/THSarabunIT/THSarabunIT Italic.ttf')}}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunIT';
            font-style: italic;
            font-weight: bold;
            src: url("{{ asset('fonts/THSarabunIT/THSarabunIT BoldItalic.ttf')}}") format('truetype');
        }
        textarea {
            font-family: 'THSarabunIT';
        }
</style>

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12col-xl-12  ">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>บันทึกการประชุม</div>
                    <div class="card-body">

                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="content">
                          
                            <div class="title m-b-md">
                                <br>
                                <form action="{{url('agenda/book').'/'.$id.'/update'}}" method="post">
                                    <h4>เรื่อง</h4>
                                        <input type="text" name="agendas_title" id="agendas_title"  value="{{$agendas->agendas_title}}" class="form-control">
                                    <h4>รายละเอียด</h4>
                                    <textarea class="form-control tinymce" rows="3" placeholder="Textarea" required
                                        name="agendas_description">{!!$agendas->agendas_description!!}</textarea>

                                    @csrf
                                    <br>
                                
                                   <center>  <button type="submit" class="btn btn-success">บันทึกการประชุม</button></center> 
                                </form>
                            </div>

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



<script>
    var editor_config = {
        path_absolute: "/",
        selector: "textarea.tinymce",
        setup: function (editor) {
            editor.on('change', function (e) {
                editor.save();
            });


            
        },
        object_resizing: true,
        // menubar: false,
        // content_style: "img { width: 320px;};",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern" 
        ],
        // toolbar: "insertfile undo redo | bullist numlist |  image ",
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        image_dimensions: false,
        image_description: false,
        width: 'auto',
        height: '720px',

        // content_style: "body { font-family: 'THSarabunIT'}",

        // object_resizing: 'true',
        resize_img_proportional: true,

        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '{{ route("image_upload") }}');
            var token = '{{ csrf_token() }}';
            xhr.setRequestHeader("X-CSRF-Token", token);
            xhr.onload = function () {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                success(json.location);
            };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        }
    };

    tinymce.init(editor_config);

</script>


@endsection
