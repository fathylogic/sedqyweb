@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>إدارة المستفيدين</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary me-sm-3 me-1" href="{{ route('recipients.create') }}"><i
                        class="fa fa-plus"></i>&nbsp;
                    اضافة مستفيد جديد</a>
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
                        <th> الاسم</th>
                        <th>نوع المستفيد </th>
                        <th> الجوال </th>
                        <th> العنوان </th>
                        <th> صورة المستند </th>
                        <th>اجراءات</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data as $key => $recipient)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $recipient->name }}</td>
                            <td>{{ $recipient->r_type }}</td>

                            <td>{{ $recipient->mobile_no }}</td>
                            <td>{{ $recipient->r_address }}</td>
                            <td>
                                <a href="#imgModal{{ $recipient->id }}" data-bs-toggle="modal"
                                    data-bs-target="#imgModal{{ $recipient->id }}">
                                    <i class="fa fa-eye " aria-hidden="true"></i>
                                </a>
                                <div class="modal fade" id="imgModal{{ $recipient->id }}" tabindex="-1"
                                    aria-labelledby="imgModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"> صورة الهوية</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="<?= asset('storage/' . $recipient->img) ?>" width="400px"
                                                    height="400px">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">اغلاق</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>

                            <td>

                                <div class="d-inline-block">
                                    <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="text-primary ti ti-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end m-0">
                                        <li><a href="{{ route('recipients.edit', $recipient->id) }}""
                                                class="dropdown-item"><i class="fa-solid fa-circle-info"></i> تعديل</a></li>

                                        <div class="dropdown-divider"></div>
                                        <li><a href="#" onclick="fn_delete_center({{ $recipient->id }})"
                                                class="dropdown-item text-danger delete-record"><i
                                                    class="fa-solid fa-trash-can"></i> حذف</a></li>
                                    </ul>
                                </div>
                                <a href="{{ route('recipients.show', $recipient->id) }}"
                                    class="btn btn-sm btn-icon item-edit">
                                    <i class="text-primary ti ti-pencil"></i>
                                </a>


                            </td>

                        </tr>
                        @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th>#</th>
                        <th> الاسم</th>
                        <th>نوع المستفيد </th>
                        <th> الجوال </th>
                        <th> العنوان </th>
                        <th> صورة المستند </th>
                        <th>اجراءات</th>
                    </tr>
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
                    window.location.href = "./recipients/destroy/" + id
                }
            });
        }
    </script>
    {!! $data->links('pagination::bootstrap-5') !!}



    <p class="text-recipient text-primary"><small>أوقاف إبراهيم صدقي محمد سعيد أفندي</small></p>
@endsection
