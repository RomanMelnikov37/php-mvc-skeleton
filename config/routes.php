<?php

use App\Controllers\PostController;
use App\Core\Route;

Route::get('/', [PostController::class, 'index']);