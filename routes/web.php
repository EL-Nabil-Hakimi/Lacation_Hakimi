<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarCompanyController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ModelCarController;
use App\Http\Controllers\ReservationController;
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
        Route::get('/', 'index')->name('Client.index');
        Route::get('/index', 'index')->name('Client.index');
        Route::get('/services', 'services')->name('Client.services');
        Route::get('/cars', 'cars')->name('Client.cars');
        Route::get('/about', 'about')->name('Client.about');
        Route::get('/blog', 'blog')->name('Client.blog');
        Route::get('/contact', 'contact')->name('Client.contact');

        Route::get('/profile/{id}', 'profile_client')->name('Client.profile');

        

        Route::get('/profileusershow/{id}', 'profileusershow');
        Route::get('/profileuser/{id}',  'profileuser');
        Route::get('/clients/admin',  'dashboard')->name('admin.clients');

        Route::post('/changephotouser/{id}',  'changephotouser');

        Route::post('/updateinfouser',  'updateinfouser');

        Route::get('/car_single/{id}' , 'car_single');

    });
});


Route::post('/addreservation/{id}',[ReservationController::class , 'addreservation']);


Route::post('/check_car/{id}' , [ReservationController::class, 'check_car']);


Route::get('/Client/reservations' , [ReservationController::class, 'index']);
// Authontification _______________________________________________________________________

Route::group([], function () {
    Route::controller(AuthController::class)->group(function () {

        Route::get('/login', 'login')->name('Auth.login');
        Route::get('/logout', 'logout')->name('Auth.logout');

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

        Route::get('/admin/permissions' , [AdminController::class, 'Role'])->name('admin.roles');
        Route::post('/admin/Permissions/add' , [AdminController::class, 'createRole']);
        
        Route::post('/admin/Permissions/update' , [AdminController::class, 'updateRole']);
        Route::get('/admin/Permissions/destroy/{id}' , [AdminController::class, 'destroyRole']);

        Route::get('/getroles/{id}' , [AdminController::class, 'getPermission' ]);

        
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

        // reservation

        Route::get('/admin/reservation', [ReservationController::class, 'AdminReservation'])->name('admin.reservation');
        Route::get('/admin/StatuCar/{id}/{status}', [ReservationController::class, 'StatuCar']);

        Route::post('/createmanager' , [ManagerController::class, 'create']);
        Route::post('/updatemanager' , [ManagerController::class, 'update']);

        Route::get('/banuser/{id}' , [AuthController::class, 'ban']);
        Route::get('/restoruser/{id}' , [AuthController::class, 'restore']);

        Route::get('/admin/module' , [ModelCarController::class, 'index'])->name('module.cars');
        Route::post('/module/add' , [ModelCarController::class, 'store']);
        Route::get('/module/delete/{id}' , [ModelCarController::class, 'delete']);

        Route::resources(['admin' => AdminController::class]);

    
});

Route::get('/profile', [ManagerController::class, 'profilepage']);

Route::group(['middleware' => ['manager']], function () {
    // Dashboard
    Route::get('/manager/dashboard', [AdminController::class, 'index'])->name('manager.dashboard');

    // Cars
    Route::get('/manager/cars', [CarController::class, 'AdminIndex'])->name('manager.voitures');
    Route::get('/manager/cars/destroy/{id}', [CarController::class, 'manager.destroy']);
    Route::get('/manager/cars/restore/{id}', [CarController::class, 'manager.restore']);
    Route::get('/manager/cars/delete/{id}', [CarController::class, 'manager.delete']);

    // Clients
    Route::get('/manager/clients', [ClientController::class, 'dashboard'])->name('manager.clients');

    // Modules
    Route::get('/manager/modules', [AdminController::class, 'modules'])->name('manager.modules');

    // Reservation
    Route::get('/manager/reservation', [ReservationController::class, 'AdminReservation'])->name('manager.reservation');
    Route::get('/manager/StatuCar/{id}/{status}', [ReservationController::class, 'StatuCar'])->name('manager.statuCar');

    // User Management
    Route::get('/manager/banuser/{id}', [AuthController::class, 'ban'])->name('manager.banUser');
    Route::get('/manager/restoruser/{id}', [AuthController::class, 'restore'])->name('manager.restoreUser');

    // Module Cars
    Route::get('/manager/module', [ModelCarController::class, 'index'])->name('manager.module_cars');
    Route::post('/manager/module/add', [ModelCarController::class, 'store'])->name('manager.module_add');
    Route::get('/manager/module/delete/{id}', [ModelCarController::class, 'delete'])->name('manager.module_delete');

    // Mark Cars
    Route::get('/manager/marque' , [CarCompanyController::class, 'index'])->name('manager.marque_cars');

});


Route::get('/client/StatuCar/{id}/{status}', [ReservationController::class, 'StatuCar']);
Route::get('/client/downloadReservation/{id}',  [ReservationController::class, 'downloadReservation']);



Route::post('/changephotomanager/{id}' , [ManagerController::class, 'changephoto']);
Route::post('/modifiermotdepass' , [AuthController::class, 'modifiermotdepass']);




// Cars Manager

// Route::get('/manager/dashboard' , [ManagerController::class, 'ManagerDashboard'])->name('manager.dashboard');
// Route::get('/manager/clients', [ClientController::class, 'dashboard'])->name('manager.clients');

// Route::get('/manager/cars' , [CarController::class, 'ManagerIndex'])->name('manager.cars');
// Route::get('/manager/module' , [ModelCarController::class, 'index'])->name('module.cars');
// Route::post('/module/add' , [ModelCarController::class, 'store']);
// Route::post('/module/update' , [ModelCarController::class, 'update']);
// Route::get('/module/delete/{id}' , [ModelCarController::class, 'delete']);


Route::post('/marque/add' , [CarCompanyController::class, 'store']);
Route::post('/marque/update' , [CarCompanyController::class, 'update']);
Route::get('/marque/delete/{id}' , [CarCompanyController::class, 'delete']);

Route::get('/manager/myprofile/{id}' , [ManagerController::class, 'profilepage']);
Route::post('/manager/changepass' , [AuthController::class, 'modifiermotdepass']);
Route::post('/manager/changeimage/{id}' , [ManagerController::class, 'changephoto']);




Route::get('/cars/desponible/{id}' , [CarController::class, 'desponible']);
Route::get('/cars/indesponible/{id}' , [CarController::class, 'indesponible']);
Route::post('/cars/create' , [CarController::class, 'store']);
Route::post('/cars/update' , [CarController::class, 'update']);

// Model

Route::get('/manager/accepteuser/{id}' , [ManagerController::class, 'accepteuser']);
Route::get('/manager/refuseuser/{id}' , [ManagerController::class, 'refuseuser']);

Route::get('/cars/searchByMark/{id}' , [ModelCarController::class, 'searchByMark']);


Route::post('/updateinfo/{id}' , [ClientController::class, 'updateinfo']);


Route::post('/search/cars/client' , [ClientController::class, 'searchcarforclient']);
Route::post('/search/cars/client/ajax' , [ClientController::class, 'searchCarByModle']);

// Permission
