<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        $grand_total = 0;
        foreach ($carts as $cart) {
            $grand_total += $cart->qty * $cart->product->price;
        }
        return view('cart', compact('carts', 'grand_total'));
    }
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        Session::put('passcode', strtoupper(Str::random(6)));
        $grand_total = 0;
        foreach ($carts as $cart) {
            $grand_total += $cart->qty * $cart->product->price;
        }
        return view('checkout', compact('carts', 'grand_total'));
    }
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function doCheckout(Request $request)
    {
        $passcode = Session::get('passcode');
        $request->validate([
            'passcode' => ["required", "in:{$passcode}"]
        ]);
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        $grand_total = 0;
        foreach ($carts as $cart) {
            $grand_total += $cart->qty * $cart->product->price;
        }

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'total_price' => $grand_total
        ]);
        $data = [];

        foreach ($carts as $cart) {
            $data[] = [
                'transaction_id' => $transaction->id,
                'product_id' => $cart->product_id,
                'qty' => $cart->qty,
                'price' => $cart->product->price,
                'subtotal' => $cart->qty * $cart->product->price,
                'created_at' => now()
            ];
            Product::where('id', $cart->product_id)->decrement('stock', $cart->qty);
        }
        
        TransactionDetail::insert($data);
        Cart::where('user_id', Auth::id())->delete();
        $request->session()->flash('success', "Checkout Cart Success!");
        return redirect()->route('transactions');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required|numeric|min:1',
        ]);
        $product = Product::find($request->product_id);
        if ($product == null) {
            return response()->json(['message' => 'Product not Found'], 404);
        }
        $cart = Cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->first();
        if ($cart) {
            $quantity = $cart->qty + $request->qty;
            if ($quantity > $product->stock) {
                return response()->json(['message' => 'Quantity Cannot exceed product stock'], 400);
            }
            $cart->qty = $quantity;
            $save = $cart->save();
        } else {
            if ($request->qty > $product->stock) {
                return response()->json(['message' => 'Quantity Cannot exceed product stock'], 400);
            }
            $save = Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'qty' => $request->qty,
            ]);
        }
        if ($save) {
            return response()->json(['message' => 'Add to Cart Success']);
        }
        return response()->json(['message' => 'Error'], 400);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'qty' => ['required', 'numeric'],
        ]);
        $cart = Cart::with('product')->find($request->id);
        if ($request->qty > $cart->product->stock) {
            return response()->json(['message' => 'Quantity cannot exceed the current stock'], 400);
        }
        if ($request->qty <= 0) {
            $cart->delete();
            return response()->json(['message' => 'Product Deleted From Cart']);
        }
        $cart->qty = $request->qty;
        $cart->save();
        return response()->json(['message' => 'Product Qty Updated']);
    }
}
