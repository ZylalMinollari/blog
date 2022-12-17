<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{

    public function create() {
        return view('sessions.create');
    }

    public function store() {
        $attribtes=request()->validate([
            'email' =>'required|email',
            'password'=>'required',
        ]);
        if(!auth()->attempt($attribtes)){
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.'
            ]);

            session()->regenerate();
            return redirect('/')->with('succes','Welcome Back');

        }
    }

    public function destroy() {
        auth()->logout();
        return redirect('/')->with('success','Goodbye!');
    }
}


