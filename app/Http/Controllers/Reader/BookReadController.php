<?php

namespace App\Http\Controllers\Reader;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Pinjam;
use Illuminate\Support\Facades\Auth;

class BookReadController extends Controller
{
    public function index(Book $book)
    {
        // cek pinjam
        $pinjam = Pinjam::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->where('status', 'aktif')
            ->first();

        if (!$pinjam || $pinjam->berakhir_pada < now()) {
            abort(403, 'Akses baca sudah berakhir');
        }

        $chapters = $book->chapters()
            ->orderBy('chapter_order')
            ->get();

        return view('reader.books.read', compact(
            'book',
            'chapters',
            'pinjam'
        ));
    }

    public function show(Book $book, Chapter $chapter)
    {
        $pinjam = Pinjam::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->where('status', 'aktif')
            ->first();

        if (!$pinjam || $pinjam->berakhir_pada < now()) {
            abort(403, 'Akses baca sudah berakhir');
        }

      
        abort_if($chapter->book_id !== $book->id, 404);

        return view('reader.books.read-chapter', compact(
            'book',
            'chapter',
            'pinjam'
        ));
    }
}
