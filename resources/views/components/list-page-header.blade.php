@props([
    'eyebrow' => null,
    'eyebrow_icon' => null,
    'title',
    'title_icon' => null,
    'subtitle' => null,
    'actionHref' => null,
    'actionLabel' => null,
    'stats' => [],
    'formAction',
    'search' => '',
    'searchPlaceholder' => 'Search',
    'searchHint' => 'Press Enter to search.',
    'hintId' => 'list-search-hint',
    'filterLabel' => 'Filter',
    'filterName' => 'filter',
    'filterValue' => 'all',
    'filterOptions' => [],
    'sortLabel' => 'Sort',
    'sortName' => 'sort',
    'sortValue' => 'newest',
    'sortOptions' => [],
])

@php
    $controlCount = (count($filterOptions) > 0 ? 1 : 0) + (count($sortOptions) > 0 ? 1 : 0);

    $gridClass = match ($controlCount) {
        2 => 'lg:grid-cols-[minmax(0,1fr)_180px_180px]',
        1 => 'lg:grid-cols-[minmax(0,1fr)_220px]',
        default => 'lg:grid-cols-[minmax(0,1fr)]',
    };
@endphp

<section class="rounded-t-xl border border-slate-200 bg-white/95 shadow-sm">
    <div class="border-b border-slate-200 bg-gradient-to-r from-blue-50/80 to-indigo-50/80 px-5 py-5">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                @if ($eyebrow)
                    <span class="flex items-end gap-1">
                        @if ($eyebrow_icon)
                            <x-google-icon :name="$eyebrow_icon" wght="300" class="text-[30px] text-slate-500" />
                        @endif
                        <p class="mb-1 text-xs font-semibold uppercase tracking-wide text-slate-500">{{ $eyebrow }}</p>
                </span>
                @endif

                <span class="flex items-center gap-1">
                    <h1 class="text-2xl font-semibold text-slate-900">{{ $title }}</h1>
                    @if ($title_icon)
                        <x-google-icon :name="$title_icon" class="text-[40px]" />
                    @endif
                </span>

                @if ($subtitle)
                    <p class="mt-1 text-sm text-slate-600">{{ $subtitle }}</p>
                @endif
            </div>

            @if ($actionHref && $actionLabel)
                <a class="btn self-start lg:self-auto" href="{{ $actionHref }}">{{ $actionLabel }}</a>
            @endif
        </div>
    </div>

    @if (count($stats) > 0)
        <div class="grid gap-3 px-5 py-4 sm:grid-cols-3">
            @foreach ($stats as $stat)
                <div class="rounded-lg border border-slate-200 bg-slate-50/70 px-3 py-2">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">{{ $stat['label'] }}</p>
                    <p class="mt-1 text-xl font-semibold text-slate-900">{{ $stat['value'] }}</p>
                </div>
            @endforeach
        </div>
    @endif

</section>

<div class="list-header-controls mb-6 -mt-px rounded-b-xl border border-slate-200 px-5 py-4 shadow-sm">
    <form action="{{ $formAction }}" method="GET" data-auto-submit class="grid gap-3 {{ $gridClass }} lg:items-start">
        <div class="w-full">
            <span class="mb-1 block text-xs font-medium uppercase tracking-wide text-slate-500">Filter</span>
            <label class="flex w-full items-center gap-2 rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-500">
                <span aria-hidden="true">
                    <x-google-icon name="search" />
                </span>
                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    data-applied-value="{{ $search }}"
                    data-hint-id="{{ $hintId }}"
                    placeholder="{{ $searchPlaceholder }}"
                    class="w-full bg-transparent text-slate-700 placeholder:text-slate-400 focus:outline-none"
                >
            </label>
            <p id="{{ $hintId }}" class="search-pending-hint text-xs text-slate-500">{{ $searchHint }}</p>
        </div>

        @if (count($filterOptions) > 0)
            <label class="block">
                <span class="mb-1 block text-xs font-medium uppercase tracking-wide text-slate-500">{{ $filterLabel }}</span>
                <select name="{{ $filterName }}" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 focus:border-blue-400 focus:outline-none">
                    @foreach ($filterOptions as $option)
                        <option value="{{ $option['value'] }}" @selected((string) $filterValue === (string) $option['value'])>{{ $option['label'] }}</option>
                    @endforeach
                </select>
            </label>
        @endif

        @if (count($sortOptions) > 0)
            <label class="block">
                <span class="mb-1 block text-xs font-medium uppercase tracking-wide text-slate-500">{{ $sortLabel }}</span>
                <select name="{{ $sortName }}" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 focus:border-blue-400 focus:outline-none">
                    @foreach ($sortOptions as $option)
                        <option value="{{ $option['value'] }}" @selected((string) $sortValue === (string) $option['value'])>{{ $option['label'] }}</option>
                    @endforeach
                </select>
            </label>
        @endif
    </form>
</div>
