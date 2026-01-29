<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{
    public function create(Book $book)
    {
        abort_if($book->writer_id !== Auth::id(), 403);
        return view('writer.chapters.create', compact('book'));
    }

    public function store(Request $request, Book $book)
    {
        abort_if($book->writer_id !== Auth::id(), 403);

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $lastOrder = $book->chapters()->max('chapter_order') ?? 0;

        Chapter::create([
            'book_id' => $book->id,
            'title' => $request->title,
            'content' => $request->content,
            'chapter_order' => $lastOrder + 1,
        ]);

        return redirect()
            ->route('writer.books.edit')
            ->with('success', 'Bab berhasil ditambahkan');
    }
}
