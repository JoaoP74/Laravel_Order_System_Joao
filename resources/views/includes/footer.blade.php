@stack('custom-script')
<script>
    $(document).on("change", ".uploadProfileInput", function() {
        var triggerInput = $(this);
        console.log(triggerInput);
        var currentImg = $(this).closest(".pic-holder").find(".pic").attr("src");
        var holder = $(this).closest('.profile-pic-wrapper').find(".pic-holder");
        var wrapper = $(this).closest(".profile-pic-wrapper");
        $(wrapper).find('[role="alert"]').remove();
        triggerInput.blur();
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            return;
        }
        if (/^image/.test(files[0].type)) {
            // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function() {
                $(holder).addClass("uploadInProgress");
                $(holder).find(".pic").attr("src", this.result);
                $(holder).append(
                    '<div class="upload-loader"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>'
                );

                // Dummy timeout; call API or AJAX below
                setTimeout(() => {
                    $(holder).removeClass("uploadInProgress");
                    $(holder).find(".upload-loader").remove();
                    // If upload successful
                    if (Math.random() < 0.9) {
                        $(wrapper).append(
                            '<div class="snackbar show" role="alert"><i class="fa fa-check-circle text-success"></i> Profile image updated successfully</div>'
                        );

                        // Clear input after upload
                        // $(triggerInput).val("");

                        setTimeout(() => {
                            $(wrapper).find('[role="alert"]').remove();
                        }, 3000);
                    } else {
                        $(holder).find(".pic").attr("src", currentImg);
                        $(wrapper).append(
                            '<div class="snackbar show" role="alert"><i class="fa fa-times-circle text-danger"></i> There is an error while uploading! Please try again later.</div>'
                        );

                        // Clear input after upload
                        $(triggerInput).val("");
                        setTimeout(() => {
                            $(wrapper).find('[role="alert"]').remove();
                        }, 3000);
                    }
                }, 1500);
            };
        } else {
            $(wrapper).append(
                '<div class="alert alert-danger d-inline-block p-2 small" role="alert">Please choose the valid image.</div>'
            );
            setTimeout(() => {
                $(wrapper).find('role="alert"').remove();
            }, 3000);
        }
    });
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert").alert('close');
        }, 3000);
    });
</script>
<footer>
    <div class="footer_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <ul class="copyright_list">
                        <li>
                            <p>© Lion Advertising GmbH | We advertise. Strong as a lion. All rights reserved.</p>
                        </li>
                    </ul>
                </div>

                <div class="col-md-5 col-sm-12">
                    <ul class="copyright_list" style="justify-content: end">
                        <li>
                            <a href="">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="">imprint</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>


{{-- <script>
    $("#order_file_upload").change(function(e) {
        var files = e.target.files;
        var data = new FormData();

        for (var i in files) {
            if (i < files.length) {
                data.append(i, files[i]);
            }
        }

        $.ajax({
            url: '{{ route('upload') }}',
            type: 'POST',
            contentType: false,
            processData: false,
            data: data,
            xhr: () => {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        $('#order_progress').removeClass('reqiurd');
                        $('#order_progress').text('Uploading ' + percentComplete + '%...');
                    }
                }, false);
                return xhr;
            },
            success: () => {
                $('#order_progress').text('{{ __('home.Files are successfully uploaded') }}');
                table.ajax.reload();
            },
            error: () => {
                $('#order_progress').addClass('reqiurd');
                $('#order_progress').text('{{ __('home.Files uploading failed') }}');
                console.error("error!");
            }
        });
    });
