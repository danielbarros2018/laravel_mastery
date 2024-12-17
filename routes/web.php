<?php

use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Hello\HelloWorldController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/hello-world', [HelloWorldController::class, 'helloWorld']);

Route::get('/hello-world/{name}', [HelloWorldController::class, 'hello']);

Route::get('/', [HomeController::class, 'index']);
Route::get('/eventos/{slug}', [HomeController::class, 'show'])->name('event.single');


// CRUD de Eventos...
Route::prefix('/admin')->name('admin.')->group(function () {
    Route::prefix('/events')->name('events.')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('index');
    
        Route::get('/create', [EventController::class, 'create'])->name('create');
        Route::post('/store', [EventController::class, 'store'])->name('store');
    
        Route::get('/{event}/edit', [EventController::class, 'edit'])->name('edit');
        Route::post('/update/{event}', [EventController::class, 'update'])->name('update');
    
        Route::get('/destroy/{event}', [EventController::class, 'destroy'])->name('destroy');
    });
});

Route::group(['prefix' => '/admin2', 'name' => 'admin2'],(function () {
    Route::group(['prefix' => '/events', 'name' => 'events'],(function () {
        Route::get('/index', [EventController::class, 'index']);
    
        Route::get('/create', [EventController::class, 'create']);
        Route::post('/store', [EventController::class, 'store']);
    
        Route::get('/{event}/edit', [EventController::class, 'edit']);
        Route::post('/update/{event}', [EventController::class, 'update']);
    
        Route::get('/destroy/{event}', [EventController::class, 'destroy']);
    }));
}));





// ----------------------------------------------------
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
