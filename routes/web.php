<?php

use \App\Http\Controllers\AdminPostController;
use \App\Http\Controllers\CommentController;
use \App\Http\Controllers\NewsletterController;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\RegisterController;
use \App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::post("/newsletter", NewsletterController::class);

Route::get('/', [PostController::class, "index"])->name("home");
Route::get('/posts/{post:slug}', [PostController::class, "show"])->name("post");
Route::post('/posts/{post:slug}/comment', [CommentController::class, "store"])->name("comment")->middleware("auth");

Route::get("/register", [RegisterController::class, "create"])->name("register")->middleware("guest");
Route::post("/register", [RegisterController::class, "store"])->name("register")->middleware("guest");

Route::get("/login", [SessionController::class, "create"])->name("create")->middleware("guest");
Route::post("/login", [SessionController::class, "store"])->name("store")->middleware("guest");

Route::post("/logout", [SessionController::class, "destroy"])->name("logout")->middleware("auth");

Route::get("/admin/posts", [AdminPostController::class, "index"])->middleware("auth.admin");
Route::post("/admin/posts", [AdminPostController::class, "store"])->middleware("auth.admin");
Route::get("/admin/posts/create", [AdminPostController::class, "create"])->middleware("auth.admin");
Route::get("/admin/posts/{post}/edit", [AdminPostController::class, "edit"])->middleware("auth.admin");
Route::delete("/admin/posts/{post}", [AdminPostController::class, "destroy"])->middleware("auth.admin");
Route::patch("/admin/posts/{post}", [AdminPostController::class, "update"])->middleware("auth.admin");
