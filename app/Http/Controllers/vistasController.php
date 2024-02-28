<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;
use App\Models\User;

class vistasController extends Controller
{
    public function viewBooks(){
        $book = Book::all();
        $category = Category::all();
        $user = User::all();

        return view('books', compact('book','category','user'));
    }
    public function viewCategory(){

        $category = Category::all();
        return view('category', compact('category'));
    }
    public function viewusers(){
        $user = User::all();
        return view('user', compact('user'));
    }
}
