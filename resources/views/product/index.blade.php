@extends('layouts.base')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Product Catalog</h4>
            <div class="d-flex gap-2">
                <form method="GET" action="{{ route('products.index') }}" class="d-flex gap-2">
                    <input type="text" class="form-control" name="q" value="{{ request('q') }}" placeholder="Search products..." />
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </form>
            </div>
        </div>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 text-center">
                        <img src="{{ asset('img/products/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h6 class="card-title">{{ $product->name }}</h6>
                            <p class="fw-bold">Rp {{ number_format($product->price, 3) }}</p>
                            <a class="btn btn-primary" href="{{ route('products.show', ['id' => $product->id]) }}">Add to Cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
