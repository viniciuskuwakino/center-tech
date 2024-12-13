<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/show/{id}', [ClientController::class, 'show'])->name('clients.show');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients/create', [ClientController::class, 'register'])->name('clients.register');
    Route::put('/clients', [ClientController::class, 'update'])->name('clients.update');

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks/create', [TaskController::class, 'register'])->name('tasks.register');
    Route::put('/tasks', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks', [TaskController::class, 'destroy'])->name('tasks.delete');

});

require __DIR__.'/auth.php';
