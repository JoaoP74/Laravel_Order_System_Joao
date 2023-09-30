<div id="wrapper" class="{{ session()->has('sidebar') ? 'full_height' : '' }}">



    <div id="sidebar-wrapper">
        <ul class="sidebar-nav" style="margin-left:0">
            <li class="sidebar-brand">
                <a href="#menu-toggle" id="menu-toggle" class="q1" style="margin-top: 10px"> <svg aria-hidden="true"
                        style="width:16px" focusable="false" data-prefix="fal" data-icon="arrow-right-to-line"
                        class="svg-inline--fa fa-arrow-right-to-line " role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512">
                        <path fill="currentColor"
                            d="M432 64C423.2 64 416 71.16 416 80v352c0 8.844 7.156 16 16 16s16-7.156 16-16v-352C448 71.16 440.8 64 432 64zM219.3 100.7c-6.25-6.25-16.38-6.25-22.62 0s-6.25 16.38 0 22.62L313.4 240H16C7.156 240 0 247.2 0 256s7.156 16 16 16h297.4l-116.7 116.7c-6.25 6.25-6.25 16.38 0 22.62s16.38 6.25 22.62 0l144-144C366.4 264.2 368 260.1 368 256s-1.562-8.188-4.688-11.31L219.3 100.7z">
                        </path>
                    </svg></a>
                <a href="#menu-toggle" id="menu-toggle" class="q2" style="margin-top: 10px"> <svg aria-hidden="true"
                        style="width:16px" focusable="false" data-prefix="fal" data-icon="arrow-left-to-line"
                        class="svg-inline--fa fa-arrow-left-to-line " role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512">
                        <path fill="currentColor"
                            d="M432 240H134.6l116.7-116.7c6.25-6.25 6.25-16.38 0-22.62s-16.38-6.25-22.62 0l-144 144C81.56 247.8 80 251.9 80 256s1.562 8.188 4.688 11.31l144 144c6.25 6.25 16.38 6.25 22.62 0s6.25-16.38 0-22.62L134.6 272H432C440.8 272 448 264.8 448 256S440.8 240 432 240zM16 64C7.156 64 0 71.16 0 80v352C0 440.8 7.156 448 16 448S32 440.8 32 432v-352C32 71.16 24.84 64 16 64z">
                        </path>
                    </svg> <span class="sidebar-item-text" style="margin-left:5px;">{{ __('home.minimize') }}</span>
                </a>
            </li>

            <li>
                <p lion-pop-id="profile_popup" id="profile_popup1" class="btn btn-demo lion_pop_btn" data-toggle="modal"
                    data-target="#myModal2"><i class="sidebar-icon fa-solid fa-user-tie"></i> <span
                        class="sidebar-item-text"
                        style="margin-left:13px; font-size:12px;">{{ __('home.profile') }}</span></p>
            </li>
            <li>
                <p lion-pop-id="view_order_popup" id="view_order_popup1" class="btn btn-demo lion_pop_btn"
                    data-toggle="modal" data-target="#myModal1"> <i class="sidebar-icon fa-regular fa-newspaper"></i>
                    <span class="sidebar-item-text"
                        style="margin-left:10px; font-size:12px;">{{ __('home.view_orders') }}</span>
                </p>
            </li>
            <li>
                <p lion-pop-id="order_form_em_standard_popup" id="order_form_em_standard_popup1"
                    class="btn btn-demo lion_pop_btn" data-toggle="modal" data-target="#myModal3"> <i
                        class="sidebar-icon fa-solid fa-file-invoice-dollar"></i>
                    <span class="sidebar-item-text"
                        style="margin-left:14px; font-size:12px;">{{ __('home.order_form_em_standard') }}</span>
                </p>
            </li>
            <li>
                <p lion-pop-id="order_form_em_standard_popup" id="order_form_em_standard_popup2"
                    class="btn btn-demo lion_pop_btn" data-toggle="modal" data-target="#myModal4"> <svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-basket3" viewBox="0 0 16 16">
                        <path
                            d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6h-9.21z" />
                    </svg> <span class="sidebar-item-text"
                        style="margin-left:11px; font-size:12px;">{{ __('home.order_form_em_express') }}</span>
                </p>
            </li>
            <li>
                <p lion-pop-id="order_form_em_standard_popup" id="order_form_em_standard_popup3"
                    class="btn btn-demo lion_pop_btn" data-toggle="modal" data-target="#myModal5"> <i
                        class="sidebar-icon fa-solid fa-file-zipper"></i> <span class="sidebar-item-text"
                        style="margin-left:15px; font-size:12px;">{{ __('home.order_form_ve_standard') }}</span> </p>
            </li>
            <li>
                <p lion-pop-id="order_form_em_standard_popup" id="order_form_em_standard_popup4"
                    class="btn btn-demo lion_pop_btn" data-toggle="modal" data-target="#myModal6"> <i
                        class="sidebar-icon fa-solid fa-compass-drafting"></i>
                    <span class="sidebar-item-text"
                        style="margin-left:10px; font-size:12px;">{{ __('home.order_form_ve_express') }}</span>
                </p>
            </li>
            <li>
                <p lion-pop-id="login_information" id="login_information1" class="btn btn-demo lion_pop_btn"
                    data-toggle="modal" data-target="#myModal6"> <i
                        class="sidebar-icon fa-solid fa-compass-drafting"></i>
                    <span class="sidebar-item-text"
                        style="margin-left:10px; font-size:12px;">{{ __('home.login_information') }}</span>
                </p>
            </li>
            <li>
                <div class=" hMBQiH "></div><br>
            </li>
            <li>
                <p lion-pop-id="prices_popup" class="btn btn-demo lion_pop_btn" data-toggle="modal"
                    data-target="#myModal7"> <svg aria-hidden="true" focusable="false" style="width: 18px"
                        data-prefix="fal" data-icon="coins" class="svg-inline--fa fa-coins " role="img"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M168.3 92.78C169.6 93.97 171.2 95.17 172.9 96.36C157.5 96.95 142.5 98.24 128 100.2V80C128 64.75 136.6 52.28 147.4 42.96C158.3 33.58 173.1 25.87 190.1 19.71C224.1 7.338 270 0 320 0C369.1 0 415.9 7.338 449.9 19.71C466.9 25.87 481.7 33.58 492.6 42.96C503.4 52.28 512 64.75 512 80V184V184V297.9C512 313.3 503.8 326.1 492.9 335.9C481.1 345.7 467.1 353.8 450.1 360.3C439.8 364.2 428.3 367.7 416 370.6V337.6C424.2 335.4 431.8 333 438.8 330.4C453.6 324.7 464.5 318.4 471.5 312.1C478.4 305.9 480 301 480 297.9V231.7C471.3 237.3 461.2 242.2 450.1 246.4C439.8 250.3 428.3 253.8 416 256.7V223.7C424.2 221.5 431.8 219.1 438.8 216.5C453.6 210.8 464.5 204.4 471.5 198.2C478.4 191.1 480 187.1 480 184V126.1C471.2 131.6 461 136.3 449.9 140.3C432.6 146.6 412.3 151.6 389.9 154.9C388.1 152.1 386.2 151.2 384.3 149.5C374.2 140.4 362.6 133 350.5 127C385.2 124.7 415.9 118.6 438.1 110.2C453.9 104.8 464.8 98.72 471.7 92.78C478.7 86.79 480 82.42 480 80C480 77.58 478.7 73.21 471.7 67.22C464.8 61.28 453.9 55.2 438.1 49.78C409.3 38.99 367.2 32 320 32C272.8 32 230.7 38.99 201 49.78C186.1 55.2 175.2 61.28 168.3 67.22C161.3 73.21 159.1 77.58 159.1 80C159.1 82.42 161.3 86.79 168.3 92.78L168.3 92.78zM0 208C0 192.7 8.552 180.3 19.4 170.1C30.3 161.6 45.14 153.9 62.08 147.7C96.1 135.3 142 128 192 128C241.1 128 287.9 135.3 321.9 147.7C338.9 153.9 353.7 161.6 364.6 170.1C375.4 180.3 384 192.7 384 208V425.9C384 441.3 375.8 454.1 364.9 463.9C353.1 473.7 339.1 481.8 322.1 488.3C288.1 501.3 242 508.1 192 508.1C141.1 508.1 95.95 501.3 61.85 488.3C44.86 481.8 30.01 473.7 19.12 463.9C8.241 454.1 .0003 441.3 .0003 425.9L0 208zM40.26 220.8C47.17 226.7 58.11 232.8 73.02 238.2C102.7 249 144.8 256 192 256C239.2 256 281.3 249 310.1 238.2C325.9 232.8 336.8 226.7 343.7 220.8C350.7 214.8 352 210.4 352 208C352 205.6 350.7 201.2 343.7 195.2C336.8 189.3 325.9 183.2 310.1 177.8C281.3 166.1 239.2 160 192 160C144.8 160 102.7 166.1 73.02 177.8C58.11 183.2 47.17 189.3 40.26 195.2C33.3 201.2 32 205.6 32 208C32 210.4 33.3 214.8 40.26 220.8V220.8zM321.9 268.3C287.9 280.7 241.1 288 192 288C142 288 96.1 280.7 62.08 268.3C50.98 264.3 40.78 259.5 32 254.1V312C32 315.1 33.61 319.1 40.54 326.2C47.46 332.4 58.39 338.8 73.25 344.5C102.9 355.7 144.8 363 192 363C239.2 363 281.1 355.7 310.8 344.5C325.6 338.8 336.5 332.4 343.5 326.2C350.4 319.1 352 315.1 352 312V254.1C343.2 259.5 333 264.3 321.9 268.3zM40.54 440.1C47.46 446.4 58.39 452.7 73.25 458.4C102.9 469.6 144.8 476.1 192 476.1C239.2 476.1 281.1 469.6 310.8 458.4C325.6 452.7 336.5 446.4 343.5 440.1C350.4 433.9 352 429 352 425.9V359.7C343.3 365.3 333.2 370.2 322.1 374.4C288.1 387.4 242 395 192 395C141.1 395 95.95 387.4 61.85 374.4C50.84 370.2 40.72 365.3 31.1 359.7V425.9C31.1 429 33.61 433.9 40.54 440.1H40.54z">
                        </path>
                    </svg> <span class="sidebar-item-text"
                        style="margin-left:10px; font-size:12px;">{{ __('home.prices') }}</span>
                </p>
            </li>

        </ul>
    </div>




    <div id="profile_popup" class="lion_popup_wrrpr {{ session()->has('sidebar') ? 'active' : '' }}">
        <div class="lion_pop_close"><i class="fa fa-close" aria-hidden="true"> </i></div>
        <div class="lion_popup_dv">
            @if (auth()->user()->user_type == 'admin')
                <x-admin.admin-profile />
            @elseif(auth()->user()->user_type == 'freelancer')
                <x-freelancer.freelancer-profile />
            @elseif(auth()->user()->user_type == 'customer')
                <x-user.customer-profile />
            @elseif(auth()->user()->user_type == 'employer')
                <x-user.employer-profile />
            @endif
        </div>
    </div>

    <div id="view_order_popup" class="lion_popup_wrrpr">
        <div class="lion_pop_close"><i class="fa fa-close" aria-hidden="true"> </i></div>
        <div class="lion_popup_dv">
            @if (auth()->user()->user_type == 'admin')
                <x-admin.vieworders />
            @elseif(auth()->user()->user_type == 'freelancer')
                <x-freelancer.vieworders />
            @elseif(auth()->user()->user_type == 'customer')
                <x-user.vieworders />
            @elseif(auth()->user()->user_type == 'employer')
                <x-user.employer-vieworders />
            @endif
        </div>
    </div>

    <div id="order_form_em_standard_popup" class="lion_popup_wrrpr">
        <div class="lion_pop_close"><i class="fa fa-close" aria-hidden="true"> </i></div>
        <div class="lion_popup_dv">

            @if (auth()->user()->user_type == 'customer')
                <x-user.order_form_em_standard />
            @endif
        </div>
    </div>
    <div id="login_information" class="lion_popup_wrrpr">
        <div class="lion_pop_close"><i class="fa fa-close" aria-hidden="true"> </i></div>
        <div class="lion_popup_dv">

            @if (auth()->user()->user_type == 'customer')
                <x-user.login-information />
            @endif
        </div>
    </div>






</div>

<div class="wrapper_shadow"></div>
