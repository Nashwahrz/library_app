<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::where('writer_id', Auth::id())->get();
        return view('writer.books.index', compact('books'));
    }

    public function create()
    {
        return view('writer.books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_name' => 'required',
            'category' => 'required',
            'sinopsis' => 'required',
            'tahun_terbit' => 'required|digits:4',
            'cover' => 'nullable|image|max:2048',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        Book::create([
            'book_name' => $request->book_name,
            'category' => $request->category,
            'penulis' => Auth::user()->name,
            'sinopsis' => $request->sinopsis,
            'cover' => $coverPath,
            'tahun_terbit' => $request->tahun_terbit,
            'writer_id' => Auth::id(),
        ]);

        return redirect()->route('writer.books.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit(Book $book)
    {
        abort_if($book->writer_id !== Auth::id(), 403);
        return view('writer.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        abort_if($book->writer_id !== Auth::id(), 403);

        $request->validate([
            'book_name' => 'required',
            'category' => 'required',
            'sinopsis' => 'required',
            'tahun_terbit' => 'required|digits:4',
        ]);

        $book->update($request->only([
            'book_name',
            'category',
            'sinopsis',
            'tahun_terbit'
        ]));

        return redirect()->route('writer.books.index')
            ->with('success', 'Buku berhasil diupdate');
    }

    public function destroy(Book $book)
    {
        abort_if($book->writer_id !== Auth::id(), 403);
        $book->delete();

        return back()->with('success', 'Buku dihapus');
    }
}
