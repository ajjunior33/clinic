<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MedicsController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\PacientsController;
use App\Http\Controllers\Api\PhonesController;
use App\Http\Controllers\Api\ProblemsController;
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


    //Phones
    Route::get("phones/{idPacient}", [PhonesController::class, 'show']);
    Route::post("phones", [PhonesController::class, 'store']);
    Route::put("phones/{idPhone}", [PhonesController::class, 'update']);
    Route::put('phones/updateMain/{idPacient}/{idNew}', [PhonesController::class , 'updateMain']);
    Route::delete('phones/{idPhone}', [PhonesController::class, 'destroy']);

    //Address
    Route::get("address/{idPacient}", [AddressController::class, 'show']);
    Route::post("address", [AddressController::class, 'store']);
    Route::put("address", [AddressController::class, 'update']);
    Route::put('address/updateMain/{idPacient}/{idNew}', [AddressController::class , 'updateMain']);
    Route::delete('address/{idAddress}', [AddressController::class, 'destroy']);
    

    Route::get("medics", [MedicsController::class, 'index']);
    Route::get("medics/{idMedic}", [MedicsController::class, 'show']);
    Route::post("medics", [MedicsController::class, 'store']);
    Route::put("medics/{idMedic}", [MedicsController::class, 'update']);
    Route::delete("medics/{idMedic}", [MedicsController::class, 'destroy']);


    Route::post('diagnostic', [ProblemsController::class, 'store']);
    Route::get('diagnostic/{document}', [ProblemsController::class, 'show']);
    Route::put('diagnostic/{idDiagnostic}', [ProblemsController::class, 'update']);
    Route::delete('diagnostic', [ProblemsController::class, 'destroy']);
});