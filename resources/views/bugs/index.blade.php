<x-layout>
    @php
        $bugStats = [
            ['label' => 'Open Bugs', 'value' => $openCount],
            ['label' => 'In Progress Bugs', 'value' => $inProgressCount],
            ['label' => 'New This Week', 'value' => $recentCount],
        ];

        $bugStatusOptions = [
            ['value' => 'all', 'label' => 'All'],
            ['value' => 'open', 'label' => 'Open'],
            ['value' => 'in progress', 'label' => 'In Progress'],
        ];

        $bugSortOptions = [
            ['value' => 'newest', 'label' => 'Newest First'],
            ['value' => 'oldest', 'label' => 'Oldest First'],
        ];
    @endphp

    <x-list-page-header
        eyebrow="Bug Tracking"
        eyebrow_icon="bug_report"
        title="Open and In Progress Bugs: {{ $openCount + $inProgressCount }}"
        subtitle="Monitor incoming issues, triage faster, and keep your team unblocked."
        :action-href="route('bugs.report')"
        action-label="Report New Bug"
        :stats="$bugStats"
        :form-action="route('bugs.index')"
        :search="$search"
        search-placeholder="Search bugs by title or description"
        hint-id="bugs-search-hint"
        filter-label="Status"
        filter-name="status"
        :filter-value="$status"
        :filter-options="$bugStatusOptions"
        sort-label="Sort"
        sort-name="sort"
        :sort-value="$sort"
        :sort-options="$bugSortOptions"
    />

    <div class="mb-4 text-sm text-gray-500">
        Showing {{ $bug_array->count() }} bug{{ $bug_array->count() === 1 ? '' : 's' }} on this page.
    </div>
    <ul class="buglist-index">
        @foreach ($bug_array as $bug)
            @php
                $statusClass = match($bug->status) {
                    'open' => 'border-red-200 bg-red-50 text-red-700',
                    'in progress' => 'border-amber-200 bg-amber-50 text-amber-700',
                    default => 'border-slate-200 bg-slate-50 text-slate-700',
                };

                $ageClass = $bug->days_old >= 30
                    ? 'border-red-200 bg-red-50 text-red-700'
                    : 'border-slate-200 bg-slate-50 text-slate-700';
            @endphp
            <li>
                <x-card href="{{ route('bugs.show', $bug->id) }}" :warn="$bug->days_old >= 30">
                    <div class="space-y-3">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                            <div class="min-w-0">
                                <p class="truncate text-base font-semibold text-slate-900">{{ $bug->title }}</p>
                                <p class="mt-1 text-xs text-slate-500">Bug #{{ $bug->id }} • Reported {{ $bug->created_at->diffForHumans() }}</p>
                            </div>

                            <span class="inline-flex w-fit items-center rounded-full border px-2.5 py-1 text-xs font-medium {{ $statusClass }}">
                                {{ ucfirst($bug->status) }}
                            </span>
                        </div>

                        <p class="text-sm text-slate-600">
                            {{ $bug->description ? \Illuminate\Support\Str::limit($bug->description, 140) : 'No description provided yet.' }}
                        </p>

                        <div class="flex flex-wrap items-center gap-2 text-xs">
                            <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-slate-700">
                                <x-google-icon name="person" class="mr-1 !text-[14px]" />
                                {{ optional($bug->worker)->name ?? 'Unassigned' }}
                            </span>

                            <span class="inline-flex items-center rounded-full border px-2.5 py-1 {{ $ageClass }}">
                                <x-google-icon name="schedule" class="mr-1 !text-[14px]" />
                                {{ floor($bug->days_old) }} day{{ floor($bug->days_old) === 1 ? '' : 's' }} old
                            </span>

                            <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-slate-700">
                                <x-google-icon name="calendar_today" class="mr-1 !text-[14px]" />
                                {{ $bug->created_at->format('M j, Y') }}
                            </span>
                        </div>
                    </div>
                </x-card>
            </li>
        @endforeach
    </ul>
    <br />
    {{ $bug_array->links() }}
    <br />

</x-layout>