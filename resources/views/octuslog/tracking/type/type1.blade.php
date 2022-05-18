<style>
    .read-only {
        pointer-events: none;
        opacity: 0.3;
    }

    .read-only-none {
        pointer-events: none;
    }


    .read-only-none a {
        pointer-events: auto;
    }
    .inputtypefile {
        /* pointer-events: none; */
    }

</style>


@if ($data != '')

@if ($data->trackings_status == 1 )
<div class="read-only">
    @elseif($data->trackings_sub_2 == 11 || $data->trackings_sub_3 == 6 )
    <div class="read-only-none">


        <style>
            input[type="file"] {
                pointer-events: none;
                display: none;
            }

            .btn_upload {
                pointer-events: none;
                display: none;
            }

        </style>
        @else
        <div>
            @endif
            <div class="row">

                <div class="col mx-auto">
                    <center>

                        @if ($data->trackings_main == 1)
                        <div class="card card_flow border-1 flow-shadow" style="width: 80% ;" onclick="step_main(this)"
                            data-status="1">
                            <div class="card-body" style="text-align: center">
                                ใส่ในกล่อง ลงนามแล้ว
                            </div>
                        </div>
                        @else
                        <div class="card card_flow border-1" style="width: 80% ;" onclick="step_main(this)"
                            data-status="1">
                            <div class="card-body" style="text-align: center">
                                ใส่ในกล่อง ลงนามแล้ว
                            </div>
                        </div>
                        @endif

                        @if ($data->trackings_main == 2)
                        <div class="card card_flow flow-shadow" style="width: 80%" onclick="step_main(this)"
                            data-status="2">
                            <div class="card-body" style="text-align: center">
                                <span style="color: red"> **</span><span>หน.สำนักงาน ตรวจสอบ และขอเลขจาก
                                    หลักสูตร/สาขา/คณะ (เลขที่ อว.)
                                </span>
                                <br>
                                <span style="color: red">{{$data->trackings_mhesi}}</span>
                            </div>
                        </div>
                        @else
                        <div class="card card_flow" style="width: 80%" onclick="step_main(this)" data-status="2">
                            <div class="card-body" style="text-align: center">
                                <span style="color: red"> **</span><span>หน.สำนักงาน ตรวจสอบ และขอเลขจาก
                                    หลักสูตร/สาขา/คณะ (เลขที่ อว.)
                                </span>
                                <br>
                                <span style="color: red">{{$data->trackings_mhesi}}</span>
                            </div>
                        </div>
                        @endif


                        @if ($data->trackings_main == 3)
                        <div class="card card_flow flow-shadow" style="width: 80%" onclick="step_main(this)"
                            data-status="3">
                            <div class="card-body" style="text-align: center">
                                <span>บันทึกหนังสือส่ง ของ สนง. </span>
                            </div>
                        </div>
                        @else
                        <div class="card card_flow" style="width: 80%" onclick="step_main(this)" data-status="3">
                            <div class="card-body" style="text-align: center">
                                <span>บันทึกหนังสือส่ง ของ สนง. </span>
                            </div>
                        </div>
                        @endif


                        @if ($data->trackings_main == 4)
                        <div class="card card_flow flow-shadow" style="width: 80%" onclick="step_main(this)"
                            data-status="4">
                            <div class="card-body" style="text-align: center">
                                <span>จัดส่งให้ หลักสูตร/สาขา/คณะ </span>
                            </div>
                        </div>
                        @else
                        <div class="card card_flow" style="width: 80%" onclick="step_main(this)" data-status="4">
                            <div class="card-body" style="text-align: center">
                                <span>จัดส่งให้ หลักสูตร/สาขา/คณะ </span>
                            </div>
                        </div>
                        @endif


                        @if ($data->trackings_main == 5)
                        <div class="card card_flow flow-shadow " style="width: 80%" onclick="step_main(this)"
                            data-status="5">
                            <div class="card-body" style="text-align: center">
                                <span style="color: red">**</span> <span>บันทึก เลขรับ/ผู้รับเรื่อง (ในกรณีไม่มีเลขรับ)
                                    หนังสือของ
                                    หลักสูตร/สาขา/คณะ
                                </span>
                                @if ($data->trackings_recipient != '')
                                <br>
                                <span style="color: red"> ผู้รับเอกสาร / เลขรับ : {{$data->trackings_recipient}} </span>
                                @endif

                            </div>
                        </div>
                        @else
                        <div class="card card_flow" style="width: 80%" onclick="step_main(this)" data-status="5">
                            <div class="card-body" style="text-align: center">
                                <span style="color: red">**</span> <span>บันทึก เลขรับ/ผู้รับเรื่อง (ในกรณีไม่มีเลขรับ)
                                    หนังสือของ
                                    หลักสูตร/สาขา/คณะ
                                </span>
                                @if ($data->trackings_recipient != '')
                                <br>
                                <span style="color: red"> ผู้รับเอกสาร / เลขรับ : {{$data->trackings_recipient}} </span>
                                @endif
                            </div>
                        </div>
                        @endif


                        @if ($data->trackings_main == 6)
                        <div class="card card_flow flow-shadow " style="width: 80%" onclick="step_main(this)"
                            data-status="6">
                            <div class="card-body" style="text-align: center">
                                <span>ติดตามหนังสือ จาก หลักสูตร ไปสาขา ไปคณะ</span>
                            </div>
                        </div>
                        @else
                        <div class="card card_flow" style="width: 80%" onclick="step_main(this)" data-status="6">
                            <div class="card-body" style="text-align: center">
                                <span>ติดตามหนังสือ จาก หลักสูตร ไปสาขา ไปคณะ</span>
                            </div>
                        </div>
                        @endif


                        @if ($data->trackings_main == 7)
                        <div class="card card_flow flow-shadow " style="width: 80%" onclick="step_main(this)"
                            data-status="7">
                            <div class="card-body" style="text-align: center">
                                <span>คณะอนุญาต อนุมัติ </span>
                            </div>
                        </div>
                        @else
                        <div class="card card_flow" style="width: 80%" onclick="step_main(this)" data-status="7">
                            <div class="card-body" style="text-align: center">
                                <span>คณะอนุญาต อนุมัติ </span>
                            </div>
                        </div>
                        @endif


                        @if ($data->trackings_main == 8)
                        <div class="card card_flow-button-l-col card_flow-button-r-col flow-shadow " style="width: 80%"
                            onclick="step_main(this)" data-status="8">
                            <div class="card-body" style="text-align: center">
                                <span>คณะจองเงิน</span>
                            </div>
                        </div>
                        @else
                        <div class="card card_flow-button-l-col card_flow-button-r-col" style="width: 80%"
                            onclick="step_main(this)" data-status="8">
                            <div class="card-body" style="text-align: center">
                                <span>คณะจองเงิน</span>
                            </div>
                        </div>
                        @endif

                </div>
                </center>

            </div>
            <div class="row">


                <div class="col">
                    <div class="row ">
                        <div class="col-4">

                            @if ($data->trackings_sub_1 == 1)
                            <div class="card card_flow flow-shadow-sub" onclick="step_sub1(this)" data-status="1">
                                <div class="card-body" style="text-align: center">
                                    {{-- <span style="color: red">**
                                    </span> --}}
                                    <span>จัดทำบันทึกข้อความ เชิญวิทยากร</span>
                                </div>
                            </div>
                            @else
                            <div class="card card_flow" onclick="step_sub1(this)" data-status="1">
                                <div class="card-body" style="text-align: center">
                                    {{-- <span style="color: red">**
                                    </span> --}}
                                    <span>จัดทำบันทึกข้อความ เชิญวิทยากร</span>
                                </div>
                            </div>
                            @endif

                            @if ($data->trackings_sub_1 == 2)
                            <div class="card card_flow flow-shadow-sub" onclick="step_sub1(this)" data-status="2">
                                <div class="card-body" style="text-align: center">
                                    {{-- <span style="color: red">** </span> --}}
                                    <span>ส่งไปที่วิทยากร</span>
                                </div>
                            </div>
                            @else
                            <div class="card card_flow" onclick="step_sub1(this)" data-status="2">
                                <div class="card-body" style="text-align: center">
                                    {{-- <span style="color: red">** </span> --}}
                                    <span>ส่งไปที่วิทยากร</span>
                                </div>
                            </div>
                            @endif


                            @if ($data->trackings_sub_1 == 3)
                            <div class="card card_flow flow-shadow-sub" onclick="step_sub1(this)" data-status="3">
                                <div class="card-body" style="text-align: center">
                                    {{-- <span style="color: red">** </span> --}}
                                    <span>วิทยากรลงนาม
                                    </span>
                                </div>
                            </div>
                            @else
                            <div class="card card_flow" onclick="step_sub1(this)" data-status="3">
                                <div class="card-body" style="text-align: center">
                                    {{-- <span style="color: red">** </span> --}}
                                    <span>วิทยากรลงนาม
                                    </span>
                                </div>
                            </div>
                            @endif


                            @if ($data->trackings_sub_1 == 4)
                            <div class="card">
                                <div class="card-body flow-shadow-sub" style="text-align: center"
                                    onclick="step_sub1(this)" data-status="4">
                                    <span style="color: red">**ตามเก็บแบบตอบรับจากวิทยากร</span>
                                    <input class="form-control" id="trackings_upload_1" name="trackings_upload_1"
                                        type="file" accept="application/pdf">

                                    <a href="{{asset($data->trackings_upload_1)}}"
                                        download="{{$data->trackings_upload_name_1}}">{{$data->trackings_upload_name_1}}</a><br>
                                    <button class="btn btn-sm btn-success mt-2  btn_upload" type="button"
                                        id="btn_trackings_upload_1" onclick="upload(this)"
                                        data-upload_at="upload1">อัพโหลดไฟล์</button>


                                        <button class="btn btn-sm btn-warning  btn_upload mt-2" type="button" data-status="4"
                                        onclick="file_emty(this)">กรณีไม่มีไฟล์</button>
                                </div>
                            </div>
                            @else
                            <div class="card">
                                <div class="card-body" style="text-align: center" onclick="step_sub1(this)"
                                    data-status="4">
                                    <span style="color: red">**ตามเก็บแบบตอบรับจากวิทยากร</span>
                                    <input class="form-control" id="trackings_upload_1" name="trackings_upload_1"
                                        type="file" accept="application/pdf">
                                    <a href="{{asset($data->trackings_upload_1)}}"
                                        download="{{$data->trackings_upload_name_1}}">{{$data->trackings_upload_name_1}}</a><br>
                                    <button class="btn btn-sm btn-success  btn_upload" type="button"
                                        id="btn_trackings_upload_1" onclick="upload(this)"
                                        data-upload_at="upload1">อัพโหลดไฟล์</button>

                                    <button class="btn btn-sm btn-warning  btn_upload" type="button" data-status="4"
                                        onclick="file_emty(this)">กรณีไม่มีไฟล์</button>

                                </div>
                            </div>
                            @endif

                        </div>
                        <div class="col-8 mx-auto">
                            <center>

                                @if ($data->trackings_main == 9)
                                <div class="card  card_flow flow-shadow" onclick="step_main(this)" data-status="9">
                                    <div class="card-body" style="text-align: center">
                                        <span>จัดทำบันทึกข้อความ ขออนุญาต อนุมัติ </span>
                                    </div>
                                </div>
                                @else
                                <div class="card  card_flow " onclick="step_main(this)" data-status="9">
                                    <div class="card-body" style="text-align: center">
                                        <span>จัดทำบันทึกข้อความ ขออนุญาต อนุมัติ </span>
                                    </div>
                                </div>
                                @endif

                                @if ($data->trackings_main == 10 && $data->trackings_sub_2 == 0 &&
                                $data->trackings_sub_3 == 0)
                                <div class="card card_flow-button-l card_flow-button-r flow-shadow"
                                    onclick="step_main(this)" data-status="10">
                                    <div class="card-body" style="text-align: center">
                                        <span style="color: red"> ** อัพโหลดไฟล์ บันทึกข้อความ ขออนุญาต อนุมัติ </span>
                                        <center> <input class="form-control" id="trackings_upload_2"
                                                name="trackings_upload_2" type="file" accept="application/pdf"
                                                style="width: 50%">

                                            ลงวันที่
                                            <input type="date" name="trackings_mhesi_date" id="trackings_mhesi_date1"
                                                class="form-control" style="width: 50%"
                                                value="{{$data->trackings_mhesi_date}}">
                                            <a href="{{asset($data->trackings_upload_2)}}"
                                                download="{{$data->trackings_upload_name_2}}">{{$data->trackings_upload_name_2}}</a>
                                        </center>
                                        <br>
                                        <button class="btn btn-sm btn-success mt-2 btn_upload" type="button"
                                            id="btn_trackings_upload_2" onclick="upload(this)"
                                            data-upload_at="upload2">อัพโหลดไฟล์</button>

                                            <button class="btn btn-sm btn-warning  mt-2 btn_upload" type="button"
                                            data-status="10" onclick="file_emty_main(this)">กรณีไม่มีไฟล์</button>

                                    </div>
                                </div>
                                @else
                                <div class="card card_flow-button-l card_flow-button-r" onclick="step_main(this)"
                                    data-status="10">
                                    <div class="card-body" style="text-align: center">
                                        <span style="color: red"> ** อัพโหลดไฟล์ บันทึกข้อความ ขออนุญาต อนุมัติ </span>
                                        <center> <input class="form-control" id="trackings_upload_2"
                                                name="trackings_upload_2" type="file" accept="application/pdf"
                                                style="width: 50%">
                                            ลงวันที่
                                            <input type="date" name="trackings_mhesi_date" id="trackings_mhesi_date2"
                                                class="form-control" style="width: 50%"
                                                value="{{$data->trackings_mhesi_date}}">
                                            <a href="{{asset($data->trackings_upload_2)}}"
                                                download="{{$data->trackings_upload_name_2}}">{{$data->trackings_upload_name_2}}</a>
                                        </center><br>
                                        <button class="btn btn-sm btn-success mt-2 btn_upload" type="button"
                                            id="btn_trackings_upload_2" onclick="upload(this)"
                                            data-upload_at="upload2">อัพโหลดไฟล์</button>


                                        <button class="btn btn-sm btn-warning  mt-2 btn_upload" type="button"
                                            data-status="10" onclick="file_emty_main(this)">กรณีไม่มีไฟล์</button>

                                       
                                    </div>
                                </div>
                                @endif

                            </center>
                            <div class="row ">
                                <div class="col" id="step_sub2">


                                    @if ($data->trackings_sub_3 >= 1)
                                    <div class="read-only">
                                        @else
                                        <div>
                                            @endif


                                            @if ($data->trackings_sub_2 == 1)
                                            <div class="card card_flow flow-shadow" onclick="step_sub2(this)"
                                                data-status="1">
                                                <div class="card-body" style="text-align: center">
                                                    <span>แนบสัญญายืมเงิน</span>
                                                    <center> <input class="form-control" id="trackings_upload_3"
                                                            name="trackings_upload_3" type="file"
                                                            accept="application/pdf"></center>
                                                    <a href="{{asset($data->trackings_upload_3)}}"
                                                        download="{{$data->trackings_upload_name_3}}">{{$data->trackings_upload_name_3}}</a><br>
                                                    <button class="btn btn-sm btn-success mt-2 btn_upload" type="button"
                                                        id="btn_trackings_upload_3" onclick="upload(this)"
                                                        data-upload_at="upload3">อัพโหลดไฟล์</button>
                                                </div>
                                            </div>
                                            @else
                                            <div class="card card_flow" onclick="step_sub2(this)" data-status="1">
                                                <div class="card-body" style="text-align: center">
                                                    <span>แนบสัญญายืมเงิน</span>
                                                    <center> <input class="form-control" id="trackings_upload_3"
                                                            name="trackings_upload_3" type="file"
                                                            accept="application/pdf"></center>
                                                    <a href="{{asset($data->trackings_upload_3)}}"
                                                        download="{{$data->trackings_upload_name_3}}">{{$data->trackings_upload_name_3}}</a><br>
                                                    <button class="btn btn-sm btn-success mt-2 btn_upload" type="button"
                                                        id="btn_trackings_upload_3" onclick="upload(this)"
                                                        data-upload_at="upload3">อัพโหลดไฟล์</button>


                                                    <button class="btn btn-sm btn-warning  mt-2 btn_upload"
                                                        type="button" data-status="1"
                                                        onclick="file_emty_step_sub2(this)">กรณีไม่มีไฟล์</button>



                                                </div>
                                            </div>
                                            @endif

                                            @if ($data->trackings_sub_2 == 2)
                                            <div class="card card_flow flow-shadow" onclick="step_sub2(this)"
                                                data-status="2">
                                                <div class="card-body" style="text-align: center">
                                                    <span>วิทยแนบสำเนาบันทึกข้อความ
                                                        เชิญวิทยากรากรลงนาม </span>
                                                </div>
                                            </div>
                                            @else
                                            <div class="card card_flow" onclick="step_sub2(this)" data-status="2">
                                                <div class="card-body" style="text-align: center">
                                                    <span>วิทยแนบสำเนาบันทึกข้อความ
                                                        เชิญวิทยากรากรลงนาม </span>
                                                </div>
                                            </div>
                                            @endif

                                            @if ($data->trackings_sub_2 == 3)
                                            <div class="card card_flow flow-shadow" onclick="step_sub2(this)"
                                                data-status="3">
                                                <div class="card-body" style="text-align: center">
                                                    <span>แจ้งเลขาโครงการดำเนินกิจกรรม</span>
                                                </div>
                                            </div>
                                            @else
                                            <div class="card card_flow" onclick="step_sub2(this)" data-status="3">
                                                <div class="card-body" style="text-align: center">
                                                    <span>แจ้งเลขาโครงการดำเนินกิจกรรม</span>
                                                </div>
                                            </div>
                                            @endif

                                            @if ($data->trackings_sub_2 == 4)
                                            <div class="card card_flow flow-shadow" onclick="step_sub2(this)"
                                                data-status="4">
                                                <div class="card-body" style="text-align: center">
                                                    <span>ส่งกองคลัง</span>
                                                </div>
                                            </div>
                                            @else
                                            <div class="card card_flow" onclick="step_sub2(this)" data-status="4">
                                                <div class="card-body" style="text-align: center">
                                                    <span>ส่งกองคลัง</span>
                                                </div>
                                            </div>
                                            @endif

                                            @if ($data->trackings_sub_2 == 5)
                                            <div class="card card_flow flow-shadow" onclick="step_sub2(this)"
                                                data-status="5">
                                                <div class="card-body" style="text-align: center">
                                                    <span>กองคลังโอนเงินยืม</span>
                                                </div>
                                            </div>
                                            @else
                                            <div class="card card_flow" onclick="step_sub2(this)" data-status="5">
                                                <div class="card-body" style="text-align: center">
                                                    <span>กองคลังโอนเงินยืม</span>
                                                </div>
                                            </div>
                                            @endif

                                            @if ($data->trackings_sub_2 == 6)
                                            <div class="card card_flow flow-shadow" onclick="step_sub2(this)"
                                                data-status="6">
                                                <div class="card-body" style="text-align: center">
                                                    <span>ดำเนินกิจกรรม</span>
                                                </div>
                                            </div>
                                            @else
                                            <div class="card card_flow" onclick="step_sub2(this)" data-status="6">
                                                <div class="card-body" style="text-align: center">
                                                    <span>ดำเนินกิจกรรม</span>
                                                </div>
                                            </div>
                                            @endif

                                            @if ($data->trackings_sub_2 == 7)
                                            <div class="card card_flow flow-shadow" onclick="step_sub2(this)"
                                                data-status="7">
                                                <div class="card-body" style="text-align: center">
                                                    <span style="color: red">
                                                        **ต้องจัดทำบันทึกข้อความ
                                                        เชิญวิทยากรก่อน</span><br>
                                                    <span>ทำเอกสารล้างเงินยืม</span>
                                                </div>
                                            </div>
                                            @else
                                            <div class="card card_flow" onclick="step_sub2(this)" data-status="7">
                                                <div class="card-body" style="text-align: center">
                                                    <span style="color: red">
                                                        **ต้องจัดทำบันทึกข้อความ
                                                        เชิญวิทยากรก่อน</span><br>
                                                    <span>ทำเอกสารล้างเงินยืม</span>
                                                </div>
                                            </div>
                                            @endif

                                            @if ($data->trackings_sub_2 == 8)
                                            <div class="card card_flow flow-shadow" onclick="step_sub2(this)"
                                                data-status="8">
                                                <div class="card-body" style="text-align: center">
                                                    <span>หน.สำนักงาน ตรวจเอกสารล้างเงินยืม</span>
                                                </div>
                                            </div>
                                            @else
                                            <div class="card card_flow" onclick="step_sub2(this)" data-status="8">
                                                <div class="card-body" style="text-align: center">
                                                    <span>หน.สำนักงาน ตรวจเอกสารล้างเงินยืม</span>
                                                </div>
                                            </div>
                                            @endif

                                            @if ($data->trackings_sub_2 == 9)
                                            <div class="card card_flow flow-shadow" onclick="step_sub2(this)"
                                                data-status="9">
                                                <div class="card-body" style="text-align: center">
                                                    <span>จัดส่งให้กองคลัง</span>
                                                </div>
                                            </div>
                                            @else
                                            <div class="card card_flow" onclick="step_sub2(this)" data-status="9">
                                                <div class="card-body" style="text-align: center">
                                                    <span>จัดส่งให้กองคลัง</span>
                                                </div>
                                            </div>
                                            @endif

                                            @if ($data->trackings_sub_2 == 10)
                                            <div class="card card_flow flow-shadow" onclick="step_sub2(this)"
                                                data-status="10">
                                                <div class="card-body" style="text-align: center">
                                                    <span>กองคลังทำใบล้างเงินยืม</span>
                                                </div>
                                            </div>
                                            @else
                                            <div class="card card_flow" onclick="step_sub2(this)" data-status="10">
                                                <div class="card-body" style="text-align: center">
                                                    <span>กองคลังทำใบล้างเงินยืม</span>
                                                </div>
                                            </div>
                                            @endif

                                            @if ($data->trackings_sub_2 == 11)
                                            <div class="card flow-shadow" onclick="step_sub2(this)" data-status="11">
                                                <div class="card-body" style="text-align: center">
                                                    <span>ล้างเงินยืมสำเร็จ </span>
                                                    {{-- <span>หน.สำนักงาน จัดเก็บ ใบล้างเงินยืม </span> --}}
                                                    <center>

                                                        {{-- <input class="form-control" id="trackings_upload_4"
                                                            name="trackings_upload_4" type="file"
                                                            accept="application/pdf"></center>
                                                    <a href="{{asset($data->trackings_upload_4)}}"
                                                        download="{{$data->trackings_upload_name_4}}">{{$data->trackings_upload_name_4}}</a><br>
                                                        <button class="btn btn-sm btn-success mt-2 btn_upload"
                                                            type="button" id="btn_trackings_upload_4"
                                                            onclick="upload(this)"
                                                            data-upload_at="upload4">อัพโหลดไฟล์</button> --}}
                                                </div>
                                            </div>
                                            @else
                                            <div class="card " onclick="step_sub2(this)" data-status="11">
                                                <div class="card-body" style="text-align: center">
                                                    {{-- <span>หน.สำนักงาน จัดเก็บ ใบล้างเงินยืม </span> --}}
                                                    <span>ล้างเงินยืมสำเร็จ </span>
                                                    <center>

                                                        {{-- <input class="form-control" id="trackings_upload_4"
                                                            name="trackings_upload_4" type="file"
                                                            accept="application/pdf"></center>
                                                    <a href="{{asset($data->trackings_upload_4)}}"
                                                        download="{{$data->trackings_upload_name_4}}">{{$data->trackings_upload_name_4}}</a><br>
                                                        <button class="btn btn-sm btn-success mt-2 btn_upload"
                                                            type="button" id="btn_trackings_upload_4"
                                                            onclick="upload(this)"
                                                            data-upload_at="upload4">อัพโหลดไฟล์</button> --}}
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col" id="step_sub3">


                                        @if ($data->trackings_sub_2 >= 1)
                                        <div class="read-only">
                                            @else
                                            <div>
                                                @endif


                                                @if ($data->trackings_sub_3 == 1)
                                                <div class="card card_flow flow-shadow" onclick="step_sub3(this)"
                                                    data-status="1">
                                                    <div class="card-body" style="text-align: center">
                                                        <span>แจ้งเลขาโครงการดำเนินกิจกรรม</span>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="card card_flow" onclick="step_sub3(this)" data-status="1">
                                                    <div class="card-body" style="text-align: center">
                                                        <span>แจ้งเลขาโครงการดำเนินกิจกรรม</span>
                                                    </div>
                                                </div>
                                                @endif


                                                @if ($data->trackings_sub_3 == 2)
                                                <div class="card card_flow flow-shadow" onclick="step_sub3(this)"
                                                    data-status="2">
                                                    <div class="card-body" style="text-align: center">
                                                        <span>ดำเนินกิจกรรม</span>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="card card_flow" onclick="step_sub3(this)" data-status="2">
                                                    <div class="card-body" style="text-align: center">
                                                        <span>ดำเนินกิจกรรม</span>
                                                    </div>
                                                </div>
                                                @endif


                                                @if ($data->trackings_sub_3 == 3)
                                                <div class="card card_flow flow-shadow" onclick="step_sub3(this)"
                                                    data-status="3">
                                                    <div class="card-body" style="text-align: center">
                                                        <span style="color: red">
                                                            *ต้องจัดทำบันทึกข้อความ
                                                            เชิญวิทยากรก่อน</span><br>
                                                        <span>เลขาโครงการ ทำเอกสารเบิกเงิน</span>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="card card_flow" onclick="step_sub3(this)" data-status="3">
                                                    <div class="card-body" style="text-align: center">
                                                        <span style="color: red">
                                                            *ต้องจัดทำบันทึกข้อความ
                                                            เชิญวิทยากรก่อน</span><br>
                                                        <span>เลขาโครงการ ทำเอกสารเบิกเงิน</span>
                                                    </div>
                                                </div>
                                                @endif


                                                @if ($data->trackings_sub_3 == 4)
                                                <div class="card card_flow flow-shadow" onclick="step_sub3(this)"
                                                    data-status="4">
                                                    <div class="card-body" style="text-align: center">
                                                        <span>หน.สำนักงาน ตรวจเอกสารเบิกเงิน</span>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="card card_flow" onclick="step_sub3(this)" data-status="4">
                                                    <div class="card-body" style="text-align: center">
                                                        <span>หน.สำนักงาน ตรวจเอกสารเบิกเงิน</span>
                                                    </div>
                                                </div>
                                                @endif


                                                @if ($data->trackings_sub_3 == 5)
                                                <div class="card card_flow flow-shadow" onclick="step_sub3(this)"
                                                    data-status="5">
                                                    <div class="card-body" style="text-align: center">
                                                        <span>จัดส่งให้กองคลัง</span>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="card card_flow" onclick="step_sub3(this)" data-status="5">
                                                    <div class="card-body" style="text-align: center">
                                                        <span>จัดส่งให้กองคลัง</span>
                                                    </div>
                                                </div>
                                                @endif


                                                @if ($data->trackings_sub_3 == 6)
                                                <div class="card flow-shadow" onclick="step_sub3(this)" data-status="6">
                                                    <div class="card-body" style="text-align: center">
                                                        <span>กองคลังโอนเงินให้ผู้ทำรายงาน/หัวหนาโครงการ</span>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="card" onclick="step_sub3(this)" data-status="6">
                                                    <div class="card-body" style="text-align: center">
                                                        <span>กองคลังโอนเงินให้ผู้ทำรายงาน/หัวหนาโครงการ</span>
                                                    </div>
                                                </div>
                                                @endif


                                            </div>


                                            <hr>

                                            @if ($data->trackings_sub_2 == 11 || $data->trackings_sub_3 == 6 )
                                            <div class="read-only">
                                                @else
                                                <div>
                                                    @endif



                                                    <span style="color:red"> กรณีเอกสารถูกยกเลิก/ ตีกลับ
                                                        :</span>
                                                    <textarea class="form-control" id="text_cancel" name="text_cancel"
                                                        rows="6"
                                                        placeholder="อธิบายเหตุผมที่ถูกยกเลิกหรือตีกลับ..">{{$data->trackings_canceltext}}</textarea>
                                                    <br>

                                                    <center><button class="btn  btn-danger" type="button"
                                                            onclick="cancel(this)">ยกเลิกเอกสาร</button> </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="trackings_id" id="trackings_id" value="{{$data->trackings_id}}">
                    <input type="hidden" name="trackings_main" id="trackings_main" value="{{$data->trackings_main}}">
                    <input type="hidden" name="trackings_sub_1" id="trackings_sub_1" value="{{$data->trackings_sub_1}}">
                    <input type="hidden" name="trackings_sub_2" id="trackings_sub_2" value="{{$data->trackings_sub_2}}">
                    <input type="hidden" name="trackings_sub_3" id="trackings_sub_3" value="{{$data->trackings_sub_3}}">
                    <input type="hidden" name="old_trackings_mhesi" id="old_trackings_mhesi" value="{{$data->trackings_mhesi}}">
                    @endif




                    <script>
                        function step_main(data) {
                            let id = $('#trackings_id').val();
                            let step = $(data).data('status');
                            let status = 'step_main';

                            let old_trackings_mhesi = $('#old_trackings_mhesi').val();

                            if (step == 2) {

                                if (trackings_mhesi = prompt("กรุณากรอกเลขทะเบียนส่ง", old_trackings_mhesi )) {
                                    $.ajax({
                                        url: '{{URL("tracking/tracking_step")}}' + '/' + id + '/' + step + '/' +
                                            status + '?trackings_mhesi=' +
                                            trackings_mhesi,
                                        success: function (data) {
                                            rander_trackings(id);
                                        }
                                    });
                                }
                            } else if (step == 3) {

                                if ($('#trackings_main').val() < 2) {
                                    alert(
                                        'กรุณาทำขั้นตอน กรุณากรอกเลขทะเบียนส่ง'
                                    );
                                } else if (confirm('คุณต้องการเปลี่ยนสถานะเอกสาร ?')) {
                                    tracking_step(id, step, status);
                                }

                            } else if (step == 4) {

                                if ($('#trackings_main').val() < 2) {
                                    alert(
                                        'กรุณาทำขั้นตอน กรุณากรอกเลขทะเบียนส่ง'
                                    );
                                } else if (confirm('คุณต้องการเปลี่ยนสถานะเอกสาร ?')) {
                                    tracking_step(id, step, status);
                                }

                            } else if (step == 5) {

                                if ($('#trackings_main').val() < 2) {
                                    alert(
                                        'กรุณาทำขั้นตอน กรุณากรอกเลขทะเบียนส่ง'
                                    );
                                } else if (trackings_recipient = prompt("กรุณากรอกผู้รับเอกสาร / เลขรับ", "")) {
                                    $.ajax({
                                        url: '{{URL("tracking/tracking_step")}}' + '/' + id + '/' + step + '/' +
                                            status + '?recipient=' + trackings_recipient,
                                        success: function (data) {
                                            rander_trackings(id);
                                        }
                                    });
                                }
                            } else if (step == 6) {

                                if ($('#trackings_main').val() < 5) {
                                    alert(
                                        'กรุณาทำขั้นตอน บันทึก เลขรับ/ผู้รับเรื่อง (ในกรณีไม่มีเลขรับ) หนังสือของ หลักสูตร/สาขา/คณะ'
                                    );
                                } else if (confirm('คุณต้องการเปลี่ยนสถานะเอกสาร ?')) {
                                    tracking_step(id, step, status);
                                }

                            } else if (step == 7) {
                                if ($('#trackings_main').val() < 5) {
                                    alert(
                                        'กรุณาทำขั้นตอน บันทึก เลขรับ/ผู้รับเรื่อง (ในกรณีไม่มีเลขรับ) หนังสือของ หลักสูตร/สาขา/คณะ'
                                    );
                                } else if (confirm('คุณต้องการเปลี่ยนสถานะเอกสาร ?')) {
                                    tracking_step(id, step, status);
                                }
                            } else if (step == 8) {
                                if ($('#trackings_main').val() < 5) {
                                    alert(
                                        'กรุณาทำขั้นตอน บันทึก เลขรับ/ผู้รับเรื่อง (ในกรณีไม่มีเลขรับ) หนังสือของ หลักสูตร/สาขา/คณะ'
                                    );
                                } else if (confirm('คุณต้องการเปลี่ยนสถานะเอกสาร ?')) {
                                    tracking_step(id, step, status);
                                }
                            } else if (step == 9) {
                                if ($('#trackings_main').val() < 5) {
                                    alert(
                                        'กรุณาทำขั้นตอน บันทึก เลขรับ/ผู้รับเรื่อง (ในกรณีไม่มีเลขรับ) หนังสือของ หลักสูตร/สาขา/คณะ'
                                    );
                                } else if (confirm('คุณต้องการเปลี่ยนสถานะเอกสาร ?')) {
                                    tracking_step(id, step, status);
                                }
                            } else if (step == 10) {

                            } else {
                                if (confirm('คุณต้องการเปลี่ยนสถานะเอกสาร ?')) {
                                    tracking_step(id, step, status);
                                }
                            }


                        }

                        function step_sub1(data) {

                            let id = $('#trackings_id').val();
                            let step = $(data).data('status');
                            let status = 'step_sub1';


                            if (step == 4) {

                            } else {
                                if (confirm('คุณต้องการเปลี่ยนสถานะเอกสาร ?')) {
                                    tracking_step(id, step, status);
                                }
                            }


                        }

                        function step_sub2(data) {



                            let id = $('#trackings_id').val();
                            let step = $(data).data('status');
                            let status = 'step_sub2';

                            if (step == 1) {

                            } else if (step == 7 && $('#trackings_sub_2').val() >= 1) {

                                if ($('#trackings_sub_1').val() == 4) {
                                    if (confirm('คุณต้องการเปลี่ยนสถานะเอกสาร ?')) {
                                        tracking_step(id, step, status);
                                    }
                                } else {
                                    alert('กรุณาทำขั้นตอน **ตามเก็บแบบตอบรับจากวิทยากร');
                                }

                            } else if ($('#trackings_main').val() == 10 && $('#trackings_sub_2').val() >= 1) {

                                if (step >= 7) {


                                    if ($('#trackings_sub_2').val() >= 7) {
                                        if (confirm('คุณต้องการเปลี่ยนสถานะเอกสาร ss?')) {
                                            tracking_step(id, step, status);
                                        }
                                    } else {
                                        alert('กรุณาทำขั้นตอน **ต้องจัดทำบันทึกข้อความ เชิญวิทยากรก่อน');
                                    }
                                } else {
                                    if (confirm('คุณต้องการเปลี่ยนสถานะเอกสาร ?')) {
                                        tracking_step(id, step, status);
                                    }
                                }


                            } else {
                                alert('กรุณาทำขั้นตอน แนบสัญญายืมเงิน');
                            }

                        }

                        function step_sub3(data) {

                            let id = $('#trackings_id').val();
                            let step = $(data).data('status');
                            let status = 'step_sub3';

                            if (step == 3 && $('#trackings_main').val() == 10) {

                                if ($('#trackings_sub_1').val() == 4) {
                                    if (confirm('คุณต้องการเปลี่ยนสถานะเอกสาร ?')) {
                                        tracking_step(id, step, status);
                                    }
                                } else {
                                    alert('กรุณาทำขั้นตอน **ตามเก็บแบบตอบรับจากวิทยากร');
                                }

                            } else if (step == 1 && $('#trackings_main').val() == 10 || step == 2 && $(
                                    '#trackings_main').val() == 10) {

                                if (confirm('คุณต้องการเปลี่ยนสถานะเอกสาร ?')) {
                                    tracking_step(id, step, status);
                                }
                            } else if (step == 4 && $('#trackings_main').val() == 10 || step == 5 && $(
                                    '#trackings_main').val() == 10 || step == 6 && $('#trackings_main').val() == 10) {
                                if ($('#trackings_sub_3').val() >= 3) {
                                    if (confirm('คุณต้องการเปลี่ยนสถานะเอกสาร ?')) {
                                        tracking_step(id, step, status);
                                    }
                                } else {
                                    alert('กรุณาทำขั้นตอน เลขาโครงการ ทำเอกสารเบิกเงิน');
                                }

                            } else {

                                alert('กรุณาทำขั้นตอน อัพโหลดไฟล์ บันทึกข้อความ ขออนุญาต อนุมัติ ');
                            }

                        }


                        function upload(data) {

                            let id = $('#trackings_id').val();
                            let upload_at = $(data).data('upload_at');

                            let data_form = new FormData();



                            if (upload_at == 'upload1') {

                                if ($('#trackings_upload_1').val() == '') {
                                    alert('กรุณาเลือกไฟล์');
                                }
                                data_form.append('file', document.getElementById('trackings_upload_1').files[0]);
                            } else if (upload_at == 'upload2') {

                                if ($('#trackings_main').val() >= 5) {
                                    if ($('#trackings_upload_2').val() == '') {
                                        alert('กรุณาเลือกไฟล์');
                                    }
                                } else {
                                    alert(
                                        'กรุณาทำขั้นตอน บันทึก เลขรับ/ผู้รับเรื่อง (ในกรณีไม่มีเลขรับ) หนังสือของ หลักสูตร/สาขา/คณะ'
                                    )
                                    return;
                                }


                                data_form.append('file', document.getElementById('trackings_upload_2').files[0]);

                                // data_form.append('trackings_mhesi1', $('#trackings_mhesi1').val());
                                // data_form.append('trackings_mhesi2', $('#trackings_mhesi2').val());

                                data_form.append('trackings_mhesi_date1', $('#trackings_mhesi_date1').val());
                                data_form.append('trackings_mhesi_date2', $('#trackings_mhesi_date2').val());


                            } else if (upload_at == 'upload3') {

                                if ($('#trackings_main').val() == 10) {

                                    if ($('#trackings_upload_3').val() == '') {
                                        alert('กรุณาเลือกไฟล์');
                                    }
                                    
                                } else {
                                    alert('กรุณาทำขั้นตอน อัพโหลดไฟล์ บันทึกข้อความ ขออนุญาต อนุมัติ');
                                    return;
                                }

                                data_form.append('file', document.getElementById('trackings_upload_3').files[0]);
                            } else if (upload_at == 'upload4') {
                                if ($('#trackings_upload_4').val() == '') {
                                    alert('กรุณาเลือกไฟล์');
                                }
                                data_form.append('file', document.getElementById('trackings_upload_4').files[0]);
                            }

                            data_form.append('upload_at', upload_at);
                            data_form.append('id', id);
                            axios.post('tracking/upload', data_form)
                                .then(function (response) {
                                    rander_trackings(id);

                                })
                                .catch(function (error) {
                                    console.log(error);
                                });


                        }


                        function tracking_step(id, step, status) {
                            $.ajax({
                                url: '{{URL("tracking/tracking_step")}}' + '/' + id + '/' + step + '/' + status,
                                success: function (data) {
                                    rander_trackings(id);
                                },
                                error: function (error) {
                                    console.log('Error: ' + error);
                                }
                            });
                        }


                        function cancel(data) {

                            let id = $('#trackings_id').val();
                            let text = $('#text_cancel').val();
                            let data_form = new FormData();
                            data_form.append('id', id);
                            data_form.append('text', text);


                            if (text == '') {
                                alert('กรุณากรอกเหตุผลในการยกเลิกเอกสาร');
                            } else {
                                axios.post('tracking/cancel', data_form)
                                    .then(function (response) {
                                        rander_trackings(id);

                                    })
                                    .catch(function (error) {
                                        console.log(error);
                                    });
                            }

                        }

                    </script>

                    
