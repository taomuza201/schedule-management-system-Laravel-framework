@if ($row-> trackings_status == 1)

<span style="color: red">เอกสารถูกยกเลิก</span>
@else


@if ($row->trackings_main == 10 && $row->trackings_sub_2 <=11 && $row->trackings_sub_2 >= 1   ) 
        @if ($row->trackings_sub_2 == 1)
        แนบสัญญายืมเงิน
        @elseif ($row->trackings_sub_2 == 2)
        แนบสำเนาบันทึกข้อความ เชิญวิทยากร
        @elseif ($row->trackings_sub_2 == 3)
        แจ้งเลขาโครงการดำเนินกิจกรรม
        @elseif ($row->trackings_sub_2 == 4)
        ส่งกองคลัง
        @elseif ($row->trackings_sub_2 == 5)
        กองคลังโอนเงินยืม
        @elseif ($row->trackings_sub_2 == 6)
        ดำเนินกิจกรรม
        @elseif ($row->trackings_sub_2 == 7)
        เลขาโครงการ ทำเอกสารล้างเงินยืม
        @elseif ($row->trackings_sub_2 == 8)
        หน.สำนักงาน ตรวจเอกสารล้างเงินยืม
        @elseif ($row->trackings_sub_2 == 9)
        จัดส่งให้กองคลัง
        @elseif ($row->trackings_sub_2 == 10)
        กองคลังทำใบล้างเงินยืม
        @elseif ($row->trackings_sub_2 == 11)
        <span style="color:rgb(59, 168, 59)"> ล้างเงินยืมสำเร็จ  </span>  
        @endif
@elseif ($row->trackings_main == 10 && $row->trackings_sub_3 <=6  && $row->trackings_sub_3 >= 1   ) 
        @if ($row->trackings_sub_3 == 1)
        แจ้งเลขาโครงการดำเนินกิจกรรม
        @elseif ($row->trackings_sub_3 == 2)
        ดำเนินกิจกรรม
        @elseif ($row->trackings_sub_3 == 3)
        เลขาโครงการ ทำเอกสารเบิกเงิน
        @elseif ($row->trackings_sub_3 == 4)
        หน.สำนักงาน ตรวจเอกสารเบิกเงิน
        @elseif ($row->trackings_sub_3 == 5)
        จัดส่งให้กองคลัง
        @elseif ($row->trackings_sub_3 == 6)
        <span style="color:rgb(59, 168, 59)">  กองคลังโอนเงินให้ผู้ทำรายงาน/หัวหนาโครงการ -สำเร็จ </span>  
        @endif
@elseif ($row->trackings_main <= 10 ) 
    @if ($row->trackings_main == 1)
    ใส่ในกล่อง ลงนามแล้ว
    @elseif ($row->trackings_main == 2)
    หน.สำนักงาน ตรวจสอบ และขอเลขจาก หลักสูตร/สาขา/คณะ
    @elseif ($row->trackings_main == 3)
    บันทึกหนังสือส่ง ของ สนง.
    @elseif ($row->trackings_main == 4)
    จัดส่งให้ หลักสูตร/สาขา/คณะ
    @elseif ($row->trackings_main == 5)
    บันทึก เลขรับ/ผู้รับเรื่อง (ในกรณีไม่มีเลขรับ) หนังสือของ หลักสูตร/สาขา/คณะ
    @elseif ($row->trackings_main == 6)
    ติดตามหนังสือ จาก หลักสูตร ไปสาขา ไปคณะ
    @elseif ($row->trackings_main == 7)
    คณะอนุญาต อนุมัติ
    @elseif ($row->trackings_main == 8)
    คณะจองเงิน
    @elseif ($row->trackings_main == 9)
    คณะจองเงิน
    @elseif ($row->trackings_main == 10)
    อัพโหลดไฟล์ บันทึกข้อความ ขออนุญาต อนุมัติ
    @endif
@endif
@endif