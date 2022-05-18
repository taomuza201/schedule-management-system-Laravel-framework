<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>รายการติดตามเอกสาร</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th align="center">{{$title}}</th>
            </tr>
            <tr>
                <th align="center">ลำดับที่</th>
                <th align="center">เลขทะเบียนส่ง</th>
                <th align="center">เลขที่ อว.</th>
                <th align="center">จาก</th>
                <th align="center">ถึง</th>
                <th align="center">เรื่อง</th>

                <th align="center">รายละเอียด</th>
                <th align="center">การปฎิบัติ</th>
                <th align="center">วันที่เอกสารออก</th>
                <th align="center">ผู้ทึทำรายการ</th>
            </tr>
        </thead>
        <tbody>
            @php
            $number = 1;
            @endphp

            @foreach ($tracking as $row)
            <tr>
                <td align="center">{{$number}} </td>
                <td align="left">
                    {{$row->districts_initials }}/{{ date('m', strtotime($row->created_at))}}.{{$row->trackings_number }}
                </td>
                <td align="left"> {{$row->trackings_mhesi }}</td>
                <td align="left"> {{$row->districts_prefix }} {{$row->districts_fname }}
                    {{$row->districts_lname }}</td>
                <td align="left"> {{$row->trackings_to }}</td>
                <td align="left"> {{$row->trackings_name }}</td>
                <td align="left">{{$row->trackings_detail}}</td>
                <td align="left"> @include('octuslog.tracking.type.step')</td>
                <td align="left">{{ formatDateThat($row->created_at)}}</td>
                <td align="left">{{$row->name}}</td>

            </tr>
            @php
            $number ++;
            @endphp
            @endforeach

        </tbody>
    </table>
</body>

</html>
