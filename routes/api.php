<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\PacientsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Driver\PcovDriver;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['apiJwt']], function(){
    Route::get('getLogin', [AuthController::class, 'me']);
    Route::get('users', [UsersController::class ,'index']);

    //Pacients

    Route::get("pacients", [PacientsController::class, 'index']);
    Route::get("pacients/{document}", [PacientsController::class, 'show']);
    Route::post('pacients', [PacientsController::class,'store']);
    Route::delete('pacients/{id}', [ PacientsController::class, 'destroy']);


});