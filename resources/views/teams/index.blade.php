<x-layout>

    @php
        $teamStats = [
            ['label' => 'Total Teams', 'value' => $totalTeamsCount],
            ['label' => 'Teams With Members', 'value' => $withMembersCount],
            ['label' => 'New This Week', 'value' => $newThisWeekCount],
        ];

        $membershipOptions = [
            ['value' => 'all', 'label' => 'All Teams'],
            ['value' => 'with_members', 'label' => 'With Members'],
            ['value' => 'without_members', 'label' => 'Without Members'],
        ];

        $teamSortOptions = [
            ['value' => 'newest', 'label' => 'Newest First'],
            ['value' => 'oldest', 'label' => 'Oldest First'],
            ['value' => 'name_asc', 'label' => 'Name A-Z'],
            ['value' => 'name_desc', 'label' => 'Name Z-A'],
        ];
    @endphp

    <x-list-page-header
        eyebrow="Team Directory"
        eyebrow_icon="diversity_3"
        title="Teams"
        subtitle="Review group structure, monitor staffing, and organize team ownership."
        :action-href="route('teams.create')"
        action-label="Create New Team"
        action-icon="group_add"
        :stats="$teamStats"
        :form-action="route('teams.index')"
        :search="$search"
        search-placeholder="Search teams by name"
        hint-id="teams-search-hint"
        filter-label="Membership"
        filter-name="membership"
        :filter-value="$membership"
        :filter-options="$membershipOptions"
        sort-label="Sort"
        sort-name="sort"
        :sort-value="$sort"
        :sort-options="$teamSortOptions"
    />

    <div class="mb-4 text-sm text-gray-500">
        Showing {{ $team_array->count() }} team{{ $team_array->count() === 1 ? '' : 's' }} on this page.
    </div>

    <ul class="teamlist-index">
        @foreach ($team_array as $team)
            @php
                $memberCount = $team->workers_count ?? 0;

                $membershipClass = $memberCount > 0
                    ? 'border-emerald-200 bg-emerald-50 text-emerald-700'
                    : 'border-slate-200 bg-slate-50 text-slate-700';

                $recencyClass = $team->created_at->isAfter(now()->subDays(7))
                    ? 'border-blue-200 bg-blue-50 text-blue-700'
                    : 'border-slate-200 bg-slate-50 text-slate-700';
            @endphp
            <li>
                <x-card href="{{ route('teams.show', $team->id) }}">
                    <div class="space-y-3">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                            <div class="min-w-0">
                                <p class="truncate text-base font-semibold text-slate-900">{{ $team->name }}</p>
                                <p class="mt-1 text-xs text-slate-500">Team #{{ $team->id }} • Created {{ $team->created_at->diffForHumans() }}</p>
                            </div>

                            <span class="inline-flex w-fit items-center rounded-full border px-2.5 py-1 text-xs font-medium {{ $membershipClass }}">
                                {{ $memberCount > 0 ? 'Active Team' : 'No Members Yet' }}
                            </span>
                        </div>

                        <p class="text-sm text-slate-600">
                            {{ $memberCount > 0
                                ? 'Team currently has '.$memberCount.' member'.($memberCount === 1 ? '' : 's').'.'
                                : 'This team has not been assigned members yet.' }}
                        </p>

                        <div class="flex flex-wrap items-center gap-2 text-xs">
                            <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-slate-700">
                                <x-google-icon name="groups" class="mr-1 !text-[14px]" />
                                {{ $memberCount }} member{{ $memberCount === 1 ? '' : 's' }}
                            </span>

                            <span class="inline-flex items-center rounded-full border px-2.5 py-1 {{ $recencyClass }}">
                                <x-google-icon name="calendar_today" class="mr-1 !text-[14px]" />
                                {{ $team->created_at->format('M j, Y') }}
                            </span>

                            <span class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-slate-700">
                                <x-google-icon name="schedule" class="mr-1 !text-[14px]" />
                                {{ floor($team->created_at->diffInDays(now())) }} day{{ floor($team->created_at->diffInDays(now())) === 1 ? '' : 's' }} old
                            </span>
                        </div>
                    </div>
                </x-card>
            </li>
        @endforeach
    </ul>
    <br />
    {{ $team_array->links() }}
    <br />

</x-layout>