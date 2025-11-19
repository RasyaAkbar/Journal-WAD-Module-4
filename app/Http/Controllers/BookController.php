<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // ===============1==============
    // Get all books from the database, order by latest, and pass to 'books.index' view.
    public function index()
    {
        
    }

    // ===============2==============
    // Display the details of a specific book based on the book parameter.
    public function show(Book $book)
    {
        
    }

    // ===============3==============
    // Display the form to add a new book.
    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'isbn' => 'required|unique:books',
            'description' => 'required',
            'published_year' => 'required|integer|min:1800|max:' . date('Y'),
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        Book::create($validated);
        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }


    // ===============4==============
    // Display the form to edit a specific book based on the book parameter.
    public function edit(Book $book)
    {
        
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'description' => 'required',
            'published_year' => 'required|integer|min:1800|max:' . date('Y'),
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }
        $book->update($validated);
        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }
    
    // ===============5==============
    // Delete a specific book based on the book parameter.
    // If the book has a cover image, delete it from storage as well.
    // Finally, redirect back to the book list with a success message.
    public function destroy(Book $book)
    {
        
    }
}