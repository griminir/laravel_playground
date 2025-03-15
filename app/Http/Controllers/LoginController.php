<?php

namespace App\Http\Controllers;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        dd(request()->all());
        // validate the request
        // log the user in
        // redirect to the home page
    }
}
