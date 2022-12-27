<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view("home.index");
// })->name("home.index");


// Route::get("/contact", function() {
//     return view("home.contact");
// })->name("home.contact");

// SIMPLEST FORM
Route::get("/", [HomeController::class, "home"])->name("home.index");
Route::get("/contact", [HomeController::class, "contact"])->name("home.contact");
Route::get('/admin', [HomeController::class, "admin"])->name("home.admin")->middleware("can:admin");

Route::resource("/posts", PostController::class);
Route::resource("/users", UserController::class)->only(["show", "edit", "update"]);

Route::post("/comment/{post}/posts", [CommentController::class, "store"])->name("comment.posts");
Route::post("/comment/{user}/users", [UserCommentController::class, "store"])->name("comment.users");

Auth::routes();

// Route::get("/posts", function() use($posts) {
//     return view("posts.index", ["posts" => $posts]);
// })->name("posts.index");

// Route::get("/posts/{id}", function($id) use($posts) {

//     abort_if(!isset($posts[$id]), 404);

//     return view("posts.show", ["post" => $posts[$id]]);
// }

// // YOU CAN USE THIS AS GLOBAL
// // YOU WILL SEE THIS AT RouteServiceProvider.php
// // )->where([
// //     "id" => "[0-9]+"
// // ]
// )->name("posts.show");

// Route::get("/recent-posts/{days_ago?}", function($days_ago = 13) {
//     return "Posts from $days_ago days ago";
// })->name("posts.recent.index");


// Route::prefix("/fun")->name("fun.")->group(function() use($posts){

//     Route::get("/responses", function() use($posts) {
//         return response($posts, 201)
//         ->header("Content-Type", "application/json")
//         ->cookie("MY_COOKIE","Mark", 3600);
//    })->name("response");
   
//    Route::get("/redirect", function() {
//        return redirect("/contact");
//    })->name("redirect");
   
//    Route::get("/back", function() {
//        return back();
//    })->name("back");
   
//    Route::get("/named-route", function() {
//        return redirect()->route("home.index");
//    })->name("named-route");
   
//    Route::get("/away", function() {
//        return redirect()->away("https://google.com");
//    })->name("away");
   
//    Route::get("/json", function() use($posts) {
//        return response()->json($posts);
//    })->name("json");
   
//    Route::get("/download", function() {
//        return response()->download(public_path("/laravel.png"));
//    })->name("download");

// });

