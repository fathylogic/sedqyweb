@extends('layouts.app')

@section('content')


@if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Whoops!</strong> يوجد خطأ في بيانات الادخال.<br><br>
      <ul>
         @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
         @endforeach
      </ul>
    </div>
@endif

<form method="POST" action="{{ route('employees.update',$employee->id) }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $employee->id }}">
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Login -->
          <div class="card border">
            <div class="card-body">

<div class="row g-3">
<div class="col-md-4">
                            <label class="form-label" for="name">الاسم     <i class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                            <input type="text" id="name" name="name" value="{{ $employee->name }}" class="form-control" required   />
                          </div>
                          <div class="col-md-4">
                            <label class="form-label" for="id_no">    رقم الهوية     <i class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                            <input type="text" id="id_no" name="id_no" value="{{ $employee->id_no }}" required class="form-control"   />
                          </div>

                          <div class="col-md-4">
                            <label class="form-label" for="nationality">    الجنسية     <i class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                            <input type="text" id="nationality" name="nationality" value="{{ $employee->nationality }}" required class="form-control"   />
                          </div>

                           <div class="col-md-4">
                            <label class="form-label" for="mobile_no">      رقم الموبيل (الواتس)      <i class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                            <input type="text" id="mobile_no" required name="mobile_no" value="{{ $employee->mobile_no }}" class="form-control"   />
                          </div>

                          <div class="col-md-4">
                                    <label class="form-label" for="iban"> الحساب البنكي (IBAN) <i
                                            class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="iban" value="{{ $employee->iban }}" required name="iban" class="form-control" />
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="job"> الوظيفة <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="job" value="{{ $employee->job }}" required name="job" class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="center_id"> المركز الربحي الذي يعمل به </label>
                                    <select id="center_id" name="center_id" class="select2 form-select"
                                        data-allow-clear="true">
                                        <option value="">غير محدد</option>
                                        @foreach ($centers as $row)
                                            <option value="{{ $row->id }}" @if($employee->center_id==$row->id) {{ 'selected' }}@endif>{{ $row->center_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="salary"> المرتب <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="salary" value="{{ $employee->salary }}" required name="salary" class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="birthday"> تاريخ الميلاد </label>
                                    <input type="text" id="birthday" value="{{ $employee->birthday }}" name="birthday" class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="birthdayh"> هجري تاريخ الميلاد </label>
                                    <input type="text" id="birthdayh" value="{{ $employee->birthdayh }}" name="birthdayh" class="form-control" />
                                </div>


                             <div class="col-md-4">
                          <label for="file" class="form-label">   صورة

<?php $url = asset('storage/'.$employee->img) ; ?> <a href="{{ $url }}" target="_blank" >  <i class="fa fa-eye "  aria-hidden="true"></i>   </a>

                          </label>
            <input type="file" name="file" id="file" class="form-control" >

                          </div>

                            <div class="col-md-12">
                            <label class="form-label" for="notes">       ملاحظات      </label>
                            <textarea   id="notes" name="notes" class="form-control"  >{{ $employee->notes }}</textarea>
                          </div>

                        </div>


    <div class="mb-3">


        <div class="col-md-4 text-employee">
            <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"> حفظ &nbsp;  <i class="fa-solid fa-floppy-disk"></i> </button>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</form>

<p class="text-employee text-primary"><small> </small></p>
@endsection
