@php
    $serial = 1;
@endphp
<style>
    * {
        box-sizing: border-box;
    }

    .order_form_input,
    textarea,
    .ms-options-wrap>button,
    .ms-options-wrap>button:focus {
        width: 100%;
        height: 50px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .ms-options-wrap * {
        font-size: 16px;
    }

    .ms-res-ctn {
        top: 100%;
        left: 0;
    }

    .order_form_lavel {
        padding: 12px 12px 12px 0;
        display: inline-block;
    }

    .order_form_submit {
        background-color: #04AA6D;
        color: white;
        padding: 10px 14px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 300px;
        float: right;
    }

    .order_form_submit_em_ex {
        background-color: #04AA6D;
        color: white;
        padding: 10px 14px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 300px;
        float: right;
    }

    .dropdown-toggle.product-multiselect {
        height: 50px;
    }

    .dropdown-toggle.product-multiselect_em_ex {
        height: 50px;
    }

    .dropdown-toggle.product-multiselect div {
        max-width: 100%;
        overflow-y: visible;
        text-wrap: wrap;
        width: 100%;
        min-height: 100%;
        background-color: #fff;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .dropdown-toggle.product-multiselect_em_ex div {
        max-width: 100%;
        overflow-y: visible;
        text-wrap: wrap;
        width: 100%;
        min-height: 100%;
        background-color: #fff;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .dropdown-toggle.product-multiselect::after {
        display: none;
    }

    .dropdown-toggle.product-multiselect_em_ex::after {
        display: none;
    }

    .order_form_submit:hover {
        background-color: #45a049;
    }

    .order_form_submit_em_ex:hover {
        background-color: #45a049;
    }


    .col-20 {
        float: left;
        width: 20%;
        margin-top: 6px;
    }

    .col-80 {
        float: left;
        width: 80%;
        margin-top: 6px;
    }

    .col-lg-7 {
        flex: 0 0 auto;
        width: 100%;
        margin-top: 10px;
    }

    /* Clear floats after the columns */
    .row::after {
        content: "";
        display: table;
        clear: both;
    }

    .order_form_check_label {
        margin-left: 10px;
        margin-top: -4px;
    }

    .ms-options-wrap>.ms-options>ul input[type="checkbox"] {
        margin: auto 5px auto 0;
        position: static;
    }

    .ms-ctn .ms-sel-ctn {
        margin-left: -7px;
        padding-left: 10px;
    }

    .ms-ctn .ms-trigger .ms-trigger-ico {
        display: inline-block;
        width: 0;
        height: 0;
        vertical-align: bottom;
        border-top: 4px solid #333;
        border-right: 4px solid transparent;
        border-left: 4px solid transparent;
        content: "";
        margin-left: 8px;
        margin-top: 15px;
    }

    .ms-res-ctn .ms-res-item {
        line-height: 25px;
        text-align: left;
        padding: 2px 15px;
        color: #666;
        cursor: pointer;
    }

    .clear-products-button {
        position: absolute;
        right: 10px;
        top: 0;
        height: 100%;
        border: none;
        background-color: transparent;
    }

    .product-item-menu {
        position: absolute;
        z-index: 1000;
        display: none;
        min-width: 10rem;
        padding: 0.5rem 0;
        margin: 0;
        font-size: 1rem;
        color: #212529;
        text-align: left;
        list-style: none;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, .15);
        border-radius: 0.25rem;
    }

    .product-item-menu_em_ex {
        position: absolute;
        z-index: 1000;
        display: none;
        min-width: 10rem;
        padding: 0.5rem 0;
        margin: 0;
        font-size: 1rem;
        color: #212529;
        text-align: left;
        list-style: none;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, .15);
        border-radius: 0.25rem;
    }

    .order_form_file_uplaod_command {
        color: #04AA6D;
        text-align: center;
        font-size: 20px;
    }

    #order_form_anotherOrderButton {
        background-color: #04AA6D;
        color: white;
        padding: 10px 14px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 300px;
        float: right;
        margin-top: 50px;
        margin-right: 160px;
        font-size: 13px
    }

    #order_form_anotherOrderButton:hover {
        background-color: #45a049;
    }

    .btn-success {
        color: #fff;
        background-color: #aaa;
        border: none;
    }

    .btn-warning {
        color: white;
        background-color: #aaa;
        border: none;
    }

    .order_form_validation_deliver_time,
    .order_form_validation_projectname,
    .order_form_validation_size,
    .order_form_validation_products,
    .order_form_file_upload {
        color: red;
        font-style: italic;
        font-size: 13px;
        display: none;
        margin-bottom: 10px;
    }


    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {

        .col-25,
        .col-75 {
            width: 100%;
            margin-top: 0;
        }
    }
