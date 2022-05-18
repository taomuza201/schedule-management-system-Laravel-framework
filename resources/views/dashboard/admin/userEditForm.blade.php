@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row justify-content-center">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 " >
                <div class="card ">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('แก้ขไข้อมูล') }} {{ $user->name }}</div>
                    <div class="card-body">
                        <br>
                        <form method="POST" action="{{URL('/users/'.$user->id )}}">
                            @csrf
                            @method('PUT')
                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="cil-user"></i>
                                </span>
                            </div>
                            <input class="form-control" type="text" placeholder="{{ __('ชื่อ - นามสกุล') }}" name="name" 
                                value="{{  $user->name }}" required autofocus>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="cil-envelope-open"></i>
                                </span>
                            </div>
                            <input class="form-control" type="text" placeholder="{{ __('อีเมล') }}" name="email"
                                value="{{  $user->email }}" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">

                                    <i class="cil-phone"></i>

                                </span>
                            </div>
                            <input class="form-control" type="number" placeholder="{{ __('เบอร์โทร') }}" name="tel"
                                value="{{  $user->tel }}" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="cil-building"></i>
                                </span>
                            </div>
                            <select name="districts_id" value="{{ old('districts_id') }}" required class="form-control">
                                <option value="">กรุณาเลือกสักกัดตำบล</option>

                                @foreach ($districts as $item)
                                <option value="{{ $item->districts_id}}"    
                                  @if ($item->districts_id == $user->districts_id)
                                  selected
                                @endif>{{ $item->districts_name}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="cil-user"></i>
                                </span>
                            </div>
                            <select name="menuroles" value="{{ old('menuroles') }}" required class="form-control">
                                <option value="">กรุณาเลือกตำแหน่ง</option>

                                @foreach ($roles as $item)
                                <option value="{{$item->name}}"
                                  @if ($item->name == $user->menuroles)
                                  selected
                                @endif
                                  >{{$item->name}}</option>

                                @endforeach
                            </select>
                        </div>


                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="cil-lock-locked"></i>
                                </span>
                            </div>
                            <input class="form-control" type="password" placeholder="{{ __('รหัสผ่าน') }}"
                                name="password" >
                        </div>



                            <button class="btn btn-block btn-success" type="submit">{{ __('Save') }}</button>
                            <a href="{{ route('users.index') }}" class="btn btn-block btn-primary">{{ __('Return') }}</a> 
                        </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection

@section('javascript')

@endsection