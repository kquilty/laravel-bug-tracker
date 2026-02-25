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
        action-label="Add New Team"
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
            <li>
                <x-card href="{{ route('teams.show', $team['id']) }}">
                    <div>
                        <p>{{ $team['name'] }}</p>
                        <p class="text-sm text-gray-500">Created {{ $team['created_at']->diffForHumans() }}</p>
                    </div>
                </x-card>
            </li>
        @endforeach
    </ul>
    <br />
    {{ $team_array->links() }}
    <br />

</x-layout>