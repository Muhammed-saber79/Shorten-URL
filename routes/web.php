<?php

use App\Http\Controllers\ShortLinkController;
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

Route::get('/', [ShortLinkController::class, 'index']);
Route::post('/generate', [ShortLinkController::class, 'store'])->name('generate');
Route::get('/{code}', [ShortLinkController::class, 'show'])->name('show.shorten.link');
Route::delete('/{code}', [ShortLinkController::class, 'destroy'])->name('delete.link');