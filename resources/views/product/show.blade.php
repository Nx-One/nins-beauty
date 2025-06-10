@extends('layouts.base')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('img/products/' . $product->image) }}" class="img-fluid rounded" alt="Hydrating Serum">
        </div>
        <div class="col-md-6">
            <h2 class="fw-bold">{{ $product->name }}</h2>
            <p class="text-muted">{{ $product->description }}.</p>

            <h5 class="mt-4">Price</h5>
            <p class="fs-4 fw-bold">Rp {{ number_format($product->price, 3) }}</p>

            <h6>Quantity</h6>
            <form method="POST" action="{{ route('cart.add') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="input-group mb-4" style="width: 150px;">
                    <button class="btn btn-outline-secondary" type="button" onclick="adjustQuantity(-1)">−</button>
                    <input type="text" id="quantity" name="quantity" class="form-control text-center" value="1" readonly>
                    <button class="btn btn-outline-secondary" type="button" onclick="adjustQuantity(1)">+</button>
                </div>
                <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
            </form>
        </div>
    </div>
</div>

<script>
    function adjustQuantity(amount) {
        let input = document.getElementById('quantity');
        let current = parseInt(input.value);
        if (!isNaN(current)) {
            let newVal = current + amount;
            if (newVal > 0) input.value = newVal;
        }
    }
</script>
@endsection
