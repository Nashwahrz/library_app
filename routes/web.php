<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\WriterApprovalController;
use App\Http\Controllers\Writer\BookController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
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
