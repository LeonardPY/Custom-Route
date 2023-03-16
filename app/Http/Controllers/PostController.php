<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\RMVC\Models\Post;
use App\RMVC\Route\Route;
use App\RMVC\View\View;

class PostController extends Controller
{
    public function index()
    {
        return View::view('post.index');
    }

    public function show($post)
    {
        return View::view('post.show', compact('post'));
    }


    public function store()
    {
        $post1 = new Post();
        $post1->title = $_POST['title'];
        $post1->content = $_POST['content'];


        $post2 = Post::query()->create([
            'title' => $_POST['title'],
            'content' => $_POST['content'],
        ]);

        $post3 = Post::create([
            'title' => $_POST['title'],
            'content' => $_POST['content'],
        ]);

        echo "<pre>";
        print_r($post1);
        print_r($post2);
        print_r($post3);
    }
}