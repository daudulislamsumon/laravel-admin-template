<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Ecommerce | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}assets/images/favicon.ico">
    <link href="{{ asset('/') }}assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('/') }}assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('/') }}assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('/') }}assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/libs/%40chenfengyuan/datepicker/datepicker.min.css">

    <!-- Bootstrap Css -->
    <link href="{{ asset('/') }}assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('/') }}assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('/') }}assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{ asset('/') }}assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('/') }}assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Summernote css -->
    <link href="{{ asset('/') }}assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />

</head>

<body data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('includes.header')

        @include('includes.menu')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    @yield('body')

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('includes.footer')

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('/') }}assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/node-waves/waves.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/select2/js/select2.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/%40chenfengyuan/datepicker/datepicker.min.js"></script>

    <!-- form advanced init -->
    <script src="{{ asset('/') }}assets/js/pages/form-advanced.init.js"></script>

    <!-- apexcharts -->
    <script src="{{ asset('/') }}assets/libs/apexcharts/apexcharts.min.js"></script>

    <script src="{{ asset('/') }}assets/js/pages/dashboard.init.js"></script>

    <!-- App js -->
    <script src="{{ asset('/') }}assets/js/app.js"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('/') }}assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('/') }}assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/jszip/jszip.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('/') }}assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('/') }}assets/js/pages/datatables.init.js"></script>

    <!-- Summernote js -->
    <script src="{{ asset('/') }}assets/libs/summernote/summernote-bs4.min.js"></script>

    <!-- init js -->
    <script src="{{ asset('/') }}assets/js/pages/form-editor.init.js"></script>

    <!-- Custom Js -->
    <script>
        function getThisSubCategory(categoryId) {
            $(document).ready(function() {
                $.ajax({
                    method: 'GET',
                    url: "{{ url('/get-sub-category-info-by-category-id') }}",
                    data: {
                        categoryId: categoryId
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        var select = $('#subCategoryId').empty();
                        var option = '<option value="" disabled selected>---- Select Product Sub Category ----</option>';
                        $.each(response, function(key, value) {
                            option += '<option value="' + value.id + '">' + value.name + '</option>';
                        });
                        select.append(option);
                    }
                });
            });
        }

    </script>

</body>

</html>
