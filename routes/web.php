<?php

use http\Client\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/home', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return view('layouts.test1');
});
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/course', function () {
    return view('courses');
})->name('course-page');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/my-view', function () {
    return view('view');
})->name('view');

Route::get('/send', function () {
    $data = [
        'error' => 1,
        'msg' => 'hi',
        'msg2' => 'hi2'
    ];
    return $data;
});


