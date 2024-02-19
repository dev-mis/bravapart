<!DOCTYPE html>
<html lang="en">
    <head>
        {{-- Required meta tags --}}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MODENA Agent</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

        <link rel="icon" type="image/png" href="{{ asset('backend/media/favicon.png') }}">

        <link href="{{ asset('backend/css/pages/login/classic/login-6.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('backend/plugins/global/plugins.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('backend/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('backend/css/style.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
    </head>
    <body id="kt_body" class="quick-panel-right demo-panel-right offcanvas-right header-fixed header-mobile-fixed subheader-enabled aside-enabled aside-static page-loading">
        <div class="d-flex flex-column flex-root">
            <div class="login login-6 login-signin-on login-signin-on d-flex flex-row-fluid" id="kt_login">
                <div class="d-flex flex-column flex-lg-row flex-row-fluid text-center" style="background-image: url({{ asset('backend/media/bg/bg-3.jpg') }});">
                    <div class="d-flex w-100 flex-center p-15">
                        <div class="login-wrapper">
                            <div class="text-dark-75">
                                <a href="#">
                                    <img src="{{ asset('backend/media/logos/Logo.png') }}" class="max-h-75px" alt=""/>
                                </a>
                                <h3 class="mb-8 mt-22 font-weight-bold">CMS MODENA Agent</h3>
                                <p class="mb-15 text-muted font-weight-bold">
                                    Welcome to CMS MODENA Agent!
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="login-divider">
                        <div></div>
                    </div>

                    <div class="d-flex w-100 flex-center p-15 position-relative overflow-hidden">
                        <div class="login-wrapper">
                            <div class="login-signin">
                                <div class="text-center mb-10 mb-lg-20">
                                    <h2 class="font-weight-bold">Sign In</h2>
                                    <p class="text-muted font-weight-bold">Enter your email and password</p>
                                </div>
                                <form class="form text-left" id="kt_login_signin_form" method="POST" action="{{ url('admin/login') }}">
                                    <div class="form-group py-2 m-0">
                                        <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text" placeholder="Email" name="email" autocomplete="off" data-toggle="tooltip" data-theme="dark" title="" data-placement="top" autocomplete="off" data-original-title="Please note that the login is integrated with Microsoft. Ensure that you enter the Microsoft Email" />
                                    </div>
                                    <div class="form-group py-2 border-top m-0">
                                        <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="password" placeholder="Password" name="password" data-toggle="tooltip" data-theme="dark" title="" data-placement="left" data-original-title="Please note that the login is integrated with Microsoft Password. Ensure that you enter the Microsoft Password" />
                                    </div>
                                    <div class="text-center mt-15">
                                        <a href="https://login.microsoftonline.com/modena.com/oauth2/v2.0/authorize?client_id={{ env('MICROSOFT_CLIENT_ID') }}&response_type=code&response_mode=query&scope=User.Read&state={{ md5(date('Y-m-d H:i:s')) }}" class="btn btn-dark btn-pill border shadow-sm py-4 px-9 font-weight-bold">
                                            <img src="{{ asset('backend/media/microsoft.png') }}" alt="" style="width: 16px; height: 16px; margin: 0; margin-right: 10px;">
                                            Login with Microsoft
                                        </a>
                                        &nbsp;
                                        <button id="kt_login_signin_submit" class="btn btn-primary btn-pill shadow-sm py-4 px-9 font-weight-bold">Sign In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layouts.script')

        <script>
            $('form').submit(function(e){
                e.preventDefault();

                var action = $(this).attr('action');

                var email = $('input[name="email"]').val();
                var password = $('input[name="password"]').val();

                $.ajax({
                    url: action,
                    type: 'POST',
                    data: {
                        email: email,
                        password: password,
                    },
                    success: function(data){
                        var result = data;
                        let timerInterval;

                        Swal.fire({
                            title: 'Success',
                            text: result.message,
                            icon: 'success',
                            timer: 2000,
                            timerProgressBar: true,
                            showCancelButton: false,
                            showCloseButton: false,
                            showConfirmButton: false,
                        })
                        .then((result) => {
                            window.location.replace(data.redirect);
                        })
                    },
                    error: function(data){
                        var result = data.responseJSON;

                        Swal.fire({
                            title: 'Failed!',
                            text: result.message,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        })
                    }
                })
            })
        </script>
    </body>
</html>