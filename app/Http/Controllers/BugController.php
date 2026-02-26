<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bug;

class BugController extends Controller
{
    function index(Request $request) {
        $search = trim((string) $request->query('search', ''));
        $status = (string) $request->query('status', 'all');
        $sort = (string) $request->query('sort', 'newest');

        if (!in_array($status, ['all', 'open', 'in progress'], true)) {
            $status = 'all';
        }

        if (!in_array($sort, ['newest', 'oldest'], true)) {
            $sort = 'newest';
        }

        $baseQuery = Bug::query()
            ->with('worker:id,name')
            ->whereIn('status', ['open', 'in progress']);

        if ($search !== '') {
            $baseQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($status !== 'all') {
            $baseQuery->where('status', $status);
        }

        $bug_array = $baseQuery
            ->orderBy('created_at', $sort === 'oldest' ? 'asc' : 'desc')
            ->paginate(10)
            ->withQueryString();

        $statsQuery = Bug::query()->whereIn('status', ['open', 'in progress']);
        if ($search !== '') {
            $statsQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $openCount = (clone $statsQuery)->where('status', 'open')->count();
        $inProgressCount = (clone $statsQuery)->where('status', 'in progress')->count();
        $recentCount = (clone $statsQuery)->where('created_at', '>=', now()->subDays(7))->count();

        return view('bugs.index', [
            'bug_array' => $bug_array,
            'search' => $search,
            'status' => $status,
            'sort' => $sort,
            'openCount' => $openCount,
            'inProgressCount' => $inProgressCount,
            'recentCount' => $recentCount,
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

    function store(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|min:5',
            'description' => 'required|string|min:5',
            'status' => 'required|string',
        ]);

        $bug = Bug::create($validatedData);

        return redirect()->route('bugs.show', ['id' => $bug->id])
            ->with('success', 'Bug reported successfully!');
    }

    function destroy($id) {
        $bug = Bug::findOrFail($id);

        $bug->delete();

        return redirect()->route('bugs.index')->with('success', 'Bug #' . $bug->id . ' deleted successfully!');
    }
}
