<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\NoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', array(AuthController::class, 'login'));
Route::post('refresh', array(AuthController::class, 'refresh'));

Route::group(array('middleware' => 'auth:api'), function(){
    
    // Contacts
    Route::group(array('prefix' => 'contacts'), function(){
        Route::get('/', array(ContactController::class, 'list'));
        Route::get('/get-id/{id}', array(ContactController::class, 'getById'));
        Route::get('/get-name/{name}', array(ContactController::class, 'getByName'));
        Route::get('/get-company/{company}', array(ContactController::class, 'getByCompanyId'));
        Route::post('/create', array(ContactController::class, 'create'));
        Route::post('/store', array(ContactController::class, 'store'));
        Route::put('/update/{id}', array(ContactController::class, 'update'));
    });

    // Companies
    Route::group(array('prefix' => 'companies'), function(){
        Route::get('/', array(CompanyController::class, 'list'));
    });

    // Notes
    Route::group(array('prefix' => 'notes'), function(){
        Route::post('/create', array(NoteController::class, 'create'));
    });

    Route::post('logout', array(AuthController::class, 'logout'));
});