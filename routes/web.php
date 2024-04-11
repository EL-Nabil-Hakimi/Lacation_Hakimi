<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ModelCarController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\ModelCar;
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

        Route::get('/profileusershow/{id}', 'profileusershow');
        Route::get('/profileuser/{id}',  'profileuser');
        Route::get('/clients/admin',  'dashboard')->name('admin.clients');
        Route::post('/changephotouser/{id}',  'changephotouser');
        Route::post('/updateinfo',  'updateinfo');

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




// Group Middleware
// Admin____________________________________________________________________________________
Route::group(['middleware' => ['admin']], function () {

        
        Route::get('/admin/cars' , [CarController::class , 'AdminIndex'])->name('admin.voitures');
        Route::get('/admin/cars/destroy/{id}' , [CarController::class , 'destroy']);
        Route::get('/admin/cars/restore/{id}' , [CarController::class , 'restore']);
        Route::get('/admin/cars/delete/{id}' , [CarController::class , 'delete']);


        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/managers', [ManagerController::class, 'index'])->name('admin.managers');
        Route::get('/profile', [ManagerController::class, 'profilepage']);
        Route::get('/profileshow', [ManagerController::class, 'profileshow']);

        Route::get('/admin/clients', [ClientController::class, 'dashboard'])->name('admin.clients');
        Route::get('/admin/modules', [AdminController::class, 'modules'])->name('admin.modules');

        Route::post('/createmanager' , [ManagerController::class, 'create']);
        Route::post('/updatemanager' , [ManagerController::class, 'update']);

        Route::resources(['admin' => AdminController::class]);

    
});


Route::post('/changephotomanager/{id}' , [ManagerController::class, 'changephoto']);
Route::post('/modifiermotdepass' , [AuthController::class, 'modifiermotdepass']);

Route::get('/banuser/{id}' , [AuthController::class, 'ban']);
Route::get('/restoruser/{id}' , [AuthController::class, 'restore']);



// Cars Manager

Route::get('/cars/manager' , [CarController::class, 'ManagerIndex'])->name('voitures');
Route::get('/cars/desponible/{id}' , [CarController::class, 'desponible']);
Route::get('/cars/indesponible/{id}' , [CarController::class, 'indesponible']);
Route::post('/cars/create' , [CarController::class, 'store']);
Route::post('/cars/update' , [CarController::class, 'update']);

// Model

Route::get('/manager/accepteuser/{id}' , [ManagerController::class, 'accepteuser']);
Route::get('/manager/refuseuser/{id}' , [ManagerController::class, 'refuseuser']);

Route::get('/cars/searchByMark/{id}' , [ModelCarController::class, 'searchByMark']);




