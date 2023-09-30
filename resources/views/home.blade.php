@extends('layout.layout')
@section('content')
    <section id="bn_sec">
        <div class="container-fluid p-0">

            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="5000">
                        <img src="{{ asset('asset/images/image_slide1.jpg') }}" class="d-block custom-width zoomable"
                            alt="CUTTER & BUCK" width="100%" height="600px">
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="{{ asset('asset/images/image_slide2.jpg') }}" class="d-block custom-width zoomable"
                            alt="" width="100%" height="600px">
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="{{ asset('asset/images/image_slide3.jpg') }}" class="d-block custom-width zoomable"
                            alt="CRAFT GRAVELWEAR" width="100%" height="600px">
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="{{ asset('asset/images/image_slide4.jpg') }}" class="d-block custom-width zoomable"
                            alt="UNSERE MARKENKATALOGE" width="100%" height="600px">
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="{{ asset('asset/images/image_slide5.jpg') }}" class="d-block custom-width zoomable"
                            alt="..." width="100%" height="600px">
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="{{ asset('asset/images/image_slide6.jpg') }}" class="d-block custom-width zoomable"
                            alt="HOODIES & SWEATSHIRTS" width="100%" height="600px">
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="{{ asset('asset/images/image_slide7.jpg') }}" class="d-block custom-width zoomable"
                            alt="Softshell Jacken & Westen" width="100%" height="600px">
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="{{ asset('asset/images/image_slide8.jpg') }}" class="d-block custom-width zoomable"
                            alt="Sichtbar. Sicher." width="100%" height="600px">
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="{{ asset('asset/images/image_slide9.jpg') }}" class="d-block custom-width zoomable"
                            alt="CRAFT" width="100%" height="600px">
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="{{ asset('asset/images/image_slide10.jpg') }}" class="d-block custom-width zoomable"
                            alt="CRAFT FOOTWEAR" width="100%" height="600px">
                    </div>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
    </section>
@endsection
