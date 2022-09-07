<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ComplateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

Route::middleware(['guest', 'preventBackHistory'])->group(function () {
    Route::get('/', function () {
        return view('index');
    });
    Route::view('/login', 'index')->name('login');
    Route::view('/register', 'index')->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login/check', [AuthController::class, 'check'])->name('check');
});
Route::middleware(['auth', 'preventBackHistory'])->group(function () {
    Route::view('/home', 'home')->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::view('/password', 'dashboard.password')->name('password');
    Route::patch('/password/changed', [AuthController::class, 'changePassword'])->name('password.changed');
    Route::post('/add/todo', [TodoController::class, 'store'])->name('newTodo');
    Route::get('/todo/{user_id}', [TodoController::class, 'index'])->name('todo');
    Route::get('/todo/edit/{id}', [TodoController::class, 'edit'])->name('todo.edit');
    Route::patch('/todo/update/{id}', [TodoController::class, 'update'])->name('todo.update');
    Route::delete('/todo/delete/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');
    Route::get('/todo/complated/{id}', [ComplateController::class, 'update'])->name('todo.complated');
    Route::get('/todo/complate/{user_id}', [ComplateController::class, 'index'])->name('complated');
    Route::get('/todo/undo/{id}', [ComplateController::class, 'undo'])->name('complated.undo');
    Route::delete('/todo/complated/delete/{id}', [ComplateController::class, 'destroy'])->name('complated.destroy');
});