<?php

use App\Controllers\PostController;
use App\Core\Route;

Route::get('posts', [PostController::class, 'index']);