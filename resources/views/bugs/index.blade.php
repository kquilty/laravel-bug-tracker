<x-layout>
    <section class="mb-6 overflow-hidden rounded-xl border border-slate-200 bg-white/95 shadow-sm">
        <div class="border-b border-slate-200 bg-gradient-to-r from-blue-50/80 to-indigo-50/80 px-5 py-5">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="mb-1 text-xs font-semibold uppercase tracking-wide text-slate-500">Bug Tracking</p>
                    <h1 class="text-2xl font-semibold text-slate-900">Open Bugs</h1>
                    <p class="mt-1 text-sm text-slate-600">Monitor incoming issues, triage faster, and keep your team unblocked.</p>
                </div>
                <a class="btn self-start lg:self-auto" href="{{ route('bugs.report') }}">Report New Bug</a>
            </div>
        </div>

        <div class="grid gap-3 px-5 py-4 sm:grid-cols-3">
            <div class="rounded-lg border border-slate-200 bg-slate-50/70 px-3 py-2">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Open Bugs</p>
                <p class="mt-1 text-xl font-semibold text-slate-900">{{ $openCount }}</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-slate-50/70 px-3 py-2">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">In Progress Bugs</p>
                <p class="mt-1 text-xl font-semibold text-slate-900">{{ $inProgressCount }}</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-slate-50/70 px-3 py-2">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">New This Week</p>
                <p class="mt-1 text-xl font-semibold text-slate-900">{{ $recentCount }}</p>
            </div>
        </div>

        <div class="border-t border-slate-200 px-5 py-4">
            <form action="{{ route('bugs.index') }}" method="GET" data-auto-submit class="grid gap-3 lg:grid-cols-[minmax(0,1fr)_180px_180px] lg:items-start">
                <div class="w-full">
                    <span class="mb-1 block text-xs font-medium uppercase tracking-wide text-slate-500">Filter</span>
                    <label class="flex w-full items-center gap-2 rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-500">
                        <span aria-hidden="true">🔎</span>
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            data-applied-value="{{ $search }}"
                            data-hint-id="bugs-search-hint"
                            placeholder="Search bugs by title or description"
                            class="w-full bg-transparent text-slate-700 placeholder:text-slate-400 focus:outline-none"
                        >
                    </label>
                    <p id="bugs-search-hint" class="search-pending-hint text-xs text-slate-500">Press Enter to search.</p>
                </div>

                <label class="block">
                    <span class="mb-1 block text-xs font-medium uppercase tracking-wide text-slate-500">Status</span>
                    <select name="status" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 focus:border-blue-400 focus:outline-none">
                        <option value="all" @selected($status === 'all')>All</option>
                        <option value="open" @selected($status === 'open')>Open</option>
                        <option value="in progress" @selected($status === 'in progress')>In Progress</option>
                    </select>
                </label>

                <label class="block">
                    <span class="mb-1 block text-xs font-medium uppercase tracking-wide text-slate-500">Sort</span>
                    <select name="sort" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 focus:border-blue-400 focus:outline-none">
                        <option value="newest" @selected($sort === 'newest')>Newest First</option>
                        <option value="oldest" @selected($sort === 'oldest')>Oldest First</option>
                    </select>
                </label>
            </form>
        </div>
    </section>

    <div class="mb-4 text-sm text-gray-500">
        Showing {{ $bug_array->count() }} bug{{ $bug_array->count() === 1 ? '' : 's' }} on this page.
    </div>
    <ul class="buglist-index">
        @foreach ($bug_array as $bug)
            <li>
                <x-card href="{{ route('bugs.show', $bug['id']) }}" :warn="$bug['days_old'] >= 30">
                    <div>
                        <p>{{ $bug['title'].' ('.$bug['status'].')' }}</p>
                        <p class="text-sm text-gray-500">Reported {{ $bug['created_at']->diffForHumans() }}</p>
                    </div>
                </x-card>
            </li>
        @endforeach
    </ul>
    <br />
    {{ $bug_array->links() }}
    <br />

</x-layout>