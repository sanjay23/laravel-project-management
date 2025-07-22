<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ADMIN API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register ADMIN API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::apiResource('projects',App\Http\Controllers\Admin\ProjectController::class);
Route::apiResource('project-logs',App\Http\Controllers\Admin\ProjectLogController::class);
