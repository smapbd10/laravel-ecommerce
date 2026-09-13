<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = $this->getCart();
        if (!$cart || $cart->items->isEmpty()) {
            return redirect('/cart')->with('error', 'Your cart is empty');
        }

        $cartItems = $cart->items()->with('product', 'variant')->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('checkout.index', compact('cartItems', 'subtotal'));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'shipping_address' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'payment_method' => 'required|in:cod,bank_transfer,manual_payment',
        ]);

        $cart = $this->getCart();
        if (!$cart || $cart->items->isEmpty()) {
            return back()->with('error', 'Your cart is empty');
        }

        $cartItems = $cart->items()->with('product')->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // Create order
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'user_id' => auth()->id() ?? null,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'shipping_address' => $validated['shipping_address'],
            'country' => $validated['country'],
            'state' => $validated['state'],
            'city' => $validated['city'],
            'postal_code' => $validated['postal_code'],
            'subtotal' => $subtotal,
            'tax_amount' => 0,
            'shipping_amount' => 0,
            'total_amount' => $subtotal,
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_variant_id' => $item->product_variant_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        // Clear cart
        $cart->items()->delete();

        return redirect()->route('order.confirmation', $order->id)
            ->with('success', 'Order placed successfully');
    }

    public function confirmation(Order $order)
    {
        $order->load('items.product');
        return view('checkout.confirmation', compact('order'));
    }

    protected function getCart()
    {
        if (auth()->check()) {
            return Cart::where('user_id', auth()->id())->first();
        }

        return Cart::where('session_id', session()->getId())->first();
    }
}