</script> --}}

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
      {% for (var i=0, file; file=o.files[i]; i++) { %}
          <tr class="template-upload fade{%=o.options.loadImageFileTypes.test(file.type)?' image':''%}">
              <td>
                  <span class="preview"></span>
              </td>
              <td>
                  <p class="name">{%=file.name%}</p>
                  <strong class="error text-danger"></strong>
              </td>
              <td>
                  <p class="size">Processing...</p>
                  <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
              </td>
              <td>
                  {% if (!o.options.autoUpload && o.options.edit && o.options.loadImageFileTypes.test(file.type)) { %}
                    <button class="btn btn-success edit" data-index="{%=i%}" disabled>
                        <i class="glyphicon glyphicon-edit"></i>
                        <span>Edit</span>
                    </button>
                  {% } %}
                  {% if (!i && !o.options.autoUpload) { %}
                      <button class="btn btn-primary start" disabled>
                          <i class="glyphicon glyphicon-upload"></i>
                          <span style="font-size:13px;">Start</span>
                      </button>
                  {% } %}
                  {% if (!i) { %}
                      <button class="btn btn-warning cancel">
                          <i class="glyphicon glyphicon-ban-circle"></i>
                          <span style="font-size:13px;">Cancel</span>
                      </button>
                  {% } %}
              </td>
          </tr>
      {% } %}
    </script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
      {% for (var i=0, file; file=o.files[i]; i++) { %}
          <tr class="template-download fade{%=file.thumbnailUrl?' image':''%}">
              <td>
                  <span class="preview">
                      {% if (file.thumbnailUrl) { %}
                          <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                      {% } %}
                  </span>
              </td>
              <td>
                  <p class="name">
                      {% if (file.url) { %}
                          <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                      {% } else { %}
                          <span>{%=file.name%}</span>
                      {% } %}
                  </p>
                  {% if (file.error) { %}
                      <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                  {% } %}
              </td>
              <td>
                  <span class="size">{%=o.formatFileSize(file.size)%}</span>
              </td>
              <td>
                  {% if (file.deleteUrl) { %}
                      <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                          <i class="glyphicon glyphicon-trash"></i>
                          <span>Delete</span>
                      </button>
                      <input type="checkbox" name="delete" value="1" class="toggle">
                  {% } else { %}
                      <button class="btn btn-warning cancel">
                          <i class="glyphicon glyphicon-ban-circle"></i>
                          <span>Cancel</span>
                      </button>
                  {% } %}
              </td>
          </tr>
      {% } %}
    </script>
