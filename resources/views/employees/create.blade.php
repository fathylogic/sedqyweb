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
    <?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>
    <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="container-xxl">
            <div class="authentication-wrapper authentication-basic container-p-y">
                <div class="authentication-inner py-4">
                    <!-- Login -->
                    <div class="card border">
                        <div class="card-body">

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="name">الاسم <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="name" name="name" class="form-control" required />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="id_no"> رقم الهوية <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="id_no" name="id_no" required class="form-control" />
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="nationality"> الجنسية <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="nationality" name="nationality" required
                                        class="form-control" />
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="mobile_no"> رقم الموبيل (الواتس) <i
                                            class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="mobile_no" required name="mobile_no" class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="iban"> الحساب البنكي (IBAN) <i
                                            class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="iban" required name="iban" class="form-control" />
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="job"> الوظيفة <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="job" required name="job" class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="maincenter_id"> المركز الرئيسي </label>
                                    <select id="maincenter_id" name="maincenter_id" class="select2 form-select"
                                        onchange="fn_get_centers(this.value)" data-allow-clear="true">
                                        <option value="">غير محدد</option>
                                        @foreach ($maincenters as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="center_id"> المركز الفرعي </label>
                                    <select id="center_id" name="center_id" class="select2 form-select"
                                        data-allow-clear="true">

                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="emp_type"> نوع الموظف </label>
                                    <select id="emp_type" name="emp_type" onchange="fn_setDates(this.value);"
                                        class="select2 form-select" data-allow-clear="true">
                                        
                                        @foreach ($empTypes as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="row g-3" id="temp_emp" style="display: none">


                                    <div class="col-md-4 cal_con">
                                        <label class="form-label">تاريخ البداية </label>

                                        <input id="start_date" name="start_date" style="display:none;" class=""
                                            onclick="pickDate(event);  cdid(this.id);" type="text">
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
                                        <label class="form-label">تاريخ النهاية </label>

                                        <input id="end_date" name="end_date" style="display:none;" class=""
                                            onclick="pickDate(event);  cdid(this.id);" type="text">
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




                                     




                                </div>



                                <div class="col-md-4">
                                    <label class="form-label" for="emp_status"> حالة الموظف </label>
                                    <select id="emp_status" name="emp_status" class="select2 form-select"
                                        data-allow-clear="true">
                                        <option value="">غير محدد</option>
                                        @foreach ($empStatus as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-4 cal_con">
                                    <label class="form-label">تاريخ الالتحاق </label>

                                    <input id="join_date" name="join_date" style="display:none;" class=""
                                        onclick="pickDate(event);  cdid(this.id);" type="text">
                                    <input id="join_dateh" name="join_dateh" class="hijrDate"
                                        onclick="pickDate(event); cdid(this.id.substring(0, this.id.length - 1)); "
                                        type="text">
                                    <div class="check_cal">
                                        <div id="join_date" name="join_date" class="gdatelable"
                                            onclick=" this.classList.add(this.id); gdcon(this.id);">ميلادي
                                            <i class="fa-solid fa-repeat"></i>
                                        </div>
                                        <div id="join_date" name="join_date" class="hdatelable"
                                            onclick="this.classList.add(this.id+'h'); hjowcon(this.id);">
                                            هجري <i class="fa-solid fa-repeat"></i></div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label class="form-label" for="salary"> المرتب <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="salary" required name="salary" class="form-control" />
                                </div>

                                <div class="col-md-4 cal_con">
                                    <label class="form-label">تاريخ الميلاد </label>

                                    <input id="birthday" name="birthday" style="display:none;" class=""
                                        onclick="pickDate(event);  cdid(this.id);" type="text">
                                    <input id="birthdayh" name="birthdayh" class="hijrDate"
                                        onclick="pickDate(event); cdid(this.id.substring(0, this.id.length - 1)); "
                                        type="text">
                                    <div class="check_cal">
                                        <div id="birthday" name="birthday" class="gdatelable"
                                            onclick=" this.classList.add(this.id); gdcon(this.id);">ميلادي
                                            <i class="fa-solid fa-repeat"></i>
                                        </div>
                                        <div id="birthday" name="birthday" class="hdatelable"
                                            onclick="this.classList.add(this.id+'h'); hjowcon(this.id);">
                                            هجري <i class="fa-solid fa-repeat"></i></div>
                                    </div>
                                </div>




                                <div class="col-md-4">
                                    <label for="file" class="form-label"> صورة الهوية</label>
                                    <input type="file" name="file" id="file" class="form-control">

                                </div>


                                <div class="col-md-4">
                                    <label class="form-label" for="notes"> ملاحظات </label>
                                    <textarea id="notes" name="notes" class="form-control"></textarea>
                                </div>

                            </div>


                            <div class="mb-3">


                                <div class="col-md-4 text-employee">
                                    <button type="submit"
                                        class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">حفظ
                                        <i class="fa-solid fa-floppy-disk"></i> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <input type="hidden" id="aurl" value="{{ $root }}/employees/get_centers/">
    <script>
        function fn_setDates(id) {
            if (id != 1)

                $('#temp_emp').show();

            else
                $('#temp_emp').hide();

        }

        function fn_get_centers(id) {
            if (id != '' && id > 0) {
                var url = $('#aurl').val() + id;


                $.ajax({
                    url: url,
                    method: 'GET',
                    data: id,
                    dataType: 'text',
                    success: function(data) {

                        $('#center_id').html(data);

                        $('#center_id').trigger('change');



                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error("AJAX error:", status, error);
                    }
                });
            } else
                $('#uint_div').hide();

        }
    </script>
    <p class="text-employee text-primary"><small> </small></p>
@endsection
