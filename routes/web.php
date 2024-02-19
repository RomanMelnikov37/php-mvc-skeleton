<?php

use App\Controllers\PostController;
use App\Core\Route;

Route::get('posts', [PostController::class, 'index']);
Route::post('posts', [PostController::class, 'store']);