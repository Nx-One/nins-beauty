@php
    $imagePath = $getRecord()->payment_proof ? asset('storage/payment_proofs/' . $getRecord()->payment_proof) : null;
@endphp
@if($imagePath)
    <div class="mb-2">
        <img src="{{ $imagePath }}" alt="Payment Proof" style="max-width: 300px; max-height: 300px;" class="border rounded">
    </div>
    <a href="{{ $imagePath }}" target="_blank" class="btn btn-sm btn-primary">View Full Image</a>
@else
    <span class="text-muted">No payment proof uploaded.</span>
@endif
