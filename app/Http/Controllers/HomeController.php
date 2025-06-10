<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get Top 5 products
        $topProducts = Product::orderBy('Id', 'desc')->take(4)->get();
        return view('home', compact('topProducts'));
    }

    // public function invoice($id)
    // {
    //     $order = Order::with(['orderDetails.product', 'user'])->findOrFail($id);
    //     // Option 1: Render a Blade view as invoice (HTML)
    //     // return view('orders.invoice', compact('order'));

    //     // Option 2: Download as PDF (requires barryvdh/laravel-dompdf)
    //     // $pdf = PDF::loadView('orders.invoice_pdf', compact('order'));
    //     // return $pdf->download('invoice_order_' . $order->id . '.pdf');

    //     // For now, render a simple HTML invoice view
    //     return view('orders.invoice', compact('order'));
    // }
}
