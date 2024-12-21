<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::where('active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        return view('shop.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }

    public function cart()
    {
        return view('shop.cart');
    }

    public function addToCart(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image_url" => $product->image_url
            ];
        }
        
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }

    public function checkout()
    {
        if (!session()->has('cart') || empty(session()->get('cart'))) {
            return redirect()->route('shop.cart')->with('error', 'Your cart is empty!');
        }

        return view('shop.checkout');
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required',
            'shipping_city' => 'required',
            'shipping_country' => 'required',
            'shipping_postal_code' => 'required',
            'payment_method' => 'required',
        ]);

        $cart = session()->get('cart');
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => Order::generateOrderNumber(),
            'total_amount' => $total,
            'shipping_address' => $request->shipping_address,
            'shipping_city' => $request->shipping_city,
            'shipping_country' => $request->shipping_country,
            'shipping_postal_code' => $request->shipping_postal_code,
            'payment_method' => $request->payment_method,
        ]);

        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
                'subtotal' => $details['price'] * $details['quantity']
            ]);
        }

        session()->forget('cart');
        return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully!');
    }
}
