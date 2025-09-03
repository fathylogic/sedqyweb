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

    <form method="POST" action="{{ route('renters.update', $renter->id) }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $renter->id }}">
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
                                    <input type="text" id="name" name="name" value="{{ $renter->name }}"
                                        class="form-control" required />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="id_type"> نوع الهوية <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>

                                    <select id="id_type" name="id_type" class="select2 form-select"
                                        data-allow-clear="true">
                                        <option value="">اختر </option>
                                        @foreach ($id_types as $row)
                                            <option value="{{ $row->id }}"
                                                @if ($row->id == $renter->id_type) {{ 'selected' }} @endif>
                                                {{ $row->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="id_no"> رقم الهوية <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="id_no" name="id_no" value="{{ $renter->id_no }}"
                                        required class="form-control" />
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="nationality"> الجنسية <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="nationality" value="{{ $renter->nationality }}"
                                        name="nationality" required class="form-control" />
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="mobile_no"> رقم الموبيل (الواتس) <i
                                            class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="mobile_no" required value="{{ $renter->mobile_no }}"
                                        name="mobile_no" class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="employer"> جهة العمل </label>
                                    <input type="text" id="employer" value="{{ $renter->employer }}" name="employer"
                                        class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="work_no	"> رقم جهة العمل </label>
                                    <input type="text" id="work_no	" name="work_no" value="{{ $renter->work_no }}"
                                        class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="other_no	"> رقم اخر للتواصل </label>
                                    <input type="text" id="other_no" name="other_no" value="{{ $renter->other_no }}"
                                        class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="work_letter	"> خطاب جهة العمل </label>
                                    <input type="file" name="work_letter" id="work_letter"
                                        value="{{ $renter->work_letter }}" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="file" class="form-label"> صورة

                                        <?php $url = asset('storage/' . $renter->img); ?> <a href="{{ $url }}" target="_blank"> <i
                                                class="fa fa-eye " aria-hidden="true"></i> </a>

                                    </label>
                                    <input type="file" name="file" id="file" class="form-control">

                                </div>

                                <div class="col-md-8">
                                    <label class="form-label" for="notes"> ملاحظات </label>
                                    <textarea id="notes" name="notes" class="form-control">{{ $renter->notes }}</textarea>
                                </div>

                            </div>
 
                        </div>

                        <div class="row g-3">










                            <div class="mb-3">


                                <div class="col-md-6 text-renter">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">
                                        حفظ &nbsp; <i class="fa-solid fa-floppy-disk"></i> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <p class="text-renter text-primary"><small> </small></p>
@endsection
