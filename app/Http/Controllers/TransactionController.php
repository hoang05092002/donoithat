<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Cart::where('user_id', '=', Auth::user()->id)
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->get(['carts.discount', 'products.id', 'products.name', 'products.main_img', 'products.price']);
        // dd($products);
        $total = 0;
        foreach ($products as $product) {
            $total += $product->discount * $product->price;
        }

        // dd($total);
        return view('client.checkout', [
            'products' => $products,
            'total' => $total,
            'nav_hover' => 'checkout',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $total)
    {
        $transaction = new Transaction();
        $transaction = $transaction->fill($request->all());
        $transaction->user_id = Auth::user()->id;
        $transaction->amount = $total;
        $transaction->payment_info = $request->payment;
        $transaction->status = '1';
        $transaction->security_code = 'abc';

        $transaction->save();

        if ($transaction->id) {
            $cart = new Cart();
            $products = $cart->where('user_id', '=', Auth::user()->id)->get();
            $product_ids = $products->pluck('id');
            foreach ($products as $product) {
                $item = Product::select('price')->where('id', '=', $product->id)->get();
                $order = new Order();
                $order->transaction_id = $transaction->id;
                $order->product_id = $product->id;
                $order->qty = $product->discount;
                $order->amount = $product->discount * $item->first()->price;
                $order->status = 1;

                $order->save();
            }

            $cart->destroy($product_ids);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
