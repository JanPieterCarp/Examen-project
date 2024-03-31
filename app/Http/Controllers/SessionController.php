<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Concerns\InteractsWithInput;
use Illuminate\Http\Request;

class sessionController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(auth()-> attempt($attributes)){
            session()->regenerate();
            return redirect('/')->with('succses', 'Je bent ingelogd');
        }

        return back()
        ->withInput()->
        withErrors(['email' => 'Geen gebruiker gevonden met deze gegevens']);
    }


    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'doei!');
    }
}