<script>
    $(function() {
        // checkbox fileds in select products
        $('.product-item-menu').hide();
        var products = [];
        var inputValues = [];

        var popup = '#order_form_em_standard_popup';
        var typeInput = $('[name=type]');
        var deliverTimeInput = $('[name=deliver_time]');

        $('#order_form_em_standard_popup1').click(function() {
            typeInput.val('Embroidery');
            deliverTimeInput.val('STANDARD');
            inputValues = [];
            popup = '#' + $(this).attr('lion-pop-id');
            $('#order_form_title').text('{{ __('home.orderform_title') }}');
            $('#order_form_size').css("display", "block");
            $('#order_form_products').css("display", "block");
            $('#order_form_anotherOrderButton').trigger('click');
            $('.order_form_validation_projectname').hide();
            $('[name=project_name]').css("border", "1px solid #ccc");
            $('.order_form_validation_size').hide();
            $('[name=size]').css("border", "1px solid #ccc");
            $('.order_form_validation_products').hide();
            $('#selected_products').css("border", "1px solid #ccc");
            $('#selected_products').text("");
            $('.order_form_file_upload').hide();

        });
        $('#order_form_em_standard_popup2').click(function() {
            typeInput.val('Embroidery');
            deliverTimeInput.val('EXPRESS');
            inputValues = [];
            popup = '#' + $(this).attr('lion-pop-id');
            $('#order_form_title').text('{{ __('home.express_head_title') }}');
            $('#order_form_size').css("display", "block");
            $('#order_form_products').css("display", "block");
            $('#order_form_anotherOrderButton').trigger('click');
            $('.order_form_validation_projectname').hide();
            $('[name=project_name]').css("border", "1px solid #ccc");
            $('.order_form_validation_size').hide();
            $('[name=size]').css("border", "1px solid #ccc");
            $('.order_form_validation_products').hide();
            $('#selected_products').css("border", "1px solid #ccc");
            $('#selected_products').text("");
            $('.order_form_file_upload').hide();

        });
        $('#order_form_em_standard_popup3').click(function() {
            typeInput.val('Vector');
            deliverTimeInput.val('STANDARD');
            inputValues = [];
            popup = '#' + $(this).attr('lion-pop-id');
            $('#order_form_title').text('{{ __('home.vecotr_standard_head_title') }}');
            $('#order_form_size').css("display", "none");
            $('#order_form_products').css("display", "none");
            $('#order_form_anotherOrderButton').trigger('click');
            $('.order_form_validation_projectname').hide();
            $('[name=project_name]').css("border", "1px solid #ccc");
            $('.order_form_file_upload').hide();
            $('[name=size]').val("24");
            $('#selected_products').text("No Products");
            console.log($('[name=size]').val(), $('#selected_products').text());
        });
        $('#order_form_em_standard_popup4').click(function() {
            typeInput.val('Vector');
            deliverTimeInput.val('EXPRESS');
            inputValues = [];
            popup = '#' + $(this).attr('lion-pop-id');
            $('#order_form_title').text('{{ __('home.vecotr_express_head_title') }}');
            $('#order_form_size').css("display", "none");
            $('#order_form_products').css("display", "none");
            $('#order_form_anotherOrderButton').trigger('click');
            $('.order_form_validation_projectname').hide();
            $('[name=project_name]').css("border", "1px solid #ccc");
            $('.order_form_file_upload').hide();
            $('[name=size]').val("24");
            $('#selected_products').text("No Products");
        });

        $('.product-select-items input[type=checkbox]').change(function() {
            products = [];
            $('.product-select-items').find('input[type=checkbox]:checked').each(function() {
                products.push($(this).val());
            });
            products = products.concat(inputValues);
            $('#selected_products').text(products.join(', '));
            $('[name=products]').val(products.join(', '));
        });

        $(popup).find('#order_submit_form').submit(function(e) {
            console.log('submitted');
            e.preventDefault();
            $('.product-items-menu').show();
        });
        //manual input fiels in multi select
        $('#manualInput').keyup(function(e) {
            var inputValue = $(this).val().trim();
            if (e.key == "Enter") {
                if (inputValue !== '') {
                    products.push(inputValue);
                    inputValues.push(inputValue);
                    $('#selected_products').text(products.join(', '));
                    $('[name=products]').val(products.join(', '));
                    $('#manualInput').val('');
                }
            }
            $('.product-item-menu').show();
        });

        // $('#clear_all_selected').click(function() {
        //     products = [];
        //     $('#selected_products').text('');
        //     $('[name=products]').val('');
        // });

        $('.product-multiselect.dropdown-toggle').click(function() {
            if ($('.product-item-menu').css("display") === "none") {
                $('.product-item-menu').show();
            } else if ($('.product-item-menu').css("display") === "block") {
                $('.product-item-menu').hide();
            }
        });

        $(document).mouseup(function(event) {
            var container = $('.product-item-menu');
            // Check if the clicked element is outside the modal
            if (!container.is(event.target) &&
                container.has(event.target).length === 0 &&
                $('.product-item-menu').css("display") === "block") {
                // Hide the modal
                container.hide();
            }
        });
        //cancel button in muti select dropdown
        $('#close_project_menu').click(function() {
            $('.product-item-menu').hide();
        })

        //another order button
        $('#order_form_anotherOrderButton').click(function() {
            $('#order_form_success_popup').modal('hide');
            $('.order_form_input').val('');
            $('#selected_products').text('');
            $('[name=products]').val('');
            products = [];
            $('#order_form_textarea').val('');
            $('#fileupload').val('');
            $('.template-upload').remove();
            $('.order_form_anotherOrder').hide();
            $('.product-select-items input[type=checkbox]').prop('checked', false);
        });
        //order form submit button
        $('.order_form_submit').click(function() {
            console.log(popup);
            var data = new FormData();
            data.append('project_name', $('[name=project_name]').val());
            data.append('size', $('[name=size]').val());
            data.append('width_height', $('[name=width_height]:checked').val());
            data.append('products', $('[name=products]').val());
            data.append('special_instructions', $('[name=special_instructions]').val());
            data.append('type', typeInput);
            data.append('deliver_time', deliverTimeInput);
            console.log(typeInput.val(), deliverTimeInput.val());
        });
        //validation
        $('.order_form_submit').click(function(e) {
            e.preventDefault();

            // if (($('[name=project_name]').val() != "") && ($(
            //         '[name=size]').val() != "") && ($('#selected_products')
            //         .text() != "") && ($('#order_form_upload_list tr th').length == 0)) {
            $('.fileupload-buttonbar .start').trigger('click');
            // }

            if ($('[name=project_name]').val() == "") {
                $('.order_form_validation_projectname').show();
                $('[name=project_name]').css("border", "1px solid red");
            }
            if ($('[name=size]').val() == "") {
                $('.order_form_validation_size').show();
                $('[name=size]').css("border", "1px solid red");
            }
            if ($('#selected_products').text() == "") {
                $('.order_form_validation_products').show();
                $('#selected_products').css("border", "1px solid red");
            }
            if ($('#order_form_upload_list tr').length == 0) {
                $('.order_form_file_upload').show();
            }
        });
        $("[name=project_name]").keyup(function(e) {
            if ($(this).val() != "") {
                $('.order_form_validation_projectname').hide();
                $('[name=project_name]').css("border", "1px solid #ccc");
            }
        });
        $("#input_number_format").keyup(function(e) {
            if ($(this).val() != "") {
                $('.order_form_validation_size').hide();
                $('[name=size]').css("border", "1px solid #ccc");
            }
        });
        $('.product-multiselect').click(function(e) {
            $('.order_form_validation_products').hide();
            $('#selected_products').css("border", "1px solid #ccc");
        })
        $('.fileinput-button').click(function(e) {
            $('.order_form_file_upload').hide();
        })

        // validation size field
        $("#input_number_format").keyup(function(e) {
            if ($(this).val().match(/^[0-9]+$/))
                return;
            else
                $(this).val('');
        });
    });
</script>
