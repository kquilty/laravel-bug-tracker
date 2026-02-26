<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    function index(Request $request) {
        $search = trim((string) $request->query('search', ''));
        $membership = (string) $request->query('membership', 'all');
        $sort = (string) $request->query('sort', 'newest');

        if (!in_array($membership, ['all', 'with_members', 'without_members'], true)) {
            $membership = 'all';
        }

        if (!in_array($sort, ['newest', 'oldest', 'name_asc', 'name_desc'], true)) {
            $sort = 'newest';
        }

        $baseQuery = Team::query()->withCount('workers');

        if ($search !== '') {
            $baseQuery->where('name', 'like', "%{$search}%");
        }

        if ($membership === 'with_members') {
            $baseQuery->whereHas('workers');
        } elseif ($membership === 'without_members') {
            $baseQuery->whereDoesntHave('workers');
        }

        $team_array = match ($sort) {
            'oldest' => $baseQuery->orderBy('created_at', 'asc')->paginate(10)->withQueryString(),
            'name_asc' => $baseQuery->orderBy('name', 'asc')->paginate(10)->withQueryString(),
            'name_desc' => $baseQuery->orderBy('name', 'desc')->paginate(10)->withQueryString(),
            default => $baseQuery->orderBy('created_at', 'desc')->paginate(10)->withQueryString(),
        };

        $statsQuery = Team::query();
        if ($search !== '') {
            $statsQuery->where('name', 'like', "%{$search}%");
        }

        $totalTeamsCount = (clone $statsQuery)->count();
        $withMembersCount = (clone $statsQuery)->whereHas('workers')->count();
        $newThisWeekCount = (clone $statsQuery)->where('created_at', '>=', now()->subDays(7))->count();

        return view('teams.index', [
            'team_array' => $team_array,
            'search' => $search,
            'membership' => $membership,
            'sort' => $sort,
            'totalTeamsCount' => $totalTeamsCount,
            'withMembersCount' => $withMembersCount,
            'newThisWeekCount' => $newThisWeekCount,
        ]);
    }

    function show(Team $team) {
        return view('teams.show', [
            'team' => $team
        ]);
    }

    function create() {
        return view('teams.create');
    }

    function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $team = Team::create($validated);

        return redirect()->route('teams.index', ['team' => $team])->with('success', 'Team "' . $team->name . '" created successfully!');
    }

    function destroy(Team $team) {

        $team->delete();

        return redirect()->route('teams.index')->with('success', 'Team "' . $team->name . '" deleted successfully!');
    }
}
