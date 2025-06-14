@extends('layouts.base')

@section('content')
    <div class="bg-light text-center py-5" style="background: url({{ asset('img/banner.jpg') }}) center/cover no-repeat;">
        <div class="container py-5">
            <h1 class="text-white fw-bold">Summer Skincare Collection</h1>
            <p class="text-white">Discover our new range of hydrating products</p>
            <a href="{{ route('products.index') }}" class="btn btn-outline-light">Shop Now</a>
        </div>
    </div>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Featured Products</h4>
        </div>

        <div class="row">
            @foreach ($topProducts as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 text-center">
                        <img src="{{ asset('img/products/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h6 class="card-title">{{ $product->name }}</h6>
                            {{-- <p class="text-muted">{{ $product->size }}</p> --}}
                            <p class="fw-bold">Rp {{ number_format($product->price, 3) }}</p>
                            <a class="btn btn-primary" href="{{ route('products.show', ['id' => $product->id]) }}">Add to Cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
