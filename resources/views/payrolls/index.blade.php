@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>إدارة رواتب الموظفين</h2>
            </div>
            <div class="pull-right mb-3">
                <a class="btn btn-primary me-sm-3 me-1" href="#"><i class="fa fa-plus"></i>&nbsp;
                    اضافة راتب موظف  </a> 
                    <a class="btn btn-primary me-sm-3 me-1" href="#"><i class="fa fa-plus"></i>&nbsp;
                    اضافة راتب جميع الموظفين  </a> 
                    <a class="btn btn-primary me-sm-3 me-1" href="#"><i class="fa fa-plus"></i>&nbsp;
                    اضافة راتب جميع الموظفين مع الصرف  </a>
            </div>
        </div>
    </div>


    @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
    @endsession

    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="table table-striped FathyTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> الشهر</th>
                        <th> الموظف </th>
                        <th> الاساسي </th>
                        <th> الحوافز </th>
                        <th> الخصومات </th>
                        <th> صافي الراتب </th>
                        <th> الحالة </th>
                        <th>اجراءات</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data as $key => $salary)
                        <?php // dd($salary->sarf) ;
                        ?>
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $salary->salary_year_month }}</td>
                            <td>{{ $salary->employee->name }}</td>
                            <td>{{ $salary->employee->salary }}</td>

                            <td>{{ $salary->other_allowance }}</td>
                            <td>{{ $salary->deductions }}</td>
                            <td>{{ $salary->net_salary }}</td>
                            <td>
                                @if ($salary->sarf)
                                    <a href="{{ route('sarfs.show', @$salary->sarf->id) }}" class="dropdown-item">

                                        <i class="fa fa-circle-check  text-success" aria-hidden="true"></i>
                                        تم
                                    </a>
                                @else
                                    <i class="fa-solid fa-circle-xmark text-danger"></i>
                                    لم يتم
                                @endif
                            </td>
                            <td>



                                {{-- 
                                <div class="d-inline-block">
                                    <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="text-primary ti ti-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end m-0">
                                        <li><a href="{{ route('payrolls.edit', $salary->id) }}" class="dropdown-item"><i
                                                    class="fa-solid fa-circle-info"></i> تعديل</a></li>

                                        <div class="dropdown-divider"></div>
                                        <li><a href="#" onclick="fn_delete_center({{ $salary->id }})"
                                                class="dropdown-item text-danger delete-record"><i
                                                    class="fa-solid fa-trash-can"></i> حذف</a></li>
                                    </ul>
                                </div>
                                <a href="{{ route('payrolls.show', $salary->id) }}" class="btn btn-sm btn-icon item-edit">
                                    <i class="text-primary ti ti-pencil"></i>
                                </a> --}}


                            </td>

                        </tr>
                </tbody>
                @endforeach
                <tfoot>
                    <th>#</th>
                    <th> الشهر</th>
                    <th> الموظف </th>
                    <th> الاساسي </th>
                    <th> الحوافز </th>
                    <th> الخصومات </th>
                    <th> صافي الراتب </th>
                    <th> الحالة </th>
                    <th>اجراءات</th>
                </tfoot>
            </table>
        </div>
    </div>

    <script>
        function fn_delete_center(id) {
            Swal.fire({
                title: "هل انت متأكد من انك تريد الحذف ?",
                text: "لا يمكنك استرجاعها مرة أخرى!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "إلغاء",
                confirmButtonText: "نعم,  احذف!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "./payrolls/destroy/" + id
                }
            });
        }
    </script>
    {!! $data->links('pagination::bootstrap-5') !!}



    <p class="text-employee text-primary"><small>أوقاف إبراهيم صدقي محمد سعيد أفندي</small></p>
@endsection
