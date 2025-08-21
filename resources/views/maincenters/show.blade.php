@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card  mb-3">
                <div class="card-header bg-lighter"><strong>{{ $maincenter->name }} </strong>
                </div>
                <div class="card-body">

                    <div class="col-md-3 float-end">
                        <div>
                            @if ($maincenter->img != '')
                                <a href="<?= asset('storage/' . $maincenter->img) ?>" target="_blank">
                                    <img src="<?= asset('storage/' . $maincenter->img) ?>" class="w-100" />
                                </a>
                            @else
                                <?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>
                                <img class=" float-end" style="width: 125px ; height: 125px;"
                                    src="{{ $root }}/assets/img/branding/sedqilogo1.png">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-9 float-start">


                        <form method="POST" action="{{ route('maincenters.update', $maincenter->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="container-xxl">
                                <div class="authentication-wrapper authentication-basic container-p-y">
                                    <div class="authentication-inner py-4">
                                        <!-- Login -->

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="name">اسم المركز الرئيسي <i
                                                        class="fa fa-asterisk " style="color: red"
                                                        aria-hidden="true"></i></label>
                                                <input type="text" id="name" name="name"
                                                    value="{{ $maincenter->name }}" class="form-control" required />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="iban">حساب الايبان <i
                                                        class="fa fa-asterisk " style="color: red"
                                                        aria-hidden="true"></i></label>
                                                <input type="text" name="iban" class="form-control" id="iban"
                                                    value="{{ $maincenter->iban }}" required>
                                                @error('iban')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="emp_id">الموظف المسئول </label>
                                                <select id="emp_id" name="emp_id" class="select2 form-select"
                                                    data-allow-clear="true">
                                                    <option value="">اختر </option>
                                                    @foreach ($emps as $row)
                                                        <option value="{{ $row->id }}"
                                                            @if ($maincenter->emp_id == $row->id) {{ 'selected' }} @endif>
                                                            {{ $row->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>





                                            <div class="col-md-6">
                                                <label for="file" class="form-label"> صورة </label>
                                                <input type="file" name="file" id="file" class="form-control">

                                            </div>

                                            <div class="col-md-12">
                                                <label class="form-label" for="notes"> ملاحظات </label>
                                                <textarea id="notes" name="notes" class="form-control"> {{ $maincenter->notes }}</textarea>
                                            </div>

                                        </div>


                                        <div class="mb-3">
                                            <div class="pt-4">
                                                <button type="submit"
                                                    class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"><i
                                                        class="fa-solid fa-floppy-disk pe-2"></i> حفظ
                                                    التعديلات</button>


                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>






                    </div>











                </div>
            </div>


            <div class="card mb-3">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-units"
                                role="tab" aria-selected="true">
                                المراكز الفرعية
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-sarf" role="tab"
                                aria-selected="false">
                                المصروفات
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-kabd" role="tab"
                                aria-selected="false">
                                الايرادات
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-files" role="tab"
                                aria-selected="false">
                                المرفقات
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="form-tabs-units" role="tabpanel">

                        <div class="card-datatable table-responsive pt-0">
                            <table class="table table-striped FathyTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> المنطقة</th>
                                        <th>المركز الربحي</th>
                                        <th> حساب شركة الكهرباء </th>
                                        <th> حساب شركة المياة </th>
                                        <th> صورة المركز </th>
                                        <th>اجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($centers as $key => $center)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $center->location->name }}</td>
                                            <td>{{ $center->center_name }}</td>
                                            <td>{{ $center->electric_no }}</td>
                                            <td>{{ $center->woter_no }}</td>

                                            <td>
                                                <a href="#exampleModal{{ $center->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $center->id }}">
                                                    <i class="fa fa-eye " aria-hidden="true"></i>
                                                </a>
                                                <div class="modal fade" id="exampleModal{{ $center->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"> الصورة </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <img src="<?= asset('storage/' . $center->img) ?>"
                                                                    width="100%">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">اغلاق</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>

                                            </td>

                                            <td>

                                                <div class="d-inline-block">
                                                    <a href="javascript:;"
                                                        class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="text-primary ti ti-dots-vertical"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end m-0">
                                                        <li><a href="{{ route('centers.edit', $center->id) }}""
                                                                class="dropdown-item"><i
                                                                    class="fa-solid fa-circle-info"></i> تعديل</a></li>

                                                        <div class="dropdown-divider"></div>
                                                        <li><a href="#"
                                                                onclick="fn_delete_center({{ $center->id }})"
                                                                class="dropdown-item text-danger delete-record"><i
                                                                    class="fa-solid fa-trash-can"></i> حذف</a></li>
                                                    </ul>
                                                </div>
                                                <a href="{{ route('centers.show', $center->id) }}"
                                                    class="btn btn-sm btn-icon item-edit">
                                                    <i class="text-primary ti ti-pencil"></i>
                                                </a>


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <th>#</th>
                                    <th> المنطقة</th>
                                    <th>المركز الربحي</th>
                                    <th> حساب شركة الكهرباء </th>
                                    <th> حساب شركة المياة </th>
                                    <th> صورة المركز </th>
                                    <th>اجراءات</th>
                                </tfoot>
                            </table>
                        </div>





                    </div>
                    <div class="tab-pane fade" id="form-tabs-sarf" role="tabpanel">

                        بيانات المصروفات
                    </div>
                    <div class="tab-pane fade" id="form-tabs-kabd" role="tabpanel">

                        بيانات الايرادات

                    </div>
                    <div class="tab-pane fade" id="form-tabs-files" role="tabpanel">

                        <span>
                            <a class="btn bt-show" href="#"
                                onclick="fn_add_file_row('file_attach'); return false ; ">
                                + اضافة مرفق </a>
                        </span>
                        <form method="POST" action="{{ route('allfiles.add_files') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="object_id" value="{{ $maincenter->id }}">
                            <input type="hidden" name="object_name" value="maincenters">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>عنوان الملف </th>
                                        <th> الملف </th>

                                    </tr>
                                </thead>
                                <tbody id="file_attach">
                                    @if (!empty($files))
                                        @foreach ($files as $file)
                                            <tr>
                                                <td>{{ $file->title }}</td>
                                                <td>
                                                    <i class="ti ti-file"></i>
                                                    <span class="align-middle ms-1">
                                                        <a href="<?= asset('storage/' . $file->url) ?>" target="_blank">
                                                            عرض الملف </a></span>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif


                                </tbody>


                            </table>
                            <div class="pt-4 btn-save-files" style="display: none">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"><i
                                        class="fa-solid fa-floppy-disk pe-2"></i> حفظ
                                    الملفات </button>


                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function fn_add_file_row(div_id) {
            var new_row =
                '<tr><td><input type="text"   name="title[]" class="form-control" required /></td><td><input type="file" name="file[]"   class="form-control"></td></tr>';
            $('#' + div_id).append(new_row);
            $('.btn-save-files').show();

        }
    </script>
@endsection
