<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bug;

class BugController extends Controller
{
    function index() {
        $bug_array = Bug::orderBy('created_at', 'desc')
            ->whereIn('status', ['open', 'in progress'])
            ->get();

        return view('bugs.index', [
            'bug_array' => $bug_array
        ]);
    }

    function show($id) {
        $bug = Bug::find($id);

        return view('bugs.show', [
            'bug' => $bug
        ]);
    }

    function report() {
        return view('bugs.report');
    }
}
