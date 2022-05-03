<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User_controller extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function save(request $request)
    {

        //$this->user->create($request->all());
        $hashPassword = Hash::make($request->password);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $hashPassword,

        ]);
        $user =  User::toBase()->get();
        return view('pages.admin.profile', compact('user'));
    }
}
