@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('payments.index') }}"> <i class="fa fa-arrow-left"></i>&nbsp; عودة
                    &nbsp;</a>
            </div>
        </div>
    </div>


    @if (\Session::has('danger'))
        <div class="alert alert-danger">
            <ul>
                <li>{!! \Session::get('danger') !!}</li>
            </ul>
        </div>
    @endif

<?php   

                    $ser = '('. str_pad($payment->sereal, 4, '0', STR_PAD_LEFT)   .')'.$payment->year_m.'-'.$payment->year_h ; 
                    $pdateh = 'التاريخ:'.$payment->actual_dateh .'هـ' ; 
                    $pdate = 'Date:'.$payment->actual_date   ; 
                    $pamount = '#'.$payment->amount . 'ريال'  ; 
                    if($payment->payment_no==0)
                    $p_note = $payment->notes;
                    else
                    $p_note = ':دفعة رقم'. $payment->payment_no.' من الايجار السنوي';
                
?>			

    <div class="row">
        <div class="col">
            <div class="card  mb-3">
                <div class="card-header bg-lighter">
                    <strong> بيانات سند القبض
                    </strong>
                </div>
                <div class="card-body">
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
                                                <span id="p_sereal">  {{ $ser }}</span>
                                            </div>
                                            <div class="col-md-1 mx-2 h-100 text-center p-2">
                                            </div>
                                        </div>

                                        <div class="row justify-content-between mb-3">
                                            <div
                                                class="col-md-2 invoice-date border border-dark text-dark fw-bold border-1 rounded h-100 text-center p-2">
                                                <span id="p_actual_dateh">  {{$pdateh}}</span>
                                            </div>

                                            <div
                                                class="col-md-5 invoice-title h-100 text-center text-dark fw-bold p-2 mx-2">
                                                <span class=" p-2">  سند قبض  
                                                </span>
                                            </div>
                                            <div
                                                class="col-md-2 invoice-date border border-dark text-dark fw-bold border-1 rounded h-100 text-center p-2">
                                                <span id="p_actual_date">{{$pdate}}</span>
                                            </div>

                                        </div>

                                        <div class="row justify-content-between mb-3">
                                            <div
                                                class="col-md-2 border border-dark shadow-lg  text-dark fw-bold border-1 h-100 text-center p-2">
                                                <span id="p_amount">{{$pamount}}</span>
                                            </div>
                                        </div>

                                        <div class="row justify-content-between mb-3">
                                            <div class="col-md-12 text-start p-2">
                                                <span class="invoice-name-title text-dark fw-bold"> استلمت أنا : </span>
                                                <span id="p_emp" class="invoice-name fw-bold"> {{ @$payment->employee->name }}   </span>
                                            </div>
                                        </div>

                                        <div class="row justify-content-between mb-3">
                                            <div class="col-md-2 text-dark fw-bold  h-100 text-center p-2">
                                                <span> مبلغ وقدره </span>
                                            </div>
                                            <div
                                                class="col-md-10 border border-2 border-dark shadow-lg  text-danger fw-bold border-1 h-100 text-center p-2">
                                                <span id="p_amount_txt"> {{$payment->amount_txt}}</span>
                                            </div>
                                        </div>

                                        <div class="row justify-content-between mb-3">
                                            <div class="col-md-2 text-dark fw-bold  h-100 text-center p-2">
                                                <span> وذلك نظير : </span>
                                            </div>
                                            <div class="col-md-10 invoice-name fw-bold h-100 text-start p-2">
                                                <span id="p_note"> {{  $p_note }}   </span>
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
            </script>
        @endsection
