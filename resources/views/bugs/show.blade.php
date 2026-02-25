<x-layout>

    @php
        // $ageInDays = optional($bug->created_at)->diffInDays(now());
        $ageInDays = $bug->days_old;
    @endphp

    @if(!is_null($ageInDays) && $ageInDays > 30)
        <div class="text-red-700 font-semibold mb-4">
            ⚠️ This bug is {{ floor($ageInDays) }} days old. ⚠️ 
        </div>
    @endif

    I am bug {{ $bug->id }}.
    <br>
    I am {{ $bug->status }}.
</x-layout>