<script>
    function file_emty(data) {

        let id = $('#trackings_id').val();
        let step = $(data).data('status');
        let status = 'step_sub1';



        if (confirm('คุณต้องการเปลี่ยนสถานะเอกสาร ?')) {
            tracking_step(id, step, status);
        }


    }

</script>
<script>
    function file_emty_main(data) {

        let id = $('#trackings_id').val();
        let step = $(data).data('status');
        let status = 'step_main';

        let trackings_mhesi_date = $('#trackings_mhesi_date2').val();

        if ($('#trackings_main').val() >= 5) {
            if (confirm('คุณต้องการเปลี่ยนสถานะเอกสาร ?')) {
                $.ajax({
                    url: '{{URL("tracking/file_emty")}}' + '/' + id +
                        '/' +
                        step + '/' +
                        status + '?trackings_mhesi_date=' +
                        trackings_mhesi_date,
                    success: function (data) {
                        rander_trackings(id);
                    }
                });
            }
        } else {
            alert(
                'กรุณาทำขั้นตอน บันทึก เลขรับ/ผู้รับเรื่อง (ในกรณีไม่มีเลขรับ) หนังสือของ หลักสูตร/สาขา/คณะ'
            )
        }


    }

</script>


<script>
    function file_emty_step_sub2(data) {

        let id = $('#trackings_id').val();
        let step = $(data).data('status');
        let status = 'step_sub2';



        if ($('#trackings_main').val() >= 10) {

            if (confirm('คุณต้องการเปลี่ยนสถานะเอกสาร ?')) {
                tracking_step(id, step, status);
            }

        } else {
            alert(
                'กรุณาทำขั้นตอน อัพโหลดไฟล์ บันทึกข้อความ ขออนุญาต อนุมัติ'
            )
        }



    }

</script>