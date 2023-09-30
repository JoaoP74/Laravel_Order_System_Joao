@php
    $user = auth()->user();
    
    $currentLocale = app()->getLocale();
    $currentPath = Request::path();
    $languagePrefix = $currentLocale . '/';
    //echo $currentPath;
    // Remove existing language prefix if present
    $currentPathWithoutLang = preg_replace('/^(en|de)\//', '', $currentPath);
    
    if ($currentLocale === 'en') {
        $currentLanguage = 'English';
    } elseif ($currentLocale === 'de') {
        $currentLanguage = 'Deutsch';
    } else {
        $currentLanguage = $currentLocale;
    }
    
    // Generate URLs for language switches
    $enUrl = 'en/';
    $deUrl = 'de/';
    // Handle case where URL already contains language prefix
    if (strpos($currentPath, $languagePrefix) === 0) {
        $currentPathWithoutLang = substr($currentPath, strlen($languagePrefix));
        $enUrl = 'en/' . $currentPathWithoutLang;
        $deUrl = 'de/' . $currentPathWithoutLang;
    }
    
@endphp
<style>
    .card {
        background: #e9e9e9;
        margin-bottom: 30px;
        border: none;
    }

    /* .card .card-body {
        padding-top: 20px;
        padding-bottom: 20px;
    } */

    .avatar-box-left {
        margin: 0px;
    }

    .avatar-upload {
        position: relative;
        max-width: 205px;
        margin: 10px auto;
    }

    .avatar-upload .avatar-edit {
        position: absolute;
        right: 12px;
        z-index: 1;
        top: 10px;
    }

    .avatar-box .avatar-preview {
        border-radius: 10%;
    }

    .avatar-upload .avatar-preview {
        width: 192px;
        height: 192px;
        position: relative;
        border-radius: 100%;
        border: 6px solid #F8F8F8;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .avatar-box .avatar-preview>div {
        border-radius: 10%;
        width: 100%;
    }

    .avatar-upload .avatar-preview>div {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }

    .avatar-box-left {
        margin: 0px;
    }

    .avatar-upload {
        position: relative;
        max-width: 205px;
        margin: 10px auto;
    }

    .form-group .control-label,
    .form-group>label {
        font-weight: 400 !important;
        font-size: 13px !important;
        color: #060617;
        font-family: "Inter", "Helvetica", monospace;
        line-height: 1.6;
        width: 145px;
    }

    .form-check>label {
        padding-left: 12px;
        font-size: 16px !important;
    }

    .control-label-wrap {
        width: auto !important;
    }

    .avatar-upload .avatar-edit input {
        display: none;
    }

    .avatar-upload .avatar-edit input+label {
        display: inline-block;
        width: 34px;
        height: 34px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #FFFFFF;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
    }

    .avatar-box .avatar-preview {
        border-radius: 10%;
    }

    .field-group {
        border: 1px solid black;
        padding: 3px;
        margin: 5px;
    }

    .field-caption {
        float: none;
        width: auto;
        margin-left: 20px;
        padding: 5px;
    }

    .form-group .form-control {
        display: inline !important;
        width: calc(100% - 150px) !important;
        font-size: 13px;
    }

    @media screen and (max-width: 992px) {

        .form-group .control-label,
        .form-group>label {
            width: 100%;
        }

        .form-group .form-control {
            display: inline !important;
            width: 100% !important;
        }
    }

    @media screen and (max-width: 768px) {

        .form-group .control-label,
        .form-group>label {
            width: 125px;
        }

        .form-group .form-control {
            display: inline !important;
            width: calc(100% - 130px) !important;
        }
    }

    @media screen and (max-width: 600px) {

        .form-group .control-label,
        .form-group>label {
            width: 100%;
        }

        .form-group .form-control {
            display: inline !important;
            width: 100% !important;
        }
    }

    .custom-select {
        display: inline;
    }

    .space {
        min-height: 30px;
    }

    .mw-100 {
        min-width: 100%;
        padding-left: 0;
    }

    .nav-tabs {
        border-bottom: 2px solid #777;
        padding-left: 12px;
    }

    .nav-tabs .nav-link {
        background-color: #e9e9e9 !important;
        margin-right: 0 !important;
        margin-bottom: 0 !important;
        color: #212529 !important;
    }

    .nav-tabs .nav-link:active,
    .nav-tabs .nav-link:hover,
    .nav-tabs li.active .nav-link {
        background-color: #777 !important;
        color: white !important;

    }


    .list-group {
        margin: 5px;
    }

    .submit_btn {
        padding-right: 10px;
        padding-bottom: 10px;
    }
