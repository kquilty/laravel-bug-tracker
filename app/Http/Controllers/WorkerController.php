<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;

class WorkerController extends Controller
{
    function index(Request $request) {
        $search = trim((string) $request->query('search', ''));
        $position = (string) $request->query('position', 'all');
        $sort = (string) $request->query('sort', 'newest');

        if (!in_array($position, ['all', 'general', 'developer', 'manager'], true)) {
            $position = 'all';
        }

        if (!in_array($sort, ['newest', 'oldest', 'name_asc', 'name_desc'], true)) {
            $sort = 'newest';
        }

        $baseQuery = Worker::query()->with('team:id,name');

        if ($search !== '') {
            $baseQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($position !== 'all') {
            $baseQuery->where('position', $position);
        }

        $worker_array = match ($sort) {
            'oldest' => $baseQuery->orderBy('created_at', 'asc')->paginate(10)->withQueryString(),
            'name_asc' => $baseQuery->orderBy('name', 'asc')->paginate(10)->withQueryString(),
            'name_desc' => $baseQuery->orderBy('name', 'desc')->paginate(10)->withQueryString(),
            default => $baseQuery->orderBy('created_at', 'desc')->paginate(10)->withQueryString(),
        };

        $statsQuery = Worker::query();
        if ($search !== '') {
            $statsQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $totalWorkersCount = (clone $statsQuery)->count();
        $managerCount = (clone $statsQuery)->where('position', 'manager')->count();
        $unassignedCount = (clone $statsQuery)->whereNull('team_id')->count();

        return view('workers.index', [
            'worker_array' => $worker_array,
            'search' => $search,
            'position' => $position,
            'sort' => $sort,
            'totalWorkersCount' => $totalWorkersCount,
            'managerCount' => $managerCount,
            'unassignedCount' => $unassignedCount,
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

    function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:workers,email',
            'position' => 'required|in:general,developer,manager',
            'team_id' => 'nullable|exists:teams,id',
        ]);

        $worker = Worker::create($validatedData);

        return redirect()->route('workers.show', ['id' => $worker->id])->with('success', 'Worker created successfully.');
    }
}
