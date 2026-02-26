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
        eyebrow="Worker Directory"
        eyebrow_icon="people"
        title="Workers"
        subtitle="Browse contributors, review roles, and keep team assignments organized."
        :action-href="route('workers.create')"
        action-label="Add New Worker"
        action-icon="person_add"
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

    <x-success-message />

    <div class="mb-4 text-sm text-gray-500">
        Showing {{ $worker_array->count() }} worker{{ $worker_array->count() === 1 ? '' : 's' }} on this page.
    </div>

    <ul class="workerlist-index">
        @foreach ($worker_array as $worker)
            @php
                $positionLabel = ucfirst($worker->position);

                $positionClass = match($worker->position) {
                    'manager' => 'border-indigo-200 bg-indigo-50 text-indigo-700',
                    'developer' => 'border-blue-200 bg-blue-50 text-blue-700',
                    default => 'border-slate-200 bg-slate-50 text-slate-700',
                };
            @endphp
            <li>
                <x-card href="{{ route('workers.show', $worker->id) }}">
                    <div class="space-y-3">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                            <div class="min-w-0">
                                <p class="truncate text-base font-semibold text-slate-900">{{ $worker->name }}</p>
                                <p class="mt-1 text-xs text-slate-500">Worker #{{ $worker->id }} • Joined {{ $worker->created_at->diffForHumans() }}</p>
                            </div>

                            <span class="inline-flex w-fit items-center rounded-full border px-2.5 py-1 text-xs font-medium {{ $positionClass }}">
                                {{ $positionLabel }}
                            </span>
                        </div>

                        <div class="flex flex-wrap items-center gap-2 text-xs">
                            <span class="inline-flex max-w-full items-center rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-slate-700">
                                <x-google-icon name="mail" class="mr-1 !text-[14px]" />
                                <span class="truncate">{{ $worker->email }}</span>
                            </span>

                            <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-slate-700">
                                <x-google-icon name="groups" class="mr-1 !text-[14px]" />
                                {{ optional($worker->team)->name ?? 'Unassigned Team' }}
                            </span>

                            <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-slate-700">
                                <x-google-icon name="calendar_today" class="mr-1 !text-[14px]" />
                                {{ $worker->created_at->format('M j, Y') }}
                            </span>
                        </div>
                    </div>
                </x-card>
            </li>
        @endforeach
    </ul>
    <br />
    {{ $worker_array->links() }}
    <br />

</x-layout>