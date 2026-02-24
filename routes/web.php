<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bugs', [App\Http\Controllers\BugController::class, 'index']);

Route::get('/bugs/report', [App\Http\Controllers\BugController::class, 'report']);

Route::get('/bugs/{id}', [App\Http\Controllers\BugController::class, 'show']);
