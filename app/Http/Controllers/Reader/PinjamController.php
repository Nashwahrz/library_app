<?php

namespace App\Http\Controllers\Reader;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Pinjam;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PinjamController extends Controller
{

public function index()
{
    $pinjams = Pinjam::with('book')
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

    // auto expire
    foreach ($pinjams as $pinjam) {
        if ($pinjam->status === 'aktif' && $pinjam->berakhir_pada < now()) {
            $pinjam->update(['status' => 'expired']);
        }
    }

    return view('reader.pinjaman.index', compact('pinjams'));
}
    public function store(Book $book)
{
    // Cegah pinjam ganda
    $exists = Pinjam::where('user_id', Auth::id())
        ->where('book_id', $book->id)
        ->where('status', 'aktif')
        ->where('berakhir_pada', '>', now())
        ->exists();

    if ($exists) {
        return back()->with('error', 'Buku masih dalam masa pinjam');
    }

    Pinjam::create([
        'user_id'        => Auth::id(),
        'book_id'        => $book->id,
        'mulai_akses'    => now(),
        'berakhir_pada'  => now()->addDays(3),
        'status'         => 'aktif',
    ]);

    return back()->with('success', 'Buku berhasil dipinjam selama 3 hari');
}

}
