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
        // dd(session()->get('count'));
        $total = 0;
        if (Auth::id()) {
            $products = Cart::where('user_id', '=', Auth::user()->id)
                ->join('products', 'products.id', '=', 'carts.product_id')
                ->get(['carts.discount', 'products.id', 'products.name', 'products.main_img', 'products.price']);
        } else {
            if (session()->has('cart')) {
                $products = session()->get('cart');
            } else {
                $products = [];
            }
            foreach ($products as $id => $product) {
                $total += $product->discount * $product->price;
            }
        }
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

    public function addToDb($product, $qty)
    {
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
        $count = session()->get('count');
        $id = $request->product_id;
        $product = Product::find($id);
        $qty = isset($request->qty) ? $request->qty : 1;
        if (Auth::user()) {
            $this->addToDb($product, $qty);
        } else {
            $cart = session()->has('cart') ? session('cart') : [];
            if (true) {
                if (isset($cart[$id])) {
                    $cart[$id]->discount = $cart[$id]->discount + $qty;
                } else {
                    $cart[$id] = new Cart();
                    $cart[$id]->name = $product->name;
                    $cart[$id]->discount = $qty;
                    $cart[$id]->price = $product->price;
                    $cart[$id]->main_img = $product->main_img;
                }
            }
            session()->put('cart', $cart);
        }

        session()->put('count', $count+1);
    }
}
