@extends('layouts.app')

@section('content')
    





    <div class="row">
        <div class="col">
            <div class="card  mb-3">
                <div class="card-header bg-light">
                    <strong>{{ $recipient->name }} </strong>

                </div>
                <div class="card-body">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="table">
                            <thead>

                                <tr>

                                    <th>نوع المستفيد </th>
                                    <th> الجوال </th>
                                    <th> العنوان </th>
                                    <th> صورة المستند </th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $recipient->r_type }}</td>
                                    <td>{{ $recipient->mobile_no }}</td>
                                    <td>{{ $recipient->r_address }}</td>

                                    <td><a href="#imgModal{{ $recipient->id }}" data-bs-toggle="modal"
                                            data-bs-target="#imgModal{{ $recipient->id }}">
                                            <i class="fa fa-eye " aria-hidden="true"></i>
                                        </a>
                                        <div class="modal fade" id="imgModal{{ $recipient->id }}" tabindex="-1"
                                            aria-labelledby="imgModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"> صورة المستند</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img class="d-block" src="<?= asset('storage/' . $recipient->img) ?>" width="100%"
                                                           >
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">اغلاق</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>



                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="card mb-3">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-units"
                                        role="tab" aria-selected="true">
                                        كشف المصروفات
                                    </button>
                                </li>


                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="form-tabs-units" role="tabpanel">


                        @if (!empty($sarfs))
            <div class="card-datatable table-responsive pt-0">
                <table class="table table-striped FathyTable">
                    <thead>
                        <tr>

                            <th> من </th>
                            <th>وجه الصرف </th>
                            <th> المستلم </th>
                            <th> المبلغ </th>
                            <th> الغرض </th>
                            <th> التاريخ </th>
                            <th>اجراءات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($sarfs as $key => $row)
                            <tr>

                                <td>{{ $row->sourceType->name }}
                                    @if ($row->from_ohda_id != '')
                                        ({{ $row->fromOhda->employee->name }})
                                    @endif

                                </td>
                                <td>{{ $row->sarfType->name }}


                                    @if ($row->to_ohda_id != '')
                                        ({{ $row->toOhda->employee->name }})
                                    @elseif ($row->pay_role_id != '')
                                        ({{ $row->payrool->employee->name }})
                                    @elseif ($row->recipient_id != '')
                                        ({{ $row->recipient->name }})
                                    @elseif ($row->service_type_id != '')
                                        ({{ $row->serviceType->name }})
                                    @endif


                                </td>
                                <td>{{ $row->receved_by }}</td>
                                <td>{{ $row->amount }}
                                    - ({{ $row->paymentType->name }})

                                </td>
                                <td>

                                    {{ $row->s_desc }}
                                </td>
                                <td>

                                    {{ $row->p_date }} - {{ $row->p_dateh }}

                                </td>

                                <td>

                                    <a href="{{ route('sarfs.show',$row->id) }}"
                                        class="btn btn-sm btn-icon item-edit" alt=" عرض التفاصيل" alt=" عرض التفاصيل">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th> من </th>
                            <th>وجه الصرف </th>
                            <th> المستلم </th>
                            <th> المبلغ </th>
                            <th> الغرض </th>
                            <th> التاريخ </th>
                            <th>اجراءات</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @else
            لا يوجد
        @endif

                            </div>


                        </div>
                    </div>


                </div>
            </div>
        @endsection
