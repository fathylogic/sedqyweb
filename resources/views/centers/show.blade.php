@extends('layouts.app')

@section('content')



    @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
    @endsession
    @if (\Session::has('danger'))
        <div class="alert alert-danger">
            <ul>
                <li>{!! \Session::get('danger') !!}</li>
            </ul>
        </div>
    @endif

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

    <div class="row">
        <div class="col">
            <div class="card  mb-3">
                <div class="card-header bg-lighter"><strong>{{ $center->location->name }} /
                        {{ $center->center_name }}</strong>
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
                                <img class=" float-end" style="width: 125px ; height: 125px;"
                                    src="{{ $root }}/assets/img/branding/sedqilogo1.png">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-9 float-start">


                        {{-- ---------------------UPDATE FORM---------------------------- --}}
                        <form method="POST" action="{{ route('centers.update', $center->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="maincenter_id" name="maincenter_id"
                                value="{{ $center->maincenter_id }}">
                            <input type="hidden" id="id" name="id" value="{{ $center->id }}">
                            <div class="container-xxl">
                                <div class="authentication-wrapper authentication-basic container-p-y">
                                    <div class="authentication-inner py-4">
                                        <!-- Login -->
                                        <div class="card border">
                                            <div class="card-header">
                                                <h5 id="mctitle"></h5>
                                            </div>
                                            <div class="card-body">

                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="center_name">اسم المركز
                                                            الفرعي <i class="fa fa-asterisk " style="color: red"
                                                                aria-hidden="true"></i></label>
                                                        <input type="text" name="center_name"
                                                            value="{{ $center->center_name }}" class="form-control"
                                                            required />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="center_location">المنطقة <i
                                                                class="fa fa-asterisk " style="color: red"
                                                                aria-hidden="true"></i></label>
                                                        <select id="center_location" name="center_location" required
                                                            class="select2 form-select" data-allow-clear="true">
                                                            <option value="">اختر</option>
                                                            @foreach ($locations as $row)
                                                                <option value="{{ $row->id }}"
                                                                    @if ($center->center_location == $row->id) {{ 'selected' }} @endif>
                                                                    {{ $row->name }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="hainame">الحي </label>
                                                        <input type="text" name="hainame" value="{{ $center->hainame }}"
                                                            class="form-control" />

                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="street">الشارع
                                                        </label>
                                                        <input type="text" name="street" value="{{ $center->street }}"
                                                            class="form-control" />

                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="Building_no">رقم
                                                            العمارة </label>
                                                        <input type="text" name="Building_no"
                                                            value="{{ $center->Building_no }}" class="form-control" />

                                                    </div>



                                                    <div class="col-md-6">
                                                        <label class="form-label" for="sak_no"> الموقع على
                                                            الخريطة </label>
                                                        <input type="text" name="gps" value="{{ $center->gps }}"
                                                            class="form-control" />
                                                        <a href='{{ $center->gps }}'
                                                            target='_blank'>{{ $center->gps }}</a>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label" for="sak_no">رقم الصك
                                                        </label>
                                                        <input type="text" name="sak_no" value="{{ $center->sak_no }}"
                                                            class="form-control" />

                                                    </div>


                                                    <div class="col-md-6">
                                                        <label class="form-label" for="electric_no"> حساب شركة
                                                            الكهرباء <i class="fa fa-asterisk " style="color: red"
                                                                aria-hidden="true"></i></label>
                                                        <input type="text" id="electric_no" name="electric_no"
                                                            value="{{ $center->electric_no }}" required
                                                            class="form-control" />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label" for="woter_no"> حساب شركة
                                                            المياة <i class="fa fa-asterisk " style="color: red"
                                                                aria-hidden="true"></i></label>
                                                        <input type="text" id="woter_no" name="woter_no"
                                                            value="{{ $center->woter_no }}" required
                                                            class="form-control" />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label" for="left_electric_no"> حساب
                                                            اخر للمصاعد
                                                        </label>
                                                        <input type="text" id="left_electric_no"
                                                            name="left_electric_no"
                                                            value="{{ $center->left_electric_no }}"
                                                            class="form-control" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="file" class="form-label"> صورة</label>
                                                        <input type="file" name="file" id="file"
                                                            class="form-control">

                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label" for="notes"> ملاحظات
                                                        </label>
                                                        <textarea id="notes" name="notes" class="form-control">{{ $center->notes }}</textarea>
                                                    </div>

                                                </div>



                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">الغاء </button>
                                                    <button type="submit" name="btn_add_center"
                                                        class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">

                                                        <i class="fa-solid fa-floppy-disk pe-2"></i>
                                                        حفظ
                                                    </button>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{-- ---------------------END UPDATE FORM---------------------------- --}}

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
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-kabd"
                                role="tab" aria-selected="false">
                                الايرادات
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-files"
                                role="tab" aria-selected="false">
                                المرفقات
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-ohda"
                                role="tab" aria-selected="false">
                                العهدة
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="form-tabs-units" role="tabpanel">
                        <a href="#exampleModal" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"
                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                            اضافة وحدة ايجارية جديدة <i class=" fa-solid fa-plus pe-2 " aria-hidden="true"></i>
                        </a>



                        @if (!empty($units))
                            <div class="card-datatable table-responsive pt-0">
                                <table class="table table-striped FathyTable">
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
                                        <?php $i = 0; ?>
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
                                                    <div class="modal fade" id="exampleModal{{ $unit->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"> صورة </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <img class="d-block"
                                                                        src="<?= asset('storage/' . $unit->img) ?>"
                                                                        width="100%">
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


                                                    <a href="{{ route('units.show', $unit->id) }}"
                                                        class="btn btn-sm btn-icon item-edit">
                                                        <i class="text-primary ti ti-pencil"></i>
                                                    </a>


                                                </td>

                                            </tr>

                                            <?php $i++; ?>
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
                                            <th>اجراءات</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif

                    </div>
                    
                    <div class="tab-pane fade" id="form-tabs-kabd" role="tabpanel">

                        <hr class="my-1" />
                        @if (!empty($payments))
                            <div class="card-datatable table-responsive pt-0">
                                <table class="table table-striped FathyTable">
                                    <thead>
                                        <tr>

                                            <th> المستأجر </th>
                                            <th> موعد الدفع </th>
                                            <th> المبلغ </th>
                                            <th> الدفعة </th>
                                            <th> حالة الدفع </th>
                                            <th>اجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($payments as $key => $row)
                                            <tr>

                                                <td>{{ $row->contract->renter->name }}</td>
                                                <td>{{ $row->p_date }} م - {{ $row->p_dateا }} هـ</td>
                                                <td>{{ $row->amount }} </td>
                                                <td>
                                                    @if ($row->payment_no == 0)
                                                        {{ $row->notes }} @else{{ $row->payment_no }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($row->status)
                                                        <i class="fa fa-circle-check  text-success"
                                                            aria-hidden="true"></i>
                                                        {{ $row->actual_date }} - {{ $row->actual_dateh }}
                                                    @else
                                                        <i class="fa-solid fa-circle-xmark text-danger"></i>
                                                    @endif
                                                </td>

                                                <td>

                                                    <a href="{{ route('payments.show', $row->id) }}"
                                                        class="btn btn-sm btn-icon item-edit" alt=" عرض التفاصيل"
                                                        alt=" عرض التفاصيل">
                                                        <i class="fa-solid fa-circle-info"></i>
                                                    </a>



                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr>

                                            <th> المستأجر </th>
                                            <th> موعد الدفع </th>
                                            <th> المبلغ </th>
                                            <th> الدفعة </th>
                                            <th> حالة الدفع </th>
                                            <th>اجراءات</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @else
                            لا يوجد ايرادات مسجلة
                        @endif

                    </div>

                    <div class="tab-pane fade" id="form-tabs-files" role="tabpanel">

                        <span>
                            <a class="btn bt-show" href="#"
                                onclick="fn_add_file_row('file_attach'); return false ; ">
                                + اضافة مرفق </a>
                        </span>
                        <form method="POST" action="{{ route('allfiles.add_files') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="object_id" value="{{ $center->id }}">
                            <input type="hidden" name="object_name" value="centers">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>عنوان الملف </th>
                                        <th> الملف </th>

                                    </tr>
                                </thead>
                                <tbody id="file_attach">
                                    @if (!empty($files))
                                        @foreach ($files as $file)
                                            <tr>
                                                <td>{{ $file->title }}</td>
                                                <td>
                                                    <i class="ti ti-file"></i>
                                                    <span class="align-middle ms-1">
                                                        <a href="<?= asset('storage/' . $file->url) ?>" target="_blank">
                                                            عرض الملف </a></span>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif


                                </tbody>


                            </table>
                            <div class="pt-4 btn-save-files" style="display: none">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"><i
                                        class="fa-solid fa-floppy-disk pe-2"></i> حفظ
                                    الملفات </button>


                            </div>

                        </form>

                    </div>

                    <div class="tab-pane fade" id="form-tabs-ohda" role="tabpanel">
                        @if ($ohdas->count() > 0)
                            @foreach ($ohdas as $ohda)
                                <div class="row">
                                    <div class="col">
                                        <div class="card  mb-3">

                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-md-12 float-start">
                                                        <div class="row">
                                                            <div class="col-md-6 p-0 float-start mb-1">
                                                                <div
                                                                    class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">

                                                                    الموظف المسئول
                                                                </div>
                                                                <div
                                                                    class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                                                    {{ $ohda->employee->name }} </div>
                                                            </div>
                                                            <div class="col-md-6 p-0 float-start mb-1">
                                                                <div
                                                                    class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                                                    الرصيد
                                                                </div>
                                                                <div
                                                                    class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                                                    {{ $ohda->raseed }}
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6 p-0 float-start mb-1">
                                                                <div
                                                                    class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                                                    الغرض من العهدة
                                                                </div>
                                                                <div
                                                                    class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                                                    {{ $ohda->purpose }} </div>
                                                            </div>
                                                            <div class="col-md-6 p-0 float-start mb-1">
                                                                <div
                                                                    class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                                                    تاريخ انشائها
                                                                </div>
                                                                <div
                                                                    class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                                                    {{ @$ohda->created_at }}
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="card mb-3">
                                                        <div class="card-header">
                                                            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                                                <li class="nav-item">
                                                                    <button class="nav-link active" data-bs-toggle="tab"
                                                                        data-bs-target="#form-tabs-ohda_op{{ $ohda->id }}"
                                                                        role="tab" aria-selected="true">
                                                                        العمليات
                                                                    </button>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <button class="nav-link " data-bs-toggle="tab"
                                                                        data-bs-target="#form-tabs-ohda_add{{ $ohda->id }}"
                                                                        role="tab" aria-selected="true">
                                                                        اضافة اموال
                                                                    </button>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <button class="nav-link " data-bs-toggle="tab"
                                                                        data-bs-target="#form-tabs-ohda_sarf{{ $ohda->id }}"
                                                                        role="tab" aria-selected="true">
                                                                        صرف أموال
                                                                    </button>
                                                                </li>




                                                            </ul>
                                                        </div>

                                                        <div class="tab-content">
                                                            <div class="tab-pane fade active show"
                                                                id="form-tabs-ohda_op{{ $ohda->id }}"
                                                                role="tabpanel">

                                                                @if (!empty($ohda->operatios))
                                                                    <div class="card-datatable table-responsive pt-0">
                                                                        <table class="table table-striped FathyTable">
                                                                            <thead>
                                                                                <tr>

                                                                                    <th> نوع العملية </th>

                                                                                   
                                                                                    <th> المبلغ </th>
 <th> الرصيد السابق </th>
                                                                                    <th> التاريخ </th>
                                                                                    <th>اجراءات</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>

                                                                                @foreach ($ohda->operatios as $op)
                                                                                    <tr>
                                                                                        <td>{{ $op->opType() }} </td>
                                                                                      
                                                                                        <td>{{ $op->amount }} </td>
                                                                                          <td>{{ $op->last_amount }} </td>
                                                                                        <td>{{ $op->created_at }}</td>


                                                                                        <td>

                                                                                            <a href="{{ route('sarfs.show', $op->sarf_id) }}"
                                                                                                class="btn btn-sm btn-icon item-edit" target="_blank"
                                                                                                alt=" عرض التفاصيل"
                                                                                                alt=" عرض التفاصيل">
                                                                                                <i
                                                                                                    class="fa-solid fa-circle-info"></i>
                                                                                            </a>

                                                                                        </td>

                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>

                                                                            <tfoot>
                                                                                <tr>
                                                                                    <th> نوع العملية </th>
                                                                                    <th> الرصيد السابق </th>
                                                                                    <th> المبلغ </th>
                                                                                    <th> التاريخ </th>
                                                                                    <th>اجراءات</th>
                                                                                </tr>
                                                                            </tfoot>
                                                                        </table>
                                                                    </div>
                                                                @else
                                                                    لا يوجد عمليات
                                                                @endif

                                                            </div>

                                                            <div class="tab-pane fade  "
                                                                id="form-tabs-ohda_add{{ $ohda->id }}"
                                                                role="tabpanel">
                                                            @include('centers.add_to_ohda')
                                                            </div>

                                                            <div class="tab-pane fade  "
                                                                id="form-tabs-ohda_sarf{{ $ohda->id }}"
                                                                role="tabpanel">
                                                               
                                                            @include('centers.create_sarf')

                                                            </div>


                                                        </div>
                                                    </div>

                                                </div>


                                            </div>
                                        </div>


                                    </div>
                                </div>
                            @endforeach
                        @else
                            لا يوجد عهدة مسجلة
                            <span>
                                <a href="#ohdaModal" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"
                                    data-bs-toggle="modal" data-bs-target="#ohdaModal">
                                    اضافة بيانات العهدة <i class=" fa-solid fa-plus pe-2 " aria-hidden="true"></i>
                                </a>
                            </span>
                        @endif





                    </div>
                </div>
            </div>
        </div>
    </div>








    <div class="modal fade" id="ohdaModal" tabindex="-1" aria-labelledby="ohdaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="maincenter_id" name="maincenter_id" value="{{ $center->maincenter_id }}">
                    <input type="hidden" id="center_id" name="center_id" value="{{ $center->id }}">
                    <div class="container-xxl">
                        <div class="authentication-wrapper authentication-basic container-p-y">
                            <div class="authentication-inner py-4">
                                <!-- Login -->
                                <div class="card border">

                                    <h5 id="mctitle">

                                        {{ $center->maincenter->name }} /
                                        {{ $center->location->name }} /
                                        {{ $center->center_name }}

                                        <div class="card-body">


                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label class="form-label" for="emp_id">الموظف المسئول <i
                                                            class="fa fa-asterisk " style="color: red"
                                                            aria-hidden="true"></i></label>
                                                    <select id="emp_id" name="emp_id" required
                                                        class="select2 form-select" data-allow-clear="true">
                                                        <option value="">اختر </option>
                                                        @foreach ($emps as $row)
                                                            <option value="{{ $row->id }}">{{ $row->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label" for="purpose"> الغرض من العهدة <i
                                                            class="fa fa-asterisk " style="color: red"
                                                            aria-hidden="true"></i></label>
                                                    <input type="text" id="purpose" name="purpose" required
                                                        class="form-control" />
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label" for="raseed"> الرصيد الابتدائي <i
                                                            class="fa fa-asterisk " style="color: red"
                                                            aria-hidden="true"></i></label>
                                                    <input type="text" value="0" id="raseed" name="raseed"
                                                        required class="form-control" />
                                                </div>

                                            </div>





                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">الغاء </button>
                                                <button type="submit" name="btn_add_ohda"
                                                    class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">

                                                    <i class="fa-solid fa-floppy-disk pe-2"></i>
                                                    حفظ
                                                </button>
                                            </div>



                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>




    <!------------------------------------------------------->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <form method="POST" action="{{ route('units.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="maincenter_id" name="maincenter_id" value="{{ $center->maincenter_id }}">
                    <input type="hidden" id="center_id" name="center_id" value="{{ $center->id }}">
                    <div class="container-xxl">
                        <div class="authentication-wrapper authentication-basic container-p-y">
                            <div class="authentication-inner py-4">
                                <!-- Login -->
                                <div class="card border">

                                    <h5 id="mctitle">

                                        {{ $center->maincenter->name }} /
                                        {{ $center->location->name }} /
                                        {{ $center->center_name }}

                                        <div class="card-body">


                                            <!-- Login -->
                                            <div class="card border">
                                                <div class="card-body">

                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="unit_type"> نوع
                                                                الوحدة <i class="fa fa-asterisk " style="color: red"
                                                                    aria-hidden="true"></i></label>
                                                            <select id="unit_type" name="unit_type"
                                                                class="select2 form-select" data-allow-clear="true">
                                                                <option value="">اختر </option>
                                                                @foreach ($types as $row)
                                                                    <option value="{{ $row->id }}">
                                                                        {{ $row->name }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="form-label" for="unit_description">وصف الوحدة <i
                                                                    class="fa fa-asterisk " style="color: red"
                                                                    aria-hidden="true"></i></label>
                                                            <input type="text" id="unit_description"
                                                                name="unit_description" class="form-control" required />
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="no_of_rooms"> عدد الغرف
                                                            </label>
                                                            <input type="text" id="no_of_rooms" name="no_of_rooms"
                                                                class="form-control" />
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="no_of_wc"> عدد دورات المياة
                                                            </label>
                                                            <input type="text" id="no_of_wc" name="no_of_wc"
                                                                class="form-control" />
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="activity"> النشاط </label>
                                                            <input type="text" id="activity" name="activity"
                                                                class="form-control" />
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="form-label" for="woter_no"> حساب
                                                                المياه </label>
                                                            <input type="text" id="woter_no" name="woter_no"
                                                                class="form-control" />
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="form-label" for="electric_no">
                                                                حساب الكهرباء <i class="fa fa-asterisk "
                                                                    style="color: red" aria-hidden="true"></i></label>
                                                            <input type="text" id="electric_no" name="electric_no"
                                                                required class="form-control" />
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="form-label" for="floor_no">
                                                                الدور<i class="fa fa-asterisk " style="color: red"
                                                                    aria-hidden="true"></i></label>
                                                            <input type="text" id="floor_no" required name="floor_no"
                                                                class="form-control" />
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="unit_no"> رقم
                                                                الوحدة <i class="fa fa-asterisk " style="color: red"
                                                                    aria-hidden="true"></i></label>
                                                            <input type="text" id="unit_no" required name="unit_no"
                                                                class="form-control" />
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="form-label" for="current_renter_id"> المستأجر
                                                                الحالي
                                                            </label>
                                                            <select id="current_renter_id" name="current_renter_id"
                                                                class="select2 form-select" data-allow-clear="true">
                                                                <option value="">اختر </option>
                                                                @foreach ($renters as $row)
                                                                    <option value="{{ $row->id }}">
                                                                        {{ $row->name }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>





                                                        <div class="col-md-4">
                                                            <label for="file" class="form-label"> صورة
                                                            </label>
                                                            <input type="file" name="file" id="file"
                                                                class="form-control">

                                                        </div>


                                                        <div class="col-md-4">
                                                            <label class="form-label" for="notes">
                                                                ملاحظات </label>
                                                            <textarea id="notes" name="notes" class="form-control"></textarea>
                                                        </div>



                                                    </div>



                                                </div>
                                            </div>




                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">الغاء </button>
                                                <button type="submit" name="btn_add_unit"
                                                    class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">

                                                    <i class="fa-solid fa-floppy-disk pe-2"></i>
                                                    حفظ
                                                </button>
                                            </div>



                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            // Your code here will run once the DOM is ready
            // console.log("Document is ready!");
            // $("#myButton").click(function() {
            //     // Handle button click
            // });
        });

       


        function fn_set_amount(amount) {

            $("#amount").val(amount);
        }

       

        function fn_setSarfType() {
            var selected_type = $("input[name='sarf_type_id']:checked").val();

            $(".sarftype2").hide();
            $(".sarftype3").hide();
            $(".sarftype4").hide();
            $(".sarftype" + selected_type).show();


        }
    </script>
@endsection
