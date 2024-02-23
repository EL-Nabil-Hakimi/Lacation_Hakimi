<?php

use App\Http\Controllers\ClientController;
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

// Affichage des page Client____________________________________________________________________________

Route::get('/', [ClientController::class, 'index']);
Route::get('/index', [ClientController::class, 'index'])->name('Client.index');
Route::get('/services', [ClientController::class, 'services'])->name('Client.services');
Route::get('/cars', [ClientController::class, 'cars'])->name('Client.cars');
Route::get('/about', [ClientController::class, 'about'])->name('Client.about');
Route::get('/blog', [ClientController::class, 'blog'])->name('Client.blog');
Route::get('/contact', [ClientController::class, 'contact'])->name('Client.contact');