</style>
<section class="order_form_section">
    <div class="pagetitle">
        <h1 id="order_form_title">{{ __('home.orderform_title') }}</h1>
        <p></p>
    </div>
    <div class="order_fome_container">
        <form id="order_submit_form" action="" style="font-size: 13px;">
            <input type="hidden" name="type">
            <input type="hidden" name="deliver_time">
            <div class="row">
                <div class="col-20">
                    <label class="order_form_lavel" for="projectname">{{ __('home.projectname') }}: <span
                            class="reqiurd">*</span></label>
                </div>
                <div class="col-80">
                    <input type="text" class="order_form_input" name="project_name"
                        placeholder="{{ __('home.order_form-projectname_placeholder') }}">
                    <div class="order_form_validation_projectname">
                        {{ __('home.validation_project_name') }}
                    </div>
                </div>
            </div>
            <div class="row" id="order_form_size">
                <div class="col-20">
                    <label class="order_form_lavel" for="size">{{ __('home.size') }}: <span
                            class="reqiurd">*</span></label>
                </div>
                <div class="col-80">
                    <div style="display: flex">
                        <div style="display: flex;">
                            <input type="text" class="order_form_input" id="input_number_format" name="size"><span
                                style="margin-left:13px; margin-top:13px;">mm</span>
                        </div>
                        <div style="margin-left:100px">
                            <div class="input-group">
                                <input type="radio" id="order_form_width" name="width_height" value="Breite" checked>
                                <label class="order_form_lavel" style="margin-left: 5px;"
                                    for="Width">{{ __('home.width') }}</label>
                                <input type="radio" id="order_form_heght" name="width_height" value="Höhe">
                                <label class="order_form_lavel" style="margin-left: 5px;"
                                    for="Height">{{ __('home.height') }}</label>
                            </div>

                        </div>
                    </div>

                    <div class="order_form_validation_size">
                        {{ __('home.validation_size') }}
                    </div>
                </div>


            </div>

            <input type="hidden" name="products">
            <div class="row" id="order_form_products">
                <div class="col-20">
                    <label class="order_form_lavel" for="projectname">{{ __('home.fianl_product') }}: <span
                            class="reqiurd">*</span></label>
                </div>
                <div class="col-80">
                    <div class="dropdown">
                        <div class="product-multiselect dropdown-toggle" href="#">
                            <div id="selected_products" style="padding: 12px">

                            </div>
                        </div>
                        <div class="product-item-menu" style="width:100%; padding:15px;">
                            <div class="row product-select-items" style="font-size: 13px;">
                                <div class="col-20">
                                    <div>
                                        <input type="checkbox" value="{{ __('home.working pants') }}" name="example" />
                                        {{ __('home.working pants') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.working jackets') }}"
                                            name="example" />
                                        {{ __('home.working jackets') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.cotton bag') }}" name="example" />
                                        {{ __('home.cotton bag') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.canvas') }}" name="example" />
                                        {{ __('home.canvas') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.caps') }}" name="example" />
                                        {{ __('home.caps') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.blanket') }}" name="example" />
                                        {{ __('home.blanket') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.felt') }}" name="example" />
                                        {{ __('home.felt') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.felt hats') }}" name="example" />
                                        {{ __('home.felt hats') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.fleece') }}" name="example" />
                                        {{ __('home.fleece') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.fleece scarf') }}"
                                            name="example" />
                                        {{ __('home.fleece scarf') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.frottee') }}" name="example" />
                                        {{ __('home.frottee') }}
                                    </div>
                                </div>
                                <div class="col-20">
                                    <div>
                                        <input type="checkbox" value="{{ __('home.dishtowels') }}" name="example" />
                                        {{ __('home.dishtowels') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.towels') }}" name="example" />
                                        {{ __('home.towels') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.dress shirt') }}"
                                            name="example" />
                                        {{ __('home.dress shirt') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.jacket') }}" name="example" />
                                        {{ __('home.jacket') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.jeans jacket') }}"
                                            name="example" />
                                        {{ __('home.jeans jacket') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.tunics') }}" name="example" />
                                        {{ __('home.tunics') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.overall') }}" name="example" />
                                        {{ __('home.overall') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.chef jacket') }}"
                                            name="example" />
                                        {{ __('home.chef jacket') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.dungarees') }}" name="example" />
                                        {{ __('home.dungarees') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.baby bib') }}" name="example" />
                                        {{ __('home.baby bib') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.leather') }}" name="example" />
                                        {{ __('home.leather') }}
                                    </div>
                                </div>
                                <div class="col-20">
                                    <div>
                                        <input type="checkbox" value="{{ __('home.leather shoes') }}"
                                            name="example" />
                                        {{ __('home.leather shoes') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.linen fabric') }}"
                                            name="example" />
                                        {{ __('home.linen fabric') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.loden fabric') }}"
                                            name="example" />
                                        {{ __('home.loden fabric') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.knitted hat') }}"
                                            name="example" />
                                        {{ __('home.knitted hat') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.work overall') }}"
                                            name="example" />
                                        {{ __('home.work overall') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.patch') }}" name="example" />
                                        {{ __('home.patch') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.patch material') }}"
                                            name="example" />
                                        {{ __('home.patch material') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.plush') }}" name="example" />
                                        {{ __('home.plush') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.polo') }}" name="example" />
                                        {{ __('home.polo') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.backback') }}" name="example" />
                                        {{ __('home.backback') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.sauna coat') }}" name="example" />
                                        {{ __('home.sauna coat') }}
                                    </div>
                                </div>
                                <div class="col-20">

                                    <div>
                                        <input type="checkbox" value="{{ __('home.saddle cloth') }}"
                                            name="example" />
                                        {{ __('home.saddle cloth') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.chef apron') }}" name="example" />
                                        {{ __('home.chef apron') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.silk') }}" name="example" />
                                        {{ __('home.silk') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.napkins') }}" name="example" />
                                        {{ __('home.napkins') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.socks') }}" name="example" />
                                        {{ __('home.socks') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.softshell') }}" name="example" />
                                        {{ __('home.softshell') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.quilted vest') }}"
                                            name="example" />
                                        {{ __('home.quilted vest') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.baby body') }}" name="example" />
                                        {{ __('home.baby body') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.knitted jackets') }}"
                                            name="example" />
                                        {{ __('home.knitted jackets') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.knitted material') }}"
                                            name="example" />
                                        {{ __('home.knitted material') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.knitted sweat') }}"
                                            name="example" />
                                        {{ __('home.knitted sweat') }}
                                    </div>
                                </div>
                                <div class="col-20">
                                    <div>
                                        <input type="checkbox" value="{{ __('home.knit headband') }}"
                                            name="example" />
                                        {{ __('home.knit headband') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.sweatshirt') }}" name="example" />
                                        {{ __('home.sweatshirt') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.bags') }}" name="example" />
                                        {{ __('home.bags') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.tablecloths') }}"
                                            name="example" />
                                        {{ __('home.tablecloths') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.trainingsjackets') }}"
                                            name="example" />
                                        {{ __('home.trainingsjackets') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.jersey') }}" name="example" />
                                        {{ __('home.jersey') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.t-shirt') }}" name="example" />
                                        {{ __('home.t-shirt') }}
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.vest') }}" name="example" />
                                        {{ __('home.vest') }}
                                    </div>
                                    <div>
                                        <input id="manualInput" class="order_form_input" type="text"
                                            placeholder="{{ __('home.manual_input') }}"
                                            style="height:30px; margin: 10px 0; ">
                                    </div>
                                    <div>
                                        <input type="checkbox" value="{{ __('home.Not specified') }}"
                                            name="example" />
                                        {{ __('home.Not specified') }}
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: flex-end; margin-top: 20px">
                                    <button type="button" id="close_project_menu" class="btn btn-secondary "
                                        style="width:200px; height: 30px; padding: 0; font-size:13px;glyphicon glyphicon-upload">{{ __('home.close') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order_form_validation_products">
                        {{ __('home.validation_products') }}
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-20">
                    <label class="order_form_lavel"
                        for="special_instructions">{{ __('home.special instructions') }}:</label>
                </div>
                <div class="col-80">
                    <textarea id="order_form_textarea" name="special_instructions"
                        placeholder="{{ __('home.order_form_textarea_placeholder') }}" style="height:200px"></textarea>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-20">
                    <label class="order_form_lavel" for="">{{ __('home.data_upload') }}:</label><span
                        class="reqiurd">*</span>
                </div>
                <div class="col-80">
                    <!-- The file upload form used as target for the file upload widget -->
                    <div id="fileupload" action="" method="POST" enctype="multipart/form-data">
                        <!-- Redirect browsers with JavaScript disabled to the origin page -->
                        <noscript><input type="hidden" name="redirect" value="" /></noscript>
                        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                        <div class="row fileupload-buttonbar">
                            <div class="col-lg-7">
                                <!-- The fileinput-button span is used to style the file input field as button -->
                                <span class="btn btn-success fileinput-button">
                                    <i class="glyphicon glyphicon-plus"></i>
                                    <span style="font-size: 13px;">{{ __('home.add_file') }}...</span>
                                    <input type="file" name="files[]" multiple
                                        accept=".jpg, .png, .pdf, .ai, .dst" />
                                </span>
                                <button type="submit" class="btn btn-primary start" style="visibility: hidden;">
                                    <i class="glyphicon glyphicon-upload"></i>
                                    <span>Start Upload</span>
                                </button>
                                <button type="reset" class="btn btn-warning cancel" style="margin-left: -120px">
                                    <i class="glyphicon glyphicon-ban-circle"></i>
                                    <span style="font-size: 13px;">{{ __('home.cancel_upload') }}</span>
                                </button>
                                <!-- The global file processing state -->
                                <span class="fileupload-process"></span>
                            </div>
                            <div class="order_form_file_upload">
                                {{ __('home.validation_file_upload') }}
                            </div>
                            <!-- The global progress state -->
                            <div class="col-lg-5 fileupload-progress fade">
                                <!-- The global progress bar -->
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                    aria-valuemax="100">
                                    <div class="progress-bar progress-bar-success" style="width: 0%;"></div>
                                </div>
                                <!-- The extended global progress state -->
                                <div class="progress-extended">&nbsp;</div>
                            </div>
                        </div>
                        <!-- The table listing the files available for upload/download -->
                        <table role="presentation" class="table table-striped" id="order_form_upload_list">
                            <tbody class="files"></tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="row" style="display: flex; justify-content:flex-end">
                <div>
                    <button type="button" class="order_form_submit">{{ __('home.submit') }}</button>
                </div>
            </div>
        </form>

    </div>

</section>
@include('components.user.order_form_success')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
