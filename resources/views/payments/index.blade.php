@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>إدارة   الايرادات</h2>
            </div>

        </div>
    </div>

    @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
    @endsession


   <div class="card mb-3">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" role="tablist">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab_payed"
                                        role="tab" aria-selected="false">
                                        الايرادات (المدفوعة)
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link " data-bs-toggle="tab" data-bs-target="#tab_un_payed"
                                        role="tab" aria-selected="true">
                                          الايرادات (الغير مدفوعة)

                                    </button>
                                </li>



                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade  active show" id="tab_payed" role="tabpanel">

                                <hr class="my-1" />
                                @if (!empty($payments_payed))
                                    <div class="card-datatable table-responsive pt-0">
                                        <table class="table table-striped FathyTable">
                                            <thead>
                                                <tr>

                                                    <th> المركز الرئيسي </th>
                                                    <th> المركز الفرعي </th>
                                                    <th> رقم الوحدة  </th>
                                                    <th> المستأجر </th>
                                                    <th>   المستلم </th>
                                                    <th> المبلغ </th>
                                                    <th> الدفعة </th>
                                                    <th> تاريخ الدفع </th>
                                                    <th>اجراءات</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($payments_payed as $key => $row)
                                                    <tr>

                                                        <td>{{ @$row->maincenter->name }}</td>
                                                        <td>{{ @$row->center->center_name }}</td>
                                                        <td>{{ @$row->unit->unit_no }}</td>
                                                        <td>{{ $row->contract->renter->name }}</td>
                                                         <td>{{ $row->employee->name }}</td>
                                                        <td>{{ $row->amount }}
                                                                - ({{ $row->paymentType->name }})

                                                        </td>
                                                        <td>
                                                            @if ($row->payment_no == 0)
                                                                {{ $row->notes }} @else{{ $row->payment_no }}
                                                            @endif
                                                        </td>
                                                        <td>

                                                                {{ $row->actual_date }} - {{ $row->actual_dateh }}

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


                                                                <a href="#" onclick="fn_print({{ $row }})"
                                                                    class="btn btn-sm btn-icon item-edit" alt="طباعة"
                                                                    alt="طباعة">
                                                                    <i class="fa-solid fa-print"></i>
                                                                </a>




                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>

                                            <tfoot>
                                                <tr>

                                                    <th> المركز الرئيسي </th>
                                                    <th> المركز الفرعي </th>
                                                   <th> رقم الوحدة  </th>
                                                    <th> المستأجر </th>
                                                    <th>   المستلم </th>
                                                    <th> المبلغ </th>
                                                    <th> الدفعة </th>
                                                    <th> تاريخ الدفع </th>
                                                    <th>اجراءات</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                @else
                                    لا يوجد
                                @endif


                            </div>
                            <div class="tab-pane fade  " id="tab_un_payed" role="tabpanel">


                                <hr class="my-1" />
                                 @if (!empty($payments_un_payed))
                                    <div class="card-datatable table-responsive pt-0">
                                        <table class="table table-striped FathyTable">
                                            <thead>
                                                <tr>

                                                    <th> المستأجر </th>
                                                    <th> موعد الدفع </th>
                                                    <th>   المتبقي من الايام </th>
                                                    <th> المبلغ </th>
                                                    <th> الدفعة </th>

                                                    <th>اجراءات</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($payments_un_payed as $key => $row)
                                                <?php $days = dateDiff(today(),$row->p_date)  ;
                                                        if($days <= 0 )
                                                            $class = "table-danger" ;
                                                        else if($days <= 7 )
                                                            $class = "table-warning" ;
                                                        else   $class = "" ;

                                                ?>
                                                    <tr class="{{ $class }}">

                                                        <td>{{ $row->contract->renter->name }}</td>
                                                        <td>

                                                            {{ $row->p_date }} م - {{ $row->p_dateh }} هـ</td>
                                                        <td>{{ $days }} </td>
                                                        <td>{{ $row->amount }} </td>
                                                        <td>
                                                            @if ($row->payment_no == 0)
                                                                {{ $row->notes }} @else{{ $row->payment_no }}
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


                                                                <a href="#"
                                                                    onclick="fn_payement({{ $row }})"
                                                                    class="btn btn-sm btn-icon item-edit" alt="الدفع"
                                                                    alt="الدفع">
                                                                    <i class="fas fa-sack-dollar"></i>
                                                                </a>





                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>

                                            <tfoot>
                                                <tr>

                                                    <th> المستأجر </th>
                                                    <th> موعد الدفع </th>
                                                      <th>   المتبقي من الايام </th>
                                                    <th> المبلغ </th>
                                                    <th> الدفعة </th>

                                                    <th>اجراءات</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                @else
                                    لا يوجد
                                @endif

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
                                                <span class=" p-2">  سند قبض
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
                                                <span id="p_emp" class="invoice-name fw-bold"> م / فتحي محمد سليمان الخشن</span>
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
                                                <span id="p_note">    </span>
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


                    var ser = '('+String(row['sereal']).padStart(4, '0')+')'+row['year_m']+'-'+row['year_h'] ;
                    $('#p_sereal').html(ser);

                    var pdateh = 'التاريخ:'+row['actual_dateh'] +'هـ' ;
                    $('#p_actual_dateh').html(pdateh);

                    var pdate = 'Date:'+row['actual_date']   ;
                    $('#p_actual_date').html(pdate);

                    var pamount = '#'+row['amount'] + 'ريال'  ;
                    $('#p_amount').html(pamount);
                    $('#p_emp').html(row['employee']['name']);


                    $('#p_amount_txt').html(row['amount_txt']);
                    if(row['payment_no']==0)
                    $('#p_note').html(row['notes']);
                else
                $('#p_note').html(':دفعة رقم'+ row['payment_no']+' من الايجار السنوي');





                    $('#print_paymentModal').modal('show');


                }


        function fn_delete_center(id) {
            Swal.fire({
                title: "هل انت متأكد من انك تريد الحذف ?",
                text: "لا يمكنك استرجاعها مرة أخرى!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "إلغاء",
                confirmButtonText: "نعم,  احذف!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "./payments/destroy/" + id
                }
            });
        }
    </script>




    <p class="text-unit text-primary"><small> </small></p>
@endsection
