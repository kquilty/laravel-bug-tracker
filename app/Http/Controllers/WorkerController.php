<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;

class WorkerController extends Controller
{
    function index() {
        $worker_array = Worker::orderBy('created_at', 'desc')
            //->whereIn('status', ['open', 'in progress'])
            ->paginate(10);

        return view('workers.index', [
            'worker_array' => $worker_array
        ]);
    }

    function show($id) {
        $worker = Worker::find($id);

        return view('workers.show', [
            'worker' => $worker
        ]);
    }

    function create() {
        return view('workers.create');
    }
}
