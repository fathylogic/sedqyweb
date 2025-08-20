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




    <form method="POST" action="{{ route('ohdas.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="container-xxl">
            <div class="authentication-wrapper authentication-basic container-p-y">
                <div class="authentication-inner py-4">
                    <!-- Login -->
                    <div class="card border">
                        <div class="card-body">

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="emp_id">الموظف المسئول <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <select id="emp_id" name="emp_id" required class="select2 form-select"
                                        data-allow-clear="true">
                                        <option value="">اختر </option>
                                        @foreach ($emps as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="purpose"> الغرض من العهدة <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="purpose" name="purpose" required class="form-control" />
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="raseed"> الرصيد الابتدائي <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" value="0" id="raseed" name="raseed" required
                                        class="form-control" />
                                </div>

                            </div>


                            <div class="mb-3">


                                <div class="col-md-4 text-employee">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">حفظ
                                        <i class="fa-solid fa-floppy-disk"></i> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>



    <p class="text-employee text-primary"><small> </small></p>
@endsection
