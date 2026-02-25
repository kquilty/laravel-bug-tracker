<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BugController;
use App\Http\Controllers\WorkerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bugs',         [BugController::class, 'index']) ->name('bugs.index');
Route::get('/bugs/report',  [BugController::class, 'report'])->name('bugs.report');
Route::get('/bugs/{id}',    [BugController::class, 'show'])  ->name('bugs.show');

Route::get('/workers',         [WorkerController::class, 'index']) ->name('workers.index');
Route::get('/workers/create',  [WorkerController::class, 'create'])->name('workers.create');
Route::get('/workers/{id}',    [WorkerController::class, 'show'])  ->name('workers.show');