@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary btn-sm mb-2" href="{{ route('users.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>

@if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Whoops!</strong> يوجد أخطاء في ادخال البيانات.<br><br>
      <ul>
         @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
         @endforeach
      </ul>
    </div>
@endif

<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Login -->
          <div class="card border">
            <div class="card-body">

<div class="row g-3">
                          <div class="col-md-6">
                            <label class="form-label" for="name">الأسم  </label>
                            <input type="text" id="name" name="name" value="{{$user->name}}" class="form-control" placeholder="الأسم" />
                          </div>
                          <div class="col-md-6">
                            <label class="form-label" for="mobile_no">الجوال   </label>
                            <input type="text" id="mobile_no" name="mobile_no" value="{{$user->mobile_no}}" class="form-control" placeholder="رقم الواتس" />
                          </div>




                          <div class="col-md-6">
                            <label class="form-label" for="email"> البريد الإلكتروني  </label>
                            <div class="input-group input-group-merge">
                              <input type="text" id="email" value="{{$user->email}}"  name="email" class="form-control" placeholder="mglava"
                                aria-label="john.doe" aria-describedby="email2" />
                              <span class="input-group-text" id="email2">@example.com</span>
                            </div>
                          </div>

                             <div class="col-md-6">
                             <label class="form-label" for="is_admin">  هل المستخدم مدير    </label>

                            <div class="form-check form-switch mb-2">
                              <label class="switch">
                          <input name="is_admin" value="1" @if($user->is_admin) {{'checked'}}@endif  type="checkbox" id="is_admin" class="switch-input">
                          <span class="switch-toggle-slider">
                            <span class="switch-on">
                              <i class="ti ti-check"></i>
                            </span>
                            <span class="switch-off">
                              <i class="ti ti-x"></i>
                            </span>
                          </span>
                          <span class="switch-label"> مدير </span>
                        </label>
                            </div>


                          </div>
                          <div class="col-md-6">
                            <div class="form-password-toggle">
                              <label class="form-label" for="password">كلمة مرور</label>
                              <div class="input-group input-group-merge">
                                <input type="password" id="password" name="password" class="form-control"
                                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                  aria-describedby="-password2" />
                                <span class="input-group-text cursor-pointer" id="-password2"><i
                                    class="ti ti-eye-off"></i></span>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-password-toggle">
                              <label class="form-label" for="-confirm-password">تاكيد كلمة المرور </label>
                              <div class="input-group input-group-merge">
                                <input type="password" id="confirm-password" name="confirm-password" class="form-control"
                                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                  aria-describedby="-confirm-password2" />
                                <span class="input-group-text cursor-pointer" id="confirm-password2"><i
                                    class="ti ti-eye-off"></i></span>
                              </div>
                            </div>
                          </div>
                        </div>


    <div class="mb-3">


        <div class="col-md-6 text-unit">
            <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"> حفظ &nbsp;  <i class="fa-solid fa-floppy-disk"></i> </button>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</form>

<p class="text-unit text-primary"><small> </small></p>
@endsection
