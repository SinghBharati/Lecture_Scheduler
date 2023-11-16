<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\BatchController;


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

Route::get('/', [InstructorController::class, 'index']);

Route::get('/add_course', [CourseController::class , 'index'])->name('addcourse');
Route::post('/add_course', [CourseController::class , 'store']);

Route::get('/add_batch/{id}', [BatchController::class , 'index'])->name('addbatch');
Route::post('/add_batch/{id}', [BatchController::class , 'store']);

//Route::view('/instructiorpanel', 'instructorpanel');
Route::get('/instructiorpanel/{id}', [InstructorController::class, 'show']);
