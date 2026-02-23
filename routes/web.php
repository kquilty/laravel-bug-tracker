<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bugs', function () {

    //TODO: Fetch from database, pass in below.
    $bug_array = [
        ['id' => 1, 'title' => 'Login page error', 'status' => 'open'],
        ['id' => 2, 'title' => 'Dashboard not loading', 'status' => 'in progress'],
        ['id' => 3, 'title' => 'Profile update fails', 'status' => 'closed'],
    ];

    return view('bugs.index', [
        'bug_array' => $bug_array
    ]);
});

Route::get('/bugs/{id}', function ($id) {

    //TODO: Fetch full record from id, pass in below.

    return view('bugs.show', ['id' => $id]);
});
