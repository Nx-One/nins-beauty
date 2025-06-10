<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where('name', 'like', '%' . $search . '%');
            // Add more fields if needed, e.g. description
        }

        $products = $query->get();
        return view('product.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Check if the cart item already exists for this user and product
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('cart')->with('success', 'Product added to cart successfully!');
    }

    public function cart()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        return view('product.cart', compact('cartItems'));
    }

    public function checkout()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        return view('product.checkout', compact('cartItems'));
    }

    public function history()
    {
        // Get orders with order details and product for the logged-in user
        $orders = Auth::user()->orders()->with(['orderDetails.product'])->latest()->get();
        return view('product.history', compact('orders'));
    }

    public function updateCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cartItem->quantity = $request->input('quantity');
        $cartItem->save();
        return redirect()->route('cart')->with('success', 'Cart updated successfully!');
    }

    public function deleteCart($id)
    {
        $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cartItem->delete();
        return redirect()->route('cart')->with('success', 'Item removed from cart!');
    }

    public function processCheckout(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'full_name' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'payment_method' => 'required',
                'payment_proof' => 'required|mimes:jpeg,jpg,png|max:2048', // Adjust max size as needed
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $user = Auth::user();
        $cartItems = $user->cartItems()->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        // Handle payment proof upload
        $file = $request->file('payment_proof');
        $fileName = $file->hashName();
        // $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Calculate total
        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        // Create order
        $order = \App\Models\Order::create([
            'order_date' => now(),
            'status' => 'pending',
            'user_id' => $user->id,
            'total_amount' => $total,
            'full_name' => $request->full_name,
            'address' => $request->address,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
            'payment_proof' => $fileName,
        ]);

        // Create order details
        foreach ($cartItems as $item) {
            \App\Models\OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'subtotal' => $item->product->price * $item->quantity,
            ]);
        }

        // Optionally, save shipping/payment info to order or another table
        // ...

        // Remove items from cart
        $user->cartItems()->delete();
        $path = $file->store('payment_proofs', 'public');

        // Optionally, save payment proof path to order (add column if needed)
        // $order->update(['payment_proof' => $paymentProofPath]);

        // Redirect to home
        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }
}
