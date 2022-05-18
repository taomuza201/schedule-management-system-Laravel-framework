<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>รายการกำหนดการ</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th align="center">{{$title}}</th>
            </tr>
            <tr>
                <th align="center">ลำดับที่</th>
                <th align="center">วันเริ่มต้น</th>
                <th align="center">วันสิ้นสุด</th>
                <th align="center">เรื่อง</th>
                <th align="center">รายละเอียด</th>

                @if ($status=='all')
                <th align="center">ผู้รับผิดชอบ</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @php
            $number = 1;
            @endphp

            @foreach ($calendar as $row)
            <tr>
                <td align="center">{{$number}} </td>
                <td align="left">{{ formatDateThat_Time($row->start)}} </td>
                <td align="left">{{formatDateThat_Time($row->end)}} </td>
                <td align="left">{{$row->title}} </td>
                <td align="left">{{$row->description}} </td>

                @if ($status=='all')
                <td align="left">              
                    @if ($row->name == '')
                    ทุกคน
                    @else 
                    {{$row->name}}
                    @endif
                </td>
                @endif



            </tr>
            @php
            $number ++;
            @endphp
            @endforeach

        </tbody>
    </table>
</body>

</html>
