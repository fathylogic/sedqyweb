@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('renters.index') }}"> <i class="fa fa-arrow-left"></i>&nbsp; عودة
                    &nbsp;</a>
            </div>
        </div>
    </div>





    <div class="row">
        <div class="col">
            <div class="card  mb-3">
                <div class="card-header bg-light">
                    <strong>{{ $renter->name }} </strong>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 float-end">
                            <div>
                                @if ($renter->img != '')
                                    <a href="<?= asset('storage/' . $renter->img) ?>" target="_blank">
                                        <img src="<?= asset('storage/' . $renter->img) ?>" class="w-100" />
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
                                        {{ $renter->id_no }} </div>
                                </div>
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        الجوال
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $renter->mobile_no }}
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
                                        {{ $renter->nationality }}
                                    </div>
                                </div>
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        ملاحظات
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $renter->notes }} </div>
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
                                            العقود  
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-sarf"
                                            role="tab" aria-selected="false">
                                            الدفعات
                                        </button>
                                    </li>

                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="form-tabs-units" role="tabpanel">

                                    <hr class="my-1" />
                                @if (!empty($contracts))
                                    <div class="card-datatable table-responsive pt-0">
                                        <table class="table table-striped FathyTable">
                                            <thead>
                                                <tr>

                                                    
                                                    <th> بداية العقد </th>
                                                    <th> نهاية العقد </th>
                                                    <th> الايجار </th>
                                                    <th> عدد الدفعات </th>
                                                    <th> التأمين </th>
                                                    <th> الخدمات </th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($contracts as $key => $row)
                                                    <tr>

                                                        
                                                        <td>{{ $row->start_date }} م - {{ $row->start_dateh }} هـ</td>
                                                        <td>{{ $row->end_date }} م - {{ $row->end_dateh }} هـ</td>
                                                        <td>{{ $row->year_amount }}</td>
                                                        <td>{{ $row->no_of_payments }}</td>
                                                        <td>{{ $row->insurance_amount }}</td>
                                                        <td>{{ $row->services_amount }}</td>

                                                        

                                                    </tr>
                                                @endforeach
                                            </tbody>

                                            <tfoot>
                                                <tr>

                                                    
                                                    <th> بداية العقد </th>
                                                    <th> نهاية العقد </th>
                                                    <th> الايجار </th>
                                                    <th> عدد الدفعات </th>
                                                    <th> التأمين </th>
                                                    <th> الخدمات </th>
                                                   
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                @else
                                    لا يوجد عقود مسجلة
                                @endif
                                    
                                </div>
                                <div class="tab-pane fade" id="form-tabs-sarf" role="tabpanel">
                                    
                                     <hr class="my-1" />
                                @if (!empty($payments))
                                    <div class="card-datatable table-responsive pt-0">
                                        <table class="table table-striped FathyTable">
                                            <thead>
                                                <tr>

                                                    
                                                    <th> موعد الدفع </th>
                                                    <th> المبلغ </th>
                                                    <th> الدفعة </th>
                                                    <th> حالة الدفع </th>
                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=0;?>
                                                @foreach ($payments as $key => $row)
                                                    <tr>
                                                          
                                                       
                                                        <td>{{ $row[$i]->p_date }} م - {{ $row[$i]->p_dateا }} هـ</td>
                                                        <td>{{ $row[$i]->amount }} </td>
                                                        <td>
                                                            @if ($row[$i]->payment_no == 0)
                                                                {{ $row[$i]->notes }} @else{{ $row[$i]->payment_no }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($row[$i]->status)
                                                                <i class="fa fa-circle-check  text-success"
                                                                    aria-hidden="true"></i>
                                                                {{ $row[$i]->actual_date }} - {{ $row[$i]->actual_dateh }}
                                                            @else
                                                                <i class="fa-solid fa-circle-xmark text-danger"></i>
                                                            @endif
                                                        </td>

                                                      

                                                    </tr>
                                                @endforeach
                                            </tbody>

                                            <tfoot>
                                                <tr>
                                                    <th> موعد الدفع </th>
                                                    <th> المبلغ </th>
                                                    <th> الدفعة </th>
                                                    <th> حالة الدفع </th>
                                                   
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                @else
                                    لا يوجد  دفعات مسجلة
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
     {{-- 
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

                    // $('#renter_name').val(row['contract']['renter']['name']);
                    // $('#amount').val(row['amount']);
                    // $('#payment_notes').val(row['notes']);
                    // $('#payment_id').val(row['id']);
                    // //  $('#emp_name').val($("#emp_id option:selected").text());
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
            </script> --}}
@endsection
