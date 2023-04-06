@extends('layouts.main')

@section('content')
    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="display-1 text-uppercase text-dark mb-lg-4">Pet Shop</h1>
                    <h1 class="text-uppercase text-white mb-lg-4">Make Your Pets Happy</h1>
                    <p class="fs-4 text-white mb-lg-4">The pet dog food website is an online platform that offers a range of
                        high-quality and nutritious dog food products for pet owners.</p>
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-start pt-5">
                        <a href="" class="btn btn-outline-light border-2 py-md-3 px-md-5 me-5">Read More</a>
                        <button type="button" class="btn-play" data-bs-toggle="modal"
                            data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                            <span></span>
                        </button>
                        <h5 class="font-weight-normal text-white m-0 ms-4 d-none d-sm-block">Play Video</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Video Modal Start -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe class="embed-responsive-item" src="" id="video" allowfullscreen
                            allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video Modal End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded" src="{{ asset('images/about.jpg') }}"
                            style="object-fit:cov">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="border-start border-5 border-primary ps-5 mb-5">
                        <h6 class="text-primary text-uppercase">About Us</h6>
                        <h1 class="display-5 text-uppercase mb-0">We Keep Your Pets Happy All Time</h1>
                    </div>
                    <h4 class="text-body mb-4">Our website offers a variety of high-quality and nutritious dog food products
                        that can meet the specific dietary needs of your pets.</h4>
                    <div class="bg-light p-4">
                        <ul class="nav nav-pills justify-content-between mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item w-50" role="presentation">
                                <button class="nav-link text-uppercase w-100 active" id="pills-1-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-1" type="button" role="tab" aria-controls="pills-1"
                                    aria-selected="true">Our Mission</button>
                            </li>
                            <li class="nav-item w-50" role="presentation">
                                <button class="nav-link text-uppercase w-100" id="pills-2-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-2" type="button" role="tab" aria-controls="pills-2"
                                    aria-selected="false">Our Vission</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-1" role="tabpanel"
                                aria-labelledby="pills-1-tab">
                                <p class="mb-0">Our mission is to provide pet owners with high-quality and nutritious pet
                                    food products that can improve the health and well-being of their pets. We strive to
                                    educate and empower pet owners with the knowledge and resources needed to make informed
                                    decisions about their pet's diet.</p>
                            </div>
                            <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                                <p class="mb-0">Our vision is to be a leading provider of premium pet food products that
                                    are made with the finest ingredients and backed by scientific research. We aim to
                                    inspire pet owners to prioritize their pet's nutrition and to create a world where all
                                    pets are healthy, happy, and well-nourished.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->



    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
                <h6 class="text-primary text-uppercase">Products</h6>
                <h1 class="display-5 text-uppercase mb-0">Products For Your Best Friends</h1>
            </div>
            <div class="owl-carousel product-carousel">
                @foreach ($products as $product)
                    <div class="pb-5">
                        <div class="product-item position-relative bg-light d-flex flex-column text-center">
                            <img class="img-fluid mb-4" src="{{ asset('images/' . $product->image) }}" alt="">
                            <h6 class="text-uppercase">{{ $product->name }}</h6>
                            @if ($product->sale_price != null)
                                <h5 class="text-primary mb-0">{{ $product->sale_price }}</h5>
                                <h5 class="text-primary mb-0" style="text-decoration: line-through;">
                                    ${{ $product->price }}</h5>
                            @else
                                <h5 class="text-primary mb-0">${{ $product->price }}</h5>
                            @endif

                            <div class="btn-action d-flex justify-content-center">

                                <form method="POST" action="{{ route('add_to_cart') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <input type="hidden" name="name" value="{{ $product->name }}">
                                    <input type="hidden" name="price" value="{{ $product->price }}">
                                    <input type="hidden" name="sale_price" value="{{ $product->sale_price }}">
                                    <input type="hidden" name="image" value="{{ $product->image }}">
                                    <input type="hidden" name="quantity" value="1">

                                    <button class="btn btn-primary py-2 px-3" type="submit"><i
                                            class="bi bi-cart"></i></button>

                                </form>

                                <a class="btn btn-primary py-2 px-3"
                                    href="{{ route('single_product', ['id' => $product->id]) }}"><i
                                        class="bi bi-eye"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> 
        </div>
    </div>
    <!-- Products End -->


    <!-- Offer Start -->
    <div class="container-fluid bg-offer my-5 py-5">
        <div class="container py-5">
            <div class="row gx-5 justify-content-start">
                <div class="col-lg-7">
                    <div class="border-start border-5 border-dark ps-5 mb-5">
                        <h6 class="text-dark text-uppercase">Special Offer</h6>
                        <h1 class="display-5 text-uppercase text-white mb-0">Save 50% on all items your first order</h1>
                    </div>
                    <p class="text-white mb-4">Don't miss out on this incredible opportunity to save big on high-quality
                        pet products. Shop now and enjoy huge savings on your first order!</p>
                    <a href="{{ route('products') }}" class="btn btn-light py-md-3 px-md-5 me-3">Shop Now</a>
                    <a href="" class="btn btn-outline-light py-md-3 px-md-5">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->






    <!-- Testimonial Start -->
    <div class="container-fluid bg-testimonial py-5" style="margin: 45px 0;">
        <div class="container py-5">
            <div class="row justify-content-end">
                <div class="col-lg-7">
                    <div class="owl-carousel testimonial-carousel bg-white p-5">
                        <div class="testimonial-item text-center">
                            <div class="position-relative mb-4">
                                <img class="img-fluid mx-auto" src="{{ asset('images/testimonial-1.jpg') }}"
                                    alt="">
                                <div class="position-absolute top-100 start-50 translate-middle d-flex align-items-center justify-content-center bg-white"
                                    style="width: 45px; height: 45px;">
                                    <i class="bi bi-chat-square-quote text-primary"></i>
                                </div>
                            </div>
                            <p>Dolores sed duo clita tempor justo dolor et stet lorem kasd labore dolore lorem ipsum. At
                                lorem lorem magna ut et, nonumy et labore et tempor diam tempor erat. Erat dolor rebum sit
                                ipsum.</p>
                            <hr class="w-25 mx-auto">
                            <h5 class="text-uppercase">Client Name</h5>
                            <span>Profession</span>
                        </div>
                        <div class="testimonial-item text-center">
                            <div class="position-relative mb-4">
                                <img class="img-fluid mx-auto" src="{{ asset('images/testimonial-2.jpg') }}"
                                    alt="">
                                <div class="position-absolute top-100 start-50 translate-middle d-flex align-items-center justify-content-center bg-white"
                                    style="width: 45px; height: 45px;">
                                    <i class="bi bi-chat-square-quote text-primary"></i>
                                </div>
                            </div>
                            <p>Dolores sed duo clita tempor justo dolor et stet lorem kasd labore dolore lorem ipsum. At
                                lorem lorem magna ut et, nonumy et labore et tempor diam tempor erat. Erat dolor rebum sit
                                ipsum.</p>
                            <hr class="w-25 mx-auto">
                            <h5 class="text-uppercase">Client Name</h5>
                            <span>Profession</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endsection
