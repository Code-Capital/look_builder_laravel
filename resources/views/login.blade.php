<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from coderthemes.com/hyper/saas/tables-datatable.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Oct 2023 07:43:42 GMT -->

<head>
    <meta charset="utf-8" />
    <title>DTAIL | Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ asset('assets/js/hyper-config.js') }}"></script>
    <link href="{{ asset('assets/css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body class="authentication-bg pb-0">
    <div class="auth-fluid">
        <div class="auth-fluid-form-box">
            <div class="card-body d-flex flex-column h-100 gap-3">
                <a href="index" class="logo logo-light px-0">
                    <span class="logo-lg  ">
                        <div class="d-flex align-items-center gap-2">
                            <img class="logoImage" src="assets/images/logo.png" alt="small logo">
                            <span class="text-dark h2">DTAIL</span>
                        </div>
                    </span>
                    <span class="logo-sm">
                        <div class="d-flex align-items-center gap-2">
                            <img class="logoImage" src="assets/images/logo.png" alt="small logo">
                            <span class="text-dark h2">DTAIL</span>
                        </div>
                    </span>
                </a>
                <div class="my-auto">
                    <h4 class="mt-0">Sign In</h4>
                    <p class="text-muted mb-4">Enter your email address and password to access account.</p>

                    <form method="POST" id="loginForm">
                        @csrf
                        <div class="mb-3">
                            <label for="emailaddress" class="form-label">Email address</label>
                            <input class="form-control" name="email" type="email" id="emailaddress" required=""
                                placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <a href="recoverpw" class="text-muted float-end"><small>Forgot your password?</small></a>
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="password" name="password" required="" id="password"
                                placeholder="Enter your password">
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                <label class="form-check-label" for="checkbox-signin">Remember me</label>
                            </div>
                        </div>
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-login"></i> Log In
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted font-16">Sign in with</p>
                        <ul class="social-list list-inline mt-3">
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i
                                        class="mdi mdi-facebook"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i
                                        class="mdi mdi-google"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-info text-info"><i
                                        class="mdi mdi-twitter"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);"
                                    class="social-list-item border-secondary text-secondary"><i
                                        class="mdi mdi-github"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <footer class="footer footer-alt">
                    <p class="text-muted">Don't have an account? <a href="register" class="text-muted ms-1"><b>Sign
                                Up</b></a></p>
                </footer>

            </div>
        </div>

        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">DTAIL</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i> It's a Website to Complete your Look
                    Builder<i class="mdi mdi-format-quote-close"></i></p>
                <p> - Owner Name </p>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/register.js') }}"></script>
    @if (Session::has('message'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
                "timeOut": 3000
            };

            var status = {{ json_encode(Session::get('status')) }};

            if (status == 'true') {
                toastr.success("{{ Session::get('message') }}");
            } else {
                toastr.error("{{ Session::get('message') }}");
            }
        </script>
    @endif
</body>

</html>
