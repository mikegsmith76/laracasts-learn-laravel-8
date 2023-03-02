<?php

namespace App\Http\Controllers;

use \App\Services\Newsletter;

class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter)
    {
        $validated = request()->validate(["email" => "required|email"]);

        try {
            $newsletter->subscribe($validated["email"]);

        } catch (\Exception $exception) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                "email" => "This email address could not be added to our mailing list.",
            ]);
        }

        return redirect("/")
            ->with("success", "You are now signed up to our newsletter!");
    }
}
