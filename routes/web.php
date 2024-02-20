<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

//Courses
Route::controller(CourseController::class)->group(function (){
    Route::get('/index-course', 'index')->name('course.index');
    Route::get('/create-course', 'create')->name('course.create');
    Route::post('/store-course', 'store')->name('course.store');
    Route::get('/show-course', 'show')->name('course.show');
    Route::get('/edit-course', 'edit')->name('course.edit');
    Route::put('/update-course', 'update')->name('course.update');
    Route::delete('/destroy-course', 'destroy')->name('course.destroy');
});
