<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\WriterApprovalController;
use App\Http\Controllers\Writer\BookController;
use App\Http\Controllers\Writer\ChapterController;
use App\Models\Book;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    $books = Book::latest()->get();
    // kalau mau khusus writer login:
    // $books = Book::where('writer_id', Auth::id())->latest()->get();

    return view('dashboard', compact('books'));
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


