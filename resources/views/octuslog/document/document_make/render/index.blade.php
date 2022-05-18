 <div id="rander"> @if ($data != '')


     <div class="row pt-3">
         <div class="col-1">
             <i class="cil-clock" style="font-size:56px;"></i>
         </div>
         <div class="col-6 align-text-left" style="padding-top: 2%;">
             @if ($data->document_titles_status_within == 1)
             <span style=" text-shadow: 2px 2px lawngreen;">อยู่ระหว่างดำเนินการสร้างเอกสาร</span>

             @else
             <span>อยู่ระหว่างดำเนินการสร้างเอกสาร</span>
             @endif
         </div>
         <div class="col-3 vertical-center">
             <center>
                 @if ($data->document_titles_status_within == 1)
                 <i class="cil-arrow-thick-right pointer"
                     style="font-size:30px;color: rgb(29, 168, 76);padding-right: 15px;" data-status="1" data-step="in"
                     data-id="{{$data->document_titles_id}}" onclick="nextstep(this)"></i>
                 <i class="cil-ban pointer" style="font-size:30px;color:red" data-status="1" data-step="in"
                     onclick="cancelstep(this)" data-id="{{$data->document_titles_id}}"> </i>
                 @endif
             </center>

         </div>

     </div>
     <hr>
     <div class="row pt-3">
         <div class="col-1">
             <i class="cil-clock" style="font-size:56px;"></i>
         </div>
         <div class="col-6 align-text-left " style="padding-top: 2%;">
             @if ($data->document_titles_status_within == 2 && $data->document_titles_status ==0)
             <span style=" text-shadow: 2px 2px lawngreen;">คณะอาจารย์ตรวจสอบและอนุมัติเอกสาร</span>
             @else
             <span>คณะอาจารย์ตรวจสอบและอนุมัติเอกสาร</span>
             @endif
         </div>
         <div class="col-3 vertical-center">
             <center>
                 @if ($data->document_titles_status_within == 2 && $data->document_titles_status ==0)

                 <i class="cil-arrow-thick-right pointer"
                     style="font-size:30px;color: rgb(29, 168, 76);padding-right: 15px;" data-status="2" data-step="in"
                     data-id="{{$data->document_titles_id}}" onclick="nextstep(this)"></i>
                 <i class="cil-ban pointer" style="font-size:30px;color:red" data-status="2" data-step="in"
                     data-id="{{$data->document_titles_id}}" onclick="cancelstep(this)"> </i>
                 @endif
             </center>
         </div>

     </div>
     <hr>
     @foreach ($step as $item)
     <div class="row pt-3">
         <div class="col-1">
             <i class="cil-clock" style="font-size:56px;"></i>
         </div>
         <div class="col-6 align-text-left " style="padding-top: 2%;">

             @if ($data->document_titles_status == $item->document_steps_no)
             <span style=" text-shadow: 2px 2px lawngreen;">{{$item->document_steps_name}}</span>

             @else
             <span>{{$item->document_steps_name}}</span>
             @endif
         </div>
         <div class="col-3 vertical-center">

             @php
             $count = Count($step);
             @endphp

             <center>
                 @if ($data->document_titles_status != $count)
                 @if ($data->document_titles_status == $item->document_steps_no)
                 @if ($item->document_steps_upload == 1)
                 <form id="form_upload" name="form_upload" data-id="{{$data->document_titles_id}}"
                     data-status="{{$item->document_steps_no}}" enctype="multipart/form-data">
                     เลขที่ อว. <input type="text" class="form-control" name="mhesi" id="mhesi"  value="{{$data->document_titles_mhesi}}"
                         required><br>
                         อัพโหลดไฟล์
                     <input type="file" class="form-control" name="upload" id="upload" accept="application/pdf"
                         required><br>

                     @csrf
                     <button class="btn btn-success" data-id="{{$data->document_titles_id}}"
                         data-status="{{$item->document_steps_no}}" {{-- onclick="upload(this)" --}} type="submit"
                         onclick="return confirm('กรุณาตรวจสอบความถูกต้อง ?')">อัพโหลด</button>
                 </form>
                 <br>
                 @else
                 <i class="cil-arrow-thick-right pointer"
                     style="font-size:30px;color: rgb(29, 168, 76);padding-right: 15px;"
                     data-status="{{$item->document_steps_no}}" data-step="out" data-id="{{$data->document_titles_id}}" 
                     onclick="nextstep(this)"></i>

                 @endif

                 <i class="cil-ban pointer" style="font-size:30px;color:red" data-status="{{$item->document_steps_no}}"
                     data-step="out" data-id="{{$data->document_titles_id}}" onclick="cancelstep(this)"> </i>
                 <br>

                 @endif
                 @endif
                 @if ($item->document_steps_upload == 1 )

                 <span onclick="window.open('{{asset($data->document_titles_upload)}}', '_blank', 'fullscreen=yes');"
                     class="pointer" style="color: blue"> {{$data->document_titles_upload_name}}</span>

                 @endif
             </center>


         </div>
     </div>
     <hr>
     @endforeach


     @endif
 </div>
 <script src="{{ asset('js/jquery.js') }}"></script>
 <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>


 <script>

     $('#form_upload').submit(function (event) {
         event.preventDefault();
         let data = new FormData();
         data.append('file_file', document.getElementById('upload').files[0]);


         let file = document.getElementById('upload').files[0];
         let id = $(this).data("id");
         let status = $(this).data("status");
         let upload = $('#upload').val();
         let new_file = $("input[name=upload]").val();
         let document_titles_mhesi = $('#mhesi').val();


         data.append('file', file);
         data.append('id', id);
         data.append('status', status);
         data.append('upload', upload);
         data.append('new_file', new_file);
         data.append('document_titles_mhesi', document_titles_mhesi);

         console.log(document_titles_mhesi);

         axios.post('upload', data)
             .then(function (response) {
                 console.log(response.data);
                 rander(id);
               
                location.reload();
             })
             .catch(function (error) {
                 console.log(error);
             });

     });






    //  function upload(data) {
    //      let id = $(data).data("id");
    //      let upload = $('#upload').val();
    //      let status = $(data).data("status");
    //      let document_titles_mhesi =  $('#document_titles_mhesi').val();

    //      console.log(document_titles_mhesi);


    //      if (upload == '') {
    //          alert('กรุณาอัพโหลดไฟล์เอกสาร');
    //          $('#upload').focus();
    //      } else {
    //          axios.post('upload', {
    //                  'upload': upload,
    //                  'document_titles_mhesi': document_titles_mhesi,
    //                  'id': id,
    //                  'status': status,
    //              }, {
    //                  headers: {
    //                      'Content-Type': 'multipart/form-data'
    //                  }
    //              })
    //              .then(function (response) {
    //                  console.log(response.data);

    //                  rander(id);
    //              })
    //              .catch(function (error) {
    //                  console.log(error);
    //              });
    //      }



    //  }


     function nextstep(data) {

         if (confirm('กรุณาตรวจสอบความถูกต้อง ?')) {
             let id = $(data).data("id");
             let status = $(data).data("status");
             let step = $(data).data("step");
             axios.post('nextstep', {
                     'status': status,
                     'step': step,
                     'id': id,
                 })
                 .then(function (response) {
                     console.log(response);

                     rander(id);
                 })
                 .catch(function (error) {
                     console.log(error);
                 });
         }



     }

     function cancelstep(data) {

         if (confirm('กรุณาตรวจสอบความถูกต้อง ?')) {
             let id = $(data).data("id");
             console.log(id);
             let status = $(data).data("status");
             let step = $(data).data("step");
             axios.post('cancelstep', {
                     'status': status,
                     'step': step,
                     'id': id,
                 })
                 .then(function (response) {
                     console.log(response);
                     rander(id);
                 })
                 .catch(function (error) {
                     console.log(error);
                 });
         }
     }

 </script>
