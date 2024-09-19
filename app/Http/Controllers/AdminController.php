<?php

namespace App\Http\Controllers;

use App\Models\originating;
use App\Models\service;
use App\Models\terminating;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminController extends Controller
{
    public function index() {
        return view('dashboard', [
            'tittle' => 'dashboard'
        ]);
    }
    public function login() {
        return view('login', [
            'tittle' => 'dashboard'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('admin');
        }

        return back()->withErrors('Gagal Login!');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
