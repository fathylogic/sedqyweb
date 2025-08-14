@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>إدارة العهد</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary me-sm-3 me-1" href="{{ route('ohdas.create') }}"><i class="fa fa-plus"></i>&nbsp;
                    اضافة عهدة جديدة</a>
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

                        <th> الموظف المسؤول</th>
                        <th>الغرض من العهدة </th>
                        <th> الرصيد </th>

                        <th>اجراءات</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($ohdas as $key => $row)
                        <tr>

                            <td>{{ $row->employee->name }}</td>
                            <td>{{ $row->purpose }}</td>
                            <td>{{ $row->raseed }}</td>

                            <td>


                                <a href="{{ route('ohdas.show', $row->id) }}" class="btn btn-sm btn-icon item-edit">
                                    <i class="text-primary ti ti-pencil"></i>
                                </a>


                            </td>

                        </tr>
                </tbody>
                @endforeach
                <tfoot>

                    <th> الموظف المسؤول</th>
                    <th>الغرض من العهدة </th>
                    <th> الرصيد </th>

                    <th>اجراءات</th>
                </tfoot>
            </table>
        </div>
    </div>

    <script>
        // function fn_delete_center(id) {
        //     Swal.fire({
        //         title: "هل انت متأكد من انك تريد الحذف ?",
        //         text: "لا يمكنك استرجاعها مرة أخرى!",
        //         icon: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#3085d6",
        //         cancelButtonColor: "#d33",
        //         cancelButtonText: "إلغاء",
        //         confirmButtonText: "نعم,  احذف!"
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             window.location.href = "./employees/destroy/" + id
        //         }
        //     });
        // }
    </script>
    {!! $ohdas->links('pagination::bootstrap-5') !!}



    <p class="text-employee text-primary"><small>أوقاف إبراهيم صدقي محمد سعيد أفندي</small></p>
@endsection
