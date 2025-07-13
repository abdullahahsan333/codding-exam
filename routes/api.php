<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TaskManagementController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
route::get('/user/{id}', [AuthController::class, 'userInfo']);


Route::prefix('/post')->group(function () {
    Route::post('/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/destroy/{id}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::get('/show/{id}', [PostController::class, 'show'])->name('post.show');
});
Route::get('/posts', [PostController::class, 'index'])->name('posts');


Route::prefix('/task')->group(function () {
    Route::post('/store', [TaskManagementController::class, 'store'])->name('task.store');
    Route::patch('/complete/{id}', [TaskManagementController::class, 'markCompleted'])->name('task.complete');
    Route::get('/destroy/{id}', [TaskManagementController::class, 'destroy'])->name('task.destroy');
});
Route::get('/tasks', [TaskManagementController::class, 'index'])->name('tasks');