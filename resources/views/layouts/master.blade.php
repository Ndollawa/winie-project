<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pharmacy Manager</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">



    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    @include('components/nav-bar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="../../index3.html" class="brand-link">
            <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        </a>

        <!-- Sidebar -->
        @include('components/sidebar')



    {{--    @include('shared/sidebar')--}}
    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @yield('content')
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            Copyright &copy; 2021 . <b>Version</b> 1.0
        </div>
        <strong><a href="#">Powered By Easy Access</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

{{--datatables--}}
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

{{--Select--}}
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>



<!-- Toastr -->
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

<!-- SweetAlert2 -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/sweetalert.min.js') }}"></script>



<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/dist/js/demo.js') }}"></script>

@if($script == 'Y')
    @include('js.'.$jsFilename)
@endif

<script>
    // For validation errors
    @if ($errors->any())

    $(function() {
        swal({
            title: "Notification!!",
            text: "@foreach ($errors->all() as $error){{ $error }} @endforeach",
            icon: "error",
            button: "close",
        });

    });
    @endif

</script>

<script>

    // For general erros and success
    @if(session()->has('error'))
    swal({
        title: "Notification!!",
        text: "{{ session()->get('error') }}",
        icon: "error",
        button: "close",
    });

    @endif

    @if(session()->has('success'))


    swal({
        title: "Notification!",
        text: "{{ session()->get('success') }}",
        icon: "success",
        button: "close",
    });

    @endif
</script>

<script>
    // For Delete buttons
    //     swal({
    //         title: "Are you sure?",
    //         text: "Once deleted, you will not be able to recover this!",
    //         icon: "warning",
    //         buttons: true,
    //         dangerMode: true,
    //     })
    //         .then((willDelete) => {
    //             if (willDelete) {
    //                 document.getElementById("form1").submit();
    //                 swal("Record has been deleted!", {
    //                     icon: "success",
    //                 });
    //             } else {
    //                 swal("Record not deleted!");
    //             }
    //         });


</script>
<script>
    $(document).ready(function() {
        // Set up the CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Initialize Select2 on the symptoms select field
        $('#symptoms').select2({
            placeholder: "Select symptoms",
            allowClear: true
        });

        $('#symptomForm').submit(function(event) {
            event.preventDefault();
            var selectedSymptoms = $('#symptoms').val();

            // AJAX request to get top sicknesses
            $.ajax({
                type: 'POST',
                url: '/get-top-sicknesses', // Update with your route
                data: {
                    symptoms: selectedSymptoms
                },
                dataType: 'json',
                success: function(response) {
                    var resultsHtml = '';
                    response.forEach(function(item) {
                        resultsHtml += '<h1>' + item.sickness + '</h1><ul>';
                        item.prescriptions.forEach(function(prescription) {
                            resultsHtml += '<li>' + prescription.name + ' - Dosage: ' + prescription.dosage + '</li>';
                        });
                        resultsHtml += '</ul>';
                    });
                    $('#results').html(resultsHtml);
                },
                error: function(xhr) {
                    var errorMessage = xhr.responseJSON && xhr.responseJSON.error ? xhr.responseJSON.error : 'An error occurred.';
                    $('#results').html('<div class="alert alert-danger" role="alert">' + errorMessage + '</div>');
                }
            });
        });

        // Function to fetch symptoms from PHP and populate Select2
        function fetchSymptoms() {
            $.ajax({
                url: '/get-symptoms', // Update with your route
                dataType: 'json',
                success: function(response) {
                    var options = '';
                    response.forEach(function(symptom) {
                        options += '<option value="' + symptom + '">' + symptom + '</option>';
                    });
                    $('#symptoms').html(options);
                    $('#symptoms').trigger('change'); // Refresh Select2 options
                },
                error: function() {
                    console.error('Error fetching symptoms');
                }
            });
        }

        // Fetch symptoms when the page loads
        fetchSymptoms();
    });
</script>


<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,"ordering": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>
</html>

