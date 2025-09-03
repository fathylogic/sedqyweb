@extends('layouts.app')

@section('content')
    
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>إدارة المراكز الرئيسية</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary me-sm-3 me-1" href="{{ route('maincenters.create') }}"><i
                        class="fa fa-plus"></i>&nbsp;
                    اضافة مركز رئيسي جديد</a>
            </div>
        </div>
    </div>

    @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
    @endsession

    <div class="card">

        <div class="row">
            <!-- tree Menu -->
            <div class="col-md-3 col-12">
                <div class="card mb-4 shadow-none">
                    <!-- <div id="jstree-context-menu" class="overflow-auto"></div> -->
                    <!-- JSTree -->
                    <!-- JSTree -->
                    <!-- Basic -->
                    <div class="card-body">
                        <div id="jstree-basic">

                            <ul>
                                @foreach ($data as $key => $main)
                                    <li data-db-id=" {{ $main->id }} " class="jstree-open"
                                        data-edit-url="{{ route('maincenters.show', $main->id) }}"
                                        data-iban=" {{ $main->iban }} " data-jstree='{"icon" : "fa-solid fa-hotel"}'
                                        data-main-data="{{ $main }}"
                                        data-emp_name ="{{ $main->employee->name }}" {{-- اسم الموظف المسؤول  --}}
                                        onclick="fn_hidediv()">
                                        {{ $main->name }}
                                        <ul>
                                            @if ($main->centers->count() > 0)
                                                @foreach ($main->centers as $center)
                                                    <li data-db-id=" {{ $center->id }} "
                                                        data-edit-url="{{ route('centers.show', $center->id) }}"
                                                        data-woter_no="{{ $center->woter_no }}"
                                                        data-electric_no="{{ $center->electric_no }}"
                                                        data-electric_no="{{ $center->electric_no }}"
                                                        data-gps="<a href='{{ $center->gps }}' target='_blank'>{{ $center->gps }}</a>"
                                                        data-jstree='{"icon" : "fa-solid fa-building-circle-exclamation"}'>
                                                        {{ $center->center_name }}
                                                    </li>
                                                @endforeach
                                            @endif


                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- /Basic -->
                </div>
                <!-- /tree Menu -->

            </div>

            <div class="col-md-9 col-12">
                <div id="details">

                </div>
            </div>

        </div>
    </div>










    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div id="creat_new_center">
                    <form method="POST" action="{{ route('maincenters.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="maincenter_id" name="maincenter_id">
                        <div class="container-xxl">
                            <div class="authentication-wrapper authentication-basic container-p-y">
                                <div class="authentication-inner py-4">
                                    <!-- Login -->
                                    <div class="card border">
                                        <div class="card-header">
                                            <h5 id="mctitle"></h5>
                                        </div>
                                        <div class="card-body">

                                            <div class="container-xxl">
                                                <div class="authentication-wrapper authentication-basic container-p-y">
                                                    <div class="authentication-inner py-4">
                                                        <!-- Login -->
                                                        <div class="card border">
                                                            <div class="card-body">

                                                                <div class="row g-3">
                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="center_name">اسم
                                                                            المركز الفرعي <i class="fa fa-asterisk "
                                                                                style="color: red"
                                                                                aria-hidden="true"></i></label>
                                                                        <input type="text" name="center_name"
                                                                            class="form-control" required />
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label"
                                                                            for="center_location">المنطقة <i
                                                                                class="fa fa-asterisk " style="color: red"
                                                                                aria-hidden="true"></i></label>
                                                                        <select id="center_location"
                                                                            name="center_location" required
                                                                            class="select2 form-select"
                                                                            data-allow-clear="true">
                                                                            <option value="">اختر</option>
                                                                            @foreach ($locations as $row)
                                                                                <option value="{{ $row->id }}">
                                                                                    {{ $row->name }}</option>
                                                                            @endforeach

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="hainame">الحي
                                                                        </label>
                                                                        <input type="text" name="hainame"
                                                                            class="form-control" />

                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="street">الشارع
                                                                        </label>
                                                                        <input type="text" name="street"
                                                                            class="form-control" />

                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="Building_no">رقم
                                                                            العمارة </label>
                                                                        <input type="text" name="Building_no"
                                                                            class="form-control" />

                                                                    </div>



                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="sak_no"> الموقع
                                                                            على الخريطة </label>
                                                                        <input type="text" name="gps"
                                                                            class="form-control" />

                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="sak_no">رقم الصك
                                                                        </label>
                                                                        <input type="text" name="sak_no"
                                                                            class="form-control" />

                                                                    </div>


                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="electric_no"> حساب
                                                                            شركة الكهرباء <i class="fa fa-asterisk "
                                                                                style="color: red"
                                                                                aria-hidden="true"></i></label>
                                                                        <input type="text" id="electric_no"
                                                                            name="electric_no" required
                                                                            class="form-control" />
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="woter_no"> حساب
                                                                            شركة المياة <i class="fa fa-asterisk "
                                                                                style="color: red"
                                                                                aria-hidden="true"></i></label>
                                                                        <input type="text" id="woter_no"
                                                                            name="woter_no" required
                                                                            class="form-control" />
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="left_electric_no">
                                                                            حساب اخر للمصاعد
                                                                        </label>
                                                                        <input type="text" id="left_electric_no"
                                                                            name="left_electric_no"
                                                                            class="form-control" />
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="file" class="form-label">
                                                                            صورة</label>
                                                                        <input type="file" name="file"
                                                                            id="file" class="form-control">

                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <label class="form-label" for="notes"> ملاحظات
                                                                        </label>
                                                                        <textarea id="notes" name="notes" class="form-control"></textarea>
                                                                    </div>

                                                                </div>





                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                    </form>
                </div>

            </div>
        </div>
    </div>

   
    <script>
        


        function fn_creat_new_center(row) {
            console.log(row);

            // $('#objInfo').html('') ;
            $('#mctitle').html('المركز الرئيسي: ' + row['name']);
            $('#maincenter_id').val(row['id']);
            // $('#creat_new_center').show();
            $('#exampleModal').modal('show');

        }

        
    </script>
    {!! $data->links('pagination::bootstrap-5') !!}
@endsection
