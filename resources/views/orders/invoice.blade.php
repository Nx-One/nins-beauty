@extends('layouts.base')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Invoice #{{ $order->id }}</h2>
    <div class="mb-3">
        <strong>Date:</strong> {{ $order->order_date ? \Carbon\Carbon::parse($order->order_date)->format('M d, Y') : $order->created_at->format('M d, Y') }}<br>
        <strong>Name:</strong> {{ $order->full_name }}<br>
        <strong>Address:</strong> {{ $order->address }}<br>
        <strong>Phone:</strong> {{ $order->phone }}<br>
        <strong>Status:</strong> {{ ucfirst($order->status) }}
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderDetails as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->product->price, 3) }}</td>
                    <td>Rp {{ number_format($item->subtotal, 3) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-end">
        <strong>Total: Rp {{ number_format($order->total_amount, 3) }}</strong>
    </div>
    <div class="mt-4">
        <a href="{{ route('history') }}" class="btn btn-secondary">Back to History</a>
    </div>
</div>
@endsection
