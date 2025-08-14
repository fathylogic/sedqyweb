@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary me-sm-3 me-1" href="{{ route('recipients.index') }}"><i
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

    <form method="POST" action="{{ route('recipients.update', $recipient->id) }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $recipient->id }}">
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
                                    <input type="text" id="name" name="name" value="{{ $recipient->name }}"
                                        class="form-control" required />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="r_type"> نوع المستفيد <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="r_type" value="{{ $recipient->r_type }}" name="r_type"
                                        required class="form-control" />
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="r_address"> العنوان <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="r_address" value="{{ $recipient->r_address }}"
                                        name="r_address" required class="form-control" />
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="mobile_no"> رقم الموبيل (الواتس) <i
                                            class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="mobile_no" value="{{ $recipient->mobile_no }}" required
                                        name="mobile_no" class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="iban"> الحساب البنكي (IBAN) </label>
                                    <input type="text" id="iban" value="{{ $recipient->iban }}" name="iban"
                                        class="form-control" />
                                </div>



                                <div class="col-md-4">
                                    <label for="file" class="form-label"> صورة مستند</label>
                                    <?php $url = asset('storage/' . $recipient->img); ?> <a href="{{ $url }}" target="_blank"> <i class="fa fa-eye "
                                            aria-hidden="true"></i> </a>

                                    </label>
                                    <input type="file" name="file" id="file" class="form-control">

                                </div>

                                <div class="col-md-12">
                                    <label class="form-label" for="notes"> ملاحظات </label>
                                    <textarea id="notes" name="notes" class="form-control">{{ $recipient->notes }}</textarea>
                                </div>

                            </div>


                            <div class="mb-3">


                                <div class="col-md-4 text-recipient">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"> حفظ &nbsp;
                                        <i class="fa-solid fa-floppy-disk"></i> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <p class="text-recipient text-primary"><small>أوقاف إبراهيم صدقي محمد سعيد أفندي</small></p>
@endsection
