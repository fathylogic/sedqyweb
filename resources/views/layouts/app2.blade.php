<!DOCTYPE html>

<html lang="ar" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default"
  data-assets-path="../assets/" data-template="vertical-menu-template">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>أوقاف ابراهيم صدقي</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon/favicon.ico')}}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('vendor/fonts/fontawesome.css')}}" />
  <link rel="stylesheet" href="{{ asset('vendor/fonts/tabler-icons.css')}}" />
  <link rel="stylesheet" href="{{ asset('vendor/fonts/flag-icons.css')}}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('vendor/css/rtl/core.css')}}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('vendor/css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset('css/demo.css')}}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
  <link rel="stylesheet" href="{{ asset('vendor/libs/node-waves/node-waves.css')}}" />
  <link rel="stylesheet" href="{{ asset('vendor/libs/typeahead-js/typeahead.css')}}" />
  <link rel="stylesheet" href="{{ asset('vendor/libs/flatpickr/flatpickr.css')}}" />
  <link rel="stylesheet" href="{{ asset('vendor/libs/select2/select2.css')}}" />
  <link rel="stylesheet" href="{{ asset('vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
  <link rel="stylesheet" href="{{ asset('vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
  <link rel="stylesheet" href="{{ asset('vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
  <link rel="stylesheet" href="{{ asset('vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}" />
  <link rel="stylesheet" href="{{ asset('vendor/libs/flatpickr/flatpickr.css')}}" />

  <!-- Row Group CSS -->
  <link rel="stylesheet" href="{{ asset('vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css')}}" />
  <!-- Form Validation -->
  <link rel="stylesheet" href="{{ asset('vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />

  <!-- Page CSS -->
  <link rel="stylesheet" href="{{ asset('vendor/css/pages/page-help-center.css')}}" />

  <!-- Datepicker CSS -->
  <link rel="stylesheet" href="{{ asset('vendor/libs/Datepicker/Datepicker.css')}}" />

  <!-- Helpers -->
  <script src="{{ asset('vendor/js/helpers.js')}}"></script>

  <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
  <script src="{{ asset('vendor/js/template-customizer.js')}}"></script>
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{ asset('js/config.js')}}"></script>
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


  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="{{ asset('vendor/libs/jquery/jquery.js')}}"></script>
  <script src="{{ asset('vendor/libs/popper/popper.js')}}"></script>
  <script src="{{ asset('vendor/js/bootstrap.js')}}"></script>
  <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
  <script src="{{ asset('vendor/libs/node-waves/node-waves.js')}}"></script>

  <script src="{{ asset('vendor/libs/hammer/hammer.js')}}"></script>
  <script src="{{ asset('vendor/libs/i18n/i18n.js')}}"></script>
  <script src="{{ asset('vendor/libs/typeahead-js/typeahead.js')}}"></script>

  <script src="{{ asset('vendor/js/menu.js')}}"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="{{ asset('vendor/libs/cleavejs/cleave.js')}}"></script>
  <script src="{{ asset('vendor/libs/cleavejs/cleave-phone.js')}}"></script>
  <script src="{{ asset('vendor/libs/moment/moment.js')}}"></script>
  <script src="{{ asset('vendor/libs/flatpickr/flatpickr.js')}}"></script>
  <script src="{{ asset('vendor/libs/select2/select2.js')}}"></script>
  <script src="{{ asset('vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>

  <!-- Flat Picker -->
  <script src="{{ asset('vendor/libs/moment/moment.js')}}"></script>
  <script src="{{ asset('vendor/libs/flatpickr/flatpickr.js')}}"></script>

  <!-- Form Validation -->
  <script src="{{ asset('vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
  <script src="{{ asset('vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
  <script src="{{ asset('vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>

  <!-- Main JS -->
  <script src="{{ asset('js/main.js')}}"></script>

  <!-- Page JS -->
  <script src="{{ asset('js/form-layouts.js')}}"></script>
  <script src="{{ asset('js/tables-datatables-basic.js')}}"></script>

  <!-- Time JS -->
  <script src="{{ public_path('js/time.js')}}"></script>

  <script>
    var table = new DataTable('.table', {
      language: {
        url: '//cdn.datatables.net/plug-ins/2.3.2/i18n/ar.json',
      },
    });
  </script>

  <script type="text/javascript" src="{{ asset('js/hijri-date.js')}}"></script>
  <script type="text/javascript" src="{{ asset('js/datepicker.js')}}"></script>

</body>

</html>