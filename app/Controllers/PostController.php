<?php

namespace App\Controllers;

use App\Views\View;

class PostController extends Controller
{
    public function index(): string
    {
        $posts = [];
        return View::view('post.index', compact('posts'));
    }

    public function store()
    {
    }
}