@extends('layouts.app')

@section('content')
    





    <div class="row">
        <div class="col">
            <div class="card  mb-3">
                <div class="card-header bg-lighter"><strong>{{ $maincenter->name }} </strong>
                </div>
                <div class="card-body">

                     <div class="col-md-3 float-end">
                                    <div>
                                        @if ($maincenter->img != '')
                                            <a href="<?= asset('storage/' . $maincenter->img) ?>" target="_blank">
                                                <img src="<?= asset('storage/' . $maincenter->img) ?>" class="w-100" />
                                            </a>
                                        @else
                                            <?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>
                                            <img class=" float-end" style="width: 125px ; height: 125px;" src="{{ $root }}/assets/img/branding/sedqilogo1.png">
                                        @endif
                                    </div>
                                </div>
                    <div class="col-md-9 float-start">
                    <div class="row">
                      <div class="col-md-6 p-0 float-start mb-1">
                        <div
                          class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                               عدد الوحدات  
                        </div>
                        <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100"> 45    
                        </div>
                      </div>
                      <div class="col-md-6 p-0 float-start mb-1">
                        <div
                          class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                         حساب البنك 
                        </div>
                        <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">  {{ $maincenter->iban }} </div>
                      </div>
                    </div>

                     <div class="row">
                      <div class="col-md-6 p-0 float-start mb-1">
                        <div
                          class="col-md-4 border rounded text-maincenter fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                               الموظف المسؤول 
                        </div>
                        <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">  {{ @$maincenter->employee->name }}    
                        </div>
                      </div>
                      
                      <div class="col-md-6 p-0 float-start mb-1">
                        <div
                          class="col-md-4 border rounded text-maincenter fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                        ملاحظات
                        </div>
                        <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">  {{ $maincenter->notes }} </div>
                      </div>
                    </div>


                                    
                                  
                                   
                                   

                                </div>
                   

                    

                    






                </div>
            </div>


            <div class="card mb-3">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-units"
                                role="tab" aria-selected="true">
                                المراكز الفرعية
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-sarf" role="tab"
                                aria-selected="false">
                                المصروفات
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-kabd" role="tab"
                                aria-selected="false">
                                الايرادات
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="form-tabs-units" role="tabpanel">
                       بيانات المراكز الفرعية
                    </div>
                    <div class="tab-pane fade" id="form-tabs-sarf" role="tabpanel">
                       
                        بيانات المصروفات
                    </div>
                    <div class="tab-pane fade" id="form-tabs-kabd" role="tabpanel">

                            بيانات الايرادات
                                
                    </div>
                </div>
            </div>
        </div>
    </div>





   
@endsection
