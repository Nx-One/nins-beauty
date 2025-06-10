@php
    $order = $getRecord()->loadMissing('orderDetails.product');
@endphp
@if($order->orderDetails->count())
    <table class="table table-bordered table-dark">
        <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderDetails as $item)
                <tr>
                    <td>{{ $item->product->name ?? '-' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->product->price ?? 0, 3) }}</td>
                    <td>Rp {{ number_format($item->subtotal, 3) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="text-muted">No order details found.</div>
@endif
