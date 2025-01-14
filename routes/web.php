<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MediaController;
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

Route::get('/', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [AdminController::class, 'login']);
Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::get('media', [MediaController::class, 'showMediaForm'])->name('media.uploadForm');
Route::post('media/upload', [MediaController::class, 'upload'])->name('media.upload');
Route::delete('media/{id}', [MediaController::class, 'deleteMedia'])->name('media.delete');
