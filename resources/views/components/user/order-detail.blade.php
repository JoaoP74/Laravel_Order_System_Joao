<div class="modal fade" id="order_detail_popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('home.order_detail') }}</h5>
                <button type="button" class="close" style="font-size: 22px" onclick="hideModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container" style="padding: 10px">
                    <div style="padding-bottom: 10px">
                        <input type="hidden" id="detail_id">
                        <div class="row">
                            <div class="col-6">
                                <p><strong>{{ __('home.customer_number') }}:&nbsp&nbsp&nbsp</strong> <span
                                        id="detail_customer_number"></span></p>
                            </div>
                            <div class="col-6">
                                <p><strong>{{ __('home.order_number') }}:&nbsp&nbsp&nbsp</strong> <span
                                        id="detail_order_number"></span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p><strong>{{ __('home.projectname') }}:&nbsp&nbsp&nbsp</strong> <span
                                        id="detail_project_name"></span>
                                </p>
                            </div>
                            <div class="col-6">
                                <p><strong>{{ __('home.size') }}:&nbsp&nbsp&nbsp</strong> <span
                                        id="detail_size"></span><span>
                                        mm </span>&nbsp&nbsp&nbsp<span id="detail_width_height"></span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p><strong>{{ __('home.fianl_product') }}:&nbsp&nbsp&nbsp</strong> <span
                                        id="detail_final_product"></span>
                                </p>
                            </div>
                            <div class="col-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p><strong>{{ __('home.special instructions') }}:&nbsp&nbsp&nbsp</strong> <span
                                        id="detail_special_instructions"></span>
                                </p>
                            </div>
                            <div class="col-6"></div>
                        </div>
                    </div>
                    <div style=" border: 1px solid #ccc; border-radius:5px; display:flex; padding:10px;">
                        <div class="col-3">
                            <ul class="nav nav-tabs flex-column"
                                style="background-color: #fff; width:80%; border-bottom:none; padding-left:0px;">
                                <li class="nav-item" style="height: 50px">
                                    <a id="subfolder_structure1" class="nav-link"><i
                                            class="fa-regular fa-folder-open"></i>
                                        Originaldatei</a>
                                </li>
                                <li class="nav-item" style="height: 50px">
                                    <a id="subfolder_structure2" class="nav-link"><i
                                            class="fa-regular fa-folder-open"></i>
                                        Stickprogramm</a>
                                </li>
                                <li class="nav-item">
                                    <a id="subfolder_structure3" class="nav-link" style="display: flex;">
                                        <i class="fa-regular fa-folder-open"></i>
                                        <div style="margin-top: -5px; margin-left:5px"> Stickprogramm Änderung</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-9 responsive-table">
                            <div style="display: flex; justify-content:flex-end">
                                <button class="btn btn-primary btn-sm" onclick="multipleDownload()"><i
                                        class="fa-solid fa-download"></i>&nbsp&nbsp{{ __('home.all') }}</button>
                            </div>
                            <table id="order_detail" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">
                                            {{ __('home.customer_number') }}</th>
                                        <th style="text-align: center">{{ __('home.order_number') }}</th>
                                        <th style="text-align: center">{{ __('home.index') }}</th>
                                        <th style="text-align: center">{{ __('home.extension') }}</th>
                                        <th style="text-align: center">{{ __('home.download') }}</th>

                                    </tr>
                                </thead>
                                <tbody style="text-align: center"></tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function openOrderDetailModal(id, type) {
        var detail_table;
        $('#detail_id').val(id);
        $.ajax({
            url: '{{ __('routes.customer-get-order-detail') }}',
            type: 'GET',
            data: {
                id
            },
            success: (data) => {
                $('#order_detail_popup').find('#detail_customer_number').text(data.customer_number);
                $('#detail_id').val(data.id);
                $('#order_detail_popup').find('#detail_order_number').text(data.order_number);
                $('#order_detail_popup').find('#detail_project_name').text(data.project_name);
                $('#order_detail_popup').find('#detail_size').text(data.size);
                $('#order_detail_popup').find('#detail_width_height').text(data.width_height);
                $('#order_detail_popup').find('#detail_final_product').text(data.products);
                $('#order_detail_popup').find('#detail_special_instructions').text(data
                    .special_instructions);
            },
            error: () => {
                console.error('err');
            }
        })
        detail_table = $('#order_detail').DataTable({
            responsive: true,
            language: {

            },
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ __('routes.customer-order_detail') }}",
                data: function(d) {
                    d.id = id;
                    d.type = type;
                }
            },

            columns: [{
                    data: 'customer_number',
                    name: 'customer_number'
                },

                {
                    data: 'order_number',
                    name: 'order_number'
                },

                {
                    data: 'index',
                    name: 'index'
                },

                {
                    data: 'extension',
                    name: 'extension'
                },

                {
                    data: 'download',
                    name: 'download',
                    orderable: false,
                    searchable: false
                },

            ]
        });
        $('#order_detail_popup').modal("show");
        detail_table.destroy();
    }

    function multipleDownload() {
        window.location.href = '{{ url('multi-download') }}/' + $('#detail_id').val();
    }

    $('#subfolder_structure1').click(function() {
        openOrderDetailModal($('#detail_id').val(), 'Originaldatei');
    });
    $('#subfolder_structure2').click(function() {
        openOrderDetailModal($('#detail_id').val(), 'Stickprogramm');
    });
    $('#subfolder_structure3').click(function() {
        openOrderDetailModal($('#detail_id').val(), 'Stickprogramm Änderung');
    });
</script>
