@foreach($document_title as $row)
<tr>
    @php
    $count = DB::table('document_steps')->where('faculties_id',$row->faculties_id)->get();
    $count = count( $count );


    @endphp

    <td class="no_number" data-href="{{ url('document/'.$row->document_titles_id  ) }}"></td>
    <td>
        <center>

            @if ($row->document_titles_status == $count)
            <i class="far fa-file-pdf pointer" style="font-size: 32px; color: lawngreen;"
                onclick="window.open('{{asset($row->document_titles_upload)}}', '_blank', 'fullscreen=yes');"></i>
            @else
            <i class="far fa-window-close" style="font-size: 32px; color: red;"></i>
            @endif
        </center>
    </td>
    <td data-href="{{ url('document/'.$row->document_titles_id  ) }}">{{ $row->document_titles_mhesi  }}</td>
    <td data-href="{{ url('document/'.$row->document_titles_id  ) }}">{{ $row->document_titles_name  }}</td>
    <td data-href="{{ url('document/'.$row->document_titles_id  ) }}">{{ $row->districts_name   }}</td>
    <td data-href="{{ url('document/'.$row->document_titles_id  ) }}">
        <center>
            @php

            if($row->document_titles_status_within == 2  && $row->document_titles_status >= 1){
            $satatus =
            DB::table('document_steps')->select('*')->where('faculties_id',$row->faculties_id)->where('document_steps_no',$row->document_titles_status)->first();

            echo $satatus->document_steps_name;
            }else{
                    if($row->document_titles_status_within == 1){   
                        echo 'อยู่ระหว่างดำเนินการสร้างเอกสาร';
                    }else {
                        echo 'คณะอาจารย์ตรวจสอบและอนุมัติเอกสาร';
                    }
            }

            @endphp
        </center>
        {{-- document_titles_status_within --}}
        {{-- document_titles_status --}}
    </td>


    <td>
        <center>

            @if ($row->document_titles_status == $count)
            <button class="btn btn-warning" type="button" style="color: #fff" onclick="status(this)"
                data-id="{{$row->document_titles_id}}">ดูสถานะ</button>
            @else
            <button class="btn btn-warning" type="button" style="color: #fff" onclick="status(this)"
                data-id="{{$row->document_titles_id}}">ดูสถานะ</button>
            <button class="btn btn-info" type="button" onclick="edit(this)"
                data-id="{{$row->document_titles_id}}">ดู/แก้ไขข้อมูล</button>
            <a class="btn btn-danger" href="{{URL('document/delete/'.$row->document_titles_id)}}"
                onclick="return confirm('คุณต้องการลบ {{ $row->document_patterns_name  }} ?')">ลบข้อมูล</a>
            @endif

        </center>
    </td>
</tr>
@endforeach

<script>
    function status(data) {
        let id = $(data).data("id");
        var modal = document.getElementById("warningModal");
        $('#warningModal').modal('show');
        rander(id);
    }

</script>
