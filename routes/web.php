<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodolistController;
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

Route::get('/', [HomeController::class, "home"]);

Route::view("/template", "template");

Route::controller(UserController::class)->group(function(){
    Route::get("/login", 'login')->middleware(["onlyguest"]);
    Route::post("/login", 'dologin')->middleware(["onlyguest"]);
    Route::post("/logout", 'logout')->middleware(["onlymember"]);
});

Route::controller(TodolistController::class)->middleware("onlymember")->group(function(){
    Route::get("/todolist", 'todo');
    Route::post("/todolist", 'addTodo');
    Route::post("/todolist/{id}/remove", 'delTodo');
});