</style>

<section class="customer_profile_section">
    <div class="container-fluid-md container-lg mw-100">

        <div class="pagetitle">
            <h1>{{ __('home.sample_customer') }}</h1>
            <p></p>
        </div>
        <form method="POST" action="{{ __('routes.customer-profileupdate') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="profile_wrap customer_profile_page">
                        @if (Session::has('success'))
                            <p class="alert alert-success" style="text-align: center;">
                                {{ Session::get('success') }}
                            </p>
                        @endif

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <fieldset class="field-group row">
                                            <legend class="field-caption">{{ __('home.general_information') }}</legend>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label class="control-label">{{ __('vector_form.company_id') }}
                                                        <span class="reqiurd">*</span></label>
                                                    <input type="text" readonly name="company_id"
                                                        class="form-control" value="{{ @$user->id }}">
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="field-group row" style="padding-bottom: 10px">
                                            <legend class="field-caption">{{ __('home.customer_data') }}</legend>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label>{{ __('vector_form.company') }} <span
                                                            class="reqiurd">*</span></label>
                                                    <input type="text" name="company" class="form-control"
                                                        value="{{ @$user->company }}">
                                                    @if ($errors->has('company'))
                                                        <span class="text-danger">{{ __('home.requiredMessage') }}<i
                                                                class="fa fa-exclamation-circle"
                                                                aria-hidden="true"></i></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label class="">{{ __('home.email') }}</label>
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ @$user->email }}">
                                                    @if ($errors->has('email'))
                                                        <span
                                                            class="text-danger">{{ __('home.email') }}{{ __('home.required') }}<i
                                                                class="fa fa-exclamation-circle"
                                                                aria-hidden="true"></i></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label>{{ __('vector_form.company_addition') }} <span
                                                            class="reqiurd">*</span></label>
                                                    <input type="text" name="company_addition" class="form-control"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label class="">{{ __('home.contact') }} <span
                                                            class="reqiurd">*</span></label>
                                                    <input type="number" name="number" class="form-control"
                                                        value="{{ @$user->contact_no }}">
                                                    @if ($errors->has('number'))
                                                        <span class="text-danger">{{ __('home.requiredMessage') }}<i
                                                                class="fa fa-exclamation-circle"
                                                                aria-hidden="true"></i></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label>{{ __('embroidery_form.salutation') }} <span
                                                            class="reqiurd">*</span></label>
                                                    <div class="custom-select">
                                                        <select class="form-control" name="salutation">
                                                            <option value="" selected="selected">
                                                                {{ __('vector_form.salutation') }}</option>
                                                            <option value="vector_form.mister"
                                                                {{ @$user->salutation == 'vector_form.mister' ? 'selected' : '' }}>
                                                                {{ __('vector_form.mister') }}</option>
                                                            <option value="vector_form.woman"
                                                                {{ @$user->salutation == 'vector_form.woman' ? 'selected' : '' }}>
                                                                {{ __('vector_form.woman') }}</option>
                                                            <option value="vector_form.company"
                                                                {{ @$user->salutation == 'vector_form.company' ? 'selected' : '' }}>
                                                                {{ __('vector_form.company') }}</option>
                                                        </select>
                                                    </div>
                                                    @if ($errors->has('salutation'))
                                                        <span class="text-danger">{{ __('home.requiredMessage') }}<i
                                                                class="fa fa-exclamation-circle"
                                                                aria-hidden="true"></i></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label class="">{{ __('home.mobile') }} <span
                                                            class="reqiurd">*</span></label>
                                                    <input type="number" name="number" class="form-control"
                                                        value="">
                                                    @if ($errors->has('mobile'))
                                                        <span class="text-danger">{{ __('home.requiredMessage') }}<i
                                                                class="fa fa-exclamation-circle"
                                                                aria-hidden="true"></i></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label class="">{{ __('home.firstName') }}</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ @$user->name }}">
                                                    @if ($errors->has('name'))
                                                        <span
                                                            class="text-danger">{{ __('home.fullName') }}{{ __('home.required') }}<i
                                                                class="fa fa-exclamation-circle"
                                                                aria-hidden="true"></i></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label>{{ __('home.fax') }} <span class="reqiurd">*</span></label>
                                                    <input type="text" name="fax" class="form-control"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label class="">{{ __('home.lastName') }}</label>
                                                    <input type="text" name="last_name" class="form-control"
                                                        value="">
                                                    @if ($errors->has('name'))
                                                        <span
                                                            class="text-danger">{{ __('home.fullName') }}{{ __('home.required') }}<i
                                                                class="fa fa-exclamation-circle"
                                                                aria-hidden="true"></i></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label>{{ __('home.website') }} <span
                                                            class="reqiurd">*</span></label>
                                                    <input type="text" name="site" class="form-control"
                                                        value="{{ @$user->site }}">
                                                    @if ($errors->has('site'))
                                                        <span class="text-danger">{{ __('home.requiredMessage') }}<i
                                                                class="fa fa-exclamation-circle"
                                                                aria-hidden="true"></i></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12 "></div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label>{{ __('home.address') }} <span
                                                            class="reqiurd">*</span></label>
                                                    <input type="text" name="address" class="form-control"
                                                        value="{{ @$user->address }}">
                                                    @if ($errors->has('address'))
                                                        <span class="text-danger">{{ __('home.requiredMessage') }}<i
                                                                class="fa fa-exclamation-circle"
                                                                aria-hidden="true"></i></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label>{{ __('home.tax_number') }} <span
                                                            class="reqiurd">*</span></label>
                                                    <input type="text" name="tax_number" class="form-control"
                                                        value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label>{{ __('home.address_addition') }} <span
                                                            class="reqiurd">*</span></label>
                                                    <input type="text" name="address_addition"
                                                        class="form-control" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label>{{ __('home.VAT_No') }} <span
                                                            class="reqiurd">*</span></label>
                                                    <input type="text" name="vat_no" class="form-control"
                                                        value="{{ @$user->vat_no }}">
                                                    @if ($errors->has('vat_no'))
                                                        <span class="text-danger">{{ __('home.requiredMessage') }}<i
                                                                class="fa fa-exclamation-circle"
                                                                aria-hidden="true"></i></span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label>{{ __('home.zip_code') }} <span
                                                            class="reqiurd">*</span></label>
                                                    <input type="text" name="zip_code" class="form-control"
                                                        value="{{ @$user->zip_code }}">
                                                    @if ($errors->has('zip_code'))
                                                        <span class="text-danger">{{ __('home.requiredMessage') }}<i
                                                                class="fa fa-exclamation-circle"
                                                                aria-hidden="true"></i></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label>{{ __('home.commercial_register_no') }} <span
                                                            class="reqiurd">*</span></label>
                                                    <input type="text" name="commercial_register_no"
                                                        class="form-control" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label>{{ __('home.place') }} <span
                                                            class="reqiurd">*</span></label>
                                                    <input type="text" name="place" class="form-control"
                                                        value="{{ @$user->place }}">
                                                    @if ($errors->has('place'))
                                                        <span class="text-danger">{{ __('home.requiredMessage') }}<i
                                                                class="fa fa-exclamation-circle"
                                                                aria-hidden="true"></i></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label>{{ __('vector_form.company_group') }} <span
                                                            class="reqiurd">*</span></label>
                                                    <div class="custom-select">
                                                        <select class="form-control" name="salutation">
                                                            <option value="" selected="selected">
                                                                {{ __('vector_form.company_group') }}</option>
                                                            <option value="vector_form.mister">aaa</option>
                                                            <option value="vector_form.woman">bbb</option>
                                                            <option value="vector_form.company">ccc</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label>{{ __('home.country') }} <span
                                                            class="reqiurd">*</span></label>
                                                    <input type="text" name="country" class="form-control"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label>{{ __('vector_form.company_category') }} <span
                                                            class="reqiurd">*</span></label>
                                                    <div class="custom-select">
                                                        <select class="form-control" name="company_category">
                                                            <option value="" selected="selected">
                                                                {{ __('vector_form.company_category') }}</option>
                                                            <option value="aaa">aaa</option>
                                                            <option value="bbb">bbb</option>
                                                            <option value="ccc">ccc</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label>{{ __('home.federal_state') }} <span
                                                            class="reqiurd">*</span></label>
                                                    <input type="text" name="federal_state" class="form-control"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label>{{ __('vector_form.payment_method') }} <span
                                                            class="reqiurd">*</span></label>
                                                    <div class="custom-select">
                                                        <select class="form-control" name="payment_method">
                                                            <option value="" selected="selected">
                                                                {{ __('vector_form.company_category') }}</option>
                                                            <option value="aaa">aaa</option>
                                                            <option value="bbb">bbb</option>
                                                            <option value="ccc">ccc</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </fieldset>
                                    </div>


                                    <div class="col-lg-6 col-md-6 col-12">
                                        <fieldset class="field-group row">
                                            <legend class="field-caption">
                                                {{ __('home.embroidery_file_information') }}</legend>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label style="width: 200px;">{{ __('home.yarn_information') }}
                                                    </label>
                                                    <input type="text" name="country" class="form-control"
                                                        style="width: calc(100% - 205px) !important;" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label
                                                        style="width: 200px;">{{ __('home.need_embroidery_files') }}
                                                    </label>
                                                    <input type="text" name="country" class="form-control"
                                                        style="width: calc(100% - 205px) !important;" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label style="width: 200px;">{{ __('home.cutting_options') }}
                                                    </label>
                                                    <input type="text" name="country" class="form-control"
                                                        style="width: calc(100% - 205px) !important;" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label
                                                        style="width: 200px;">{{ __('home.special_cutting_options') }}
                                                    </label>
                                                    <input type="text" name="country" class="form-control"
                                                        style="width: calc(100% - 205px) !important;" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label style="width: 200px;">{{ __('home.needle_instructions') }}
                                                    </label>
                                                    <input type="text" name="country" class="form-control"
                                                        style="width: calc(100% - 205px) !important;" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label
                                                        style="width: 200px;">{{ __('home.standard_instructions') }}
                                                    </label>
                                                    <input type="text" name="country" class="form-control"
                                                        style="width: calc(100% - 205px) !important;" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12" style="margin-bottom:5px;">
                                                <div class="form-group form_dv_wrap">
                                                    <label
                                                        style="width: 200px;">{{ __('home.special_standard_instructions') }}
                                                    </label>
                                                    <input type="text" name="country" class="form-control" ;
                                                        style="height: 138px; width: calc(100% - 205px) !important;"
                                                        value="">
                                                </div>
                                            </div>

                                        </fieldset>
                                        <fieldset class="field-group row">
                                            <legend class="field-caption">
                                                {{ __('home.vector_file_information') }}</legend>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label style="width: 200px;">{{ __('home.required_vector_file') }}
                                                    </label>
                                                    <input type="text" name="country" class="form-control"
                                                        style="width: calc(100% - 205px) !important;" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12" style="margin-bottom:5px;">
                                                <div class="form-group form_dv_wrap">
                                                    <label style="width: 200px;">{{ __('home.required_image_file') }}
                                                    </label>
                                                    <input type="text" name="country" class="form-control"
                                                        style="width: calc(100% - 205px) !important;" value="">
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        {{-- <fieldset class="field-group row" style="padding: 20px 5px">
                                            <div class="space">
                                                <h5>{{ __('home.thread') }}</h5>
                                            </div>
                                            <div class="space">
                                                <h5>{{ __('home.file_emb') }}</h5>
                                            </div>
                                            <div class="space">
                                                <h5>{{ __('home.file_vect') }}</h5>
                                            </div>
                                            <div class="space">
                                                <h5>{{ __('home.thread_instruction') }}</h5>
                                            </div>
                                            <div class="space">
                                                <h5>{{ __('home.thread_cut') }}</h5>
                                            </div>
                                            <div class="space">
                                                <h5>{{ __('home.needle_instruction') }}</h5>
                                            </div>
                                            <div class="space">
                                                <h5>{{ __('home.font_instruction') }}</h5>
                                            </div>
                                            <div class="space">
                                                <h5>{{ __('home.special_instruction') }}</h5>
                                            </div>
                                            <div class="space"></div>
                                            <div class="space"></div>
                                            <div class="space"></div>
                                        </fieldset> --}}
                                        {{-- <fieldset class="field-group row">
                                            <legend class="field-caption">
                                                {{ __('home.vector_file_information') }}</legend>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group form_dv_wrap">
                                                    <label style="width: 200px;">{{ __('home.required_vector_file') }}
                                                    </label>
                                                    <input type="text" name="country" class="form-control"
                                                        style="width: calc(100% - 205px) !important;" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12" style="margin-bottom:5px;">
                                                <div class="form-group form_dv_wrap">
                                                    <label style="width: 200px;">{{ __('home.required_image_file') }}
                                                    </label>
                                                    <input type="text" name="country" class="form-control"
                                                        style="width: calc(100% - 205px) !important;" value="">
                                                </div>
                                            </div>
                                        </fieldset> --}}
                                    </div>
                                </div>






                                <div class="row row-reverse">
                                    <!-- <div class="col-lg-6 col-md-12 col-12">
                                     @if (auth()->user()->user_type == 'customer')
<div class="row">
                                            <div class="employee-list-container mt-4">
                                                <div class="employee-top d-flex justify-content-between">
                                                    <div class="employee-title">
                                                        Employee List
                                                    </div>
                                                    <div class=" submit_btn">
                                                        <a href="#invite-employee" data-bs-toggle="modal" style="background: #c4ae79 !important; color: #fff !important; border: 0; border-radius: 0; font-size: 16px; padding: 10px 15px;" class="btn">Invite Employees </a>
                                                    </div>
                                                </div>
                                                <div class="employee-list">
                                                    <table id="list-employees" class="table table-striped" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>S.no</th>
                                                                <th>Employee Email</th>
                                                                <th>Customer</th>
                                                                <th>Created at</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if ($employees->isEmpty())
<tr>
                                                                <td colspan="5" class="text-center">No Employee found.</td>
                                                            </tr>
@else
@foreach ($employees as $d)
<tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $d->email }}</td>
                                                                    <td>{{ auth()->user()->name }}</td>
                                                                    <td>{{ date('d M, Y', strtotime($d->created_at)) }}</td>
                                                                    <td>
                                                                        <div class="d-flex" style="gap:20px;">
                                                                            <div>
                                                                                <a href='{{ __('routes.employer-editemployee') . $d->id }}'><i class="fa-solid fa-pen-to-square text-primary"></i></a>
                                                                            </div>
                                                                            <div><span><i class="fa-solid fa-trash text-danger" onclick="deleteemployee({{ $d->id }})" style="cursor:pointer;"></i></span></div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
