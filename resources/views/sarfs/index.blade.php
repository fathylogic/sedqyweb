@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>إدارة المصروفات</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary me-sm-3 me-1" href="{{ route('sarfs.create') }}"><i class="fa fa-plus"></i>&nbsp;
                    اضافة صرف جديد</a>
            </div>
        </div>
    </div>

    @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
    @endsession



    <div class="card mb-3">

        <hr class="my-1" />
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

                                    <div class="d-inline-block">
                                        <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="text-primary ti ti-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end m-0">
                                            <li><a href="{{ route('sarfs.show',$row->id) }}" class="dropdown-item"><i
                                                        class="fa-solid fa-circle-info"></i>
                                                    عرض التفاصيل</a></li>

                                            <div class="dropdown-divider"></div>
                                            <li><a href="#" class="dropdown-item text-danger delete-record"><i
                                                        class="fa-solid fa-trash-can"></i> حذف</a>
                                            </li>
                                        </ul>
                                    </div>


                                    <a href="#" onclick="fn_print({{ $row }})"
                                        class="btn btn-sm btn-icon item-edit" alt="طباعة" alt="طباعة">
                                        <i class="fa-solid fa-print"></i>
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



    <div class="modal fade" id="print_paymentModal" tabindex="-1" aria-labelledby="print_paymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">


            <div class="modal-content">
                <div class="modal-header  bg-primary">
                    <h5 class="modal-title bg-lighter text-white" id="print_paymentModalLabel"> طباعة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                    <div class="col-md-5 invoice-header border border-1 rounded h-100 text-center p-2 mx-2">
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

                                    <div class="col-md-5 invoice-title h-100 text-center text-dark fw-bold p-2 mx-2">
                                        <span class=" p-2"> سند صرف
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



        function fn_print(row) {


            console.log(row);


            var ser = '(' + String(row['sereal']).padStart(4, '0') + ')' + row['year_m'] + '-' + row['year_h'];
            $('#p_sereal').html(ser);

            var pdateh = 'التاريخ:' + row['actual_dateh'] + 'هـ';
            $('#p_actual_dateh').html(pdateh);

            var pdate = 'Date:' + row['actual_date'];
            $('#p_actual_date').html(pdate);

            var pamount = '#' + row['amount'] + 'ريال';
            $('#p_amount').html(pamount);
            $('#p_amount_txt').html(row['amount_txt']);
            $('#p_emp').html(row['receved_by']);



            $('#p_note').html(row['s_desc']);





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
