<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate; // Add this line

class BookController extends Controller
{
    public function index()
    {
        $books = Book::where('user_id', Auth::id())->get();
        return view('collection', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:Reading,Finished',
        ]);

        $imageUrl = $this->fetchBookImage($request->title, $request->author);

        $book = Book::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'status' => $request->status,
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('collection');
    }

    public function show(Book $book)
    {
        Gate::authorize('view', $book); // Change this line
        return response()->json($book);
    }

    public function update(Request $request, Book $book)
    {
        Gate::authorize('update', $book); // Change this line

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:Reading,Finished',
        ]);

        $imageUrl = $this->fetchBookImage($request->title, $request->author);

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'status' => $request->status,
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('collection');
    }

    public function destroy(Book $book)
    {
        if (Gate::denies('delete', $book)) {
            abort(403, 'This action is unauthorized.');
        }
        $book->delete();

        return redirect()->route('collection');
    }

    private function fetchBookImage($title, $author)
    {
        $query = "intitle:" . urlencode($title) . "+inauthor:" . urlencode($author);
        $url = "https://www.googleapis.com/books/v1/volumes?q={$query}&maxResults=1";
        
        $response = Http::get($url);
        $data = $response->json();
        
        return $data['items'][0]['volumeInfo']['imageLinks']['thumbnail'] ?? null;
    }
}