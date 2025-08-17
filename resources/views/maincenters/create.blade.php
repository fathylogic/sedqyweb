@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
         
        <div class="pull-right">
            <a class="btn btn-primary me-sm-3 me-1" href="{{ route('centers.index') }}"><i class="fa fa-arrow-left"></i>&nbsp;  عودة &nbsp;</a>
        </div>
    </div>
</div>

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

<form method="POST" action="{{ route('maincenters.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Login -->
          <div class="card border">
            <div class="card-body">

<div class="row g-3">
                          <div class="col-md-6">
                            <label class="form-label" for="name">اسم المركز الرئيسي    <i class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required   />
                          </div>
                          <div class="col-md-6">
                             <label class="form-label" for="iban">حساب الايبان  <i class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                             <input type="text" name="iban" class="form-control" id="iban" value="{{ old('iban') }}" required>
                            @error('iban')
                                <div style="color:red">{{ $message }}</div>
                            @enderror
                          </div>
                           <div class="col-md-6">
                                    <label class="form-label" for="emp_id">الموظف المسئول </label>
                                    <select id="emp_id" name="emp_id"   class="select2 form-select"
                                        data-allow-clear="true">
                                        <option value="">اختر </option>
                                        @foreach ($emps as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                          
                         

                         
                          
                             <div class="col-md-6">
                          <label for="file" class="form-label">   ارفاق مستند </label>
            <input type="file" name="file" id="file" class="form-control" >
           
                          </div>
                      
                            <div class="col-md-12">
                            <label class="form-label" for="notes">       ملاحظات      </label>
                            <textarea   id="notes" name="notes" class="form-control"  ></textarea>
                          </div>
                          
                        </div>

            
    <div class="mb-3">
        
        
        <div class="col-md-6 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">حفظ  <i class="fa-solid fa-floppy-disk"></i> </button>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</form>

<p class="text-center text-primary"><small>أوقاف إبراهيم صدقي محمد سعيد أفندي</small></p>
@endsection