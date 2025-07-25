<?php

use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Http\Controllers\AuthController;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('projects',App\Http\Controllers\ProjectController::class);
    Route::apiResource('project-users',App\Http\Controllers\ProjectUserController::class);
    Route::apiResource('project-logs',App\Http\Controllers\TimesheetController::class);
    Route::apiResource('users',App\Http\Controllers\UserController::class);  
    Route::patch('/users/{id}/status', [App\Http\Controllers\UserController::class, 'updateStatus']);
    Route::patch('/users/{id}/password', [App\Http\Controllers\UserController::class, 'updatePassword']);
    Route::apiResource('roles',App\Http\Controllers\RoleController::class); 
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
});