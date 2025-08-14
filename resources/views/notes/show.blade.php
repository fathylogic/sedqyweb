@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('centers.index') }}"> <i class="fa fa-arrow-left"></i>&nbsp;  عودة &nbsp;</a>
            </div>
        </div>
    </div>





    <div class="row">
        <div class="col">
            <div class="card  mb-3">
                <div class="card-header bg-lighter"><strong>{{ $center->location->name }} / {{ $center->center_name }}</strong>
                </div>
                <div class="card-body">

                     <div class="col-md-3 float-end">
                                    <div>
                                        @if ($center->img != '')
                                            <a href="<?= asset('storage/' . $center->img) ?>" target="_blank">
                                                <img src="<?= asset('storage/' . $center->img) ?>" class="w-100" />
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
                         حساب المياة 
                        </div>
                        <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">  {{ $center->woter_no }} </div>
                      </div>
                    </div>

                     <div class="row">
                      <div class="col-md-6 p-0 float-start mb-1">
                        <div
                          class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                               حساب الكهرباء   
                        </div>
                        <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">  {{ $center->electric_no }}    
                        </div>
                      </div>
                      <div class="col-md-6 p-0 float-start mb-1">
                        <div
                          class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                               حساب المصعد   
                        </div>
                        <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">  {{ $center->left_electric_no }}    
                        </div>
                      </div>
                      <div class="col-md-6 p-0 float-start mb-1">
                        <div
                          class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                        ملاحظات
                        </div>
                        <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">  {{ $center->notes }} </div>
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
                                الوحدات
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
                        @if (!empty($units))
                         <div class="card-datatable table-responsive pt-0">
 <table  class="table table-striped FathyTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                      
                                        <th> نوع الوحدة </th>
                                        <th> الدور </th>
                                        <th> رقم الوحدة </th>
                                        <th> حساب الكهرباء </th>
                                        <th> المستأجر الحالي </th>
                                        <th> صورة </th>
                                        <th width="280px">اجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0 ; ?>
                                    @foreach ($units as $key => $unit)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                          
                                            <td>{{ $unit->unitType->name }}</td>
                                            <td>{{ $unit->floor_no }}</td>

                                            <td>{{ $unit->unit_no }}</td>
                                            <td>{{ $unit->electric_no }}</td>
                                            <td>{{ @$unit->renter->name }}</td>
                                            <td>
                                                <a href="#exampleModal{{ $unit->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $unit->id }}">
                                                    <i class="fa fa-eye " aria-hidden="true"></i>
                                                </a>
                                                <div class="modal fade" id="exampleModal{{ $unit->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"> صورة </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <img src="<?= asset('storage/' . $unit->img) ?>"
                                                                    width="400px" height="400px">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">اغلاق</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>

                                            
                                            <td>

                                <div class="d-inline-block">
                                    <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="text-primary ti ti-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end m-0">
                                        <li><a href="{{ route('units.edit', $unit->id) }}""
                                                class="dropdown-item"><i class="fa-solid fa-circle-info"></i> تعديل</a></li>

                                        <div class="dropdown-divider"></div>
                                        {{-- <li><a href="#" onclick="fn_delete_center({{ $unit->id }})"
                                                class="dropdown-item text-danger delete-record"><i
                                                    class="fa-solid fa-trash-can"></i> حذف</a></li> --}}
                                    </ul>
                                </div>
                                <a href="{{ route('units.show', $unit->id) }}"
                                    class="btn btn-sm btn-icon item-edit">
                                    <i class="text-primary ti ti-pencil"></i>
                                </a>


                            </td>
                                            
                                        </tr>
                                
                                 <?php $i++ ; ?>
                        @endforeach
                        </tbody>
                        <tfoot>
                                    <tr>
                                        <th>#</th>
                                      
                                        <th> نوع الوحدة </th>
                                        <th> الدور </th>
                                        <th> رقم الوحدة </th>
                                        <th> حساب الكهرباء </th>
                                        <th> المستأجر الحالي </th>
                                        <th> صورة </th>
                                        <th >اجراءات</th>
                                    </tr>
                                </tfoot>
                        </table>
                         </div>
                        @endif

                    </div>
                    <div class="tab-pane fade" id="form-tabs-sarf" role="tabpanel">
                        sarf contents
                    </div>
                    <div class="tab-pane fade" id="form-tabs-kabd" role="tabpanel">

                        kabd contents
                    </div>
                </div>
            </div>
        </div>
    </div>





   
@endsection
