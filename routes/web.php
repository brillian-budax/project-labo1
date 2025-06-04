<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabController;
use App\Http\Controllers\BorrowingController;

Route::get('/', function () {
    return redirect()->route('labs.index');
});

// Lab routes
Route::resource('labs', LabController::class);

// Borrowing routes
Route::resource('borrowings', BorrowingController::class)->except(['edit', 'update', 'show']);

Route::get('borrowings/{borrowing}/approve', [BorrowingController::class, 'approve'])->name('borrowings.approve');
Route::get('borrowings/{borrowing}/reject', [BorrowingController::class, 'reject'])->name('borrowings.reject');
