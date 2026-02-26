@props([
    'eyebrow' => null,
    'eyebrow_icon' => null,
    'title',
    'title_icon' => null,
    'subtitle' => null,
    'actionHref' => null,
    'actionLabel' => null,
    'actionIcon' => null,
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

<section class="list-header-section">
    <div class="list-header-bar">
        <div class="list-header-bar-inner">
            <div>
                @if ($eyebrow)
                    <span class="list-header-eyebrow">
                        @if ($eyebrow_icon)
                            <x-google-icon :name="$eyebrow_icon" wght="300" class="list-header-eyebrow-icon" />
                        @endif
                        <p class="list-header-eyebrow-label">{{ $eyebrow }}</p>
                </span>
                @endif

                <span class="list-header-title-row">
                    <h1 class="list-header-title">{{ $title }}</h1>
                    @if ($title_icon)
                        <x-google-icon :name="$title_icon" class="list-header-title-icon" />
                    @endif
                </span>

                @if ($subtitle)
                    <p class="list-header-subtitle">{{ $subtitle }}</p>
                @endif
            </div>

            @if ($actionHref && $actionLabel)
                <a class="btn list-header-action-btn" href="{{ $actionHref }}">
                    @if ($actionIcon)
                        <x-google-icon :name="$actionIcon" class="icon-inline-fix" />
                    @endif
                    {{ $actionLabel }}
                </a>
            @endif
        </div>
    </div>

    @if (count($stats) > 0)
        <div class="list-header-stats">
            @foreach ($stats as $stat)
                <div class="list-header-stat">
                    <p class="list-header-stat-label">{{ $stat['label'] }}</p>
                    <p class="list-header-stat-value">{{ $stat['value'] }}</p>
                </div>
            @endforeach
        </div>
    @endif

</section>

<div class="list-header-controls">
    <form action="{{ $formAction }}" method="GET" data-auto-submit class="list-header-controls-form">
        <div class="list-header-search-group">
            <span class="list-header-search-label">Filter</span>
            <label class="list-header-search-box">
                <span aria-hidden="true" class="list-header-search-icon">
                    <x-google-icon name="search" />
                </span>
                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    data-applied-value="{{ $search }}"
                    data-hint-id="{{ $hintId }}"
                    placeholder="{{ $searchPlaceholder }}"
                    class="list-header-search-input"
                >
            </label>
            <p id="{{ $hintId }}" class="search-pending-hint list-header-search-hint">{{ $searchHint }}</p>
        </div>

        @if (count($filterOptions) > 0)
            <label class="list-header-filter-group">
                <span class="list-header-filter-label">{{ $filterLabel }}</span>
                <select name="{{ $filterName }}" class="list-header-filter-select">
                    @foreach ($filterOptions as $option)
                        <option value="{{ $option['value'] }}" @selected((string) $filterValue === (string) $option['value'])>{{ $option['label'] }}</option>
                    @endforeach
                </select>
            </label>
        @endif

        @if (count($sortOptions) > 0)
            <label class="list-header-sort-group">
                <span class="list-header-sort-label">{{ $sortLabel }}</span>
                <select name="{{ $sortName }}" class="list-header-sort-select">
                    @foreach ($sortOptions as $option)
                        <option value="{{ $option['value'] }}" @selected((string) $sortValue === (string) $option['value'])>{{ $option['label'] }}</option>
                    @endforeach
                </select>
            </label>
        @endif
    </form>
</div>
