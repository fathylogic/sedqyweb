@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('ohdas.index') }}"> <i class="fa fa-arrow-left"></i>&nbsp;
                    عودة &nbsp;</a>
            </div>
        </div>
    </div>





    <div class="row">
        <div class="col">
            <div class="card  mb-3">

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12 float-start">
                            <div class="row">
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">

                                        الموظف المسئول
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $ohda->employee->name }} </div>
                                </div>
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        الرصيد
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $ohda->raseed }}
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        الغرض من العهدة
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $ohda->purpose }} </div>
                                </div>
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        تاريخ انشائها
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ @$ohda->created_at }}
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="card mb-3">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#form-tabs-units" role="tab" aria-selected="true">
                                            العمليات
                                        </button>
                                    </li>


                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="form-tabs-units" role="tabpanel">

                                    @if (!empty($ohda->operatios))
                                        <div class="card-datatable table-responsive pt-0">
                                            <table class="table table-striped FathyTable">
                                                <thead>
                                                    <tr>

                                                        <th> نوع العملية </th>
                                                        <th> المبلغ </th>

                                                        <th> التاريخ </th>
                                                        <th>اجراءات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($ohda->operatios as $op)
                                                        <tr>

                                                            <td>{{ $op->opType() }}


                                                            </td>
                                                            <td>{{ $op->amount }}
                                                            </td>
                                                            <td>{{ $op->created_at }}</td>


                                                            <td>

                                                                <a href="{{ route('sarfs.show', $op->sarf_id) }}"
                                                                    class="btn btn-sm btn-icon item-edit"
                                                                    alt=" عرض التفاصيل" alt=" عرض التفاصيل">
                                                                    <i class="fa-solid fa-circle-info"></i>
                                                                </a>

                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <th> نوع العملية </th>
                                                        <th> المبلغ </th>

                                                        <th> التاريخ </th>
                                                        <th>اجراءات</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    @else
                                        لا يوجد عمليات
                                    @endif

                                </div>


                            </div>
                        </div>

                    </div>


                </div>
            </div>


        </div>
    </div>
@endsection
