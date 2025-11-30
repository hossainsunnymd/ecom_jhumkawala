<?php

use App\Http\Controllers\Frontend\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix'=>'frontend'],function(){
    Route::get('countries',[LocationController::class,'countries'])->name('countries');
    Route::get('states-by-country',[LocationController::class,'stateByCountry'])->name('states');
    Route::get('cities-by-state',[LocationController::class,'cityByState'])->name('cities');
});