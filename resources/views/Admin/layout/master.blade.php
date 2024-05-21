<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{-- Ajax Csrf --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>General Dashboard &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/select2/dist/css/select2.min.css') }}">


    {{-- Text area summerNote css --}}
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/summernote/summernote-bs4.css') }}">
    {{-- Bootstrap icon piker --}}
    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-iconpicker.min.css') }}">

    {{-- Front Awesom --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Toster Css --}}

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{-- Jquery DataTable --}}
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            {{-- Navbar --}}
            @include('Admin.layout.navbar')

            {{-- sidebar --}}
            @include('Admin.layout.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                @yield('section')
            </div>

            {{-- Footer --}}
            @include('Admin.layout.footer')
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('backend/assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/popper.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('backend/assets/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/chart.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    {{-- Summer Note Js --}}
    <script src="{{ asset('backend/assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    {{-- Bootstrap icon picker --}}
    <script type="text/javascript" src="{{ asset('backend/assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>

    {{-- Toster Script --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- From ar datr ar jonno --}}
    <script src=" {{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>


    <!-- Page Specific JS File -->
    <script src="{{ asset('backend/assets/js/page/index-0.js') }}"></script>
    {{-- Jquery dataTable --}}
    <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script src=" {{ asset('backend/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('backend/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('backend/assets/js/custom.js') }}"></script>
    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    {{-- Toster Error --}}

    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>
    {{-- Sweet Alart delete Ajax --}}
    <script>
        $(document).ready(function() {

            $(document).ready(function() {
                $('.select2').select2();
            });


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('body').on('click', '.delet-item', function(event) {
                // alert(event);
                event.preventDefault();

                let deleteUrl = $(this).attr('href');
                // alert(deleteUrl);

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Ajax delete
                        $.ajax({
                            type: 'DELETE',
                            url: deleteUrl,

                            success: function(data) {
                                if (data.status == 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        data.message,
                                        'success'
                                    )
                                    window.location.reload();
                                } else if (data.status == 'error') {
                                    Swal.fire(
                                        "Can't Delete",
                                        data.message,
                                        'error'
                                    )
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        });

                    }
                });

            });
        })
    </script>

    @stack('scripts')
</body>

</html>
