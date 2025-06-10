@extends('layouts.base')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold mb-4">Checkout</h3>
    <div class="row">
        {{-- Left Column: Shipping + Payment --}}
        <div class="col-md-7">
            <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Shipping Address --}}
                <div class="mb-4">
                    <h5 class="fw-semibold">Shipping Address</h5>
                    <div class="mb-3">
                        <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="address" class="form-control" placeholder="Address" required>
                    </div>
                    <div class="mb-3">
                        <input type="tel" name="phone" class="form-control" placeholder="Phone Number" required>
                    </div>
                </div>

                {{-- Payment Method --}}
                <div class="mb-4">
                    <h5 class="fw-semibold">Payment Method</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" value="bank_transfer" id="bankTransfer" checked>
                        <label class="form-check-label" for="bankTransfer">
                            Bank Transfer
                        </label>
                    </div>
                </div>

                {{-- Upload Proof of Payment --}}
                <div class="mb-4">
                    <h6 class="fw-semibold">Upload Proof of Transfer</h6>
                    <div class="border border-dashed p-4 text-center" style="border-radius: 10px;">
                        <input type="file" name="payment_proof" class="form-control" accept="image/*" required>
                        <small class="text-muted d-block mt-2">Drag and drop your file here or click to browse</small>
                    </div>
                </div>
        </div>

        {{-- Right Column: Order Summary --}}
        <div class="col-md-5">
            <div class="bg-light p-4 rounded shadow-sm">
                <h5 class="fw-semibold mb-3">Order Summary</h5>
                @foreach ($cartItems as $item)
                    <div class="d-flex justify-content-between mb-2">
                        <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                        <span>Rp {{ number_format($item->product->price * $item->quantity, 3) }}</span>
                    </div>
                @endforeach
                <div class="d-flex justify-content-between mb-2 border-top pt-2">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }), 3) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Shipping</span>
                    <span>Rp 0</span>
                </div>
                <div class="d-flex justify-content-between fw-bold fs-5 border-top pt-3">
                    <span>Total</span>
                    <span>Rp {{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }), 3) }}</span>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-4">
                    Confirm Order
                </button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection
