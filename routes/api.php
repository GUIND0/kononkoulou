<?php

use App\Http\Controllers\AuthController;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/logout',[AuthController::class,'logout']);
    Route::get('/projet',function(){
        return Project::all();
    });

});
