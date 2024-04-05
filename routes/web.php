<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ManagerController;
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


Route::group([], function () {
    Route::controller(ClientController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/index', 'index')->name('Client.index');
        Route::get('/services', 'services')->name('Client.services');
        Route::get('/cars', 'cars')->name('Client.cars');
        Route::get('/about', 'about')->name('Client.about');
        Route::get('/blog', 'blog')->name('Client.blog');
        Route::get('/contact', 'contact')->name('Client.contact');
    });
});



// Authontification _______________________________________________________________________

Route::group([], function () {
    Route::controller(AuthController::class)->group(function () {

        Route::get('/login', 'login')->name('Auth.login');

        Route::post('/signup', 'signUp');
        Route::post('/signin', 'signIn');

        Route::get('/email', 'emailPage')->name('Auth.email');

        Route::post('/checkemail', 'checkEmail');

        Route::get('/changepass/{token}', 'pass');
        Route::post('/changepass/{token}', 'resetPass');
    });
});


// client____
Route::get('/profileusershow/{id}', [ClientController::class, 'profileusershow']);
Route::get('/profileuser/{id}', [ClientController::class, 'profileuser']);
Route::get('/clients/admin', [ClientController::class, 'dashboard'])->name('admin.clients');
Route::post('/changephotouser/{id}', [ClientController::class, 'changephotouser']);
Route::post('/updateinfo', [ClientController::class, 'updateinfo']);


// Admin____________________________________________________________________________________

Route::resources(['admin' => AdminController::class]);

Route::get('/admin', [AdminController::class, 'index'])->name('dashboard');
Route::get('/managers', [ManagerController::class, 'index'])->name('managers');
Route::get('/profile', [ManagerController::class, 'profilepage']);
Route::get('/profileshow', [ManagerController::class, 'profileshow']);




Route::get('/clients', [AdminController::class, 'clients'])->name('clients');
Route::get('/voitures', [AdminController::class, 'voitures'])->name('voitures');
Route::get('/modules', [AdminController::class, 'modules'])->name('modules');

Route::post('/createmanager' , [ManagerController::class, 'create']);
Route::post('/updatemanager' , [ManagerController::class, 'update']);

Route::post('/changephotomanager/{id}' , [ManagerController::class, 'changephoto']);
Route::post('/modifiermotdepass' , [AuthController::class, 'modifiermotdepass']);

Route::get('/banuser/{id}' , [AuthController::class, 'ban']);
Route::get('/restoruser/{id}' , [AuthController::class, 'restore']);



