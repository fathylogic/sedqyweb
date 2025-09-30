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
                <div class="card-header bg-light">
                    <strong>{{ $employee->name }} </strong>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 float-end">
                            <div>
                                @if ($employee->img != '')
                                    <a href="<?= asset('storage/' . $employee->img) ?>" target="_blank">
                                        <img src="<?= asset('storage/' . $employee->img) ?>" class="w-100" />
                                    </a>
                                @else
                                    <?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>
                                    <img class=" float-end" style="width: 125px ; height: 125px;"
                                        src="{{ $root }}/assets/img/branding/sedqilogo1.png">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-9 float-start">
                            <div class="row">
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">

                                        رقم الهوية
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $employee->id_no }} </div>
                                </div>
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        الجوال
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $employee->mobile_no }}
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        الجنسية
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $employee->nationality }}
                                    </div>
                                </div>
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        المهنة
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $employee->job }} </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        الراتب
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $employee->salary }} </div>
                                </div>
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        الحساب البنكي
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ @$employee->iban }}
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
                                            data-bs-target="#form-tabs-units" role="tab" aria-selected="true">
                                            كشف الرواتب
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-sarf"
                                            role="tab" aria-selected="false">
                                            الأجازات


                                        </button>
                                    </li>

                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="form-tabs-units" role="tabpanel">

                                    <a href="#collapsePayroll" data-bs-toggle="collapse" data-bs-target="#collapsePayroll">
                                        <i class="fa fa-plus " aria-hidden="true"></i>
                                        اضافة راتب
                                    </a>


                                    <div class="collapse" id="collapsePayroll">
                                        <form method="POST" action="{{ route('employees.addPayroll', $employee->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf


                                            <div class="card card-body">


                                                <div class="row g-3">

                                                    <div class="col-md-4">
                                                        <label class="form-label" for="year"> السنة <i
                                                                class="fa fa-asterisk " style="color: red"
                                                                aria-hidden="true"></i></label>
                                                        <input type="text" id="year" value="<?= date('Y') ?>"
                                                            required name="year" class="form-control" />
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="form-label" for="month"> الشهر <i
                                                                class="fa fa-asterisk " style="color: red"
                                                                aria-hidden="true"></i></label>
                                                        <input type="text" id="month" value="<?= date('m') ?>"
                                                            required name="month" class="form-control" />
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <br>
                                                        <button type="submit" name="btn_add_payroll"
                                                            class="btn btn-primary "> اضافة الراتب
                                                            &nbsp;
                                                            <i class="fa-solid fa-floppy-disk"></i> </button>
                                                    </div>










                                                </div>

                                            </div>

                                        </form>
                                    </div>
                                    <hr class="my-1" />

                                    @if (!empty($employee->payrolls))
                                        <div class="card-datatable table-responsive pt-0">
                                            <table class="table table-striped FathyTable">
                                                <thead>
                                                    <tr>

                                                        <th> راتب شهر </th>
                                                        <th> الراتب الاساسي </th>

                                                        <th> حوافز اخرى </th>
                                                        <th>خصومات</th>
                                                        <th>اجمالي المبلغ</th>
                                                        <th> الحالة</th>
                                                        <th> اجراءات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($employee->payrolls as $key => $row)
                                                        <tr>

                                                            <td>{{ $row->salary_year_month }} </td>
                                                            <td>{{ $row->basic_salary }} </td>
                                                            <td>{{ $row->other_allowance }} </td>
                                                            <td>{{ $row->deductions }} </td>
                                                            <td>{{ $row->net_salary }} </td>
                                                            <td>
                                                                @if ($row->sarf)
                                                                    <i class="fa fa-circle-check  text-success"
                                                                        aria-hidden="true"></i>
                                                                    تم
                                                                @else
                                                                    <i class="fa-solid fa-circle-xmark text-danger"></i>
                                                                    لم يتم
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($row->sarf)
                                                                    <a href="{{ route('sarfs.show', @$row->sarf->id) }}"
                                                                        class="btn btn-sm btn-icon item-edit"
                                                                        alt="طباعة" alt="طباعة">
                                                                        <i class="fa-solid fa-print"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="#"
                                                                        onclick="fn_payement({{ $row }})"
                                                                        class="btn btn-sm btn-icon item-edit"
                                                                        alt="الدفع" alt="الدفع">
                                                                        <i class="fas fa-sack-dollar"></i>
                                                                    </a>
                                                                @endif

                                                            </td>


                                                        </tr>
                                                    @endforeach
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <th> راتب شهر </th>
                                                        <th> الراتب الاساسي </th>

                                                        <th> حوافز اخرى </th>
                                                        <th>خصومات</th>
                                                        <th>اجمالي المبلغ</th>
                                                        <th> الحالة</th>
                                                        <th> اجراءات</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    @else
                                        لا يوجد عمليات
                                    @endif

                                </div>
                                <div class="tab-pane fade" id="form-tabs-sarf" role="tabpanel">



                                    <a href="#collapseContract" data-bs-toggle="collapse"
                                        data-bs-target="#collapseContract">
                                        <i class="fa fa-plus " aria-hidden="true"></i>
                                        تسجيل أجازة
                                    </a>


                                    <div class="collapse" id="collapseContract">
                                        <form method="POST" action="" enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="emp_id" value="{{ $employee->id }}">
                                            <div class="card card-body">


                                                <div class="row g-3">


                                                    <div class="col-md-4 cal_con">
                                                        <label class="form-label">تاريخ بداية الأجازة </label>

                                                        <input id="start_date" name="start_date" style="display:none;"
                                                            class="" onclick="pickDate(event);  cdid(this.id);"
                                                            type="text">
                                                        <input id="start_dateh" name="start_dateh" class="hijrDate"
                                                            onclick="pickDate(event); cdid(this.id.substring(0, this.id.length - 1)); "
                                                            type="text">
                                                        <div class="check_cal">
                                                            <div id="start_date" name="start_date" class="gdatelable"
                                                                onclick=" this.classList.add(this.id); gdcon(this.id);">
                                                                ميلادي
                                                                <i class="fa-solid fa-repeat"></i>
                                                            </div>
                                                            <div id="start_date" name="start_date" class="hdatelable"
                                                                onclick="this.classList.add(this.id+'h'); hjowcon(this.id);">
                                                                هجري <i class="fa-solid fa-repeat"></i></div>
                                                        </div>


                                                    </div>
                                                    <div class="col-md-4 cal_con">
                                                        <label class="form-label">تاريخ نهاية الأجازة </label>

                                                        <input id="end_date" name="end_date" style="display:none;"
                                                            class="" onclick="pickDate(event);  cdid(this.id);"
                                                            type="text">
                                                        <input id="end_dateh" name="end_dateh" class="hijrDate"
                                                            onclick="pickDate(event); cdid(this.id.substring(0, this.id.length - 1)); "
                                                            type="text">
                                                        <div class="check_cal">
                                                            <div id="end_date" name="end_date" class="gdatelable"
                                                                onclick=" this.classList.add(this.id); gdcon(this.id);">
                                                                ميلادي
                                                                <i class="fa-solid fa-repeat"></i>
                                                            </div>
                                                            <div id="end_date" name="end_date" class="hdatelable"
                                                                onclick="this.classList.add(this.id+'h'); hjowcon(this.id);">
                                                                هجري <i class="fa-solid fa-repeat"></i></div>
                                                        </div>


                                                    </div>







                                                    <div class="col-md-8">
                                                        <label class="form-label" for="notes"> ملاحظات </label>
                                                        <textarea id="notes" name="notes" class="form-control"></textarea>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" name="btn_add_vacation" class="btn btn-primary ">
                                                    حفظ
                                                    &nbsp;
                                                    <i class="fa-solid fa-floppy-disk"></i> </button>
                                                <button type="reset" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">الغاء</button>
                                            </div>
                                        </form>
                                    </div>
                                    <hr class="my-1" />









                                    @if (!empty($employee->vacations))
                                        <div class="card-datatable table-responsive pt-0">
                                            <table class="table table-striped FathyTable">
                                                <thead>
                                                    <tr>

                                                        <th> من تاريخ </th>
                                                        <th> الى تاريخ </th>

                                                        <th> عدد الايام </th>
                                                        <th>اجراءات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($employee->vacations as $key => $row)
                                                        <tr>

                                                            <td>{{ $row->start_date }} م - {{ $row->start_dateh }}
                                                                هـ
                                                            </td>
                                                            <td>{{ $row->end_date }} م - {{ $row->end_dateh }} هـ
                                                            </td>
                                                            <td>{{ $row->no_of_days }}</td>


                                                            <td>

                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <th> من تاريخ </th>
                                                        <th> الى تاريخ </th>
                                                        <th> عدد الايام </th>
                                                        <th>اجراءات</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    @else
                                        لا يوجد عمليات
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>


                </div>
            </div>


        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="pay_role_id" id="pay_role_id">




                <div class="modal-content">
                    <div class="modal-header  bg-primary">
                        <h5 class="modal-title bg-lighter text-white" id="paymentModalLabel"> بيانات الدفع</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="renter_name"> الموظف </label>
                                <input type="text" id="emp_name" name="emp_name" value="{{ $employee->name }}"
                                    class="form-control" readonly />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="amount"> اجمالي الراتب </label>
                                <input type="text" id="amount" name="amount" class="form-control" readonly />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="amount"> كتابة اجمالي الراتب </label>
                                <input type="text" id="amount_txt" name="amount_txt" class="form-control" readonly />
                            </div>

                            <div class="col-md-4 cal_con">
                                <label class="form-label">تاريخ الدفع </label>

                                <input id="p_date" name="p_date" style="display:none;" class=""
                                    onclick="pickDate(event);  cdid(this.id);" type="text">
                                <input id="p_dateh" name="p_dateh" class="hijrDate"
                                    onclick="pickDate(event); cdid(this.id.substring(0, this.id.length - 1)); "
                                    type="text">
                                <div class="check_cal">
                                    <div id="p_date" name="p_date" class="gdatelable"
                                        onclick=" this.classList.add(this.id); gdcon(this.id);">ميلادي
                                        <i class="fa-solid fa-repeat"></i>
                                    </div>
                                    <div id="p_date" name="p_date" class="hdatelable"
                                        onclick="this.classList.add(this.id+'h'); hjowcon(this.id);">
                                        هجري <i class="fa-solid fa-repeat"></i></div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="emp_id"> المستلم </label>

                                <input type="text" id="receved_by" name="receved_by" value="{{ $employee->name }}"
                                    class="form-control" />

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
                            <div class="col-md-12">
                                <label class="form-label" for="payment_type">   الصرف من العهدة   </label>

                               <select id="from_ohda_id" name="from_ohda_id"
                                            class="select2 form-select w-100 ohdafrom" data-allow-clear="true">
                                            <option value="">اختر </option>
                                            @foreach ($ohdas as $row)
                                                <option value="{{ $row->id }}">{{ $row->employee->name }}
                                                    ({{ $row->purpose }})
                                                </option>
                                            @endforeach
                                        </select>

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


    <script>
        function fn_payement(row) {


            console.log(row);

            
            $('#amount').val(row['net_salary']);
            $('#amount_txt').val(row['net_salary_txt']);
         
            $('#pay_role_id').val(row['id']);

           
            $('#paymentModal').modal('show');


        }
    </script>

@endsection
