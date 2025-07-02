<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Models\UserFragment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login page.
     */
    public function create(string $lang): Response
    {
        return Inertia::render('auth/Login', ['lang' => $lang]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): \Illuminate\Http\Response
    {
        $request->authenticate();

        $request->session()->regenerate();

        $redirects = [
            'ADMIN' => 'panel',
            'GUEST' => 'my-place'
        ];
        return response(['success' => 'test', 'redirect' => $redirects[Auth::user()->role->name]], 200);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): \Illuminate\Http\Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response(['success' => 'test'], 200);
    }
}
