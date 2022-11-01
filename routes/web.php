<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::middleware('isNotAuth')->get('/login', function () {return view('login');});
Route::middleware('isNotAuth')->post('/login', [authController::class, 'login']);
Route::middleware('isNotAuth')->get('/register', function () {return view('register');});
Route::middleware('isNotAuth')->post('/register', [authController::class, 'register']);
Route::middleware('isAuth')->get('/disconnect', [authController::class, 'disconnect']);

// Profile routes
Route::middleware('isAuth')->get('/profile', function () {return view('profile');});
Route::middleware('isAuth')->get('/profile/{id}', [ProfileController::class, 'getProfile']);
Route::middleware('isAuth')->post('/profile', [ProfileController::class, 'updateProfile']);
Route::middleware('isAuth')->post('/deleteprofile', [ProfileController::class, 'deleteProfile']);

// Post routes
Route::middleware('isAuth')->get('/home', [PostController::class, 'getAllPosts']);
Route::middleware('isAuth')->post('/home', [PostController::class, 'createPost']);
Route::middleware('isAuth')->get('/deletePost/{id}', [PostController::class, 'deletePost']);
