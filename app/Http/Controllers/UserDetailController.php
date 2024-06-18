<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserDetailController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:user_details,nik',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'nomer_whatsapp' => 'required|unique:user_details,nomer_whatsapp',
            'email' => 'required|unique:user_details,email|email',
            'username' => 'required|unique:user_details,username|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $userDetail = new UserDetail();
        $userDetail->nik = $request->nik;
        $userDetail->nama = $request->nama;
        $userDetail->alamat = $request->alamat;
        $userDetail->tempat_lahir = $request->tempat_lahir;
        $userDetail->tanggal_lahir = $request->tanggal_lahir;
        $userDetail->nomer_whatsapp = $request->nomer_whatsapp;
        $userDetail->email = $request->email;
        $userDetail->username = $request->username;
        $userDetail->password = Hash::make($request->password);
        $userDetail->save();

        return redirect()->route('login')->with('success', 'Registration successful! You can now login.');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }
}
