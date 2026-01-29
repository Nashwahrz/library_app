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
    ->route('writer.books.edit', $book)
    ->with('success', 'Bab berhasil ditambahkan');

    }
    public function show(Book $book, Chapter $chapter)
{
    abort_if($book->writer_id !== Auth::id(), 403);
    abort_if($chapter->book_id !== $book->id, 404);

    return view('writer.chapters.show', compact('book', 'chapter'));
}

public function edit(Book $book, Chapter $chapter)
{
    abort_if($book->writer_id !== Auth::id(), 403);
    abort_if($chapter->book_id !== $book->id, 404);

    return view('writer.chapters.edit', compact('book', 'chapter'));
}

public function update(Request $request, Book $book, Chapter $chapter)
{
    abort_if($book->writer_id !== Auth::id(), 403);
    abort_if($chapter->book_id !== $book->id, 404);

    $request->validate([
        'title' => 'required',
        'content' => 'required',
    ]);

    $chapter->update([
        'title' => $request->title,
        'content' => $request->content,
    ]);

    return redirect()
        ->route('writer.chapters.show', [$book, $chapter])
        ->with('success', 'Bab berhasil diperbarui');
}
public function destroy(Book $book, Chapter $chapter)
{
    abort_if($book->writer_id !== Auth::id(), 403);
    abort_if($chapter->book_id !== $book->id, 404);

    $chapter->delete();

    return back()->with('success', 'Bab berhasil dihapus');
}

}
