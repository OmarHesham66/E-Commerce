<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Requests\FormLogin;
use App\Http\Requests\FormRegister;
use App\Http\Controllers\Controller;
use App\Traits\Save_photos;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    use Save_photos;
    public function get_login()
    {
        return view('Site.Auth.login');
    }

    public function post_login(FormLogin $req)
    {
        $checker = Auth::guard('web')->attempt(['email' => $req->email, 'password' => $req->password]);
        if (!$checker) {
            return view('Site.Auth.login')->with('failed_login', 'The Email or Password Wrong !');
        } else {
            // if (auth()->user()->role == 'user') {
            //     return redirect()->route('dash_user');
            // } else {
            //     return redirect()->route('dash_admin');
            // }
            return redirect()->route('home-site');
        }
    }
    public function get_register()
    {
        return view('Site.Auth.register');
    }
    public function post_register(FormRegister $req)
    {
        if ($req->photo) {
            $photo = $this->save_photo('users_photos', $req->photo);
        } else {
            $photo = 'Profile.png';
        }
        User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => bcrypt($req->password),
            'photo' => $photo,
        ]);
        notify()->success('Registeration is Success', 'Registeration');
        return view('Site.Auth.login');
    }
    public function get_logout()
    {
        Auth::logout();
        return redirect()->route('get_login');
    }
}
