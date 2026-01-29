<?php

namespace App\Http\Controllers\Reader;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Pinjam;
use Illuminate\Support\Facades\Auth;

class BookDetailController extends Controller
{
    public function show(Book $book)
    {
        $pinjam = null;

        if (Auth::check()) {
            $pinjam = Pinjam::where('user_id', Auth::id())
                ->where('book_id', $book->id)
                ->latest()
                ->first();
        }

        return view('reader.books.show', compact('book', 'pinjam'));
    }
    
}
