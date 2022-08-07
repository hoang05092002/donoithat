<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(session('product'));
        $products = Cart::where('user_id', '=', Auth::user()->id)
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->get(['carts.discount', 'products.id', 'products.name', 'products.main_img', 'products.price']);
        // dd($products);
        $total = 0;
        foreach ($products as $product) {
            $total += $product->discount * $product->price;
        }

        // dd($total);
        return view('client.cart', [
            'products' => $products,
            'total' => $total,
            'nav_hover' => '',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product, Request $request)
    {
        $item = Cart::where('product_id', '=', $product->id)->where('user_id', '=', Auth::user()->id)->get();
        $item = count($item) ? $item[0] : null;
        $user_id = Auth::user() ? Auth::user()->id : 0;

        if ($item == null) {
            $cart = new Cart();
            $cart->product_id = $product->id;
            $cart->user_id = $user_id;

            if ($request->discount) {
                $cart->discount = $request->discount;
            } else {
                $cart->discount = 1;
            }

            $cart->save();
        } else {
            // dd($item);
            $item->discount = $item->discount + $request->discount;
            $item->save();
        }
        Auth::user()->amount_cart = Cart::where('user_id', '=', $user_id)->count();
        return redirect()->route('cart.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (Auth::user()) {
            $carts = Cart::where('user_id', '=', Auth::user()->id)->get();

            return view('client.cart', [
                'carts' => $carts,
                'nav_hover' => 'cart',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addToDb($product, $qty) {
        $item = Cart::where('product_id', '=', $product->id)->where('user_id', '=', Auth::user()->id)->get();
        $item = count($item) ? $item[0] : null;
        $user_id = Auth::user() ? Auth::user()->id : 0;

        if ($item == null) {
            $cart = new Cart();
            $cart->product_id = $product->id;
            $cart->user_id = $user_id;
            $cart->discount = $qty;
            $cart->save();
            $user = User::find(Auth::id());
            $user->amount_cart++;
            $user->save();
        } else {
            // dd($item);
            $item->discount = $item->discount + $qty;
            $item->save();
        }
        Auth::user()->amount_cart = Cart::where('user_id', '=', $user_id)->count();
        return redirect()->route('cart.list');
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);
        $qty = isset($request->qty) ? $request->qty : 1;
        if (Auth::user()) {
            $this->addToDb($product, $qty);
            // session('amount_cart');
        } else {
            if(session()->has('cart')) {
                $item = $request->session()->get('cart');
                $item[count($item)] = new Cart();
                $item[count($item)]->name = $product->name;
                $item[count($item)]->price = $product->price * $qty;
                $item[count($item)]->discount = $qty;
                $request->session()->put('cart', $item);
            } else {

            }
        }
    }
}
