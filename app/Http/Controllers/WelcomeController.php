<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Review;

class WelcomeController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $reviews = Review::with('book', 'user')->latest()->get(); // Fetch reviews with related book and user data

        return view('welcome', compact('books', 'reviews'));
    }
}
