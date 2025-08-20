@extends('layouts.app')

@section('content')
    <style>
        ul,
        #myUL {
            list-style-type: none;
        }

        #myUL {
            margin: 0;
            padding: 0;
        }

        .caret {
            cursor: pointer;
            -webkit-user-select: none;
            /* Safari 3.1+ */
            -moz-user-select: none;
            /* Firefox 2+ */
            -ms-user-select: none;
            /* IE 10+ */
            user-select: none;
        }

        .caret::before {
            content: "\25C6";
            color: green;
            display: inline-block;
            margin-right: 6px;
        }

        .caret-down::before {
            -ms-transform: rotate(90deg);
            /* IE 9 */
            -webkit-transform: rotate(90deg);
            /* Safari */
            '
     transform: rotate(90deg);
        }

        .nested {
            display: none;
        }

        .active {
            display: block;
        }
    </style>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>إدارة المراكز الرئيسية</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary me-sm-3 me-1" href="{{ route('maincenters.create') }}"><i
                        class="fa fa-plus"></i>&nbsp;
                    اضافة مركز رئيسي جديد</a>
            </div>
        </div>
    </div>

    @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
    @endsession

    <div class="card">






        <div class="row">
            <div class="col-md-4">
                <ul id="myUL">

                    @foreach ($data as $key => $main)
                        <li><span class="caret h5" onclick="fn_hidediv()">{{ $main->name }}</span>
                            <span class="badge bg-primary rounded-pill float-end "> {{ $main->centers->count() }} </span>
                            <a href="{{ route('maincenters.show', $main->id) }}"
                                class="btn btn-sm btn-icon item-edit waves-effect waves-light">
                                <i class="text-primary ti ti-pencil   float-end"></i>
                            </a>


                            <ul class="nested">
                                @if ($main->centers->count() > 0)
                                    @foreach ($main->centers as $center)
                                        <li>
                                            <i class="fa fa-circle"></i>&nbsp;
                                            <a href="{{ route('centers.show', $center->id) }}"> {{ $center->center_name }}
                                            </a>

                                        </li>
                                    @endforeach
                                @endif

                                <li><a href="#" onclick="fn_creat_new_center({{ $main }}) ; "><i
                                            class="fa fa-circle-plus"></i>&nbsp;<b> اضافة مركز فرعي </b></a>
                                </li>
                            </ul>


                        </li>
                        <br>
                    @endforeach

                </ul>
            </div>
            <div class="col-md-8" id="objInfo">
                <div id="creat_new_center" style="display: none">
                    <form method="POST" action="{{ route('maincenters.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="maincenter_id" name="maincenter_id" value="">
                        <div class="container-xxl">
                            <div class="authentication-wrapper authentication-basic container-p-y">
                                <div class="authentication-inner py-4">
                                    <!-- Login -->
                                    <div class="card border">
                                        <div class="card-header">
                                            <h5 id="mctitle"></h5>
                                        </div>
                                        <div class="card-body">

                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label" for="center_name">اسم المركز الفرعي <i
                                                            class="fa fa-asterisk " style="color: red"
                                                            aria-hidden="true"></i></label>
                                                    <input type="text" name="center_name" class="form-control"
                                                        required />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="center_location">المنطقة <i
                                                            class="fa fa-asterisk " style="color: red"
                                                            aria-hidden="true"></i></label>
                                                    <select id="center_location" name="center_location" required
                                                        class="select2 form-select" data-allow-clear="true">
                                                        <option value="">اختر</option>
                                                        @foreach ($locations as $row)
                                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="hainame">الحي </label>
                                                    <input type="text" name="hainame" class="form-control" />

                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="street">الشارع </label>
                                                    <input type="text" name="street" class="form-control" />

                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="Building_no">رقم العمارة </label>
                                                    <input type="text" name="Building_no" class="form-control" />

                                                </div>



                                                <div class="col-md-6">
                                                    <label class="form-label" for="sak_no"> الموقع على الخريطة </label>
                                                    <input type="text" name="gps" class="form-control" />

                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label" for="sak_no">رقم الصك </label>
                                                    <input type="text" name="sak_no" class="form-control" />

                                                </div>


                                                <div class="col-md-6">
                                                    <label class="form-label" for="electric_no"> حساب شركة الكهرباء <i
                                                            class="fa fa-asterisk " style="color: red"
                                                            aria-hidden="true"></i></label>
                                                    <input type="text" id="electric_no" name="electric_no" required
                                                        class="form-control" />
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label" for="woter_no"> حساب شركة المياة <i
                                                            class="fa fa-asterisk " style="color: red"
                                                            aria-hidden="true"></i></label>
                                                    <input type="text" id="woter_no" name="woter_no" required
                                                        class="form-control" />
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label" for="left_electric_no"> حساب اخر للمصاعد
                                                    </label>
                                                    <input type="text" id="left_electric_no" name="left_electric_no"
                                                        class="form-control" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="file" class="form-label"> صورة</label>
                                                    <input type="file" name="file" id="file"
                                                        class="form-control">

                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label" for="notes"> ملاحظات </label>
                                                    <textarea id="notes" name="notes" class="form-control"></textarea>
                                                </div>

                                            </div>


                                            <div class="mb-3">


                                                <div class="col-md-6 text-center">
                                                    <button type="submit" name="btn_add_center"
                                                        class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">حفظ
                                                        <i class="fa-solid fa-floppy-disk"></i> </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="row">
         <!-- tree Menu -->
         <div class="col-md-4 col-12">
                  <div class="card mb-4">
                    <div class="card-body">
                     <!-- <div id="jstree-context-menu" class="overflow-auto"></div> -->
                      <div id="jstree-context-menu" class="overflow-auto jstree jstree-1 jstree-rtl jstree-default" role="tree" aria-multiselectable="true" tabindex="0" aria-activedescendant="j1_1" aria-busy="false"><ul class="jstree-container-ul jstree-children jstree-contextmenu" role="presentation"><li role="none" id="j1_1" class="jstree-node  jstree-closed"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor jstree-clicked" href="#" tabindex="-1" role="treeitem" aria-selected="true" aria-level="1" aria-expanded="false" id="j1_1_anchor"><i class="jstree-icon jstree-themeicon ti ti-folder jstree-themeicon-custom" role="presentation"></i>csssss</a></li><li role="none" id="j1_4" class="jstree-node  jstree-open"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" role="treeitem" aria-selected="false" aria-level="1" aria-expanded="true" id="j1_4_anchor"><i class="jstree-icon jstree-themeicon ti ti-folder jstree-themeicon-custom" role="presentation"></i>img</a><ul role="group" class="jstree-children"><li role="none" id="j1_5" class="jstree-node  jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" role="treeitem" aria-selected="false" aria-level="2" id="j1_5_anchor"><i class="jstree-icon jstree-themeicon ti ti-photo text-success jstree-themeicon-custom" role="presentation"></i>bg.jpg</a></li><li role="none" id="j1_6" class="jstree-node  jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" role="treeitem" aria-selected="false" aria-level="2" id="j1_6_anchor"><i class="jstree-icon jstree-themeicon ti ti-photo text-success jstree-themeicon-custom" role="presentation"></i>logo.png</a></li><li role="none" id="j1_7" class="jstree-node  jstree-leaf jstree-last"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" role="treeitem" aria-selected="false" aria-level="2" id="j1_7_anchor"><i class="jstree-icon jstree-themeicon ti ti-photo text-success jstree-themeicon-custom" role="presentation"></i>avatar.png</a></li></ul></li><li role="none" id="j1_8" class="jstree-node  jstree-open"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" role="treeitem" aria-selected="false" aria-level="1" aria-expanded="true" id="j1_8_anchor"><i class="jstree-icon jstree-themeicon ti ti-folder jstree-themeicon-custom" role="presentation"></i>js</a><ul role="group" class="jstree-children"><li role="none" id="j1_9" class="jstree-node  jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" role="treeitem" aria-selected="false" aria-level="2" id="j1_9_anchor"><i class="jstree-icon jstree-themeicon ti ti-brand-javascript text-warning jstree-themeicon-custom" role="presentation"></i>jquery.js</a></li><li role="none" id="j1_10" class="jstree-node  jstree-leaf jstree-last"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" role="treeitem" aria-selected="false" aria-level="2" id="j1_10_anchor"><i class="jstree-icon jstree-themeicon ti ti-brand-javascript text-warning jstree-themeicon-custom" role="presentation"></i>app.js</a></li></ul></li><li role="none" id="j1_11" class="jstree-node  jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" role="treeitem" aria-selected="false" aria-level="1" id="j1_11_anchor"><i class="jstree-icon jstree-themeicon ti ti-brand-html5 text-danger jstree-themeicon-custom" role="presentation"></i>index.html</a></li><li role="none" id="j1_12" class="jstree-node  jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" role="treeitem" aria-selected="false" aria-level="1" id="j1_12_anchor"><i class="jstree-icon jstree-themeicon ti ti-brand-html5 text-danger jstree-themeicon-custom" role="presentation"></i>page-one.html</a></li><li role="none" id="j1_13" class="jstree-node  jstree-leaf jstree-last"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" role="treeitem" aria-selected="false" aria-level="1" id="j1_13_anchor"><i class="jstree-icon jstree-themeicon ti ti-brand-html5 text-danger jstree-themeicon-custom" role="presentation"></i>page-two.html</a></li></ul></div>
                    </div>
                  </div>
                </div>
                <!-- /tree Menu -->

        </div>

        <div class="col-md-8 col-12">
            form here
         </div>


    </div>




    <script>
        var toggler = document.getElementsByClassName("caret");
        var i;

        for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function() {
                this.parentElement.querySelector(".nested").classList.toggle("active");
                this.classList.toggle("caret-down");
            });
        }
    </script>
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
                    window.location.href = "./centers/destroy/" + id
                }
            });
        }


        function fn_creat_new_center(row) {
            console.log(row);

            // $('#objInfo').html('') ;
            $('#mctitle').html('المركز الرئيسي: ' + row['name']);
            $('#maincenter_id').val(row['id']);
            $('#creat_new_center').show();
        }

        function fn_hidediv() {


            // $('#objInfo').html('') ;
            $('#mctitle').html('');
            $('#maincenter_id').val('');
            $('#creat_new_center').hide();
        }
    </script>
    {!! $data->links('pagination::bootstrap-5') !!}

@endsection
