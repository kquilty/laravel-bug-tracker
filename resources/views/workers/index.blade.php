<x-layout>
    @php
        $workerStats = [
            ['label' => 'Total Workers', 'value' => $totalWorkersCount],
            ['label' => 'Managers', 'value' => $managerCount],
            ['label' => 'Unassigned to Team', 'value' => $unassignedCount],
        ];

        $workerPositionOptions = [
            ['value' => 'all', 'label' => 'All Positions'],
            ['value' => 'general', 'label' => 'General'],
            ['value' => 'developer', 'label' => 'Developer'],
            ['value' => 'manager', 'label' => 'Manager'],
        ];

        $workerSortOptions = [
            ['value' => 'newest', 'label' => 'Newest First'],
            ['value' => 'oldest', 'label' => 'Oldest First'],
            ['value' => 'name_asc', 'label' => 'Name A-Z'],
            ['value' => 'name_desc', 'label' => 'Name Z-A'],
        ];
    @endphp

    <x-list-page-header
        eyebrow="Team Operations"
        title="Workers"
        subtitle="Browse contributors, review roles, and keep team assignments organized."
        :action-href="route('workers.create')"
        action-label="Add New Worker"
        :stats="$workerStats"
        :form-action="route('workers.index')"
        :search="$search"
        search-placeholder="Search workers by name or email"
        hint-id="workers-search-hint"
        filter-label="Position"
        filter-name="position"
        :filter-value="$position"
        :filter-options="$workerPositionOptions"
        sort-label="Sort"
        sort-name="sort"
        :sort-value="$sort"
        :sort-options="$workerSortOptions"
    />

    <div class="mb-4 text-sm text-gray-500">
        Showing {{ $worker_array->count() }} worker{{ $worker_array->count() === 1 ? '' : 's' }} on this page.
    </div>

    <ul class="workerlist-index">
        @foreach ($worker_array as $worker)
            <li>
                <x-card href="{{ route('workers.show', $worker['id']) }}">
                    <div>
                        <p>{{ $worker['name'].' ('.ucfirst($worker['position']).')' }}</p>
                        <p class="text-sm text-gray-500">Joined {{ $worker['created_at']->diffForHumans() }}</p>
                    </div>
                </x-card>
            </li>
        @endforeach
    </ul>
    <br />
    {{ $worker_array->links() }}
    <br />

</x-layout>