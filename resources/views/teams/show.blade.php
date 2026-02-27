<x-layout>
    @php
        $initial = strtoupper(substr($team->name, 0, 1));
        $memberCount = $team->workers()->count();
    @endphp

    <section class="mb-6 overflow-hidden rounded-xl border border-slate-200 bg-white/95 shadow-sm">
        <div class="border-b border-slate-200 bg-gradient-to-r from-blue-50/80 to-indigo-50/80 px-5 py-5">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div class="flex items-center gap-4">
                    <div class="flex h-16 w-16 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-indigo-500 text-xl font-semibold text-white shadow-sm">
                        {{ $initial !== '' ? $initial : 'T' }}
                    </div>

                    <div>
                        <p class="mb-1 text-xs font-semibold uppercase tracking-wide text-slate-500">Team Profile</p>
                        <h1 class="text-2xl font-semibold text-slate-900">{{ $team->name }}</h1>
                        <p class="mt-1 text-sm text-slate-600">Manage team structure, members, and responsibilities.</p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('teams.index') }}" class="inline-flex items-center gap-1 rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                        <x-google-icon name="arrow_back" class="!text-[18px]" />
                        Back to Teams
                    </a>
                </div>
            </div>
        </div>

        <div class="grid gap-3 px-5 py-4 sm:grid-cols-3">
            <div class="rounded-lg border border-slate-200 bg-slate-50/70 px-3 py-2">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Team Name</p>
                <p class="mt-1 text-lg font-semibold text-slate-900">{{ $team->name }}</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-slate-50/70 px-3 py-2">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Members</p>
                <p class="mt-1 text-lg font-semibold text-slate-900">{{ $memberCount }}</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-slate-50/70 px-3 py-2">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Created</p>
                <p class="mt-1 text-lg font-semibold text-slate-900">{{ $team->created_at->diffForHumans() }}</p>
            </div>
        </div>
    </section>

    <section class="grid gap-4 md:grid-cols-2">
        <article class="rounded-xl border border-slate-200 bg-white/95 p-5 shadow-sm">
            <h2 class="mb-4 text-sm font-semibold uppercase tracking-wide text-slate-500">Team Information</h2>
            <div class="space-y-3 text-sm text-slate-700">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Name</p>
                    <p class="mt-1 font-medium text-slate-900">{{ $team->name }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Created Date</p>
                    <p class="mt-1 text-slate-900">{{ $team->created_at->format('M j, Y') }}</p>
                </div>
            </div>
        </article>

        <article class="rounded-xl border border-slate-200 bg-white/95 p-5 shadow-sm">
            <h2 class="mb-4 text-sm font-semibold uppercase tracking-wide text-slate-500">Membership Snapshot</h2>
            <div class="space-y-3 text-sm text-slate-700">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Current Members</p>
                    <p class="mt-1 text-slate-900">{{ $memberCount }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Status</p>
                    <p class="mt-1 text-slate-900">{{ $memberCount > 0 ? 'Active team' : 'Awaiting members' }}</p>
                </div>
            </div>
        </article>
    </section>

    <form action="{{ route('teams.destroy', $team->id) }}" method="POST" class="mt-6">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn inline-flex items-center gap-1 bg-red-600 text-white hover:bg-red-700" onclick="return confirm('Are you sure? This action cannot be undone.')">
            <x-google-icon name="delete" class="!text-[18px]" />
            Delete Team
        </button>
    </form>

</x-layout>