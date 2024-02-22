<?php

namespace App\Controllers;

use App\Models\Post;
use App\Views\View;

class PostController extends Controller
{
    public function index(): string
    {
        $posts = (new Post())->all();
        return View::view('post.index', compact('posts'));
    }

    public function store()
    {
    }
}