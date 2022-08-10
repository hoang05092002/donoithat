<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
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
        $transactions = Transaction::select()->orderBy('updated_at')->paginate(5);

        // dd($total);
        return view('admin.transaction.list', [
            'transactions' => $transactions,
            'nav_hover' => 'transactions',
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

    public function checkout()
    {
        $products = Cart::where('user_id', '=', Auth::user()->id)
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->get(['carts.discount', 'products.id', 'products.name', 'products.main_img', 'products.price']);
        $total = 0;
        foreach ($products as $product) {
            $total += $product->discount * $product->price;
        }
        return view('client.checkout', [
            'products' => $products,
            'total' => $total,
            'nav_hover' => 'checkout',
        ]);
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
            // dd($products);
            foreach ($products as $product) {
                $item = Product::select('price')->where('id', '=', $product->product_id)->get();
                // dd();
                $order = new Order();
                $order->transaction_id = $transaction->id;
                $order->product_id = $product->product_id;
                $order->qty = $product->discount;
                $order->amount = $product->discount * $item->first()->price;
                $order->status = 1;

                $order->save();
            }

            $cart->destroy($product_ids);
            $user = User::find(Auth::id());
            $user->amount_cart = 0;
            $user->save();

        return redirect()->route('users.trackOrder');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $transactions = Transaction::where('user_id', '=', Auth::id())->paginate(5);

        return view('client.trackOrder', [
            'transactions' => $transactions,
            'nav_hover' => ''
        ]);
    }

    public function info(Transaction $transaction)
    {
        $orders = Order::select('products.name', 'products.price', 'products.main_img', 'orders.id', 'orders.qty', 'orders.amount', 'orders.created_at', 'orders.updated_at')
            ->where('transaction_id', '=', $transaction->id)
            ->join('products', 'products.id' ,'orders.product_id')
            ->get();


        return view('admin.transaction.orders', [
            'orders' => $orders,
            'transaction' => $transaction,
            'nav_hover' => 'transactions'
        ]);
    }

    public function clientInfo(Transaction $transaction)
    {
        $orders = Order::select('products.name', 'products.price', 'products.main_img', 'orders.id', 'orders.qty', 'orders.amount', 'orders.created_at', 'orders.updated_at')
            ->where('transaction_id', '=', $transaction->id)
            ->join('products', 'products.id' ,'orders.product_id')->get();

            // dd($orders);

        return view('client.orders', [
            'orders' => $orders,
            'transaction' => $transaction,
            'nav_hover' => ''
        ]);
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

    public function delete(Transaction $transaction)
    {
        if ($transaction) {
            $transaction->delete();

            return redirect()->back();
        }
    }

    public function changeStatus($id, $status)
    {
        // dd($id, $status);
        if ($id) {
            $transaction = Transaction::find($id);
            $transaction->status = $status;
            $transaction->save();
        }
        return redirect()->route('admin.transactions.list');
    }
}
