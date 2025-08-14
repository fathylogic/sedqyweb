@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
         
        <div class="pull-right">
            <a class="btn btn-primary me-sm-3 me-1" href="{{ route('renters.index') }}"><i class="fa fa-arrow-left"></i>&nbsp;  عودة &nbsp;</a>
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

<form method="POST" action="{{ route('renters.update',$renter->id) }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $renter->id }}">
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Login -->
          <div class="card border">
            <div class="card-body">

<div class="row g-3">
<div class="col-md-6">
                            <label class="form-label" for="name">الاسم     <i class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                            <input type="text" id="name" name="name" value="{{ $renter->name }}" class="form-control" required   />
                          </div>
                          <div class="col-md-6">
                            <label class="form-label" for="id_no">    رقم الهوية     <i class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                            <input type="text" id="id_no" name="id_no" value="{{ $renter->id_no }}" required class="form-control"   />
                          </div>
 
                          <div class="col-md-6">
                            <label class="form-label" for="nationality">    الجنسية     <i class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                            <input type="text" id="nationality" name="nationality" value="{{ $renter->nationality }}" required class="form-control"   />
                          </div>

                           <div class="col-md-6">
                            <label class="form-label" for="mobile_no">      رقم الموبيل (الواتس)      <i class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                            <input type="text" id="mobile_no" required name="mobile_no" value="{{ $renter->mobile_no }}" class="form-control"   />
                          </div>
                                                     
                             <div class="col-md-6">
                          <label for="file" class="form-label">   صورة

<?php $url = asset('storage/'.$renter->img) ; ?> <a href="{{ $url }}" target="_blank" >  <i class="fa fa-eye "  aria-hidden="true"></i>   </a>

                          </label>
            <input type="file" name="file" id="file" class="form-control" >
           
                          </div>
                      
                            <div class="col-md-12">
                            <label class="form-label" for="notes">       ملاحظات      </label>
                            <textarea   id="notes" name="notes" class="form-control"  >{{ $renter->notes }}</textarea>
                          </div>
                          
                        </div>

            
    <div class="mb-3">
        
        
        <div class="col-md-6 text-renter">
            <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"> حفظ &nbsp;  <i class="fa-solid fa-floppy-disk"></i> </button>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</form>

<p class="text-renter text-primary"><small>أوقاف إبراهيم صدقي محمد سعيد أفندي</small></p>
@endsection