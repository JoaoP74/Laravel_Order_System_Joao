<section class="login_information_section">
    <div class="pagetitle">
        <h1>{{ __('home.right_top_box_name') }}</h1>
        <p></p>
    </div>
    <div class="order_fome_container">
        <fieldset class="field-group row">
            <legend class="field-caption">{{ __('home.right_top_box_name') }}</legend>
            @if (auth()->user()->user_type == 'customer')

                <ul class="nav nav-tabs">
                    <li class="nav-list active"><a class="nav-link" data-toggle="tab"
                            href="#addresses">{{ __('home.contact_person') }}</a></li>
                    {{-- <li class="nav-list"><a class="nav-link" data-toggle="tab" href="#contact_person">{{
                        __('home.contact_person') }}</a>
                </li> --}}
                    {{-- <li class="nav-list"><a class="nav-link" data-toggle="tab" href="#further_information">{{
                        __('home.further_information') }}</a>
                </li> --}}
                </ul>

                <div class="tab-content" style="height: 470px;">
                    <div id="addresses" class="tab-pane fade in active" style="height: 100%">
                        <div class="employee-list-container"
                            style="height: 100%; display:flex; flex-direction:column; justify-content:space-between; align-items:start;">
                            <div class="employee-list" style="width: 100%; font-size:13px">
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
                                                <td colspan="5" class="text-center">No Employee
                                                    found.</td>
                                            </tr>
                                        @else
                                            @foreach ($employees as $d)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $d->email }}</td>
                                                    <td>{{ auth()->user()->name }}
                                                    </td>
                                                    <td>{{ date('d M, Y', strtotime($d->created_at)) }}
                                                    </td>
                                                    <td>
                                                        <div class="d-flex" style="gap:20px;">
                                                            <div>
                                                                <a
                                                                    href='{{ __(' routes.employer-editemployee') . $d->id }}'><i
                                                                        class="fa-solid fa-pen-to-square text-primary"></i></a>
                                                            </div>
                                                            <div><span><i class="fa-solid fa-trash text-danger"
                                                                        onclick="deleteemployee({{ $d->id }})"
                                                                        style="cursor:pointer;"></i></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="employee-top d-flex" style="align-items:flex-end">
                                <div class="submit_btn">
                                    <a href="#invite-employee" data-bs-toggle="modal"
                                        style="background: #c4ae79 !important; color: #fff !important; border: 0; border-radius: 0; font-size: 14px; padding: 5px 10px; width:100px"
                                        class="btn">{{ __('home.add') }}</a>
                                </div>
                                <div class="submit_btn">
                                    <a href="#"
                                        style="background: #c4ae79 !important; color: #fff !important; border: 0; border-radius: 0; font-size: 14px; padding: 5px 10px; width:100px"
                                        class="btn">{{ __('home.edit') }}</a>
                                </div>
                                <div class="submit_btn">
                                    <a href="#"
                                        style="background: #c4ae79 !important; color: #fff !important; border: 0; border-radius: 0; font-size: 14px; padding: 5px 10px; width:100px"
                                        class="btn">{{ __('home.delete') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="contact_person" class="tab-pane fade" style="padding:10px">
                        <h5>Contact Person</h5>
                        <p style="font-size: 13px">Some content in contact person.
                        </p>
                    </div>
                    <div id="further_information" class="tab-pane fade" style="padding:10px">
                        <h5>Further Information</h5>
                        <p style="font-size: 13px">Some content in further
                            information.
                        </p>
                    </div>
                </div>

            @endif
        </fieldset>
    </div>

</section>
