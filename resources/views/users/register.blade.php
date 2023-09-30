<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Sign up</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/asset/css/user/global.css') }}">
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;

        }

        .gradient-custom {
            /* fallback for old browsers */
            background: #fccb90;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to bottom right, rgba(252, 203, 144, 1), rgba(213, 126, 235, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to bottom right, rgba(252, 203, 144, 1), rgba(213, 126, 235, 1))
        }

        .mask-custom {
            background: rgba(24, 24, 16, .2);
            border-radius: 2em;
            backdrop-filter: blur(15px);
            border: 2px solid rgba(255, 255, 255, 0.05);
            background-clip: padding-box;
            box-shadow: 10px 10px 10px rgba(46, 54, 68, 0.03);
        }

        #register_form {
            padding: 40px 0 !important;
        }

        #register_form .login_wrap {
            max-width: 750px;
            padding: 40px 40px;
        }

        #register_form .back_btttn {
            margin-bottom: 15px;
        }

        #register_form .heading_logo {
            margin-bottom: 20px;
        }

        #register_form .footerrr {
            padding-top: 15px;
        }

        #register_form .container {
            padding-right: calc(var(--mdb-gutter-x)*0.5);
            padding-left: calc(var(--mdb-gutter-x)*0.5);
        }

        @media (max-width: 450px) {

            #register_form .login_wrap {
                padding: 40px 20px;
            }

            #register_form .heading_logo .logo_img img,
            .footerrr .fttrr_img img {
                max-width: 110px;
            }
        }
    </style>
</head>

