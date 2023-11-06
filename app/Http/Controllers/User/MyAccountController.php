<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\UserOrder;
use App\Rules\CurrentPassword;
use App\Traits\Save_photos;
use Illuminate\Http\Request;
use App\Http\Requests\FormRegister;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MyAccountController extends Controller
{
    use Save_photos;
    public function index()
    {
        $orders = UserOrder::with('OrderItems')->where('user_id', Auth::user()->id)->get();
        // dd($orders);
        $user = auth()->user();
        return view('Site.MyAccount.my_account', compact('orders', 'user'));
    }
    public function edit(Request $request)
    {
        $id = Auth::id();
        $request->validate([
            'email' => "required|email|unique:users,email,$id",
            'name' => ['required'],
            'photo' => 'image|mimes:png,jpg',
            'password' => 'confirmed',
            'cpassword' => ['required', new CurrentPassword()],
        ], [], ['cpassword' => 'current password', 'password' => 'new password']);
        User::find(auth()->user()->id)->update($request->except('password'));
        return response()->json(['massage' => 'done'], 200);
    }
}
