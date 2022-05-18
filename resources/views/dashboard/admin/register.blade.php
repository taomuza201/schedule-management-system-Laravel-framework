@extends('dashboard.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mx-4 mt-5">
                <div class="card-body p-4">
                    <form method="POST" action="{{ URL('users/store') }}">
                        @csrf
                        <h1>{{ __('Register') }}</h1>
                        <p class="text-muted">Create account</p>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                                    </svg>
                                </span>
                            </div>
                            <input class="form-control" type="text" placeholder="{{ __('ชื่อ - นามสกุล') }}" name="name"
                                value="{{ old('name') }}" required autofocus>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-envelope-open">
                                        </use>
                                    </svg>
                                </span>
                            </div>
                            <input class="form-control" type="text" placeholder="{{ __('อีเมล') }}" name="email"
                                value="{{ old('email') }}" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">

                                    <i class="cil-phone"></i>

                                </span>
                            </div>
                            <input class="form-control" type="number" placeholder="{{ __('เบอร์โทร') }}" name="tel"
                                value="{{ old('tel') }}" required>
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
                                <option value="{{ $item->districts_id}}">{{ $item->districts_name}}</option>

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
                                <option value="{{$item->name}}">{{$item->name}}</option>

                                @endforeach
                            </select>
                        </div>


                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked">
                                        </use>
                                    </svg>
                                </span>
                            </div>
                            <input class="form-control" type="password" placeholder="{{ __('รหัสผ่าน') }}"
                                name="password" required>
                        </div>

                        <button class="btn btn-block btn-success" type="submit">{{ __('Register') }}</button>
                    </form>
                </div>
                {{-- <div class="card-footer p-4">
              <div class="row">
                <div class="col-6">
                  <button class="btn btn-block btn-facebook" type="button">
                    <span>facebook</span>
                  </button>
                </div>
                <div class="col-6">
                  <button class="btn btn-block btn-twitter" type="button">
                    <span>twitter</span>
                  </button>
                </div>
              </div>
            </div> --}}
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection
