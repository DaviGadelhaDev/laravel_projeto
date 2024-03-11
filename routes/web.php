<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Logincontroller;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Login
Route::controller(Logincontroller::class)->group(function () {
    Route::get('/', 'index')->name('login.index');
    Route::post('/login', 'store')->name('login.store');
    Route::get('/login-create', 'create')->name('login.create');
    Route::post('/login-create-user', 'storeUser')->name('login.createUser');
});


Route::group(['middleware' => 'auth'], function () {
    //Logout
    Route::get('/logout', [Logincontroller::class, 'destroy'])->name('login.destroy');

    //Dashboard
    Route::get('/dashborad', [DashboardController::class, 'index'])->name('dashboard.index');

    //Usuários
    Route::controller(UserController::class)->group(function () {
        Route::get('/index-user', 'index')->name('user.index');
        Route::get('/create-user', 'create')->name('user.create');
        Route::post('/store-user', 'store')->name('user.store');
        Route::get('/show-user/{user}', 'show')->name('user.show');
        Route::get('/edit-user/{user}', 'edit')->name('user.edit');
        Route::put('/update-user/{user}', 'update')->name('user.update');
        Route::get('/edit-user-password/{user}', 'editPassword')->name('user.edit-password');
        Route::put('/update-user-password/{user}', 'UpdatePassword')->name('user.update-password');
        Route::delete('/destroy-user/{user}', 'destroy')->name('user.destroy');
    });

    //Cursos
    Route::controller(CourseController::class)->group(function () {
        Route::get('/index-course', 'index')->name('course.index');
        Route::get('/create-course', 'create')->name('course.create');
        Route::post('/store-course', 'store')->name('course.store');
        Route::get('/show-course/{course}', 'show')->name('course.show');
        Route::get('/edit-course/{course}', 'edit')->name('course.edit');
        Route::put('/update-course/{course}', 'update')->name('course.update');
        Route::delete('/destroy-course/{course}', 'destroy')->name('course.destroy');
    });

    //aulas 
    Route::controller(ClasseController::class)->group(function () {
        Route::get('/index-classe/{course}', 'index')->name('classe.index');
        Route::get('/create-classe/{course}', 'create')->name('classe.create');
        Route::post('/store-classe', 'store')->name('classe.store');
        Route::get('/show-classe/{classe}', 'show')->name('classe.show');
        Route::get('/edit-classe/{classe}', 'edit')->name('classe.edit');
        Route::put('/update-classe/{classe}', 'update')->name('classe.update');
        Route::delete('/destroy-classe/{classe}', 'destroy')->name('classe.destroy');
    });
});
