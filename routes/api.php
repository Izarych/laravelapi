<?php

use App\Http\Controllers\ClassesController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'students'], function() {
    Route::get('/', [StudentController::class, 'index']);
    Route::get('{student}', [StudentController::class, 'show']);
    Route::post('/', [StudentController::class, 'store']);
    Route::patch('{student}', [StudentController::class, 'update']);
    Route::delete('{student}', [StudentController::class, 'destroy']);
});

Route::group(['prefix' => 'classes'], function () {
    Route::get('/', [ClassesController::class, 'index']);
    Route::get('{class}', [ClassesController::class, 'show']);
    Route::get('{class}/curriculum', [ClassesController::class, 'getCurriculum']);
    Route::put('curriculum/update', [ClassesController::class, 'updateCurriculum']);
    Route::post('/', [ClassesController::class, 'store']);
    Route::patch('{class}', [ClassesController::class, 'update']);
    Route::delete('{class}', [ClassesController::class, 'destroy']);
});

Route::group(['prefix' => 'lectures'], function () {
    Route::get('/', [LectureController::class, 'index']);
    Route::get('{lecture}', [LectureController::class, 'show']);
    Route::post('/', [LectureController::class, 'store']);
    Route::patch('{lecture}', [LectureController::class, 'update']);
    Route::delete('{lecture}', [LectureController::class, 'destroy']);
});
