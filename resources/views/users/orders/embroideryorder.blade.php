@extends('layout.layout')
@section('content')

<!-- <h2> Embroidery Form </h2> -->
<style>
    * {
        box-sizing: border-box;
    }

    /* body {
  background-color: #f1f1f1;
} */
    /* .error{

  background-color: #fdd;
  padding: 5px;
  color: #ff0101;
  width: 257px;
  margin-top: 10px;
  border: #f03232 2px solid;
} */

    .error {
        display: none;
        background-color: #fdd;
        padding: 5px;
        color: #ff0101;
        width: 257px;
        margin-top: 10px;
        border: #f03232 2px solid;
    }


    /* Show error messages when the corresponding input field has the "invalid" class */
    .form-group input.invalid+.error,
    .form-group select.invalid+.error,
    .form-group textarea.invalid+.error {
        display: block;
    }



    .fa-exclamation-circle {
        float: right;
    }

    #embroideryOrder {
        background-color: #e9e9e9;
        /* font-family: Raleway; */
        padding: 30px 20px 1px;
        width: 100%;
        border-left: 55px solid #c4ae79;
    }

    h1 {
        text-align: center;
    }

    input {
        padding: 10px;
        width: 100%;
        font-size: 17px;
        /* font-family: Raleway; */
        border: 1px solid #aaaaaa;
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
        /* background-color: #ffdddd; */
        border: #f03232 2px solid;
    }

    select.invalid {
        /* background-color: #ffdddd; */
        border: #f03232 2px solid;
    }

    textarea.invalid {
        /* background-color: #ffdddd; */
        border: #f03232 2px solid;
    }

    /* Hide all steps by default: */
    .tab {
        display: none;
    }

    button {
        background-color: #04AA6D;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 17px;
        /* font-family: Raleway; */
        cursor: pointer;
    }

    button:hover {
        opacity: 0.8;
    }

    #prevBtn {
        background-color: #bbbbbb;
    }

    /* Make circles that indicate the steps of the form: */
    .multi-step-nav .step {
        height: 12px;
        width: 12px;
        margin: 0 2px;
        background-color: rgb(196, 174, 121, 0.4);
        border: none;
        border-radius: 50%;
        display: inline-block;
    }

    .multi-step-nav .step.active {
        opacity: 1;
        background-color: rgb(196, 174, 121);
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
        background-color: rgb(196, 174, 121);
    }

    /* label{
font-weight: 600;
color:gray;
} */

    #embroideryOrder h5 {
        font-size: 25px;
        font-weight: 400;
        margin-bottom: 20px;
    }

    .tab label {
        display: block;
        margin-bottom: 10px;
        font-family: "Inter", "Helvetica", monospace;
        font-weight: 400 !important;
        font-size: 16.8px !important;
        color: #060617;
    }

    .custom-select {
        position: relative;
    }

    .custom-select select {
        padding-right: 20px;
        border-radius: 0;
        border: none;
        color: #777;
        font-size: 17px;
    }

    .custom-select select:focus {
        outline: none;
        border: none;
    }

    .custom-select:before {
        content: "";
        display: block;
        width: 8px;
        height: 8px;
        border-top: 2px solid #888;
        border-left: 2px solid #888;
        transform: rotate(225deg);
        position: absolute;
        top: 14px;
        right: 13px;
    }

    .form-control {
        min-height: 38px;
        font-family: "Inter", "Helvetica", monospace;
        border: none;
        border-radius: 0;
    }

    .form-control:focus {
        box-shadow: none !important;
        border: none !important;
    }

    .invalid {
        border: 1px solid #f03232 !important;
        background-color: #fff;
    }

    #embroideryOrder p {
        margin-bottom: 10px;
    }

    #embroideryOrder textarea {
        min-height: 150px;
        border: none;
        border-radius: 0;
    }

    .error {
        background-color: transparent;
        border: 0;
        width: auto;
        padding: 0 5px 0 2px;
        margin-top: 0;
    }

    .error .fa {
        float: left;
        margin-top: 4px;
        margin-right: 6px;
    }

    button#nextBtn,
    button#prevBtn {
        background-color: #c4ae79 !important;
        color: #fff;
        font-family: "Inter", "Helvetica", monospace;
        margin-top: 10px;
    }

    button#prevBtn {
        margin-right: 10px;
    }

    .multi-step-nav {
        text-align: center;
        margin-top: 20px;
        padding-bottom: 30px;
    }

    .custom-radio label {
        padding: 0 10px;
        margin: 0;
    }

    button#add-file-btn {
        background-color: #c4ae79 !important;
        color: #fff;
        font-family: "Inter", "Helvetica", monospace;
        border: 0;
        width: auto;
        margin-left: auto !important;
        margin-right: 14px !important;
    }

    button#add-file-btn:focus {
        outline: none;
        box-shadow: none;
    }

    .send-btn {
        background-color: #c4ae79 !important;
        color: #fff !important;
        font-family: "Inter", "Helvetica", monospace;
        border: 0;
        text-transform: capitalize;
        width: 100%;
        max-width: 150px;
        margin: 47px auto 0;
        display: block;
        font-weight: 400 !important;
    }

    .send-btn:focus {
        outline: none;
        box-shadow: none !important;
    }

    @media (max-width: 767px) {
        #embroideryOrder {
            border-left: 10px solid #c4ae79;
            margin-top: 35px;
        }

    }
