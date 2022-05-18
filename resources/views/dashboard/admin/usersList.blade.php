@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12col-xl-12  ">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>จัดการข้อมูลลผู้ใช้งาน</div>
                    <div class="card-body">

                      
                      @if (session('success'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                          {{ session('success') }}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      @endif
                      <div class="row p-4">
                        <a class="btn btn-lg btn-primary" href="addusers">เพิ่มผู้ใช้งาน</a>
                    </div>
                      <div class="table-responsive">
                        <table class="table table-responsive-sm table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>ชื่อ - นามสกุล</th>
                            <th>อีเมล</th>
                            <th>หน้าที่</th>
                            <th>ตำบลที่รับผิดชอบ</th>
                         
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($users as $user)
                            <tr>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->email }}</td>
                              <td>{{ $user->menuroles }}</td>
                              <td>{{ $user->districts_name }}</td>
                              {{-- <td>
                                <a href="{{ url('/users/' . $user->id) }}" class="btn btn-block btn-primary">View</a>
                              </td> --}}
                              <td>
                                <a href="{{ url('/users/' . $user->id . '/edit') }}" class="btn btn-block btn-primary">แก้ไข</a>
                              </td>
                              <td>
                                @if( $you->id !== $user->id )
                                <form action="{{ route('users.destroy', $user->id ) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-block btn-danger">ลบ</button>
                                </form>
                                @endif
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
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

