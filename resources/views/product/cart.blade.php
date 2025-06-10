@extends('layouts.base')

@section('content')
<div class="container py-5">
    <h3 class="mb-4 fw-bold">Shopping Cart</h3>

    {{-- @forelse ($cartItems as $item)
        <div class="d-flex justify-content-between align-items-center p-3 mb-3 border rounded bg-white">
            <div class="d-flex align-items-center">
                <img src="{{ asset('img/products/' . $item->product->image) }}" class="rounded me-3" width="70" alt="Product Image">
                <div>
                    <div class="fw-bold">{{ $item->product->name }}</div>
                    <small class="text-muted">{{ $item->product->description ?? '' }}</small>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <form method="POST" action="{{ route('cart.update', $item->id) }}" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                    <button class="btn btn-outline-secondary btn-sm me-1" @if($item->quantity <= 1) disabled @endif type="submit">−</button>
                </form>
                <input type="text" class="form-control text-center mx-1" value="{{ $item->quantity }}" style="width: 50px;" readonly>
                <form method="POST" action="{{ route('cart.update', $item->id) }}" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                    <button class="btn btn-outline-secondary btn-sm ms-1" type="submit">+</button>
                </form>
                <form method="POST" action="{{ route('cart.delete', $item->id) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-link text-danger ms-3" type="submit"><i class="bi bi-trash-fill"></i></button>
                </form>
            </div>

            <div class="fw-bold fs-6">Rp {{ number_format($item->product->price * $item->quantity, 3) }}</div>
        </div>
    @empty
        <div class="alert alert-info">Your cart is empty.</div>
    @endforelse --}}

    @forelse ($cartItems as $item)
        <div class="row justify-content-between align-items-center p-3 mb-3 border rounded bg-white">
            <div class="col-md-7 d-flex align-items-center">
                <img src="{{ asset('img/products/' . $item->product->image) }}" class="rounded me-3" width="70" alt="Product Image">
                <div>
                    <div class="fw-bold">{{ $item->product->name }}</div>
                    <small class="text-muted">{{ $item->product->description ?? '' }}</small>
                </div>
            </div>

            <div class="col-md-3 d-flex align-items-center justify-content-center">
                <form method="POST" action="{{ route('cart.update', $item->id) }}" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                    <button class="btn btn-outline-secondary btn-sm me-1" @if($item->quantity <= 1) disabled @endif type="submit">−</button>
                </form>
                <input type="text" class="form-control text-center mx-1" value="{{ $item->quantity }}" style="width: 50px;" readonly>
                <form method="POST" action="{{ route('cart.update', $item->id) }}" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                    <button class="btn btn-outline-secondary btn-sm ms-1" type="submit">+</button>
                </form>
                <form method="POST" action="{{ route('cart.delete', $item->id) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-link text-danger ms-3" type="submit"><i class="bi bi-trash-fill"></i></button>
                </form>
            </div>

            <div class="col-md-2 fw-bold fs-6">Rp {{ number_format($item->product->price * $item->quantity, 3) }}</div>
        </div>
    @empty
        <div class="alert alert-info">Your cart is empty.</div>
    @endforelse

    {{-- Cart Summary --}}
    <div class="bg-light p-3 rounded d-flex justify-content-between align-items-center mt-4">
        <strong>Subtotal</strong>
        <strong>Rp {{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }), 3) }}</strong>
    </div>

    <div class="mt-3">
        <form action="{{ route('checkout') }}" method="GET">
            <button class="btn btn-primary w-100" @if($cartItems->isEmpty()) disabled @endif type="submit">Proceed to Checkout</button>
        </form>
    </div>
</div>
@endsection
