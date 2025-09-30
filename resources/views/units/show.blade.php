@extends('layouts.app')

@section('content')


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

    @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
    @endsession


    <div class="row">
        <div class="col">
            <div class="card  mb-3">
                <div class="card-header bg-lighter">
                    <strong>{{ $unit->center->center_name }}/{{ $unit->unitType->name }}
                    </strong>
                </div>
                <div class="card-body">
                    <div class="col-12 col-sm-12 col-lg-12 mb-4">
                        <div class="card border">
                            <div class="card-body">
                                <div class="col-md-3 float-end">
                                    <div>
                                        @if ($unit->img != '')
                                            <a href="<?= asset('storage/' . $unit->img) ?>" target="_blank">
                                                <img src="<?= asset('storage/' . $unit->img) ?>" class="w-100" />
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
                                    <form method="POST" action="{{ route('units.update', $unit->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" id="maincenter_id" name="maincenter_id"
                                            value="{{ $unit->maincenter_id }}">
                                        <input type="hidden" id="id" name="id" value="{{ $unit->id }}">
                                        <input type="hidden" id="center_id" name="center_id"
                                            value="{{ $unit->center_id }}">
                                        <div class="container-xxl">
                                            <div class="authentication-wrapper authentication-basic container-p-y">
                                                <div class="authentication-inner py-4">
                                                    <!-- Login -->
                                                    <div class="card border">

                                                        <div class="card-body">

                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="unit_type"> نوع
                                                                        الوحدة <i class="fa fa-asterisk " style="color: red"
                                                                            aria-hidden="true"></i></label>
                                                                    <select id="unit_type" name="unit_type"
                                                                        class="select2 form-select" data-allow-clear="true">
                                                                        <option value="">اختر </option>
                                                                        @foreach ($types as $row)
                                                                            <option value="{{ $row->id }}"
                                                                                @if ($unit->unit_type == $row->id) {{ 'selected' }} @endif>
                                                                                {{ $row->name }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="unit_description">وصف
                                                                        الوحدة <i class="fa fa-asterisk " style="color: red"
                                                                            aria-hidden="true"></i></label>
                                                                    <input type="text" id="unit_description"
                                                                        value="{{ $unit->unit_description }}"
                                                                        name="unit_description" class="form-control"
                                                                        required />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="no_of_rooms"> عدد الغرف
                                                                    </label>
                                                                    <input type="text" id="no_of_rooms"
                                                                        name="no_of_rooms" value="{{ $unit->no_of_rooms }}"
                                                                        class="form-control" />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="no_of_wc"> عدد دورات
                                                                        المياة </label>
                                                                    <input type="text" id="no_of_wc"
                                                                        value="{{ $unit->no_of_wc }}" name="no_of_wc"
                                                                        class="form-control" />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="activity"> النشاط
                                                                    </label>
                                                                    <input type="text" id="activity"
                                                                        value="{{ $unit->activity }}" name="activity"
                                                                        class="form-control" />
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="woter_no"> حساب
                                                                        المياه </label>
                                                                    <input type="text" id="woter_no"
                                                                        value="{{ $unit->woter_no }}" name="woter_no"
                                                                        class="form-control" />
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="electric_no">
                                                                        حساب الكهرباء <i class="fa fa-asterisk "
                                                                            style="color: red"
                                                                            aria-hidden="true"></i></label>
                                                                    <input type="text" id="electric_no"
                                                                        name="electric_no" required
                                                                        value="{{ $unit->electric_no }}"
                                                                        class="form-control" />
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="floor_no">
                                                                        الدور<i class="fa fa-asterisk " style="color: red"
                                                                            aria-hidden="true"></i></label>
                                                                    <input type="text" id="floor_no" required
                                                                        value="{{ $unit->floor_no }}" name="floor_no"
                                                                        class="form-control" />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="unit_no"> رقم
                                                                        الوحدة <i class="fa fa-asterisk "
                                                                            style="color: red"
                                                                            aria-hidden="true"></i></label>
                                                                    <input type="text" id="unit_no" required
                                                                        value="{{ $unit->unit_no }}" name="unit_no"
                                                                        class="form-control" />
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="current_renter_id">
                                                                        المستأجر الحالي
                                                                    </label>
                                                                    <select id="current_renter_id"
                                                                        name="current_renter_id"
                                                                        class="select2 form-select"
                                                                        data-allow-clear="true">
                                                                        <option value="">اختر </option>
                                                                        @foreach ($renters as $row)
                                                                            <option value="{{ $row->id }}"
                                                                                @if ($unit->current_renter_id == $row->id) {{ 'selected' }} @endif>
                                                                                {{ $row->name }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>





                                                                <div class="col-md-6">
                                                                    <label for="file" class="form-label"> صورة
                                                                    </label>
                                                                    <input type="file" name="file" id="file"
                                                                        class="form-control">

                                                                </div>


                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="notes">
                                                                        ملاحظات </label>
                                                                    <textarea id="notes" name="notes" class="form-control">{{ $unit->notes }}</textarea>
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
                    </div>



                    <div class="card mb-3">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" role="tablist">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#form-tabs-dof3at" role="tab" aria-selected="false">
                                        الايرادات (الدفعات)
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link " data-bs-toggle="tab" data-bs-target="#form-tabs-units"
                                        role="tab" aria-selected="true">
                                        العقود
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-sarf"
                                        role="tab" aria-selected="false">
                                        المصروفات
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-files"
                                        role="tab" aria-selected="false">
                                        المرفقات
                                    </button>
                                </li>

                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade  active show" id="form-tabs-dof3at" role="tabpanel">

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

                                                            <div class="d-inline-block">
                                                                <a href="javascript:;"
                                                                    class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="text-primary ti ti-dots-vertical"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end m-0">
                                                                    <li><a href="#" class="dropdown-item"><i
                                                                                class="fa-solid fa-circle-info"></i>
                                                                            تعديل</a></li>

                                                                    <div class="dropdown-divider"></div>
                                                                    <li><a href="#"
                                                                            class="dropdown-item text-danger delete-record"><i
                                                                                class="fa-solid fa-trash-can"></i> حذف</a>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                            @if ($row->status)
                                                                <a href="#" onclick="fn_print({{ $row }})"
                                                                    class="btn btn-sm btn-icon item-edit" alt="طباعة"
                                                                    alt="طباعة">
                                                                    <i class="fa-solid fa-print"></i>
                                                                </a>
                                                            @else
                                                                <a href="#"
                                                                    onclick="fn_payement({{ $row }})"
                                                                    class="btn btn-sm btn-icon item-edit" alt="الدفع"
                                                                    alt="الدفع">
                                                                    <i class="fas fa-sack-dollar"></i>
                                                                </a>
                                                            @endif




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
                                    لا يوجد دفعات مسجلة
                                @endif


                            </div>
                            <div class="tab-pane fade  " id="form-tabs-units" role="tabpanel">

                                <a href="#collapseContract" data-bs-toggle="collapse" data-bs-target="#collapseContract">
                                    <i class="fa fa-plus " aria-hidden="true"></i>
                                    تسجيل عقد جديد
                                </a>


                                <div class="collapse" id="collapseContract">
                                    <form method="POST" action="" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="maincenter_id" value="{{ $unit->maincenter_id }}">
                                        <input type="hidden" name="center_id" value="{{ $unit->center_id }}">
                                        <input type="hidden" name="unit_id" value="{{ $unit->id }}">
                                        <div class="card card-body">


                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label class="form-label" for="renter_id"> المستأجر <i
                                                            class="fa fa-asterisk " style="color: red"
                                                            aria-hidden="true"></i></label>
                                                    <select id="renter_id" name="renter_id" class="select2 form-select"
                                                        data-allow-clear="true">
                                                        <option value="">اختر </option>
                                                        @foreach ($renters as $row)
                                                            <option value="{{ $row->id }}">{{ $row->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="col-md-4 cal_con">
                                                    <label class="form-label">تاريخ بداية العقد </label>

                                                    <input id="start_date" name="start_date" style="display:none;"
                                                        class="" onclick="pickDate(event);  cdid(this.id);"
                                                        type="text">
                                                    <input id="start_dateh" name="start_dateh" class="hijrDate"
                                                        onclick="pickDate(event); cdid(this.id.substring(0, this.id.length - 1)); "
                                                        type="text">
                                                    <div class="check_cal">
                                                        <div id="start_date" name="start_date" class="gdatelable"
                                                            onclick=" this.classList.add(this.id); gdcon(this.id);">ميلادي
                                                            <i class="fa-solid fa-repeat"></i>
                                                        </div>
                                                        <div id="start_date" name="start_date" class="hdatelable"
                                                            onclick="this.classList.add(this.id+'h'); hjowcon(this.id);">
                                                            هجري <i class="fa-solid fa-repeat"></i></div>
                                                    </div>


                                                </div>
                                                <div class="col-md-4 cal_con">
                                                    <label class="form-label">تاريخ نهاية العقد </label>

                                                    <input id="end_date" name="end_date" style="display:none;"
                                                        class="" onclick="pickDate(event);  cdid(this.id);"
                                                        type="text">
                                                    <input id="end_dateh" name="end_dateh" class="hijrDate"
                                                        onclick="pickDate(event); cdid(this.id.substring(0, this.id.length - 1)); "
                                                        type="text">
                                                    <div class="check_cal">
                                                        <div id="end_date" name="end_date" class="gdatelable"
                                                            onclick=" this.classList.add(this.id); gdcon(this.id);">ميلادي
                                                            <i class="fa-solid fa-repeat"></i>
                                                        </div>
                                                        <div id="end_date" name="end_date" class="hdatelable"
                                                            onclick="this.classList.add(this.id+'h'); hjowcon(this.id);">
                                                            هجري <i class="fa-solid fa-repeat"></i></div>
                                                    </div>


                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label" for="year_amount"> قيمة الإيجار السنوي <i
                                                            class="fa fa-asterisk " style="color: red"
                                                            aria-hidden="true"></i></label>
                                                    <input type="number" id="year_amount" name="year_amount"
                                                        class="form-control" required />
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label" for="no_of_payments">عدد الدفعات <i
                                                            class="fa fa-asterisk " style="color: red"
                                                            aria-hidden="true"></i></label>
                                                    <input type="number" id="no_of_payments" name="no_of_payments"
                                                        class="form-control" required />
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label" for="insurance_amount">قيمة التأمين <i
                                                            class="fa fa-asterisk " style="color: red"
                                                            aria-hidden="true"></i></label>
                                                    <input type="number" id="insurance_amount"
                                                        name="insurance_amount" class="form-control" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label" for="services_amount">قيمة الخدمات <i
                                                            class="fa fa-asterisk " style="color: red"
                                                            aria-hidden="true"></i></label>
                                                    <input type="number"  id="services_amount"
                                                        name="services_amount" class="form-control" />
                                                </div>

                                                <div class="col-md-8">
                                                    <label class="form-label" for="notes"> ملاحظات </label>
                                                    <textarea id="notes" name="notes" class="form-control"></textarea>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" name="btn_add_contract" class="btn btn-primary "> حفظ
                                                &nbsp;
                                                <i class="fa-solid fa-floppy-disk"></i> </button>
                                            <button type="reset" class="btn btn-secondary"
                                                data-bs-dismiss="modal">الغاء</button>
                                        </div>
                                    </form>
                                </div>
                                <hr class="my-1" />
                                @if (!empty($contracts))
                                    <div class="card-datatable table-responsive pt-0">
                                        <table class="table table-striped FathyTable">
                                            <thead>
                                                <tr>

                                                    <th> المستأجر </th>
                                                    <th> بداية العقد </th>
                                                    <th> نهاية العقد </th>
                                                    <th>   المدة باليوم </th>
                                                    <th> الايجار </th>
                                                    <th> عدد الدفعات </th>
                                                    <th> التأمين </th>
                                                    <th> الخدمات </th>
                                                    <th>اجراءات</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($contracts as $key => $row)
                                                {{------class = " @if($row->id==$currnet_contract_id){{'bg-success bg-gradient  '}}"@endif--------}}
                                                    <tr  >

                                                        <td>{{ $row->renter->name }}</td>
                                                        <td>{{ $row->start_date }} م - {{ $row->start_dateh }} هـ</td>
                                                        <td>{{ $row->end_date }} م - {{ $row->end_dateh }} هـ</td>
                                                        <td>
                                                             
                                                            <?=date_diff(date_create($row->start_date), date_create($row->end_date))->format('%a') + 1 ?></td>
                                                        <td>{{ $row->year_amount }}</td>
                                                        <td>{{ $row->no_of_payments }}</td>
                                                        <td>{{ $row->insurance_amount }}</td>
                                                        <td>{{ $row->services_amount }}</td>

                                                        <td>

                                                            <div class="d-inline-block">
                                                                <a href="javascript:;"
                                                                    class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="text-primary ti ti-dots-vertical"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end m-0">
                                                                    <li><a href="#" class="dropdown-item"><i
                                                                                class="fa-solid fa-circle-info"></i>
                                                                            تعديل</a></li>

                                                                    <div class="dropdown-divider"></div>
                                                                    <li><a href="#"
                                                                            class="dropdown-item text-danger delete-record"><i
                                                                                class="fa-solid fa-trash-can"></i> حذف</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <a href="#" class="btn btn-sm btn-icon item-edit">
                                                                <i class="text-primary ti ti-pencil"></i>
                                                            </a>


                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>

                                            <tfoot>
                                                <tr>

                                                   <th> المستأجر </th>
                                                    <th> بداية العقد </th>
                                                    <th> نهاية العقد </th>
                                                    <th>   المدة باليوم </th>
                                                    <th> الايجار </th>
                                                    <th> عدد الدفعات </th>
                                                    <th> التأمين </th>
                                                    <th> الخدمات </th>
                                                    <th>اجراءات</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                @else
                                    لا يوجد عقود مسجلة
                                @endif

                            </div>

                            <div class="tab-pane fade" id="form-tabs-sarf" role="tabpanel">

                                @if (!empty($sarfs))
                                    <div class="card-datatable table-responsive pt-0">
                                        <table class="table table-striped FathyTable">
                                            <thead>
                                                <tr>

                                                    <th> من </th>
                                                    <th>وجه الصرف </th>
                                                    <th> المستلم </th>
                                                    <th> المبلغ </th>
                                                    <th> الغرض </th>
                                                    <th> التاريخ </th>
                                                    <th>اجراءات</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($sarfs as $key => $row)
                                                    <tr>

                                                        <td>{{ $row->sourceType->name }}
                                                            @if ($row->from_ohda_id != '')
                                                                ({{ $row->fromOhda->employee->name }})
                                                            @endif

                                                        </td>
                                                        <td>{{ $row->sarfType->name }}


                                                            @if ($row->to_ohda_id != '')
                                                                ({{ $row->toOhda->employee->name }})
                                                            @elseif ($row->pay_role_id != '')
                                                                ({{ $row->payrool->employee->name }})
                                                            @elseif ($row->recipient_id != '')
                                                                ({{ $row->recipient->name }})
                                                            @elseif ($row->service_type_id != '')
                                                                ({{ $row->serviceType->name }})
                                                            @endif


                                                        </td>
                                                        <td>{{ $row->receved_by }}</td>
                                                        <td>{{ $row->amount }}
                                                            - ({{ $row->paymentType->name }})

                                                        </td>
                                                        <td>

                                                            {{ $row->s_desc }}
                                                        </td>
                                                        <td>

                                                            {{ $row->p_date }} - {{ $row->p_dateh }}

                                                        </td>

                                                        <td>

                                                            <a href="{{ route('sarfs.show', $row->id) }}"
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
                                                    <th> من </th>
                                                    <th>وجه الصرف </th>
                                                    <th> المستلم </th>
                                                    <th> المبلغ </th>
                                                    <th> الغرض </th>
                                                    <th> التاريخ </th>
                                                    <th>اجراءات</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                @else
                                    لا يوجد
                                @endif


                            </div>

                            <div class="tab-pane fade" id="form-tabs-files" role="tabpanel">

                                <span>
                                    <a class="btn bt-show" href="#"
                                        onclick="fn_add_file_row('file_attach'); return false ; ">
                                        + اضافة مرفق </a>
                                </span>
                                <form method="POST" action="{{ route('allfiles.add_files') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="object_id" value="{{ $unit->id }}">
                                    <input type="hidden" name="object_name" value="units">

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
                                                                <a href="<?= asset('storage/' . $file->url) ?>"
                                                                    target="_blank">
                                                                    عرض الملف </a></span>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif


                                        </tbody>


                                    </table>
                                    <div class="pt-4 btn-save-files" style="display: none">
                                        <button type="submit"
                                            class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"><i
                                                class="fa-solid fa-floppy-disk pe-2"></i> حفظ
                                            الملفات </button>


                                    </div>

                                </form>

                            </div>

                        </div>
                    </div>


                </div>
            </div>



            <!-- Modal -->
            <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="payment_id" id="payment_id">
                        <input type="hidden" name="emp_name" id="emp_name">
                        <input type="hidden" name="maincenter_id" value="{{ $unit->maincenter_id }}">
                        <input type="hidden" name="unit_id" value="{{ $unit->id }}">
                        <input type="hidden" name="center_id" value="{{ $unit->center_id }}">

                        <div class="modal-content">
                            <div class="modal-header  bg-primary">
                                <h5 class="modal-title bg-lighter text-white" id="paymentModalLabel"> بيانات الدفع</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label" for="renter_name"> المستأجر </label>
                                        <input type="text" id="renter_name" name="renter_name" class="form-control"
                                            readonly />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="amount"> المبلغ </label>
                                        <input type="text" id="amount" name="amount" class="form-control"
                                            readonly />
                                    </div>

                                    <div class="col-md-4 cal_con">
                                        <label class="form-label">تاريخ الدفع </label>

                                        <input id="actual_date" name="actual_date" style="display:none;" class=""
                                            onclick="pickDate(event);  cdid(this.id);" type="text">
                                        <input id="actual_dateh" name="actual_dateh" class="hijrDate"
                                            onclick="pickDate(event); cdid(this.id.substring(0, this.id.length - 1)); "
                                            type="text">
                                        <div class="check_cal">
                                            <div id="actual_date" name="actual_date" class="gdatelable"
                                                onclick=" this.classList.add(this.id); gdcon(this.id);">ميلادي
                                                <i class="fa-solid fa-repeat"></i>
                                            </div>
                                            <div id="actual_date" name="actual_date" class="hdatelable"
                                                onclick="this.classList.add(this.id+'h'); hjowcon(this.id);">
                                                هجري <i class="fa-solid fa-repeat"></i></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label" for="emp_id"> المستلم </label>

                                        <select id="emp_id" name="emp_id" class="select2 form-select"
                                            data-allow-clear="true">
                                            <option value="">اختر </option>
                                            @foreach ($emps as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label" for="payment_type"> طريقة الدفع </label>

                                        <select id="payment_type" name="payment_type" class="select2 form-select"
                                            data-allow-clear="true">
                                            <option value="">اختر </option>
                                            @foreach ($payment_types as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label" for="notes"> ملاحظات </label>
                                        <input type="text" id="payment_notes" name="notes" class="form-control" />
                                    </div>


                                </div>




                            </div>
                            <div class="modal-footer">
                                <hr>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                                <button type="submit" name="btn_savePayment" class="btn btn-primary">

                                    حفظ البيانات </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>




            <div class="modal fade" id="print_paymentModal" tabindex="-1" aria-labelledby="print_paymentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">


                    <div class="modal-content">
                        <div class="modal-header  bg-primary">
                            <h5 class="modal-title bg-lighter text-white" id="print_paymentModalLabel"> طباعة</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="NoteView" class="col-12 col-sm-12 col-lg-12 mb-4">
                                <div class="card border border-danger border-2">
                                    <div class="card-body">
                                        <button type="button"
                                            class="btn btn-label-secondary waves-effect invoice-btprint d-print-none"
                                            onclick="printDiv('printableArea')">
                                            <i class='ti ti-printer mt-1 cursor-pointer d-sm-block d-none text-dark '></i>
                                        </button>

                                        <div class="row justify-content-end mb-3">
                                            <div class="col-md-2 mx-2 h-100 text-center p-2">
                                            </div>
                                            <div
                                                class="col-md-5 invoice-header border border-1 rounded h-100 text-center p-2 mx-2">
                                                <span>وصية أوقاف إبراهيم صدقي محمد سعيد
                                                    أفندي</span>
                                            </div>
                                            <div
                                                class="col-md-2 invoice-num border border-danger text-danger fw-bold border-1 rounded h-100 text-center p-2">
                                                <span id="p_sereal">رقم (0001) 25-47</span>
                                            </div>
                                            <div class="col-md-1 mx-2 h-100 text-center p-2">
                                            </div>
                                        </div>

                                        <div class="row justify-content-between mb-3">
                                            <div
                                                class="col-md-2 invoice-date border border-dark text-dark fw-bold border-1 rounded h-100 text-center p-2">
                                                <span id="p_actual_dateh"> التاريخ : 01/01/1447 هـ</span>
                                            </div>

                                            <div
                                                class="col-md-5 invoice-title h-100 text-center text-dark fw-bold p-2 mx-2">
                                                <span class=" p-2"> سند قبض
                                                </span>
                                            </div>
                                            <div
                                                class="col-md-2 invoice-date border border-dark text-dark fw-bold border-1 rounded h-100 text-center p-2">
                                                <span id="p_actual_date">Date : 26/06/2025</span>
                                            </div>

                                        </div>

                                        <div class="row justify-content-between mb-3">
                                            <div
                                                class="col-md-2 border border-dark shadow-lg  text-dark fw-bold border-1 h-100 text-center p-2">
                                                <span id="p_amount"> #5000 ريال</span>
                                            </div>
                                        </div>

                                        <div class="row justify-content-between mb-3">
                                            <div class="col-md-12 text-start p-2">
                                                <span class="invoice-name-title text-dark fw-bold"> استلمت أنا : </span>
                                                <span id="p_emp" class="invoice-name fw-bold"> م / فتحي محمد سليمان
                                                    الخشن</span>
                                            </div>
                                        </div>

                                        <div class="row justify-content-between mb-3">
                                            <div class="col-md-2 text-dark fw-bold  h-100 text-center p-2">
                                                <span> مبلغ وقدره </span>
                                            </div>
                                            <div
                                                class="col-md-10 border border-2 border-dark shadow-lg  text-danger fw-bold border-1 h-100 text-center p-2">
                                                <span id="p_amount_txt"> خمسة آلاف ريال فقط لا غير </span>
                                            </div>
                                        </div>

                                        <div class="row justify-content-between mb-3">
                                            <div class="col-md-2 text-dark fw-bold  h-100 text-center p-2">
                                                <span> وذلك نظير : </span>
                                            </div>
                                            <div class="col-md-10 invoice-name fw-bold h-100 text-start p-2">
                                                <span id="p_note"> </span>
                                            </div>
                                        </div>

                                        <div class="row justify-content-between mb-5 pb-3">
                                            <div class="col-md-1 text-dark fw-bold  h-100 text-center p-2">
                                                <span> </span>
                                            </div>
                                            <div class="col-md-2 text-dark  fw-bold h-100 text-start p-2">
                                                <span> توقيع المستلم</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                        <div class="modal-footer">
                            <hr>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>

                        </div>
                    </div>

                </div>
            </div>

            <script>
                function replace_number(inputString) {
                    if (inputString === undefined || inputString === null) {
                        return '';
                    }

                    let str = String(inputString).trim();
                    if (str === '') {
                        return '';
                    }

                    const arabicToEnglishMap = {
                        '٠': '0',
                        '١': '1',
                        '٢': '2',
                        '٣': '3',
                        '٤': '4',
                        '٥': '5',
                        '٦': '6',
                        '٧': '7',
                        '٨': '8',
                        '٩': '9'
                    };

                    return str.replace(/[٠-٩]/g, function(d) {
                        return arabicToEnglishMap[d];
                    });
                }


                function fn_payement(row) {


                    console.log(row);

                    $('#renter_name').val(row['contract']['renter']['name']);
                    $('#amount').val(row['amount']);
                    $('#payment_notes').val(row['notes']);
                    $('#payment_id').val(row['id']);

                    //  $('#emp_name').val($("#emp_id option:selected").text());
                    $('#paymentModal').modal('show');


                }

                function fn_print(row) {


                    console.log(row);

                    // $('#renter_name').val(row['contract']['renter']['name']);
                    // $('#amount').val(row['amount']);
                    // $('#payment_notes').val(row['notes']);
                    // $('#payment_id').val(row['id']);
                    // //  $('#emp_name').val($("#emp_id option:selected").text());
                    var ser = '(' + String(row['sereal']).padStart(4, '0') + ')' + row['year_m'] + '-' + row['year_h'];
                    $('#p_sereal').html(ser);

                    var pdateh = 'التاريخ:' + row['actual_dateh'] + 'هـ';
                    $('#p_actual_dateh').html(pdateh);

                    var pdate = 'Date:' + row['actual_date'];
                    $('#p_actual_date').html(pdate);

                    var pamount = '#' + row['amount'] + 'ريال';
                    $('#p_amount').html(pamount);
                    $('#p_emp').html(row['employee']['name']);


                    $('#p_amount_txt').html(row['amount_txt']);
                    if (row['payment_no'] == 0)
                        $('#p_note').html(row['notes']);
                    else
                        $('#p_note').html(':دفعة رقم' + row['payment_no'] + ' من الايجار السنوي');





                    $('#print_paymentModal').modal('show');


                }

                function nWin() {
                    var w = window.open();
                    var html = $("#NoteView").html();

                    $(w.document.body).html(html);
                    w.print();
                }

                function printDiv(divId) {
                    var printContents = document.getElementById("NoteView").innerHTML;
                    var originalContents = document.body.innerHTML;

                    document.body.innerHTML = printContents;

                    window.print();

                    document.body.innerHTML = originalContents;
                }
                $(function() {
                    $("button#btNoteView").click(nWin);
                });
            </script>
        @endsection
