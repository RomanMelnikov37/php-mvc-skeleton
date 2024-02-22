<?php

use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Core\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [HomeController::class, 'index']);
Route::get('/register', [HomeController::class, 'index']);
Route::get('/posts', [PostController::class, 'index']);