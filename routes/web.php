<?php

use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('loan.create');
});

Route::get('/loan', [LoanController::class, 'create'])->name('loan.create');
Route::post('/loan', [LoanController::class, 'store'])->name('loan.store');
Route::get('/loan/{loan}', [LoanController::class, 'show'])->name('loan.show');