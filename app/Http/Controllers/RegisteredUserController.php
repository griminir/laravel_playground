<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function store()
    {
        $attributes = request()->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => [
                'required',
                Password::min(8)->letters()->numbers()->symbols()->mixedCase(),
                'confirmed',
            ],
            // the confirmed rule will check for a field named password_confirmation
        ]);

        $user = User::create($attributes);

        Auth::login($user);

        return redirect('/jobs')->with('success',
            'Your account has been created.');
    }

    public function create()
    {
        return view('auth.register');
    }
}
