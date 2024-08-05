<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index', [
            'categories' => Category::all(),
            // 'books_fiksi' => Book::where('category_id', 1)->take(4)->get(),
            // 'books_nonfiksi' => Book::where('category_id', 2)->take(4)->get(),
            'selectedCategory' => Book::where('category_id', 1)->take(4)->get(),
        ]);
    }

    public function category()
    {
        if ($_POST) {
            $selectedCategory = $_POST['selectedCategory'];
        }
        return view('index', [
            'categories' => Category::all(),
            // 'books_fiksi' => Book::where('category_id', 1)->take(4)->get(),
            // 'books_nonfiksi' => Book::where('category_id', 2)->take(4)->get(),
            'selectedCategory' => Book::where('category_id', $selectedCategory)->take(4)->get()
        ]);
    }
}
