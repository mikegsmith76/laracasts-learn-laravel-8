<?php

use \App\Http\Controllers\AdminPostController;
use \App\Http\Controllers\CategorySubscribeController;
use \App\Http\Controllers\CommentController;
use \App\Http\Controllers\NewsletterController;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\RegisterController;
use \App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::post("/newsletter", NewsletterController::class);

Route::get('/', [PostController::class, "index"])->name("home");

Route::delete("/category/{category}/subscribe", [CategorySubscribeController::class, "destroy"])
    ->name("category.unsubscribe")
    ->middleware("auth");

Route::post("/category/{category}/subscribe", [CategorySubscribeController::class, "store"])
    ->name("category.subscribe")
    ->middleware("auth");

Route::get('/posts/{post:slug}', [PostController::class, "show"])->name("post");
Route::post('/posts/{post:slug}/comment', [CommentController::class, "store"])->name("comment")->middleware("auth");

Route::get("/register", [RegisterController::class, "create"])->name("register")->middleware("guest");
Route::post("/register", [RegisterController::class, "store"])->name("register")->middleware("guest");

Route::get("/login", [SessionController::class, "create"])->name("create")->middleware("guest");
Route::post("/login", [SessionController::class, "store"])->name("store")->middleware("guest");

Route::post("/logout", [SessionController::class, "destroy"])->name("logout")->middleware("auth");

Route::middleware("can:admin")->group(function(\Illuminate\Routing\Router $router) {
    $router->resource("/admin/posts", AdminPostController::class)->except(["show"]);
});
