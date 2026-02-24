<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BugController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bugs',         [BugController::class, 'index']);
Route::get('/bugs/report',  [BugController::class, 'report']);
Route::get('/bugs/{id}',    [BugController::class, 'show']);