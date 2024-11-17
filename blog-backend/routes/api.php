<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\AuthController;
use \App\Http\Middleware\cors;
use \App\Http\Middleware\check_owner;




    
Route::get('/posts',[PostController::class,'index']);
Route::get('/posts/user/',[PostController::class,'user_all_post'])->middleware('auth:sanctum');
Route::get('/posts/{id}',[PostController::class,'show']);
Route::delete('/posts/{id}',[PostController::class,'destroy'])->middleware('auth:sanctum','\App\Http\Middleware\check_owner::class');
Route::post('/posts', [PostController::class, 'store'])->middleware(\App\Http\Middleware\Cors::class,'auth:sanctum');
Route::patch('/posts/{id}', [PostController::class, 'update'])->middleware(\App\Http\Middleware\Cors::class,'auth:sanctum','\App\Http\Middleware\check_owner::class');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');
//Route::patch('/profile/update', [AuthController::class, 'profile_update'])->middleware('auth:sanctum');
Route::post('/profile/update', [AuthController::class, 'profile_update_new'])->middleware('auth:sanctum');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/logout_complete', [AuthController::class, 'logout_all'])->middleware('auth:sanctum');
