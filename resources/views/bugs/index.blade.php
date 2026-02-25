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
        title="Open Bugs"
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