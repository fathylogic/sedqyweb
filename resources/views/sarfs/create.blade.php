@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary me-sm-3 me-1" href="{{ route('sarfs.index') }}"><i
                        class="fa fa-arrow-left"></i>&nbsp; عودة &nbsp;</a>
            </div>
        </div>
    </div>

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
<?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>

    <form method="POST" action="{{ route('sarfs.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="container-xxl">
            <div class="authentication-wrapper authentication-basic container-p-y">
                <div class="authentication-inner py-4">
                    <!-- Login -->
                    <div class="card border">
                        <div class="card-body">
                            <div class="row">




                                <div class="col-md-12 p-0 float-start mb-1">
                                    <div
                                        class="col-md-2 border rounded text-center fw-bold bg-light float-start p-1 me-1 mb-1 h-100">
                                        يصرف من
                                    </div>
                                    <div class="col-md-9 border rounded float-start p-1 me-1 mb-1 h-100">
                                        <div class="form-check col-md-2 form-check-inline">
                                            <input class="form-check-input" type="radio" required name="source_type_id"
                                                onclick="fn_setSorceType();" value="1">
                                            <label class="form-check-label" for="inlineRadio1"> الايرادات</label>
                                        </div>
                                        <div class="form-check col-md-2 form-check-inline">
                                            <input class="form-check-input" type="radio" required name="source_type_id"
                                                onclick="fn_setSorceType();" value="2">
                                            <label class="form-check-label" for="inlineRadio2"> العهد المالية </label>
                                        </div>
                                        <div class="form-check form-check-inline col-md-6 ohdafrom" style="display: none">

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

                                <div class="col-md-12 p-0 float-start mb-1">
                                    <div
                                        class="col-md-2 border rounded text-center fw-bold bg-light float-start p-1 me-1 mb-1 h-100">
                                        نوع الصرف
                                        (إلى)
                                    </div>
                                    <div class="col-md-9 border rounded float-start p-1 me-1 mb-1 h-100">
                                        @foreach ($sarfTypes as $row)
                                            <div class="form-check col-md-2 form-check-inline">
                                                <input class="form-check-input" type="radio" required name="sarf_type_id"
                                                    onclick="fn_setSarfType();" value="{{ $row->id }} ">
                                                <label class="form-check-label"> {{ $row->name }} </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-11 border rounded   sarftype1" style="display: none">
                                    {{-- الى عهدة مالية --}}
                                    <div class="row ">
                                        <div class="col-md-12 p-0 float-start mb-1">
                                            <div class="col-md-3   text-center fw-bold bg-lighter float-start    ">
                                                يصرف الى العهدة المالية:
                                            </div>
                                            <div class="col-md-8   float-start    ">
                                                <select name="to_ohda_id"  class="select2 form-select w-100  "
                                                    data-allow-clear="true">
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

                                </div>
                                <div class="col-md-11 border rounded      sarftype2" style="display: none">
                                    {{-- مستفيدين --}}
                                    <div class="row ">
                                        <div class="col-md-12 p-0 float-start mb-1">
                                            <div class="col-md-3   text-center fw-bold bg-lighter float-start    ">
                                                اختر المستفيد:
                                            </div>
                                            <div class="col-md-8   float-start    ">
                                                <select name="recipient_id"  class="select2 form-select w-100  "
                                                    data-allow-clear="true">
                                                    <option value="">اختر </option>
                                                    @foreach ($recipients as $row)
                                                        <option value="{{ $row->id }}">{{ $row->name }}

                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-11 border rounded       sarftype3" style="display: none">
                                    {{-- رواتب موظفين --}}
                                    <div class="row ">
                                        <div class="col-md-12 p-0 float-start mb-1">
                                            <div class="col-md-3   text-center fw-bold bg-lighter float-start    ">
                                                اختر بيان الراتب :
                                            </div>
                                            <div class="col-md-8   float-start    ">
                                                <select name="pay_role_id"  id="pay_role_id"
                                                    onchange="fn_set_amount(this.options[this.selectedIndex].getAttribute('data-amount'))"
                                                    class="select2 form-select w-100 " data-allow-clear="true">
                                                    <option value="">اختر </option>
                                                    @foreach ($payrolls as $row)
                                                        <option value="{{ $row->id }}"
                                                            data-amount="{{ $row->net_salary }}">
                                                            {{ $row->employee->name }} :
                                                            راتب شهر ({{ $row->salary_year_month }})
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-11 border rounded       mb-1 sarftype4" style="display: none">
                                    {{-- خدمات --}}
                                     <div class="row m-2">
                                     <div class="col-md-4">
                                            <label class="form-label" for="service_type_id">  نوع الخدمة </label>

                                            <select id="service_type_id"  name="service_type_id"
                                                class="select2 form-select" data-allow-clear="true">
                                                <option value="">اختر </option>
                                                @foreach ($serviceTypes as $row)
                                                    <option value="{{ $row->id }}">{{ $row->name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label" for="center_id">    المركز الربحي </label>

                                            <select id="center_id"  name="center_id" onchange="fn_get_units(this.value)"
                                                class="select2 form-select" data-allow-clear="true">
                                                <option value="">اختر </option>
                                                @foreach ($centers as $row)
                                                    <option value="{{ $row->id }}">{{ $row->center_name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>

                                         <div class="col-md-8" id="uint_div" style="display: none">
                                            <label class="form-label" for="unit_id">    الوحدة الربحية   </label>

                                            <select id="unit_id"   name="unit_id"  
                                                class="select2 form-select" data-allow-clear="true">
                                               

                                            </select>

                                        </div>
                                     </div>

                                </div>

                                <div class="col-md-11 border rounded       mb-1 ">
                                    {{-- بيانات الصرف  --}}
                                    <div class="row mb-2 m-2" >

                                        <div class="col-md-4">
                                            <label class="form-label" for="amount"> المبلغ </label>
                                            <input type="text" id="amount" name="amount" required
                                                class="form-control" />
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
                                            <label class="form-label" for="payment_type"> طريقة الدفع </label>

                                            <select id="payment_type" required name="payment_type"
                                                class="select2 form-select" data-allow-clear="true">
                                                <option value="">اختر </option>
                                                @foreach ($payment_types as $row)
                                                    <option value="{{ $row->id }}">{{ $row->name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="s_desc"> الغرض </label>
                                            <input type="text" id="s_desc" name="s_desc" value="" required
                                                class="form-control">

                                        </div> 
                                        <div class="col-md-12">
                                            <label class="form-label" for="receved_by"> المستلم </label>
                                            <input type="text" id="receved_by" name="receved_by" value="" required
                                                class="form-control">

                                        </div>
                                         




                                    </div>



                                </div>







                                <div class="col-md-4 text-unit">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">
                                        حفظ &nbsp;
                                        <i class="fa-solid fa-floppy-disk"></i> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <input type="hidden" id="aurl" value="{{ $root }}/sarfs/get_units/"
 

    <p class="text-unit text-primary"><small>أوقاف إبراهيم صدقي محمد سعيد أفندي</small></p>


    <script>
        $(document).ready(function() {
            // Your code here will run once the DOM is ready
            // console.log("Document is ready!");
            // $("#myButton").click(function() {
            //     // Handle button click
            // });
        });

        function fn_get_units(id)
        {
            if(id!=''&&id>0)
            { 
            var url = $('#aurl').val()+id;
            
            
            $.ajax({
                    url: url,  
                    method: 'GET',
                    data:id,
                    dataType: 'text',  
                    success: function(data) {
                        console.log(data) ;
                         $('#unit_id').html(data);

                         $('#unit_id').trigger('change') ; 
                        $('#uint_div').show() ;
                         
                         
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error("AJAX error:", status, error);
                    }
                }); 
            }else
             $('#uint_div').hide() ;

        }


        function fn_set_amount(amount) {

            $("#amount").val(amount);
        }

        function fn_setSorceType() {
            var selectedsource_type = $("input[name='source_type_id']:checked").val();
            if (selectedsource_type == 2)
                $(".ohdafrom").show();
            else
                $(".ohdafrom").hide();
        }

        function fn_setSarfType() {
            var selected_type = $("input[name='sarf_type_id']:checked").val();

            $(".sarftype1").hide();
            $(".sarftype2").hide();
            $(".sarftype3").hide();
            $(".sarftype4").hide();
            $(".sarftype" + selected_type).show();


        }
    </script>
@endsection
