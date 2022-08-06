<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.sign-in', [
            'url' => $_SERVER['HTTP_REFERER'],
        ]);
    }

    public function getLogin(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $auth = Auth::user();
            if ($auth->role == 0) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect($request->url);
            }
        } else {
            return redirect()->back();
        }
    }

    public function saveFile($file, $prefixName = '', $folder = 'public')
    {
        if ($file) {
            $fileName = $file->hashName();
            $fileName = isset($prefixName)
                ? $prefixName . '_' . $fileName
                : $fileName;

            return $file->storeAs($folder, $fileName);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function getRegister(RegisterRequest $request)
    {
        $user = new User();
        $user = $user->fill($request->all());

        if($request->hasFile('avatar')) {
            $user->avatar = $this->saveFile(
                $request->avatar,
                $request->name,
                'images/user'
            );
            $user->password = Hash::make($request->password);
            $user->role = 1;
            $user->status = 0;
            $user->amount_cart = 0;
            $user->save();
            Auth::login($user);
            return redirect()->route('admin.dashboard');
        }
    }

    public function show(Request $request)
    {
        if($request->session()->has('error_pass')) {
            $error = $request->session()->pull('error_pass', '');
        } else {
            $error = null;
        }
        return view('client.profile', [
            'nav_hover' => '',
            'error_pass' => $error
        ]);
    }

    public function update(RegisterRequest $request) {
        if($request->all()) {
            if(Auth::attempt(['password' => $request->password])) {
                $user = new User();
                $user = $user->fill($request->all());
                $user->save();
            } else {
                $request->session()->put('error_pass', 'Password không chính xác');
                return redirect()->route('users');
            }
        }
    }
}
