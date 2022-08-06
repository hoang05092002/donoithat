<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'avatar', 'role', 'status', 'phone', 'created_at', 'updated_at')
            ->where('id', '!=', Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->paginate(5);
        // dd($users);
        return view('admin.user.list', [
            'users' => $users,
            'nav_hover' => 'users',
        ]);
    }

    public function getListUsers()
    {
        $users = User::select('id', 'name', 'email', 'avatar', 'role', 'status', 'phone', 'created_at', 'updated_at')
            // ->where('id', '!=', Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->paginate(5);
        // dd($users);
        return response()->json([
            'status' => '200',
            'data' => $users,
            'nav_hover' => 'users'
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
    public function store(Request $request)
    {
        //
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
    public function edit(User $user)
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

    public function delete($id)
    {
        if ($id) {
            // $product_ids = Product::select()->where('user_id', '=', $id)->pluck('id');
            // Product::whereIn('id', $product_ids)->update(['status' => 1]);
            $cart_ids = Cart::select()->where('user_id', '=', $id)->pluck('id');
            Cart::whereIn('id', $cart_ids)->update(['user_id' => 0]);
            $comment_ids = Comment::select()->where('user_id', '=', $id)->pluck('id');
            Comment::whereIn('id', $comment_ids)->update(['user_id' => 0]);
            $transaction_ids = Transaction::select()->where('user_id', '=', $id)->pluck('id');
            Transaction::whereIn('id', $transaction_ids)->update(['user_id' => 0]);

            $user = User::find($id);
            $user->delete();

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function changeStatus(User $user)
    {
        if ($user) {
            $status = User::select('status')->distinct()->get();
            // dd($status);
            foreach ($status as $st) {
                if ($st->status != $user->status) {
                    $user->status = $st->status;
                    $user->save();
                    break;
                }
            }

            return redirect()->back();
        }
    }

    public function changePermission(User $user)
    {
        if ($user) {
            $permissions = User::select('role')->distinct()->get();
            // dd($status);
            foreach ($permissions as $per) {
                if ($per->role != $user->role) {
                    $user->role = $per->role;
                    $user->save();
                    break;
                }
            }

            return redirect()->back();
        }
    }
}
