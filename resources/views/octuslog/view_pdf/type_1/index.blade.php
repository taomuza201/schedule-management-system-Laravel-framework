<!DOCTYPE html>
<html lang="th">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกข้อคความ</title>
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


        body {
            font-family: 'THSarabunIT';
            font-size: 16.5pt;
            margin: 0;
            padding: 0;

        }



        @page {
            size: 21cm 29.7cm portrait;
            padding: 0;
            margin-top: 2cm;
            margin-bottom: 1.5cm;
            margin-left: 3cm;
            margin-right: 1.5cm;

        }

        .p {
            text-align: justify;
            line-height: 1;
            text-indent: 90px;
            white-space: 1;
            word-spacing: 0px; 
            /* width: 18cm; */
        }

        .img {
            margin-top: -0.4cm;
            height: 1.6cm;
            width: 1.6cm;
            position: absolute;
        }

        .head {
            margin-top: -0.6cm;
            position: static;
        }

        table {
            padding: 0;
            margin: 0;
            width: 630px;
        }

        tr {
            height: 10px;
        }

        .column {
            float: left;
            width: 50%;

            /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

    </style>

<body>
    <img src="{{url('doc/icon.png')}}" alt="" class="img">
    <div style="text-align: center" class="head"><span style="font-size: 20pt;margin-top:-5px; display: inline;"
            align="center"><b>บันทึกข้อความ</b></span> </div>

    <span style="font-size:18pt;margin:0;padding:0;"><b>ส่วนราชการ&nbsp;</b></span>
    <span>{{$document_title->faculties_name }} {{$document_title->districts_faculty_branch }}
        <br>
        <div class="row">
            <div class="column">
                <span style="font-size:18pt;margin:0;padding:0;"><b>ที่&nbsp;</b></span>
                <span>{{$document_title->document_titles_mhesi}}</span>
            </div>
            <div class="column">
                <span style="font-size:18pt;margin:0;padding:0;"><b>วันที่&nbsp;</b></span>
                <span> &nbsp;&nbsp;&nbsp;&nbsp;{{formatDatemonth( $document_title->document_titles_date)}}</span>
            </div>
        </div>
        <span style="font-size:18pt;margin:0;padding:0; "><b>เรื่อง</b></span>
        <span>{{$document_title->document_titles_name }}</span>
        <br>
        เรียน&nbsp; คณบดี{{$document_title->faculties_name }}



        <div style="width: 630px">
            @php
            $segment = new Segment();
           //echo '<hr/>';
           $result = $segment->get_segment_array($data['text_part_1_2']);
           
         
       @endphp
            <div class="p">{{$data['text_part_1_1']}}{{implode('', $result)}}</div>
          
        </div>
        <hr>

        <div class="p">{{$data['text_part_1_1']}}{{$data['text_part_1_2']}}</div>

</body>

</html>
