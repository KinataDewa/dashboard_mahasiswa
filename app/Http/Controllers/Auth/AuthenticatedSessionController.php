<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // proses login
        $request->authenticate();

        // regenerate session (security)
        $request->session()->regenerate();

        // ambil user login
        $user = auth()->user();

        // redirect berdasarkan role
        return match ($user->role) {
            'mahasiswa' => redirect()->intended('/dashboard/mahasiswa'),
            'dpa' => redirect()->intended('/dashboard/dpa'),
            'civitas' => redirect()->intended('/dashboard/civitas'),
            default => redirect('/login'),
        };
    }

    /**
     * Logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}