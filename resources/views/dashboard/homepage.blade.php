@extends('dashboard.base')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.0/chart.min.js"
    integrity="sha512-yadYcDSJyQExcKhjKSQOkBKy2BLDoW6WnnGXCAkCoRlpHGpYuVuBqGObf3g/TdB86sSbss1AOP4YlGSb6EKQPg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-sm-4 col-lg-4">
                <div class="card text-white bg-primary">
                    <div class="card-body pb-0">
                        <div class="btn-group float-right">
                            <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <svg class="c-icon">
                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use>
                                </svg>
                            </button>
                            {{-- <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a>
                              <a class="dropdown-item" href="#">Something else here</a>
                            </div> --}}
                        </div>
                        <div class="text-value-lg">
                          @php
                          $count_tracking =  DB::table('trackings')->select('*')->count();
                      @endphp
                      
                   {{$count_tracking}}
                        </div>
                        <div>จำนวนงานติดตามและจัดเก็บไฟล์เอกสารทั้งหมด</div>
                    </div>
                    <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                        <canvas class="chart" id="card-chart1" height="70"></canvas>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-4 col-lg-4">
                <div class="card text-white bg-info">
                    <div class="card-body pb-0">
                        <button class="btn btn-transparent p-0 float-right" type="button">
                            <svg class="c-icon">
                              <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use>
                            </svg>
                        </button>
                        <div class="text-value-lg">
                          @php
                          $count_calendars =  DB::table('calendars')->select('*')->count();
                      @endphp
                      
                   {{$count_calendars}}

                        </div>
                        <div>จำนวนกิจกรรมทั้งหมด</div>
                    </div>
                    <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                        <canvas class="chart" id="card-chart2" height="70"></canvas>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-4 col-lg-4">
                <div class="card text-white bg-warning">
                    <div class="card-body pb-0">
                        <div class="btn-group float-right">
                            <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <svg class="c-icon">
                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use>
                                </svg>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                    href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a
                                    class="dropdown-item" href="#">Something else here</a></div>
                        </div>
                        <div class="text-value-lg">  @php
                          $count_agendas =  DB::table('agendas')->select('*')->count();
                      @endphp
                      
                   {{$count_agendas}}</div>
                        <div>จำนวนวาระการประชุมทั้งหมด</div>
                    </div>
                    <div class="c-chart-wrapper mt-3" style="height:70px;">
                        <canvas class="chart" id="card-chart3" height="70"></canvas>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <!-- /.col-->
        </div>
        <!-- /.row-->
        <div class="card-columns cols-2">
            <div class="card">
                <div class="card-header">สรุปรายงานติดตามและจัดเก็บไฟล์เอกสาร
                    <div class="card-header-actions">
                      {{-- <a class="card-header-action" href="http://www.chartjs.org"
                            target="_blank"><small class="text-muted">docs</small></a> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="c-chart-wrapper">
                      @php
                      $tracking = DB::table('trackings')->select('*', 'trackings.created_at')
                      ->join('districts', 'trackings.districts_id', 'districts.districts_id')
                      ->join('faculties', 'districts.faculties_id', 'faculties.faculties_id')
                      ->select('districts_name', DB::raw('count(*) as total'))
                      ->groupBy('districts_name')
                      ->get();

                     
                      @endphp
                        <canvas id="myChart1" width="400" height="400"></canvas>
                        <script>
                            var ctx = document.getElementById('myChart1');
                            var myChart1 = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                  labels: [@php
                                    foreach ($tracking as $row) {
                              echo "'".$row->districts_name."',";
                                }
                                    @endphp],
                                    datasets: [{
                                        label: '# จำนวนเอกสาร',
                                        data: [@php
                                    foreach ($tracking as $row) {
                              echo "'".$row->total."',";
                                }
                                    @endphp],
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(255, 159, 64, 0.2)',
                                            'rgba(227, 8, 61, 0.2)',
                                            'rgba(221, 114, 2, 0.2)',
                                            'rgba(208, 40, 119, 0.2)',
                                            'rgba(43, 246, 147, 0.2)',
                                            'rgba(195, 87, 10, 0.2)',
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)',
                                            'rgba(227, 8, 61, 1)',
                                            'rgba(221, 114, 2, 1)',
                                            'rgba(208, 40, 119, 1)',
                                            'rgba(43, 246, 147, 1)',
                                            'rgba(195, 87, 10, 1)',
                                            ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });

                        </script>

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">สรุปรายงานปฏิทิน / กิจกรรม
                    <div class="card-header-actions"><a class="card-header-action" href="http://www.chartjs.org"
                            target="_blank"><small class="text-muted">docs</small></a></div>
                </div>
                <div class="card-body">
                    <div class="c-chart-wrapper">

              
                      @php
              $calendar =   DB::table('calendars')->select('*')
            ->leftJoin('users', 'calendars.user_id', '=', 'users.id')
            ->select('name', DB::raw('count(*) as total'))
            ->groupBy('name')
            ->get()
                  @endphp

                        <canvas id="myChart2" width="400" height="400"></canvas>
                        <script>
                            var ctx = document.getElementById('myChart2');
                            var myChart2 = new Chart(ctx, {
                                type: 'doughnut',
                                data: {
                                  labels: [@php
                                    foreach ($calendar as $row) {
                                      if($row->name==null){
                                        echo "'ทั้งหมด',";
                                      }else{
                                        echo "'".$row->name."',";
                                      }
                                }
                                    @endphp],
                                    datasets: [{
                                        label: '# จำนวนกำหนดการ',
                                        data: [@php
                                    foreach ($calendar as $row) {
                                      echo "'".$row->total."',";
                                      }
                                    @endphp],
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(255, 159, 64, 0.2)',
                                            'rgba(227, 8, 61, 0.2)',
                                            'rgba(221, 114, 2, 0.2)',
                                            'rgba(208, 40, 119, 0.2)',
                                            'rgba(43, 246, 147, 0.2)',
                                            'rgba(195, 87, 10, 0.2)',
                                            'rgba(77, 8, 88,0.2)',
                                            'rgba(63, 198, 75,0.2)',
                                            'rgba(4, 39, 80,0.2)',
                                            'rgba(252, 222, 128,0.2)',
                                            'rgba(124, 246, 139,0.2)',
                                            'rgba(243, 140, 187, 0.2)',
                                            'rgba(164, 67, 17, 0.2)',
                                            'rgba(49, 144, 184,0.2)',
                                            'rgba(178, 241, 178,0.2)',
                                            'rgba(13, 188, 11, 0.2)',
                                            'rgba(203, 45, 187, 0.2)',
                                            'rgba(137, 41, 238, 0.2)',
                                            'rgba(86, 8, 213,0.2)',
                                            'rgba(184, 155, 161,0.2)',
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)',
                                            'rgba(227, 8, 61, 1)',
                                            'rgba(221, 114, 2, 1)',
                                            'rgba(208, 40, 119, 1)',
                                            'rgba(43, 246, 147, 1)',
                                            'rgba(195, 87, 10, 1)',
                                            'rgba(77, 8, 88, 1)',
                                            'rgba(63, 198, 75, 1)',
                                            'rgba(4, 39, 80, 1)',
                                            'rgba(252, 222, 128, 1)',
                                            'rgba(124, 246, 139, 1)',
                                            'rgba(243, 140, 187, 1)',
                                            'rgba(164, 67, 17, 1)',
                                            'rgba(49, 144, 184, 1)',
                                            'rgba(178, 241, 178, 1)',
                                            'rgba(13, 188, 11, 1)',
                                            'rgba(203, 45, 187, 1)',
                                            'rgba(137, 41, 238, 1)',
                                            'rgba(86, 8, 213, 1)',
                                            'rgba(184, 155, 161, 1)',
                                            ],
                                        borderWidth: 1
                                    }]
                                },
                                // options: {
                                //     scales: {
                                //         y: {
                                //             beginAtZero: true
                                //         }
                                //     }
                                // }
                            });

                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>








@endsection

@section('javascript')



@endsection
