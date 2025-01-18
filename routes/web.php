<?php

use App\Http\Controllers\PollController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PollController::class, 'index'])->name('poll.index');
Route::get('/poll/create',[PollController::class, 'create'])->name('poll.create');
Route::get('/poll/{poll_id}',[PollController::class, 'show'])->name('poll.show');
Route::post('/poll',[PollController::class, 'store'])->name('poll.store');
Route::get('/poll/{id}/edit',[PollController::class, 'edit'])->name('poll.edit');
Route::put('poll/{id}',[PollController::class, 'update'])->name('poll.update');
Route::post('/poll/{id}/vote',[PollController::class, 'vote'])->name('poll.vote');
