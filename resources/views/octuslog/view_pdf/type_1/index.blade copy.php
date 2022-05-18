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
            font-size: 16pt;
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
            /* text-align: justify; */
            line-height: 1;
            word-spacing: 0px;
            text-indent: 90px;
            /* width: 18cm; */
        }

        .img {
            margin-top: -0.4cm;
            height: 1.6cm;
            width: 1.6cm;
            position: absolute;
        }

        table{
            padding: 0;
            margin: 0;
            width:630px;
        }
         tr {
           height: 100px;
        }

    </style>

<body>
    <img src="{{url('doc/icon.png')}}" alt="" class="img">
    <center><span style="font-size: 20pt;margin-top:-1;padding:0;"><b>บันทึกข้อความ</b></span></center>

    <table style="" >
        <tr>
            <td colspan="4"> <span style="font-size:18pt;margin:0;padding:0;"><b>ส่วนราชการ</b></span>
                <span>{{$document_title->faculties_name }} {{$document_title->districts_faculty_branch }} โทร.{{$document_title->faculties_tel }} </span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span style="font-size:18pt;margin:0;padding:0;"><b>ที่</b></span>
                 <span>{{$document_title->document_titles_mhesi}}</span>
            </td>
            <td colspan="2">
                <span style="font-size:18pt;margin:0;padding:0;"><b>วันที่</b></span> 
                <span> &nbsp;&nbsp;&nbsp;&nbsp;{{formatDatemonth( $document_title->document_titles_date)}}</span>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <span style="font-size:18pt;margin:0;padding:0; "><b>เรื่อง</b></span>
                <span>{{$document_title->document_titles_name }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                เรียน คณบดี{{$document_title->faculties_name }}
            </td>
        </tr>
        <tr>
            <td>
               
                
            </td>
        </tr>
        
    </table>
        <div style="width: 630px">
            <div class="p">{{$data['text_part_1']}}</div>
        </div>


</body>

</html>
