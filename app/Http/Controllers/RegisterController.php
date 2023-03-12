<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered as RegisteredEvent;
use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(
        protected Request $request,
        protected AuthManager $authManager,
        protected Dispatcher $dispatcher
    ) {
    }

    public function create()
    {
        return view("register.create");
    }

    public function store()
    {
        $validated = $this->request->validate([
            "name" => "required|max:255",
            "username" => "required|min:3|max:255|unique:users,username",
            "email" => "required|email|max:255|unique:users,email",
            "password" => "required|max:255|min:8",
        ]);

        $user = User::create($validated);

        $this->dispatcher->dispatch(new RegisteredEvent($user));

        $this->authManager->login($user);

        return redirect("/")
            ->with("success", "Your account has been created.");
    }
}
