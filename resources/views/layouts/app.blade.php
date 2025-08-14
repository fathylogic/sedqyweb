<!DOCTYPE html>
<?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>
<html lang="ar" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ $root }}/assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>أوقاف ابراهيم صدقي</title>

    <meta name="description" content="" />

    <!-- Favicon -->

    <link rel="icon" type="image/x-icon" href="{{ $root }}/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/css/rtl/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/css/rtl/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ $root }}/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet"
        href="{{ $root }}/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet"
        href="{{ $root }}/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
    <link rel="stylesheet"
        href="{{ $root }}/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/flatpickr/flatpickr.css" />

    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/quill/typography.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/quill/katex.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/quill/editor.css" />

    <!-- Row Group CSS -->
    <link rel="stylesheet"
        href="{{ $root }}/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css" />
    <!-- Form Validation -->
    <link rel="stylesheet"
        href="{{ $root }}/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/css/pages/page-help-center.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/css/pages/app-email.css" />

    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/Datepicker/w3.css" />


    <!-- Helpers -->
    <script src="{{ $root }}/assets/vendor/js/helpers.js"></script>

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ $root }}/assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ $root }}/assets/js/config.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('layouts.menu')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('layouts.nav')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">

                        @yield('content')

                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div
                                class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                                <div>
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    صدقي
                                </div>
                                <div>

                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- DataTable JS -->
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/jquery-3.7.1.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/dataTables.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/dataTables.bootstrap5.js">
    </script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/dataTables.buttons.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/buttons.bootstrap5.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/jszip.min.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/pdfmake.min.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/vfs_fonts.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/buttons.html5.min.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/buttons.print.min.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/buttons.colVis.min.js"></script>




    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ $root }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ $root }}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/node-waves/node-waves.js"></script>

    <script src="{{ $root }}/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="{{ $root }}/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ $root }}/assets/vendor/libs/cleavejs/cleave.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/cleavejs/cleave-phone.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/moment/moment.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/select2/select2.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/quill/katex.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/quill/quill.js"></script>

    <!-- Flat Picker -->
    <script src="{{ $root }}/assets/vendor/libs/moment/moment.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/flatpickr/flatpickr.js"></script>

    <!-- Form Validation -->
    <script src="{{ $root }}/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>

    <!-- Main JS -->
    <script src="{{ $root }}/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ $root }}/assets/js/form-layouts.js"></script>
    <script src="{{ $root }}/assets/js/app-email.js"></script>  
      <script src="{{ $root }}/assets/js/forms-editors.js"></script>  

    <!-- Time JS -->
    <script src="{{ $root }}/js/time.js"></script>




    <script type="text/javascript" src="{{ $root }}/assets/js/hijri-date_.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/js/datepicker_.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/js/my_script.js"></script>

    <script>
        window.addEventListener('load', function() {
            const protocol = window.location.protocol;

            $.fn.dataTable.ext.buttons.reload = {
                text: 'Reload',
                action: function(e, dt, node, config) {
                    dt.ajax.reload();
                }
            };


         
            new DataTable('.FathyTable', {
                language: {                 
                  url: 'http://localhost:8000/assets/vendor/libs/DataTable/ar.json'
                },
                layout: {
                    topStart: {
                        buttons: [{
                                extend: 'copy',
                                text: '<i class="fa-solid fa-copy"></i> نسخ'
                            },
                            {
                                extend: 'excel',
                                text: '<i class="fa-solid fa-file-excel"></i> أكسيل'
                            },
                            {
                                extend: 'print',
                                text: '<i class="fa-solid fa-print"></i> طباعة'
                            },
                            {
                                extend: 'pdf',
                                text: ' <i class="fa-solid fa-file-pdf"></i> pdf '
                            }, {
                                extend: 'colvis',
                                text: '<i class="fa-solid fa-list-check"></i> إظهار الأعمدة '
                            }
                        ]

                    }
                },
                columnDefs: [{
                    targets: -1, // آخر عمود (الإجراءات)
                    orderable: false, // تعطيل الترتيب عليه
                    searchable: false, // تعطيل البحث فيه

                }]
            });


        });
    </script>
</body>

</html>
