<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//GEOJSON API
Route::get('/points', [App\Http\Controllers\ApiController::class, 'geojson_points'])
->name('geojson.points');

Route::get('/polyline', [App\Http\Controllers\ApiController::class, 'geojson_polyline'])
->name('geojson.polyline');

Route::get('/polygon', [App\Http\Controllers\ApiController::class, 'geojson_polygon'])
->name('geojson.polygon');


