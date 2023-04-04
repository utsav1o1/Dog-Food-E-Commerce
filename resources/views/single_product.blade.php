@extends('layouts.main')

@section('content')
    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
                <h6 class="text-primary text-uppercase">{{$product->type}}</h6>
            </div>
            <div class="row">


                <div class="col-lg-3 col-md-6 col-sm-12 mx-auto">
                    <div class="product-item position-relative bg-light d-flex flex-column text-center">
                        <img style="width:200px; height: 200px" class="img-fluid mb-4 mx-auto"
                            src="{{ asset('images/' . $product->image) }}" alt="">
                        <h6 class="text-uppercase">{{ $product->name }}</h6>
                        <p> {{ $product->description }} </p>
                        <p>{{ $product->category }}</p>
                        @if ($product->sale_price != null)
                            <h5 class="text-primary mb-0">{{ $product->sale_price }}</h5>
                            <h5 class="text-primary mb-0" style="text-decoration: line-through;"> ${{ $product->price }}
                            </h5>
                        @else
                            <h5 class="text-primary mb-0">${{ $product->price }}</h5>
                        @endif
                        <div class="btn-action d-flex justify-content-center">
                            <a class="btn btn-primary py-2 px-3" href=""><i class="bi bi-cart"></i></a>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection
