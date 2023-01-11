@extends('layouts.front')

@section('title')
    Welecome to Marioma-Shop
@endsection

@section('content')
    @include('layouts.inc.slider')

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Featured Products</h2>
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach ($featured_products as $product)
                        <div class="item">
                            <a href="{{url('category/'.$product->category->slug.'/'.$product->slug)}}">
                                <div class="card">
                                    <img src="{{asset('assets/uploads/product/'.$product->image)}}" alt="Product Image">
                                    <div class="card-body">
                                        <h5>{{ $product->name }}</h5>
                                        <span class="float-start">{{ $product->selling_price }}</span>
                                        <span class="float-end"><s> {{ $product->original_price }} </s></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Popular Categories</h2>
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach ($trending_categories as $cat)
                        <div class="item">
                            <a href="{{ url('category/'.$cat->slug) }}">
                                <div class="card">
                                    <img src="{{asset('assets/uploads/category/'.$cat->image)}}" alt="Category Image">
                                    <div class="card-body">
                                        <h5>{{ $cat->name }}</h5>
                                        <p>{{ $cat->description }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.featured-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            dots:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:3
                }
            }
        })
    </script>
@endsection