@endforeach
@endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
@endif
                                    </div> -->

                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="upload_btn">
                        @if (@auth()->user()->user_type == 'customer')
                            <button class="btn btn-primary btn-block"
                                type="submit">{{ __('home.request_change') }}</button>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>


@push('custom-script')

    <script>
        $(function() {
            let table = $('#list-employees').DataTable({
                "searching": false,
                "dom": 'rtip',
                "pageLength": 5,
                language: {
                    paginate: {
                        next: '<i class="fa-solid fa-chevron-right"></i>', // or '→'
                        previous: '<i class="fa-solid fa-chevron-left"></i>' // or '←'
                    }
                },
            });
        })

        function deleteemployee(e) {
            const employerid = e;
            Swal.fire({
                title: 'Delete Employee?',
                text: 'Are you sure you want to delete this employee?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteajax(employerid);
                    window.location.reload();
                } else {
                    Swal.fire('Cancelled', 'The deletion has been cancelled.', 'info');
                }
            });
        }

        function deleteajax(e) {
            const userid = e;
            $.ajax({
                type: 'POST',
                url: "{{ __('routes.employer-deleteemployee') }}" + userid,
                success: function(success) {
                    Swal.fire('Deleted!', 'The employee has been deleted.', 'success');
                },
                error: function(error) {
                    console.error(error);
                    Swal.fire('Error', 'An error occurred while deleting the employee.', 'error');
                }
            });
        }

        function inviteEmp() {
            $('#ajax-msg').empty();
            $('#ajax-msg').removeClass('text-danger');
            $('#ajax-msg').removeClass('text-success');
            var email = $('.employee-email').val();
            console.log(email);
            if (email) {
                $.ajax({
                    type: 'POST',
                    url: "{{ __('routes.send-invite') }}",
                    beforeSend: function() {
                        $('#invite-btn').hide();
                        $("#loading").show();
                    },
                    complete: function() {
                        $('#invite-btn').show();
                        $("#loading").hide();
                    },
                    data: {
                        email: email
                    },
                    success: function(response) {
                        if (response.success == true) {
                            $('#ajax-msg').text(response.message);
                            $('#ajax-msg').addClass('text-success');
                            setTimeout(function() {
                                location.reload();
                            }, 2000)
                        } else {
                            $('#ajax-msg').text('Something went wrong.');
                            $('#ajax-msg').addClass('text-danger');
                        }
                    },
                    error: function(response) {
                        $('#ajax-msg').text('Something went wrong.');
                        $('#ajax-msg').addClass('text-danger');
                    }
                })
            } else {
                $('#ajax-msg').text('Please fill the email.');
                $('#ajax-msg').addClass('text-danger');
            }
        }
    </script>
