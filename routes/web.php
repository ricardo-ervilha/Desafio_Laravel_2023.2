<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Mail\OrderShipped;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'view'])->middleware(['auth', 'verified'])->name('dashboard');

/*Rotas de Gerenciamento de Usuários*/
Route::get('/users', [ProfileController::class, 'index'])->name('users.index')->can('isAdmin', '\App\Models\User');
Route::post('/users/store', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])->name('users.create')->can('isAdmin', '\App\Models\User');
Route::post('/users/delete/{id}', [ProfileController::class, 'delete'])->can('isAdmin', '\App\Models\User');

/*Rotas de Gerenciamento de Proprietários*/
Route::get('/owners', [\App\Http\Controllers\OwnerController::class, 'index'])->name('owners.index');
Route::post('/owners/store', [\App\Http\Controllers\OwnerController::class, 'store'])->name('owners.create');
Route::post('/owners/delete/{id}', [\App\Http\Controllers\OwnerController::class, 'delete']);
Route::post('/owners/edit/{id}', [\App\Http\Controllers\OwnerController::class, 'edit']);

/*Rotas de Gerenciamento de Animais*/
Route::get('/animals', [\App\Http\Controllers\AnimalController::class, 'index']);
Route::post('/animals/create', [\App\Http\Controllers\AnimalController::class, 'create']);
Route::post('/animals/delete/{id}', [\App\Http\Controllers\AnimalController::class, 'delete']);
Route::post('/animals/edit/{id}', [\App\Http\Controllers\AnimalController::class, 'edit']);

/*Rotas de Consultas*/
Route::get('/consultations', [\App\Http\Controllers\ConsultationController::class, 'index']);
Route::get('/owner-animals/{id}', [\App\Http\Controllers\ConsultationController::class, 'animals']);
Route::post('/consultations/create', [\App\Http\Controllers\ConsultationController::class, 'create']);
Route::post('/consultations/{id}/treatment/create', [\App\Http\Controllers\ConsultationController::class, 'createTreatment']);

/*Envio de e-mail*/
Route::get('/email/index', [\App\Http\Controllers\MailController::class, 'index'])->can('isAdmin', '\App\Models\User');;
Route::post('/email/send', [\App\Http\Controllers\MailController::class, 'send'])->can('isAdmin', '\App\Models\User');;

/*Geração do Relatório*/
Route::get('/pdf/index', [\App\Http\Controllers\PdfController::class, 'index']);
Route::post('/pdf/generate', [\App\Http\Controllers\PdfController::class, 'generate']);

require __DIR__.'/auth.php';
