<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\WriterApprovalController;
use App\Http\Controllers\Writer\BookController;
use App\Http\Controllers\Writer\ChapterController;
use App\Http\Controllers\Reader\PinjamController;
use App\Http\Controllers\Reader\BookDetailController;
use App\Http\Controllers\Reader\BookReadController;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Route::get('/', function () {
//     return view('welcome');
// });
    // $books = Book::where('writer_id', Auth::id())->latest()->get();
Route::get('/', function (Request $request) {

    $search = $request->search;       // input teks
    $category = $request->category;   // dropdown kategori

    // Query buku
    $books = Book::query()
        ->when($search, function ($query, $search) {
            $query->where('book_name', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%");
        })
        ->when($category, function ($query, $category) {
            $query->where('category', $category);
        })
        ->latest()
        ->get();

    // Ambil semua kategori unik
    $categories = Book::distinct()->pluck('category');

    return view('dashboard', compact('books', 'categories'));

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/writers', [WriterApprovalController::class, 'index'])
        ->name('admin.writers');

    Route::patch('/admin/writers/{user}/approve', [WriterApprovalController::class, 'approve'])
        ->name('admin.writers.approve');

});

Route::middleware(['auth'])->prefix('writer')->name('writer.')->group(function () {
    Route::resource('books',BookController::class);
});


Route::middleware(['auth'])
    ->prefix('writer')
    ->name('writer.')
    ->group(function () {

        /** =====================
         *  BOOKS (Writer)
         *  ===================== */
        Route::resource('books', BookController::class);

        /** =====================
         *  CHAPTERS (Bab Buku)
         *  ===================== */

        // tambah bab
        Route::get(
            'books/{book}/chapters/create',
            [ChapterController::class, 'create']
        )->name('chapters.create');

        Route::post(
            'books/{book}/chapters',
            [ChapterController::class, 'store']
        )->name('chapters.store');

        // lihat isi bab
        Route::get(
            'books/{book}/chapters/{chapter}',
            [ChapterController::class, 'show']
        )->name('chapters.show');

        // edit bab
        Route::get(
            'books/{book}/chapters/{chapter}/edit',
            [ChapterController::class, 'edit']
        )->name('chapters.edit');

        // update bab
        Route::put(
            'books/{book}/chapters/{chapter}',
            [ChapterController::class, 'update']
        )->name('chapters.update');

        // (opsional) hapus bab
        Route::delete(
            'books/{book}/chapters/{chapter}',
            [ChapterController::class, 'destroy']
        )->name('chapters.destroy');
    });
Route::middleware(['auth'])
    ->prefix('reader')
    ->name('reader.')
    ->group(function () {

        Route::post('/books/{book}/pinjam',
            [PinjamController::class, 'store']
        )->name('pinjam.store');

    });
Route::get('/books/{book}', [BookDetailController::class, 'show'])
    ->name('books.show');



Route::middleware(['auth'])
    ->prefix('reader')
    ->name('reader.')
    ->group(function () {

        Route::get('/books/{book}/read',
            [BookReadController::class, 'index']
        )->name('books.read');

        Route::get('/books/{book}/read/{chapter}',
            [BookReadController::class, 'show']
        )->name('books.read.chapter');
    });
Route::middleware(['auth'])
    ->prefix('reader')
    ->name('reader.')
    ->group(function () {

        Route::get('/pinjaman',
            [PinjamController::class, 'index']
        )->name('pinjaman.index');

        Route::post('/pinjam/{book}',
            [PinjamController::class, 'store']
        )->name('pinjam.store');
    });
