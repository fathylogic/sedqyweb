@extends('layouts.app')

@section('content')
    <?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>

    @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
    @endsession

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"> الملاحظات</h4>
        <hr class="my-1" />

        <div class="app-email card">
            <div class="row g-0">

                <!-- Emails List -->
                <div class="col app-emails-list">
                    <div class="shadow-none border-0">
                        <div class="emails-list-header p-3 py-lg-3 py-2">
                            <!-- Notes List: Search -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-compost-wrapper d-grid w-25 px-3">

                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#pricingModal">
                                        <i class="fa-solid fa-notes-medical px-2"></i>
                                        ملاحظة جديدة
                                    </button>
                                </div>
                                <div class="d-flex align-items-center w-100">
                                    <i class="ti ti-menu-2 ti-sm cursor-pointer d-block d-lg-none me-3"
                                        data-bs-toggle="sidebar" data-target="#app-email-sidebar" data-overlay></i>
                                    <div class="mb-0 mb-lg-2 w-100">
                                        <div class="input-group input-group-merge shadow-none">
                                            <span class="input-group-text border-0 ps-0" id="email-search">
                                                <i class="ti ti-search"></i>
                                            </span>
                                            <input type="text" class="form-control email-search-input border-0"
                                                placeholder="ابحث  في الملاحظات" aria-label="Search notes"
                                                aria-describedby="NOTES-search" />
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-0 mb-md-2">
                                    <i
                                        class="ti ti-rotate-clockwise rotate-180 scaleX-n1-rtl cursor-pointer email-refresh me-2 mt-1"></i>
                                </div>
                            </div>
                            <hr class="mx-n3 emails-list-header-hr" />
                            <!-- Email List: Actions -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                </div>
                                <div
                                    class="email-pagination d-sm-flex d-none align-items-center flex-wrap justify-content-between justify-sm-content-end">
                                    <span class="d-sm-block d-none mx-3 text-muted">1-10 من 653</span>
                                    <i
                                        class="email-prev ti ti-chevron-left scaleX-n1-rtl cursor-pointer text-muted me-2"></i>
                                    <i class="email-next ti ti-chevron-right scaleX-n1-rtl cursor-pointer"></i>
                                </div>
                            </div>
                        </div>
                        <hr class="container-m-nx m-0" />
                        <!-- Email List: Items -->
                        <div class="email-list pt-0">
                            <ul class="list-unstyled m-0">

                                @if (!empty($data))
                                    @foreach ($data as $row)
                                        <li class="email-list-item" data-draft="true" data-bs-toggle="sidebar"
                                            data-target="#app-email-view{{ $row->id }}">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar1 avatar-sm d-block flex-shrink-0 me-sm-3 me-2">
                                                    <span class="avatar-initial rounded-circle bg-label-success">
                                                        <img src="{{ $root }}/assets/svg/icons/notes-notepad.svg"
                                                            alt="user-avatar"
                                                            class="d-block flex-shrink-0 rounded-circle1 p-1"
                                                            width="32" />
                                                    </span>
                                                </div>
                                                <div class="email-list-item-content ms-2 ms-sm-0 me-2">
                                                    <span class="h6 email-list-item-username me-2"> {{ $row->title }}
                                                    </span>

                                                </div>
                                                <div class="email-list-item-meta ms-auto d-flex align-items-center">
                                                    <span
                                                        class="email-list-item-attachment ti ti-paperclip ti-xs cursor-pointer me-2 float-end float-sm-none"></span>
                                                    <span
                                                        class="email-list-item-label badge badge-dot bg-primary d-none d-md-inline-block me-2"
                                                        data-label="company"></span>
                                                    <small class="email-list-item-time text-muted">12:44 AM</small>
                                                    <ul class="list-inline email-list-item-actions text-nowrap">

                                                        <li class="list-inline-item email-delete"><a
                                                                href="javascript:confirm('هل تريد الحذف ؟');"><i
                                                                    class="ti ti-trash"></i></a>
                                                        </li>
                                                        <li class="list-inline-item"><a
                                                                href="javascript:confirm('هل تريد ارشيف ؟');"><i
                                                                    class="ti ti-archive"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif



                            </ul>
                        </div>
                    </div>
                    <div class="app-overlay"></div>
                </div>
                <!-- /Emails List -->

                <!-- Email View -->
                @if (!empty($data))
                    @foreach ($data as $row)
                        <div class="col app-email-view flex-grow-0 bg-body" id="app-email-view{{ $row->id }}">
                            <div class="card shadow-none border-0 rounded-0 app-email-view-header p-3 py-md-3 py-2">
                                <!-- Email View : Title  bar-->
                                <div class="d-flex justify-content-between align-items-center py-2">
                                    <div class="d-flex align-items-center overflow-hidden">
                                        <i class="ti ti-chevron-left ti-sm cursor-pointer me-2" data-bs-toggle="sidebar"
                                            data-target="#app-email-view"></i>
                                        <h6 class="text-truncate mb-0 me-2">{{ $row->title }} </h6>

                                    </div>
                                    <!-- Email View : Action  bar-->
                                    <div class="d-flex align-items-center">

                                        <button type="button" class="btn btn-label-secondary waves-effect" id="btNoteView">
                                            <i class='ti ti-printer mt-1 cursor-pointer d-sm-block d-none'></i>
                                        </button>

                                        <div class="dropdown ms-3">
                                            <button class="btn p-0" type="button" id="dropdownMoreOptions"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="dropdownMoreOptions">
                                                <a class="dropdown-item" href="javascript:void(0)">
                                                    <i class="fa-solid fa-file-pen"></i>
                                                    <span class="align-middle">تعديل</span>
                                                </a>
                                                <a class="dropdown-item text-danger" href="javascript:void(0)">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                    <span class="align-middle">حذف </span>
                                                </a>

                                                <a class="dropdown-item d-sm-none d-block" href="javascript:void(0)">
                                                    <i class="ti ti-printer ti-xs me-1"></i>
                                                    <span class="align-middle">Print</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <hr class="m-0" />
                            <!-- Email View : Content-->
                            <div class="app-email-view-content py-4">

                                <!-- Email View : Last mail-->
                                <div id="NoteView" class="card email-card-last mx-sm-4 mx-3 mt-4">
                                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap"
                                        style="direction: rtl !important;">
                                        <div class="d-flex align-items-center mb-sm-0 mb-3">
                                            <span class="avatar-initial rounded-circle bg-label-success">
                                                <img src="{{ $root }}/assets/svg/icons/notes-notepad.svg"
                                                    alt="user-avatar" class="d-block flex-shrink-0 rounded-circle1 p-1"
                                                    width="32" />
                                            </span>
                                            <div class="flex-grow-1 ms-1">
                                                <h6 class="m-0">{{ $row->title }} </h6>
                                                <small class="text-muted">محمد داوود</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0 me-3 text-muted"> {{ $row->created_at }}</p>
                                            <i class="ti ti-paperclip cursor-pointer me-2"></i>
                                        </div>
                                    </div>
                                    <div class="card-body" style="direction: rtl !important;">


                                        {!! $row->message !!}
                                        <hr />
                                        

                                        @if (!empty($row['files']))
                                        <p class="email-attachment-title mb-2">المرفقات</p>
                                            @foreach ($row['files'] as $f)
                                                
                                            
                                            <div class="cursor-pointer">
                                                    <i class="ti ti-file"></i>
                                                    <span class="align-middle ms-1">
                                                        <a href="<?= asset('storage/' . $f->url) ?>" target="_blank">
                                                       عرض الملف </a></span>
                                                </div>
                                            @endforeach
                                        @endif


                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif
                <!-- Email View -->
            </div>



            <!--  Modal -->
            <div class="modal fade" id="pricingModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-simple modal-pricing">
                    <div class="modal-content p-2 p-md-1">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <div class="modal-body flex-grow-1 pb-sm-0 p-4 py-2">
                                <form id="myForm" name="myForm" class="email-compose-form" method="POST"
                                    action="" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="message" id="message">
                                    <h5 class="modal-title fs-5">
                                        <i class="fa-solid fa-file-pen px-2"></i>ملاحظة جديدة
                                    </h5>

                                    <hr class="container-m-nx my-2" />
                                    <div class="email-compose-subject d-flex align-items-center mb-2">
                                        <label for="email-subject" class="form-label mb-0">العنوان:</label>
                                        <input type="text" required
                                            class="form-control border-0 shadow-none flex-grow-1 mx-2" id="email-subject"
                                            name="title" placeholder="عنوان الملاحظة" />
                                    </div>

                                    <hr class="container-m-nx my-2" />
                                    <!-- Full Editor -->
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div id="full-editor" name="full-editor">
                                                    <h6>محرر النصوص</h6>

                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="formFileMultiple" class="form-label"> <i
                                                        class="fa-solid fa-paperclip"></i>
                                                    رفع اكثر من ملف</label>
                                                <input class="form-control" name="file[]" type="file"
                                                    id="formFileMultiple" multiple />
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="is_to_admin"> مشاركة مع المديرين </label>

                                                <div class="form-check form-switch mb-2">
                                                    <label class="switch">
                                                        <input name="is_to_admin" value="1" type="checkbox"
                                                            id="is_to_admin" class="switch-input">
                                                        <span class="switch-toggle-slider">
                                                            <span class="switch-on">
                                                                <i class="ti ti-check"></i>
                                                            </span>
                                                            <span class="switch-off">
                                                                <i class="ti ti-x"></i>
                                                            </span>
                                                        </span>
                                                        <span class="switch-label"> مشاركة </span>
                                                    </label>
                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                    <!-- /Full Editor -->
                                    <hr class="container-m-nx mt-0 mb-2" />
                                    <div
                                        class="email-compose-actions d-flex justify-content-between align-items-center mt-3 mb-3">
                                        <div class="d-flex align-items-center">
                                            {{-- <button type="submit"  name="btn_save" class="btn btn-primary me-sm-2 me-1 waves-effect waves-light">
                                <i class="fa-solid fa-floppy-disk px-2"></i> حفظ </button> --}}

                                            <a href="#" onclick="showContent()"
                                                class="btn btn-primary me-sm-2 me-1 waves-effect waves-light">
                                                حفظ </a>


                                        </div>
                                        <div class="d-flex align-items-center">

                                            <button type="reset" class="btn" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/  Modal -->
        </div>



    </div>

    <script>
        // (function() {
        //     // Snow Theme
        //     // --------------------------------------------------------------------
        //     const snowEditor = new Quill('#snow-editor', {
        //         bounds: '#snow-editor',
        //         modules: {
        //             formula: true,
        //             toolbar: '#snow-toolbar'
        //         },
        //         theme: 'snow'
        //     });

        //     // Bubble Theme
        //     // --------------------------------------------------------------------
        //     const bubbleEditor = new Quill('#bubble-editor', {
        //         modules: {
        //             toolbar: '#bubble-toolbar'
        //         },
        //         theme: 'bubble'
        //     });

        //     // Full Toolbar
        //     // --------------------------------------------------------------------
        //     const fullToolbar = [
        //         [{
        //                 font: []
        //             },
        //             {
        //                 size: []
        //             }
        //         ],
        //         ['bold', 'italic', 'underline', 'strike'],
        //         [{
        //                 color: []
        //             },
        //             {
        //                 background: []
        //             }
        //         ],
        //         [{
        //                 script: 'super'
        //             },
        //             {
        //                 script: 'sub'
        //             }
        //         ],
        //         [{
        //                 header: '1'
        //             },
        //             {
        //                 header: '2'
        //             },
        //             'blockquote',
        //             'code-block'
        //         ],
        //         [{
        //                 list: 'ordered'
        //             },
        //             {
        //                 list: 'bullet'
        //             },
        //             {
        //                 indent: '-1'
        //             },
        //             {
        //                 indent: '+1'
        //             }
        //         ],
        //         [{
        //             direction: 'rtl'
        //         }],
        //         ['link', 'image', 'video', 'formula'],
        //         ['clean']
        //     ];



        // })();


        //const quill = new Quill('#editor', { theme: 'snow' }); // Assuming '#editor' is your Quill container

        const fullEditor = new Quill('#full-editor', {
            bounds: '#full-editor',
            placeholder: 'Type Something...',
            modules: {
                formula: true,
                toolbar: fullToolbar
            },
            theme: 'snow'
        });


        // form.addEventListener('submit', function(event) {
        //     // Get the content from Quill (e.g., as HTML or Delta)
        //     const content = document.querySelector('.ql-editor').innerHTML;

        //     console.log(content);
        //     return false ; 


        //     // Set the value of the hidden input/textarea
        //    $('#message').val(content) ;
        // });

        function showContent() {
            const content = document.querySelector('.ql-editor').innerHTML;
            console.log(content);
            $('#message').val(content);
            const myForm = document.getElementById('myForm');
            myForm.submit();
        }


        function nWin() {
            var w = window.open();
            var html = $("#NoteView").html();

            $(w.document.body).html(html);
            w.print();
        }

        $(function() {
            $("button#btNoteView").click(nWin);
        });




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
    </script>
    {!! $data->links('pagination::bootstrap-5') !!}

    <p class="text-center text-primary"><small>أوقاف إبراهيم صدقي محمد سعيد أفندي</small></p>
@endsection
