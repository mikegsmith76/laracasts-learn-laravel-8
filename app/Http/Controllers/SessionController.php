<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view("session.create");
    }

    public function destroy()
    {
        auth()->logout();
        return redirect("/")->with("success", "Goodbye!");
    }

    public function store()
    {
        $validated = request()->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        if (!auth()->attempt($validated)) {
            throw ValidationException::withMessages(["email" => "Your provided credentials could not be verified"]);
        }

        session()->regenerate();
        return redirect("/")->with("success", "Welcome back!");
    }
}
