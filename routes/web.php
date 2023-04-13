<?php

use App\Http\Controllers\AdminNewsController;
use App\Http\Controllers\ProfileController;
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


// Sécuriser la route via le middleware 'auth'
Route::get('/secure', function () {
    return view('secure');
})->middleware(['auth']);

Route::get('/unsecure', function () {
    return view('unsecure');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*************************
 * 
 * Route sécurée pour la gestion des news
 * [Ajout, Mise à jour, Suppression & Autres]
 * à l'aide d'un controller "AdminNewsController"
 */

 Route::middleware(['auth'])->group(function () {
    Route::get('/admin/news/add', [AdminNewsController::class, 'add'])->name('news.add');
 });

require __DIR__.'/auth.php';
