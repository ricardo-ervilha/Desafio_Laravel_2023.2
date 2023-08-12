<?php

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

Route::get('/', function () {
    return redirect(route('dashboard'));
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*Rotas da Dashboard*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*Rotas de Gerenciamento de Usuários*/
Route::get('/users', [ProfileController::class, 'index'])->name('users.index');
Route::post('/users/store', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])->name('users.create');
Route::post('/users/delete/{id}', [ProfileController::class, 'delete']);

/*Rotas de Gerenciamento de Proprietários*/
Route::get('/owners', [\App\Http\Controllers\OwnerController::class, 'index'])->name('owners.index');
Route::post('/owners/store', [\App\Http\Controllers\OwnerController::class, 'store'])->name('owners.create');
Route::post('/owners/delete/{id}', [\App\Http\Controllers\OwnerController::class, 'delete']);
Route::post('/owners/edit/{id}', [\App\Http\Controllers\OwnerController::class, 'edit']);

require __DIR__.'/auth.php';
