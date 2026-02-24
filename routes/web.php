<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bugs', [App\Http\Controllers\BugController::class, 'index']);

Route::get('/bugs/report', function () {
    return view('bugs.report');
});

Route::get('/bugs/{id}', function ($id) {

    //TODO: Fetch full record from id, pass in below.

    return view('bugs.show', ['id' => $id]);
});
