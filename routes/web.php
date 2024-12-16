<?php

use App\Http\Controllers\Hello\HelloWorldController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/hello-world', [HelloWorldController::class, 'helloWorld']);

Route::get('/hello-world/{name}', [HelloWorldController::class, 'hello']);

Route::get('/', [HomeController::class, 'index']);
Route::get('/eventos/{slug}', [HomeController::class, 'show']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
