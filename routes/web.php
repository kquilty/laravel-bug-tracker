<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BugController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\TeamController;
use App\Models\Bug;
use App\Models\Team;
use App\Models\Worker;

Route::get('/', function () {
    $openBugCount = Bug::where('status', 'open')->count();
    $inProgressBugCount = Bug::where('status', 'in progress')->count();
    $staleBugCount = Bug::where('days_old', '>=', 30)->count();

    $workerCount = Worker::count();
    $teamCount = Team::count();
    $unassignedWorkersCount = Worker::whereNull('team_id')->count();

    $latestBug = Bug::latest('created_at')->first();

    return view('welcome', [
        'openBugCount' => $openBugCount,
        'inProgressBugCount' => $inProgressBugCount,
        'staleBugCount' => $staleBugCount,
        'workerCount' => $workerCount,
        'teamCount' => $teamCount,
        'unassignedWorkersCount' => $unassignedWorkersCount,
        'latestBug' => $latestBug,
    ]);
});

Route::get('/bugs',         [BugController::class, 'index']) ->name('bugs.index');
Route::get('/bugs/report',  [BugController::class, 'report'])->name('bugs.report');
Route::get('/bugs/{id}',    [BugController::class, 'show'])  ->name('bugs.show');

Route::get('/workers',         [WorkerController::class, 'index']) ->name('workers.index');
Route::get('/workers/create',  [WorkerController::class, 'create'])->name('workers.create');
Route::get('/workers/{id}',    [WorkerController::class, 'show'])  ->name('workers.show');

Route::get('/teams',         [TeamController::class, 'index']) ->name('teams.index');
Route::get('/teams/create',  [TeamController::class, 'create'])->name('teams.create');
Route::get('/teams/{id}',    [TeamController::class, 'show'])  ->name('teams.show');

Route::post('/bugs', [BugController::class, 'store'])->name('bugs.store');
Route::post('/workers', [WorkerController::class, 'store'])->name('workers.store');
Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');

Route::delete('/bugs/{id}', [BugController::class, 'destroy'])->name('bugs.destroy');
Route::delete('/workers/{id}', [WorkerController::class, 'destroy'])->name('workers.destroy');
Route::delete('/teams/{id}', [TeamController::class, 'destroy'])->name('teams.destroy');