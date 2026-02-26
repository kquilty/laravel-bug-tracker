<x-layout>
    <section class="mb-6 overflow-hidden rounded-xl border border-slate-200 bg-white/95 shadow-sm">
        <div class="border-b border-slate-200 bg-gradient-to-r from-blue-50/80 to-indigo-50/80 px-5 py-6">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="mb-1 text-xs font-semibold uppercase tracking-wide text-slate-500">Operations Overview</p>
                    <h1 class="text-3xl font-semibold text-slate-900">Help Desk Command Center</h1>
                    <p class="mt-2 max-w-2xl text-sm text-slate-600">Quickly review active work, monitor staffing coverage, and jump into the areas that need attention.</p>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('bugs.report') }}" class="btn inline-flex items-center gap-1">
                        <x-google-icon name="bug_report" class="icon-inline-fix" />
                        Report New Bug
                    </a>
                    <a href="{{ route('workers.create') }}" class="inline-flex items-center gap-1 rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                        <x-google-icon name="person_add" class="icon-inline-fix" />
                        Add Worker
                    </a>
                </div>
            </div>
        </div>

        <div class="grid gap-3 px-5 py-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-lg border border-slate-200 bg-slate-50/70 px-3 py-2">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Open Bugs</p>
                <p class="mt-1 text-xl font-semibold text-slate-900">{{ $openBugCount }}</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-slate-50/70 px-3 py-2">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">In Progress Bugs</p>
                <p class="mt-1 text-xl font-semibold text-slate-900">{{ $inProgressBugCount }}</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-slate-50/70 px-3 py-2">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Stale Bugs (30+ days)</p>
                <p class="mt-1 text-xl font-semibold {{ $staleBugCount > 0 ? 'text-red-700' : 'text-slate-900' }}">{{ $staleBugCount }}</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-slate-50/70 px-3 py-2">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Workers</p>
                <p class="mt-1 text-xl font-semibold text-slate-900">{{ $workerCount }}</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-slate-50/70 px-3 py-2">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Teams</p>
                <p class="mt-1 text-xl font-semibold text-slate-900">{{ $teamCount }}</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-slate-50/70 px-3 py-2">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Unassigned Workers</p>
                <p class="mt-1 text-xl font-semibold {{ $unassignedWorkersCount > 0 ? 'text-amber-700' : 'text-slate-900' }}">{{ $unassignedWorkersCount }}</p>
            </div>
        </div>
    </section>

    <section class="grid gap-4 md:grid-cols-2">
        <article class="rounded-xl border border-slate-200 bg-white/95 p-5 shadow-sm">
            <h2 class="mb-4 text-sm font-semibold uppercase tracking-wide text-slate-500">Quick Navigation</h2>
            <div class="grid gap-2 sm:grid-cols-2">
                <a href="{{ route('bugs.index') }}" class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">View Bugs</a>
                <a href="{{ route('workers.index') }}" class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">View Workers</a>
                <a href="{{ route('teams.index') }}" class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">View Teams</a>
                <a href="{{ route('teams.create') }}" class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Create Team</a>
            </div>
        </article>

        <article class="rounded-xl border border-slate-200 bg-white/95 p-5 shadow-sm">
            <h2 class="mb-4 text-sm font-semibold uppercase tracking-wide text-slate-500">Latest Bug Activity</h2>

            @if ($latestBug)
                <p class="text-base font-semibold text-slate-900">{{ $latestBug->title }}</p>
                <p class="mt-1 text-sm text-slate-600">Status: {{ ucfirst($latestBug->status) }}</p>
                <p class="mt-1 text-sm text-slate-500">Reported {{ $latestBug->created_at->diffForHumans() }}</p>
                <a href="{{ route('bugs.show', $latestBug->id) }}" class="mt-4 inline-flex items-center rounded-lg border border-blue-200 bg-blue-50 px-3 py-2 text-sm font-medium text-blue-700 hover:bg-blue-100">Open Bug #{{ $latestBug->id }}</a>
            @else
                <p class="text-sm text-slate-600">No bugs have been reported yet. Create your first bug report to start tracking issues.</p>
                <a href="{{ route('bugs.report') }}" class="mt-4 inline-flex items-center rounded-lg border border-blue-200 bg-blue-50 px-3 py-2 text-sm font-medium text-blue-700 hover:bg-blue-100">Create First Bug</a>
            @endif
        </article>
    </section>

</x-layout>