@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary me-sm-3 me-1" href="{{ route('payments.index') }}"><i
                        class="fa fa-arrow-left"></i>&nbsp;  عودة &nbsp;</a>
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

    <form method="POST" action="{{ route('payments.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="container-xxl">
            <div class="authentication-wrapper authentication-basic container-p-y">
                <div class="authentication-inner py-4">
                    <!-- Login -->
                    <div class="card border">
                        <div class="card-body">

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="unit_type"> نوع الوحدة <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <select id="unit_type" name="unit_type" class="select2 form-select"
                                        data-allow-clear="true">
                                        <option value="">اختر </option>
                                        @foreach ($types as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="unit_description">وصف الوحدة <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="unit_description" name="unit_description" class="form-control"
                                        required />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="center_id"> المركز الربحي <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <select id="center_id" name="center_id" required class="select2 form-select"
                                        data-allow-clear="true">
                                        <option value="">اختر </option>
                                        @foreach ($centers as $row)
                                            <option value="{{ $row->id }}">{{ $row->center_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="woter_no"> حساب المياه </label>
                                    <input type="text" id="woter_no" name="woter_no" class="form-control" />
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="electric_no"> حساب الكهرباء <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="electric_no" name="electric_no" required
                                        class="form-control" />
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="floor_no"> الدور<i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="floor_no" required name="floor_no" class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="unit_no"> رقم الوحدة <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="unit_no" required name="unit_no" class="form-control" />
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="current_renter_id"> المستأجر الحالي </label>
                                    <select id="current_renter_id" name="current_renter_id" class="select2 form-select"
                                        data-allow-clear="true">
                                        <option value="">اختر </option>
                                        @foreach ($renters as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach

                                    </select>
                                </div>





                                <div class="col-md-4">
                                    <label for="file" class="form-label"> صورة </label>
                                    <input type="file" name="file" id="file" class="form-control">

                                </div>


                                <div class="col-md-4">
                                    <label class="form-label" for="notes"> ملاحظات </label>
                                    <textarea id="notes" name="notes" class="form-control"></textarea>
                                </div>



                            </div>


                            <div class="mb-3">


                                <div class="col-md-4 text-unit">
                                    <button type="submit"   class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"> حفظ &nbsp;
                                        <i class="fa-solid fa-floppy-disk"></i> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <p class="text-unit text-primary"><small> </small></p>
@endsection
