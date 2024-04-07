<?php

use App\Http\Controllers\ToDoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['as' => 'todo.', 'prefix' => 'todo'], function() {
    Route::get('', [ToDoController::class, 'index'])->name('index');
    Route::get('previous', [ToDoController::class, 'previousTask'])->name('previous');
    Route::get('create', [ToDoController::class, 'create'])->name('create');
    Route::post('', [ToDoController::class, 'store'])->name('store');
    Route::get('{id}/edit', [ToDoController::class, 'edit'])->name('edit');
    Route::put('{id}', [ToDoController::class, 'update'])->name('update');
    Route::delete('{id}', [ToDoController::class, 'destroy'])->name('destroy');
    Route::get('filter', [ToDoController::class, 'filter'])->name('filter');
    Route::get('search', [ToDoController::class, 'search'])->name('search');

    // Route::get('', [ToDoController::class, 'index'])->name('index');
    // Route::get('create', [ToDoController::class, 'create'])->name('create');
    // Route::post('', [ToDoController::class, 'store'])->name('store');
    // Route::get('{id}/edit', [ToDoController::class, 'edit'])->name('edit');
    // Route::put('{id}', [ToDoController::class, 'update'])->name('update');
    // Route::delete('{id}', [ToDoController::class, 'destroy'])->name('destroy');
});
