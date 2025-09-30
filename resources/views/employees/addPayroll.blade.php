@extends('layouts.app')

@section('content')


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

    <form method="POST" action="" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $employee->id }}">
        <input type="hidden" name="salary_year_month" value="{{ $salary_year_month }}">
        <input type="hidden" name="deductions" id="deductions" value="{{ $deductions }}">
        <input type="hidden" name="salary" id="salary" value="{{ $employee->salary }}">
        <div class="container-xxl">
            <div class="authentication-wrapper authentication-basic container-p-y">
                <div class="authentication-inner py-4">
                    <!-- Login -->
                    <div class="card border">
                        <div class="card-body">


                            <div class="row">
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">

                                        الموظف
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $employee->name }} </div>
                                </div>
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        راتب شهر
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $salary_year_month }}
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">

                                        المرتب الاساسي
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $employee->salary }} </div>
                                </div>
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        عدد ايام الاجازة خلال الشهر
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $no_of_leave_dayes }}
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">

                                        خصم بدل الاجازة
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $deductions }} </div>
                                </div>
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        خصومات اخرى
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        <input type="text" onchange="calc_net_salary() ; " class="form-control"
                                            value="0" id="other_d" name="other_d">
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">

                                        سبب الخصم
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        <input type="text" class="form-control" value="" name="other_purpose">
                                    </div>
                                </div>
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        حوافز اخرى
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        <input type="text" onchange="calc_net_salary() ; " class="form-control"
                                            value="0" name="other_allowance" id="other_allowance">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">

                                        سبب الحوافز الاخرى
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        <input type="text" class="form-control" value=""
                                            name="other_allowance_purpose">
                                    </div>
                                </div>
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        صافي الراتب
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        <input type="text" readonly class="form-control"
                                            value="<?= $employee->salary - $deductions ?>" name="net_salary"
                                            id="net_salary">
                                    </div>
                                </div>

                            </div>

{{-- 
                            <div class="row">
                                <div class="col-md-12 p-0 float-start mb-1">
                                    <div
                                        class="col-md-3 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">

                                        الصرف من العهدة
                                    </div>
                                    <div class="col-md-8 border rounded float-start p-1 me-1 mb-1 h-100">
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


                            </div> --}}




                            <div class="mb-3">

                                <br>
                                <div class="col-md-4 text-employee">
                                    <button type="submit" name="btn_save_payroll"
                                        class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">
                                        حفظ &nbsp; <i class="fa-solid fa-floppy-disk"></i> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <p class="text-employee text-primary"><small> </small></p>

    <script>
        function calc_net_salary() {
            let s = $('#salary').val();
            let d1 = $('#deductions').val();
            let d2 = $('#other_d').val();
            let a = $('#other_allowance').val();

            var val = Number(s) + Number(a) - Number(d1) - Number(d2);
            $('#net_salary').val(val);

        }
    </script>
@endsection
