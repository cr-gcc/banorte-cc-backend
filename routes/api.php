<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;

Route::get('/version', [AuthController::class, 'version']);
Route::prefix('auth')->group(function () {
	Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
	// AUTH
	Route::prefix('auth')->group(function () {
		Route::get('/me', [AuthController::class, 'me']);
		Route::get('/logout', [AuthController::class, 'logout']);
	});
});
/*
// 🔓 Rutas públicas
Route::prefix('auth')->group(function () {
	Route::post('/login', [AuthController::class, 'login']);

	// 👇 Importante: logout necesita auth
	Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
});


// 🔐 Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {

	Route::get('/user', function (Request $request) {
		return $request->user();
	});

	Route::get('/dashboard', [DashboardController::class, 'index']);

	// 🔑 Spatie roles
	Route::middleware('role:admin')->group(function () {
		Route::get('/admin', fn() => 'solo admin');
	});
});
*/