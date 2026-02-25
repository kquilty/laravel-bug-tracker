<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    function index() {
        $team_array = Team::orderBy('created_at', 'desc')
            //->whereIn('status', ['open', 'in progress'])
            ->paginate(10);

        return view('teams.index', [
            'team_array' => $team_array
        ]);
    }

    function show($id) {
        $team = Team::find($id);

        return view('teams.show', [
            'team' => $team
        ]);
    }

    function create() {
        return view('teams.create');
    }
}
