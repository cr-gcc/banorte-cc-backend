<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Campaigns\CampaignController;

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
	// CAMPAIGNS
	Route::prefix('campaigns')->group(function () {
		Route::get('/', [CampaignController::class, 'index']);
		Route::post('/', [CampaignController::class, 'store']);
		Route::put('/{campaign}', [CampaignController::class, 'update']);
	});
});
