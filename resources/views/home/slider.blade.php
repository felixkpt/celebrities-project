<?php

use App\Models\Person;

$items = Person::latest()->limit(9)->get();

$items_segments = [];
$max_segments = 3;
$per_segment = 3;

$counter = 0;
$temp = [];
for ($i = 0; $i < count($items); $i++) {
    $item = $items[$i];

    if (count($items_segments) >= $max_segments) {
        break;
    }

    if ($counter <= $per_segment) {
        $temp[] = $item;
        $counter++;
    }

    if ($counter === $per_segment) {
        $items_segments[] = $temp;
        $counter = 0;
        $temp = [];
    }
}
// dealing with remainance
if ($temp) {
    $items_segments[] = $temp;
}
?>
<style>
    .img-overlay {
        background-color: #5b3c6052;
        color: #e5e7eb;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        text-align: center;
        display: inline;
    }
</style>
<h2>Trending personalities</h2>
<div id="popular-carousel" class="relative" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="overflow-hidden relative h-56 rounded-lg sm:h-64 xl:h-80 2xl:h-96">
        @foreach ($items_segments as $key => $item_seg)
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <!-- Item 1 -->
            <span class="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl dark:text-gray-800">First Slide</span>
            <div class="flex justify-between absolute duration-1000 top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                @foreach ($item_seg as $person)
                <div style="min-width:300px">
                    <a class="w-full block overflow-hidden relative mx-auto" href="{{ url('people/'.$person->id.'/'.Str::slug($person->first_name.' '.$person->last_name, '-')) }}">
                        <img style="width:100%;object-fit:cover;" class="img-fadein mx-auto" src="{{ asset($person->image) }}" alt="{{ $person->first_name }}" title="{{ $person->first_name }}">
                        <div class="img-overlay">
                            <span>{{ $person->first_name.' '.$person->last_name }}</span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    <!-- Slider indicators -->
    <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
        @foreach ($items_segments as $key => $item_seg)
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide {{ $key + 1 }}" data-carousel-slide-to="{{ $key }}"></button>
        @endforeach
    </div>
    <!-- Slider controls -->
    <button type="button" class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            <span class="hidden">Previous</span>
        </span>
    </button>
    <button type="button" class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="hidden">Next</span>
        </span>
    </button>
</div>