<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        if (RateLimiter::tooManyAttempts(
            key: 'login:'.request()->input('email'), maxAttempts: 5)) {
            throw ValidationException::withMessages([
                'email' => 'Too many login attempts. Please try again later.',
            ]);
        }

        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($attributes, true)) {
            RateLimiter::hit('login:'.request()->input('email'),
                decaySeconds: 120);
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.',
            ]);
        }

        request()->session()->regenerate();

        RateLimiter::clear('login:'.request()->input('email'));

        redirect('/jobs')->with('success', 'You have been logged in.');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/')->with('success', 'You have been logged out.');
    }
}
