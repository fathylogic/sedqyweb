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

<form method="POST" action="{{ route('centers.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Login -->
          <div class="card border">
            <div class="card-body">

<div class="row g-3">
                          <div class="col-md-6">
                            <label class="form-label" for="center_name">اسم المركز   <i class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                            <input type="text" id="center_name" name="center_name" class="form-control" required   />
                          </div>
                          <div class="col-md-6">
                             <label class="form-label" for="center_location">المنطقة <i class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                            <select id="center_location" name="center_location" required class="select2 form-select" data-allow-clear="true">
                              <option value="">اختر</option>
                               @foreach ($locations as $row)
                                 <option value="{{ $row->id }}">{{ $row->name }}</option>
                               @endforeach

                            </select>
                          </div>
                          
                         

                         
                          <div class="col-md-6">
                            <label class="form-label" for="electric_no">  حساب شركة الكهرباء   <i class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                            <input type="text" id="electric_no" name="electric_no" required class="form-control"   />
                          </div>
 
                          <div class="col-md-6">
                            <label class="form-label" for="woter_no">  حساب شركة المياة   <i class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                            <input type="text" id="woter_no" name="woter_no" required class="form-control"   />
                          </div>

                           <div class="col-md-6">
                            <label class="form-label" for="left_electric_no">  حساب   اخر للمصاعد    </label>
                            <input type="text" id="left_electric_no" name="left_electric_no" class="form-control"   />
                          </div>
                             <div class="col-md-6">
                          <label for="file" class="form-label">   صورة</label>
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