

<?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>

    <form method="POST" action="{{ route('sarfs.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="center_id" value="{{$center->id}}">
        <input type="hidden" name="source_type_id" value="2">
        <input type="hidden" name="from_ohda_id" value="{{ $ohda->id }}">
        <input type="hidden" name="object_name" value="centers">
        <input type="hidden" name="object_id" value="{{$center->id}}">
        <input type="hidden" name="maincenter_id" value="{{$center->maincenter_id}}">
        <input type="hidden" name="last_amount" value="{{$ohda->raseed}}">
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
                                        العهدة
                                    </div>
                                    <div class="col-md-9 border rounded float-start p-1 me-1 mb-1 h-100">
                                        
                                        
                                        <div class="form-check form-check-inline col-md-6 ohdafrom" >

                                             {{ $ohda->employee->name }}
                                                        ({{ $ohda->purpose }})
                                                        
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
                                                @if($row->id!=1)
                                                <input class="form-check-input" type="radio" required name="sarf_type_id"
                                                    onclick="fn_setSarfType();" value="{{ $row->id }} ">
                                                <label class="form-check-label"> {{ $row->name }} </label>
                                                @endif
                                            </div>
                                        @endforeach
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



      