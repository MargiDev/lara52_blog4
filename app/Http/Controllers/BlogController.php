<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Category;
use App\User;

class BlogController extends Controller
{
    protected $limit = 3;
    public function index()
    {
      $posts = Post::with('author')
                      ->latestFirst()
                      ->published()
                      ->simplePaginate($this->limit);
      return view('blog.index', compact('posts'));

    }

    public function show(Post $post)
    {

      return view('blog.show', compact('post'));

    }

    public function category(Category $category)
    {
      $categoryName = $category->title;

      $posts = $category->posts()
                        ->with('author')
                        ->latestFirst()
                        ->published()
                        ->simplePaginate($this->limit);
      return view('blog.index', compact('posts', 'categoryName'));
    }

    public function author(User $author)
    {
      $authorName = $author->name;

      $posts = $author->posts()
                      ->with('category')
                      ->latestFirst()
                      ->published()
                      ->simplePaginate($this->limit);
      return view('blog.index', compact('posts', 'authorName'));
    }
}
