<?php


use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\GroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('register',[AuthController::class,'register']);

Route::group(['middleware' => ['auth:sanctum']],function() {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('groups', GroupController::class);

});