<body class="antialiased">
    <section id="register_form" class="login_section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="login_wrap">

                        <div class="back_btttn">
                            <a href="{{ asset('/') }}">
                                <i class="fa-solid fa-arrow-left"></i>
                                <!-- Back To Home Page -->
                                {{ __('home.backToHome') }}
                            </a>
                        </div>

                        <form action="{{ __('routes.customer-registration') }}" method="POST">
                            @csrf

                            <div class="heading_logo">
                                <div class="login_heading">
                                    <h1>{{ __('home.register') }}</h1>
                                </div>
                                <div class="logo_img">
                                    <a href="{{ asset('/') }}">
                                        <img src="http://127.0.0.1:8000/asset/images/lion_werbe_gmbh_logo.webp"
                                            alt="empty">
                                    </a>
                                </div>
                            </div>

                            <div class="cred_txt">
                                <p>{{ __('home.register_lines') }}</p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form_dv">
                                        <label for="t1">{{ __('home.fullName') }}<span
                                                class="reqiurd">*</span></label>
                                        <input type="text" placeholder="{{ __('home.fullName') }} *" id="t1"
                                            name="name">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ __('home.fullName') }}
                                                {{ __('home.required') }}<i class="fa fa-exclamation-circle"
                                                    aria-hidden="true"></i></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form_dv">
                                        <label for="e1">{{ __('home.email') }}<span
                                                class="reqiurd">*</span></label>
                                        <input type="email" placeholder="{{ __('home.email') }}*" id="e1"
                                            name="email">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}<i
                                                    class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form_dv">
                                        <label for="c1">{{ __('home.contact') }}<span
                                                class="reqiurd">*</span></label>
                                        <input type="text" placeholder="{{ __('home.contact') }}*" name="number">
                                        @if ($errors->has('number'))
                                            <span class="text-danger">{{ __('home.contact') }}
                                                {{ __('home.required') }}<i class="fa fa-exclamation-circle"
                                                    aria-hidden="true"></i></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form_dv">
                                        <label for="c1">{{ __('home.company') }}<span class="reqiurd">*</span>
                                        </label>
                                        <input type="text" placeholder="{{ __('home.company') }} *" name="company">
                                        @if ($errors->has('company'))
                                            <span class="text-danger">{{ __('home.company') }}
                                                {{ __('home.required') }}<i class="fa fa-exclamation-circle"
                                                    aria-hidden="true"></i></span>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form_dv">
                                        <label>{{ __('embroidery_form.salutation') }} <span
                                                class="reqiurd">*</span></label>
                                        <select class="form-control" name="Salutation">
                                            <option value="" selected="selected">
                                                {{ __('vector_form.salutation') }}</option>
                                            <option value="vector_form.mister">{{ __('vector_form.mister') }}</option>
                                            <option value="vector_form.woman">{{ __('vector_form.woman') }}</option>
                                            <option value="vector_form.company">{{ __('vector_form.company') }}
                                            </option>
                                        </select>
                                        @if ($errors->has('Salutation'))
                                            <span class="text-danger">{{ __('embroidery_form.salutation') }}
                                                {{ __('home.required') }}<i class="fa fa-exclamation-circle"
                                                    aria-hidden="true"></i></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form_dv">
                                        <label for="c1">{{ __('home.website') }} <span
                                                class="reqiurd">*</span></label>
                                        <input type="text" placeholder="{{ __('home.website') }}*" name="site">
                                        @if ($errors->has('site'))
                                            <span class="text-danger">{{ __('home.website') }}
                                                {{ __('home.required') }}<i class="fa fa-exclamation-circle"
                                                    aria-hidden="true"></i></span>
                                        @endif
                                    </div>
                                </div>




                                <div class="col-md-6">
                                    <div class="form_dv">
                                        <label for="c1">{{ __('home.address') }} <span
                                                class="reqiurd">*</span></label>
                                        <input type="text" name="address" class="form-control"
                                            placeholder="{{ __('home.address') }}*">
                                        @if ($errors->has('address'))
                                            <span class="text-danger">{{ __('home.address') }}
                                                {{ __('home.required') }}<i class="fa fa-exclamation-circle"
                                                    aria-hidden="true"></i></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form_dv">
                                        <label for="c1">{{ __('home.place') }} <span
                                                class="reqiurd">*</span></label>
                                        <input type="text" name="place" class="form-control"
                                            placeholder="{{ __('home.place') }}*">
                                        @if ($errors->has('place'))
                                            <span class="text-danger">{{ __('home.place') }}
                                                {{ __('home.required') }}<i class="fa fa-exclamation-circle"
                                                    aria-hidden="true"></i></span>
                                        @endif
                                    </div>
                                </div>




                                <div class="col-md-6">
                                    <div class="form_dv">
                                        <label for="c1">{{ __('home.zip_code') }} <span
                                                class="reqiurd">*</span></label>
                                        <input type="text" name="zip_code" class="form-control"
                                            placeholder="{{ __('home.zip_code') }}*">
                                        @if ($errors->has('zip_code'))
                                            <span class="text-danger">{{ __('home.zip_code') }}
                                                {{ __('home.required') }}<i class="fa fa-exclamation-circle"
                                                    aria-hidden="true"></i></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form_dv">
                                        <label for="c1">{{ __('home.VAT_No') }} <span
                                                class="reqiurd">*</span></label>
                                        <input type="text" name="vat_no" class="form-control"
                                            placeholder="{{ __('home.VAT_No') }}*">
                                        @if ($errors->has('place'))
                                            <span class="text-danger">{{ __('home.VAT_No') }}
                                                {{ __('home.required') }}<i class="fa fa-exclamation-circle"
                                                    aria-hidden="true"></i></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form_dv">
                                        <label for="p1">{{ __('home.password') }} <span
                                                class="reqiurd">*</span></label>
                                        <input type="password" placeholder="Password*" name="password">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}<i
                                                    class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form_dv">
                                        <label for="p1">{{ __('home.confirm_password') }} <span
                                                class="reqiurd">*</span></label>
                                        <input type="password" placeholder="Confirm Password*"
                                            name="confirm_password">
                                        @if ($errors->has('confirm_password'))
                                            <span class="text-danger">{{ $errors->first('confirm_password') }}<i
                                                    class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                                        @endif
                                    </div>
                                </div>

                            </div>




                            <div class="lgg_resi">
                                <div class="submit_btn">
                                    <button type="submit">{{ __('home.register') }}</button>
                                </div>
                                <div class="resig_lnkk">
                                    <p>{{ __('home.already_have_account') }}</p>
                                    <a href="{{ __('routes.customer-login') }}">{{ __('home.login') }}</a>
                                </div>
                            </div>

                            <div class="footerrr">
                                <div class="fttrr_img">
                                    <img src="http://127.0.0.1:8000/asset/images/lion_werbe_gmbh_logo.webp"
                                        alt="empty">
                                </div>
                                <div class="copy_right_txt">
                                    <p>Copyright 2023 Lion Werbung</p>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>


</body>

</html>
