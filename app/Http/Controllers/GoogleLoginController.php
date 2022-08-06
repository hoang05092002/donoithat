<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function getLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {

        $getInfo = Socialite::driver('google')->user();

        $user = $this->createUser($getInfo);
        auth()->login($user);

        return redirect()->route('home');
    }
    public function createUser($getInfo)
    {
        $user = User::where('google_id', $getInfo->id)->first();

        if (!$user) {
            $user = new User();
            $user->name = $getInfo->name;
            $user->email = $getInfo->email;
            $user->email_verified_at = Carbon::now();
            $user->avatar = $getInfo->avatar;
            $user->google_id = $getInfo->id;
            $user->role = 1;
            $user->status = 0;
            $user->password = Hash::make('password');

            $user->save();
        }
        return $user;
    }

    public function changePassword () {
        return view('auth.change-password');
    }
}
