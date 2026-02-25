<x-layout>

    @php
        $ageInDays = $bug->days_old;
        $statusLabel = ucfirst($bug->status);
        $assignedWorker = optional($bug->worker)->name ?? 'Unassigned';

        $statusClass = match($bug->status) {
            'open' => 'bg-red-50 text-red-700 border-red-200',
            'in progress' => 'bg-amber-50 text-amber-700 border-amber-200',
            'closed' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            default => 'bg-slate-50 text-slate-700 border-slate-200',
        };
    @endphp

    <section class="mb-6 overflow-hidden rounded-xl border border-slate-200 bg-white/95 shadow-sm">
        <div class="border-b border-slate-200 bg-gradient-to-r from-red-50/80 to-amber-50/70 px-5 py-5">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="mb-1 text-xs font-semibold uppercase tracking-wide text-slate-500">Bug Record</p>
                    <h1 class="text-2xl font-semibold text-slate-900">{{ $bug->title }}</h1>
                    <div class="mt-2 flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-medium {{ $statusClass }}">
                            {{ $statusLabel }}
                        </span>
                        <span class="text-sm text-slate-600">Bug #{{ $bug->id }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('bugs.index') }}" class="inline-flex items-center gap-1 rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                        <x-google-icon name="arrow_back" class="!text-[18px]" />
                        Back to Bugs
                    </a>
                </div>
            </div>
        </div>

        <div class="grid gap-3 px-5 py-4 sm:grid-cols-3">
            <div class="rounded-lg border border-slate-200 bg-slate-50/70 px-3 py-2">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Status</p>
                <p class="mt-1 text-lg font-semibold text-slate-900">{{ $statusLabel }}</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-slate-50/70 px-3 py-2">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Assigned Worker</p>
                <p class="mt-1 text-lg font-semibold text-slate-900">{{ $assignedWorker }}</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-slate-50/70 px-3 py-2">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Reported</p>
                <p class="mt-1 text-lg font-semibold text-slate-900">{{ $bug->created_at->diffForHumans() }}</p>
            </div>
        </div>
    </section>

    @if(!is_null($ageInDays) && $ageInDays > 30)
        <div class="mb-4 flex items-center gap-2 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
            <x-google-icon name="warning" class="!text-[18px]" />
            <span>This bug is {{ floor($ageInDays) }} days old and may need escalation.</span>
        </div>
    @endif

    <section class="grid gap-4 md:grid-cols-2">
        <article class="rounded-xl border border-slate-200 bg-white/95 p-5 shadow-sm">
            <h2 class="mb-4 text-sm font-semibold uppercase tracking-wide text-slate-500">Bug Description</h2>
            <p class="text-sm leading-6 text-slate-700">{{ $bug->description ?: 'No description was provided for this issue.' }}</p>
        </article>

        <article class="rounded-xl border border-slate-200 bg-white/95 p-5 shadow-sm">
            <h2 class="mb-4 text-sm font-semibold uppercase tracking-wide text-slate-500">Bug Metadata</h2>
            <div class="space-y-3 text-sm text-slate-700">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Bug ID</p>
                    <p class="mt-1 text-slate-900">#{{ $bug->id }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Age (days)</p>
                    <p class="mt-1 text-slate-900">{{ is_null($ageInDays) ? 'N/A' : floor($ageInDays) }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Created Date</p>
                    <p class="mt-1 text-slate-900">{{ $bug->created_at->format('M j, Y') }}</p>
                </div>
            </div>
        </article>
    </section>
</x-layout>