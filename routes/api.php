<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarCompanyController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ModelCarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/indexa', [CarController::class, 'ManagerIndex']);
Route::get('/indexi', [CarController::class, 'AdminIndex']);
Route::get('/indexia', [CarController::class, 'index']);
Route::get('/showcars/{id}', [CarController::class, 'show']);

Route::post('/signup', [AuthController::class , 'signUp']);
Route::post('/updateinfo', [ClientController::class, 'updateinfo']);
Route::post('/createmdl', [CarController::class, 'saveCarModels']);
Route::post('/createcar', [CarController::class, 'store']);
Route::post('/createcar/update/{id}', [CarController::class, 'update']);
Route::get('/createcar/destroy/{id}', [CarController::class, 'destroy']);
Route::get('/createcar/restore/{id}', [CarController::class, 'restore']);

Route::get('/searchcar/{matricule}', [CarController::class, 'searchByMatricule']);


Route::get('/cars/searchByMark/{id}' , [ModelCarController::class, 'searchByMark']);


Route::get('/marques', [CarCompanyController::class, 'datajsnon']);