</style>

<section class="embroidery_section">
    @if(Session::has('message'))
    <p class="alert alert-info" style="text-align: center;">
        {{(Session::get('message'))}}
    </p>
    @endif
    <div>

        <form id="embroideryOrder" action="" enctype="multipart/form-data">


            <!-- One "tab" for each step in the form: -->

            <!-- ------------------------initial Order details --------------------------- -->
            <div class="tab">
                <div class="embroidery_heading">
                    <h1>Order Embroidery Program</h1>
                </div>
                <label>{{ __('embroidery_form.program_selection') }} <span class="reqiurd">*</span></label>
                <div class="custom-select">
                    <p class="form-group">
                        <select class="form-control" name="selection">
                            <option value="">{{ __('embroidery_form.program_selection') }}</option>
                            <option value="embroidery_form.max_10_cm">{{ __('embroidery_form.max_10_cm') }}</option>
                            <option value="embroidery_form.max_30_cm">{{ __('embroidery_form.max_30_cm') }}</option>
                            <option value="embroidery_form.plus_size">{{ __('embroidery_form.plus_size') }}</option>
                        </select>
                        <span class="error" id="prog_select_error">{{__('embroidery_form.embroidery_program_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                    </p>
                </div>
                <label>{{ __('embroidery_form.delievery_time') }} <span class="reqiurd">*</span></label>
                <div class="custom-select">
                    <p class="form-group">
                        <select class="form-control" name="delivery_time">
                            <option value="">{{ __('embroidery_form.delievery_time') }}</option>
                            <option value="default">default</option>
                            <option value="express">Express</option>
                        </select>
                        <span class="error" id="d_time_error">{{__('embroidery_form.delivery_time_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                    </p>
                </div>

                <label>{{ __('embroidery_form.project_name') }} <span class="reqiurd">*</span></label>
                <p class="form-group"><input type="text" name="project_name" class="form-control">
                    <span class="error" id="p_name_error">{{__('embroidery_form.project_name_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                </p>

                <label>{{ __('embroidery_form.end_product') }} <span class="reqiurd">*</span></label>
                <div class="custom-select">
                    <p class="form-group">
                        <select class="form-control" name="end_product">
                            <option value="">{{ __('embroidery_form.end_product') }}</option>
                            <option value="embroidery_form.baby_bib">{{ __('embroidery_form.baby_bib') }}</option>
                            <option value="embroidery_form.baby_body">{{ __('embroidery_form.baby_body') }}</option>
                            <option value="embroidery_form.backback">{{ __('embroidery_form.backback') }}</option>
                            <option value="embroidery_form.bags">{{ __('embroidery_form.bags') }}</option>
                            <option value="embroidery_form.blanket">{{ __('embroidery_form.blanket') }}</option>
                            <option value="embroidery_form.canvas">{{ __('embroidery_form.canvas') }}</option>
                            <option value="embroidery_form.caps">{{ __('embroidery_form.caps') }}</option>
                            <option value="embroidery_form.chef_apron">{{ __('embroidery_form.chef_apron') }}</option>
                            <option value="embroidery_form.chef_jacket">{{ __('embroidery_form.chef_jacket') }}</option>
                            <option value="embroidery_form.cotton_bag'">{{ __('embroidery_form.cotton_bag') }}</option>
                            <option value="embroidery_form.dish_towels">{{ __('embroidery_form.dish_towels') }}</option>
                            <option value="embroidery_form.dress_shirt">{{ __('embroidery_form.dress_shirt') }}</option>
                            <option value="embroidery_form.dungarees">{{ __('embroidery_form.dungarees') }}</option>
                            <option value="embroidery_form.felt">{{ __('embroidery_form.felt') }}</option>
                            <option value="embroidery_form.felthats">{{ __('embroidery_form.felthats') }}</option>
                            <option value="embroidery_form.fleece">{{ __('embroidery_form.fleece') }}</option>
                            <option value="embroidery_form.fleece_scarf">{{ __('embroidery_form.fleece_scarf') }}</option>
                            <option value="embroidery_form.frottee">{{ __('embroidery_form.frottee') }}</option>
                            <option value="embroidery_form.jacket">{{ __('embroidery_form.jacket') }}</option>
                            <option value="embroidery_form.jeans_jacket">{{ __('embroidery_form.jeans_jacket') }}</option>
                            <option value="embroidery_form.jersey">{{ __('embroidery_form.jersey') }}</option>
                            <option value="embroidery_form.knit_headband">{{ __('embroidery_form.knit_headband') }}</option>
                            <option value="embroidery_form.knitted_hat">{{ __('embroidery_form.knitted_hat') }}</option>
                            <option value="embroidery_form.knitted_jackets">{{ __('embroidery_form.knitted_jackets') }}</option>
                            <option value="embroidery_form.knitted_material">{{ __('embroidery_form.knitted_material') }}</option>
                            <option value="embroidery_form.knitted_sweat">{{ __('embroidery_form.knitted_sweat') }}</option>
                            <option value="embroidery_form.leather">{{ __('embroidery_form.leather') }}</option>
                            <option value="embroidery_form.leather_shoes">{{ __('embroidery_form.leather_shoes') }}</option>
                            <option value="embroidery_form.loden_fabric">{{ __('embroidery_form.loden_fabric') }}</option>
                            <option value="embroidery_form.napkins">{{ __('embroidery_form.napkins') }}</option>
                            <option value="embroidery_form.overall">{{ __('embroidery_form.overall') }}</option>
                            <option value="embroidery_form.patch">{{ __('embroidery_form.patch') }}</option>
                            <option value="embroidery_form.patch_material">{{ __('embroidery_form.patch_material') }}</option>
                            <option value="embroidery_form.plush">{{ __('embroidery_form.plush') }}</option>
                            <option value="embroidery_form.polo">{{ __('embroidery_form.polo') }}</option>
                            <option value="embroidery_form.quilted_vest">{{ __('embroidery_form.quilted_vest') }}</option> <option value="embroidery_form.saddle_cloth">{{ __('embroidery_form.saddle_cloth') }}</option> <option value="embroidery_form.sauna_coat">{{ __('embroidery_form.sauna_coat') }}</option>
                            <option value="embroidery_form.socks">{{ __('embroidery_form.socks') }}</option>
                            <option value="embroidery_form.softshell">{{ __('embroidery_form.softshell') }}</option>
                            <option value="embroidery_form.sweatshirt">{{ __('embroidery_form.sweatshirt') }}</option>
                            <option value="embroidery_form.tablecloths">{{ __('embroidery_form.tablecloths') }}</option>
                            <option value="embroidery_form.towels">{{ __('embroidery_form.towels') }}</option>
                            <option value="embroidery_form.training_jackets">{{ __('embroidery_form.training_jackets') }}</option>
                            <option value="embroidery_form.t-shirt">{{ __('embroidery_form.t-shirt') }}</option>
                            <option value="embroidery_form.tunics">{{ __('embroidery_form.tunics') }}</option>
                            <option value="embroidery_form.vest">{{ __('embroidery_form.vest') }}</option>
                            <option value="embroidery_form.work_overall">{{ __('embroidery_form.work_overall') }}</option>
                            <option value="embroidery_form.working_jackets">{{ __('embroidery_form.working_jackets') }}</option>
                            <option value="embroidery_form.working_pants">{{ __('embroidery_form.working_pants') }}</option>
                            <option value="embroidery_form.silk">{{ __('embroidery_form.silk') }}</option>
                            <option value="embroidery_form.linen_fabric">{{ __('embroidery_form.linen_fabric') }}</option>
                        </select>
                        <span class="error" id="end_pro_error">{{__('embroidery_form.end_product_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                    </p>
                </div>
                <label>{{ __('embroidery_form.Emb_info') }} <span class="reqiurd">*</span></label>
                <p class="form-group col-6 custom-radio" style="display:flex; width:250px; align-items:center; margin:0; ">
                    <input type="radio" name="emb_info" value="height" class="col-1" id="radio_info">
                    <label for="" class="">{{ __('embroidery_form.height') }}</label>
                    <input type="radio" name="emb_info" value="broad" class="col-1">
                    <label for="" class="">{{ __('embroidery_form.broad') }}</label>
                </p>
                <span class="error" id="emb_info_error">{{__('embroidery_form.at_least_one_option_val')}} <i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>


                <label class="mt-3">{{ __('embroidery_form.Emb_size') }} <span class="reqiurd">*</span></label>
                <p class="form-group"><input type="text" name="emb_size" class="form-control">
                    <span class="error" id="emb_size_error">{{__('embroidery_form.desired_size_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                </p>

                <label>{{ __('embroidery_form.instructions') }} <span class="reqiurd">*</span></label>
                <p class="form-group"><textarea name="instructions" class="form-control"></textarea>
                    <span class="error" id="instruction_error">{{__('embroidery_form.special_instructions_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                </p>

            </div>

            <!-- ------------------------Order address details--------------------------- -->
            <div class="tab">
                <div class="embroidery_heading">
                    <h1>Order Address</h1>
                </div>
                <label>{{ __('embroidery_form.salutation') }} <span class="reqiurd">*</span></label>
                <div class="custom-select">
                    <p class="form-group">
                        <select class="form-control" name="Salutation">
                            <option value="">{{ __('embroidery_form.salutation') }}</option>
                            <option value="embroidery_form.mister">{{ __('embroidery_form.mister') }}</option>
                            <option value="embroidery_form.woman">{{ __('embroidery_form.woman') }}</option>
                            <option value="embroidery_form.company">{{ __('embroidery_form.company') }}</option>
                        </select>
                        <span class="error" id="salutation_error">{{__('embroidery_form.salutation_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                    </p>
                </div>
                <label>{{ __('embroidery_form.company') }} <span class="reqiurd">*</span></label>
                <p class="form-group"><input type="text" name="company" class="form-control">
                    <span class="error" id="company_error">{{__('embroidery_form.company_name_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                </p>

                <label>{{ __('embroidery_form.name') }} <span class="reqiurd">*</span></label>
                <p class="form-group"><input type="text" name="full_name" class="form-control">
                    <span class="error" id="name_error">{{__('embroidery_form.name_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                </p>

                <label>{{ __('embroidery_form.address') }} <span class="reqiurd">*</span></label>
                <p class="form-group"><input type="text" name="address" class="form-control">
                    <span class="error" id="address_error">{{__('embroidery_form.address_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                </p>

                <div class="row">
                    <div class="col-6 col-md-3">
                        <label>{{ __('embroidery_form.zip_code') }} <span class="reqiurd">*</span></label>
                        <p class="form-group"><input type="text" name="zip_code" class="form-control">
                            <span class="error" id="zip_error">{{__('embroidery_form.zip_code_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                        </p>
                    </div>

                    <div class="col-6 col-md-9">
                        <label>{{ __('embroidery_form.place') }} <span class="reqiurd">*</span></label>
                        <p class="form-group"><input type="text" name="place" class="form-control">
                            <span class="error" id="place_error">{{__('embroidery_form.place_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                        </p>
                    </div>

                </div>
                <label>{{ __('embroidery_form.VAT_No') }} <span class="reqiurd">*</span></label>
                <p class="form-group"><input type="text" name="vat_no" class="form-control">
                    <span class="error" id="vat_no_error">{{__('embroidery_form.vat_number_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                </p>

                <label>{{ __('embroidery_form.contact') }} <span class="reqiurd">*</span></label>
                <p class="form-group"><input type="text" name="contact_no" class="form-control">
                    <span class="error" id="contact_error">{{__('embroidery_form.contact_number_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                </p>

                <label>{{ __('embroidery_form.email') }} <span class="reqiurd">*</span></label>
                <p class="form-group"><input type="email" name="email" class="form-control">
                    <span class="error" id="email_error">{{__('embroidery_form.email_address_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                </p>

                <label>{{ __('embroidery_form.website') }} <span class="reqiurd">*</span></label>
                <p class="form-group"><input type="text" name="site" class="form-control">
                    <span class="error" id="site_error">{{__('embroidery_form.website_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                </p>

                <label>{{ __('embroidery_form.business_reg_file') }} <span class="reqiurd">*</span></label>
                <p class="form-group"><input type="file" name="address_file" class="form-control" id="address_file">
                    <span class="error" id="address_file_error">{{__('embroidery_form.file_upload_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                </p>


            </div>


            <!-- ---------------Order File Format Details------------------- -->
            <div class="tab">
                <div class="embroidery_heading">
                    <h1>Order File Format</h1>
                </div>

                <label>{{__('embroidery_form.file_format')}} <span class="reqiurd">*</span></label>
                <p class="form-group"><select class="form-control" name="file_format">
                        <option value="">{{__('embroidery_form.select_file_format')}}</option>
                        <option value=".10O">*.10O</option>
                        <option value=".art">*.art</option>
                        <option value=".bx">*.bx</option>
                        <option value=".cnd">*.cnd</option>
                        <option value=".csd">*.csd</option>
                        <option value=".dat">*.date</option>
                        <option value=".dsb">*.dsb</option>
                        <option value=".dst">*.dst</option>
                        <option value=".dsz">*.dsz</option>
                        <option value=".emb">*.emb</option>
                        <option value=".emt">*.emt</option>
                        <option value=".esl">*.esl</option>
                        <option value=".ess">*.ess</option>
                        <option value=".exp">*.exp</option>
                        <option value=".fdr">*.fdr</option>
                        <option value=".fmc">*.fmc</option>
                        <option value=".hus">*.hus</option>
                        <option value=".inb">*.inb</option>
                        <option value=".jan">*.Jan</option>
                        <option value=".jef">*.jef</option>
                        <option value=".ksm">*.ksm</option>
                        <option value=".mjd">*.mjd</option>
                        <option value=".mst">*.mst</option>
                        <option value=".pcd">*.pcd</option>
                        <option value=".pcm">*.pcm</option>
                        <option value=".pcq">*.pcq</option>
                        <option value=".pcs">*.pcs</option>
                        <option value=".pec">*.pec</option>
                        <option value=".pes">*.pes</option>
                        <option value=".sas">*.sas</option>
                        <option value=".sew">*.sew</option>
                        <option value=".shv">*.shv</option>
                        <option value=".t01">*.t01</option>
                        <option value=".t03">*.t03</option>
                        <option value=".t04">*.t04</option>
                        <option value=".t05">*.t05</option>
                        <option value=".t09">*.t09</option>
                        <option value=".t10">*.t10</option>
                        <option value=".t15">*.t15</option>
                        <option value=".tap">*.tap</option>
                        <option value=".tbf">*.tbf</option>
                        <option value=".u">*.u??</option>
                        <option value=".vep">*.vep</option>
                        <option value=".vip">*.vip</option>
                        <option value=".vip3">*.vip3</option>
                        <option value=".vp3">*.vp3</option>
                        <option value=".xxx">*.xxx</option>
                        <option value=".yng">*.yng</option>
                        <option value=".z">*.z??</option>
                    </select>
                    <span class="error" id="f_format_error">{{__('embroidery_form.desired_file_format_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                </p>

                <label>{{__('embroidery_form.view_file')}} <span class="reqiurd">*</span></label>
                <p class="form-group"><select class="form-control custom-select" name="view_file_format">
                        <option value="" selected="selected">{{__('embroidery_form.select_file_format')}}</option>
                        <option value=".pdf">*.pdf</option>
                    </select>
                    <span class="error" id="v_format_error">{{__('embroidery_form.view_file_format_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                </p>

            </div>

            <!-- ---------------Order File Upload Details------------------- -->
            <div class="tab">
                <div class="embroidery_heading">
                    <h1>Order File Upload</h1>
                </div>
                <div class="row">
                    <label class="col-10">{{ __('embroidery_form.file_upload') }} <span class="reqiurd">*</span></label>
                    <button type="button" id="add-file-btn" class="btn btn-outline-success col-2" style="margin:-10px 0px 13px 0px">Additional file</button>
                </div>
                <p id="file-container" style="display: flex; flex-direction:column; gap:18px" class="form-group">
                    <input type="file" name="file_upload[]" class="form-control " multiple id="file_upload">
                    <span class="error" id="file_upload_error">{{__('embroidery_form.upload_file_val')}}<i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                </p>


                <a href="#" id="loading" class="btn btn-outline-primary send-btn loading-btn" style="display:none;border-color: #54b4d3;color: #54b4d3;margin-top: 10px;font-weight: bold;">
                    <span class="loader"></span>
                </a>
                <input type="submit" id="send-btn" value="Submit" class="btn btn-outline-primary send-btn" style="border-color: #54b4d3;color: #54b4d3;margin-top: 10px;font-weight: bold;">
            </div>



            <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                </div>
            </div>
            <!-- Circles which indicates the steps of the form: -->
            <div class="multi-step-nav">

                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>


            </div>
        </form>
    </div>
</section>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("prevBtn").style.display = "none";
            document.getElementById("nextBtn").style.display = "none";
            // document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            // document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("embroideryOrder").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {

        // var errorElements = document.getElementsByClassName("error");
        //   for (var i = 0; i < errorElements.length; i++) {
        //     errorElements[i].style.display = "none";
        //   }

        // This function deals with validation of the form fields
        var x, y, z, a, error, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        z = x[currentTab].getElementsByTagName("select");
        a = x[currentTab].getElementsByTagName("textarea");
        error = x[currentTab].getElementsByClassName("error");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value === "") {
                // add an "invalid" class to the field:
                y[i].classList.add("invalid");
                // errorElements[i].style.display = "block";
                // and set the current valid status to false
                valid = false;
            } else if (y[i].value != "") {
                y[i].classList.remove("invalid");
            }

        }
        // A loop that checks every select element in the current tab:
        for (i = 0; i < z.length; i++) {
            // If a dropdown option is not selected (value is empty)...
            if (z[i].value === "") {
                // add an "invalid" class to the dropdown:
                z[i].classList.add("invalid");
                // errorElements[i].style.display = "block";
                // and set the current valid status to false
                valid = false;
            } else if (z[i].value != "") {
                z[i].classList.remove("invalid");
            }
        }
        for (i = 0; i < a.length; i++) {
            // If a dropdown option is not selected (value is empty)...
            if (a[i].value === "") {
                // add an "invalid" class to the dropdown:
                a[i].classList.add("invalid");
                // errorElements[i].style.display = "block";
                // and set the current valid status to false
                valid = false;
            } else if (a[i].value != "") {
                a[i].classList.remove("invalid");
            }

        }

        const radioOptions = document.getElementsByName('emb_info');
        let isSelected = false;

        // Check if at least one radio option is selected
        for (let i = 0; i < radioOptions.length; i++) {
            if (radioOptions[i].checked) {
                isSelected = true;
                break;
            }
        }

        if (!isSelected) {
            // alert('Please select at least one option.');
            // this.classList.add('invalid');

            const errorSpan = document.getElementById('emb_info_error');
            errorSpan.style.display = 'block';

            return false;
        } else {
            const errorSpan = document.getElementById('emb_info_error');
            errorSpan.style.display = 'none';
        }

        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            // this.classList.remove('invalid');
            // error.style.display = 'none';
            document.getElementsByClassName("step")[currentTab].classList.add("finish");
        }

        return valid; // return the valid status
    }


    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }

    document.addEventListener('DOMContentLoaded', function() {
        const addFileBtn = document.getElementById('add-file-btn');
        const fileContainer = document.getElementById('file-container');

        addFileBtn.addEventListener('click', function() {
            const newInputFile = document.createElement('input');
            newInputFile.type = 'file';
            newInputFile.name = 'file_upload[]';
            newInputFile.className = 'form-control';
            fileContainer.appendChild(newInputFile);
        });
    });

    const form = document.getElementById('embroideryOrder');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Create a new FormData object to hold the form data
        const formData = new FormData(form);

        // alert(formData);
        $.ajax({
                url: "{{__('routes.customer-embroidery-program-submit')}}",
                type: "POST",
                beforeSend: function() {
                    $('#send-btn').hide();
                    $(".loading-btn").show();
                },
                complete: function() {
                    $('#send-btn').show();
                    $(".loading-btn").hide();
                },
                data: formData,
                processData: false,
                contentType: false,
                success:function(response){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        timer: 8000,
                    }).then(() => {

                        location.reload();
                    });
                },
                error:function(error){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Something went wrong.',
                        timer: 8000,
                    })
                }

            });
    });
</script>
@endsection
