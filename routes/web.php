<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BugController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bugs',         [BugController::class, 'index']) ->name('bugs.index');
Route::get('/bugs/report',  [BugController::class, 'report'])->name('bugs.report');
Route::get('/bugs/{id}',    [BugController::class, 'show'])  ->name('bugs.show');