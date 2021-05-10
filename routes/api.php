<?php

use App\Http\Controllers\API\FormController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\OtherTransactionController;
use App\Models\OtherTransaction;
use App\Models\Transaction;
use Illuminate\Http\Request;
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

Route::get('/user', [UserController::class, 'getData']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/changePassword', [UserController::class, 'changePassword']);

Route::get('/form', [FormController::class, 'getData']);
Route::get('/form/id', [FormController::class, 'getDataId']);
Route::get('/form/date', [FormController::class, 'getDataByDate']);
Route::post('/form/create', [FormController::class, 'createForm']);
Route::get('/form/status', [FormController::class, 'getDataStatus']);
Route::get('/form/status2', [FormController::class, 'getData2Status']);
Route::get('/form/type', [FormController::class, 'getDataType']);
Route::post('/form/update', [FormController::class, 'updateForm']);

Route::post('/transaction/create', [TransactionController::class, 'createTransaction']);
Route::post('/transaction/update', [TransactionController::class, 'updateTransaction']);

Route::post('/otherTransaction/create', [OtherTransactionController::class, 'createTransaction']);
Route::post('/otherTransaction/update', [OtherTransactionController::class, 'updateTransaction']);
