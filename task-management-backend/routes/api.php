<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ForceJsonRequestHeader;
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Route::apiResource('tasks', TaskController::class)->middleware('auth:sanctum');

Route::middleware([ForceJsonRequestHeader::class,'auth:sanctum'])->group(function () {
  Route::apiResource('tasks', TaskController::class);
  Route::patch('/tasks/{task}/status' , [TaskController::class , 'updateStatus']);

});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
