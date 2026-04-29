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

//polyline
Route::post('/store-polyline', [PolylineController::class, 'store'])->name('polyline.store');

//polygon
Route::post('/store-polygon', [PolygonController::class, 'store'])->name('polygon.store');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
