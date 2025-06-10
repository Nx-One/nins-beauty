@extends('layouts.base')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold mb-4">Order History</h3>

    @foreach ($orders as $order)
        {{-- Order Details --}}
        <div class="border rounded p-4 mb-4 shadow-sm bg-white">
            <div class="d-flex justify-content-between mb-2">
                <div>
                    <strong>Order #{{ $order->id }}</strong>
                    <span class="text-muted ms-3">{{ $order->order_date ? \Carbon\Carbon::parse($order->order_date)->format('M d, Y') : $order->created_at->format('M d, Y') }}</span>
                    <span class="text-muted ms-3">• `Total: Rp {{ number_format($order->total_amount, 3) }}</span>
                </div>
                <span class="fw-semibold @if($order->status === 'completed') text-success @elseif($order->status === 'pending') text-warning @else text-secondary @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            {{-- Products --}}
            @foreach ($order->orderDetails as $item)
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="{{ asset('img/products/' . $item->product->image) }}" alt="{{ $item->product->name }}" width="60" class="rounded border">
                    <div>
                        <div>{{ $item->product->name }}</div>
                        <small class="text-muted">Qty: {{ $item->quantity }}</small>
                    </div>
                </div>
            @endforeach

            {{-- Invoice Download --}}
            {{-- <a href="{{ route('orders.invoice', $order->id) }}" class="text-primary text-decoration-none">
                <i class="bi bi-download"></i> Download Invoice
            </a> --}}
        </div>
    @endforeach
</div>
@endsection
