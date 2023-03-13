<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('sign-up', [\App\Http\Controllers\UsersController::class, 'register'])->name('new-register');
Route::post('login', [\App\Http\Controllers\UsersController::class, 'login'])->name('log-me-in');

//Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [\App\Http\Controllers\UsersController::class, 'logout']);
    Route::get('profile', [\App\Http\Controllers\UsersController::class, 'profile']);
    Route::post('change-password', [\App\Http\Controllers\UsersController::class, 'ChangePassword']);
    Route::get('view', [\App\Http\Controllers\UsersController::class, 'view']);

//});
Route::prefix('/courses')->middleware('auth:sanctum')->group(function () {
    Route::post('add', [\App\Http\Controllers\CoursesController::class, 'add'])->middleware('role:admin')->name('add-course');
    Route::post('edit', [\App\Http\Controllers\CoursesController::class, 'edit'])->middleware('role:admin');
    Route::get('view', [\App\Http\Controllers\CoursesController::class, 'view'])->middleware('role:admin|student')->name('view-courses');
    Route::post('delete', [\App\Http\Controllers\CoursesController::class, 'delete'])->middleware('role:admin');

});
Route::prefix('/classes')->middleware('auth:sanctum')->group(function () {
    Route::post('add', [\App\Http\Controllers\ClassesController::class, 'add'])->middleware('role:student');
    Route::get('view', [\App\Http\Controllers\ClassesController::class, 'view'])->middleware('role:student|admin');
    Route::post('delete', [\App\Http\Controllers\ClassesController::class, 'delete'])->middleware('role:student');

});
Route::prefix('/rate')->middleware('auth:sanctum')->middleware('role:student')->group(function () {
    Route::post('add', [\App\Http\Controllers\CourseRatingController::class, 'add']);
    Route::post('edit', [\App\Http\Controllers\CourseRatingController::class, 'edit']);
    Route::get('view', [\App\Http\Controllers\CourseRatingController::class, 'view']);
    Route::post('delete', [\App\Http\Controllers\CourseRatingController::class, 'delete']);

});

