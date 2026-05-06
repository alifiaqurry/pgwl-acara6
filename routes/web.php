<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\PolygonController;
use App\Http\Controllers\PolylineController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/peta', [PageController::class, 'peta'])->name('peta');

Route::get('/tabel', [PageController::class, 'tabel'])->name('tabel');

//points
Route::post('/store-points', [PointsController::class, 'store'])->name('point.store');
Route::delete('/delete-points/{id}', [PointsController::class, 'destroy'])->name('point.delete');

//polyline
Route::post('/store-polyline', [PolylineController::class, 'store'])->name('polyline.store');
Route::delete('/delete-polyline/{id}', [PolylineController::class, 'destroy'])->name('polyline.delete');

//polygon
Route::post('/store-polygon', [PolygonController::class, 'store'])->name('polygon.store');
Route::delete('/delete-polygon/{id}', [PolygonController::class, 'destroy'])->name('polygon.delete');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
