<?php

use \App\Http\Controllers\CommentController;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\RegisterController;
use \App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get("/ping", function() {
    $apiClient = new \MailchimpMarketing\ApiClient();

    $apiClient->setConfig([
        'apiKey' => config("services.mailchimp.key"),
        'server' => config("services.mailchimp.server")
    ]);

    //$response = $apiClient->lists->getListMembersInfo("e72056d144");

    $response = $apiClient->lists->addListMember("e72056d144", [
        "email_address" => "mail+test@mikegsmith.co.uk",
        "status" => "subscribed",
    ]);
    dd($response);
});

Route::get('/', [PostController::class, "index"])->name("home");
Route::get('/posts/{post}', [PostController::class, "show"])->name("post");
Route::post('/posts/{post}/comment', [CommentController::class, "store"])->name("comment")->middleware("auth");

Route::get("/register", [RegisterController::class, "create"])->name("register")->middleware("guest");
Route::post("/register", [RegisterController::class, "store"])->name("register")->middleware("guest");

Route::get("/login", [SessionController::class, "create"])->name("create")->middleware("guest");
Route::post("/login", [SessionController::class, "store"])->name("store")->middleware("guest");

Route::post("/logout", [SessionController::class, "destroy"])->name("logout")->middleware("auth");
