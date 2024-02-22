<?php

namespace App\Controllers;

use App\Models\Post;
use App\Views\View;

class HomeController extends Controller
{
    public function index(): string
    {
        return View::view('home');
    }

    public function store()
    {
    }
}