@include('/templates/header')
<?php
$functions = str_split($personality->name);
$map = ['I' => 'Introverted', 'E' => 'Extroverted', 'S' => 'Sensing', 'N' => 'iNtuition', 'F' => 'Feeling', 'T' => 'Thinking', 'J' => 'Judging', 'P' => 'Perceiving'];
?>
<div class="flex flex-col w-full my-2">
    <figure id="header-figure" class="w-full h-full lg:flex bg-fuchsia-50 rounded-xl overflow-hidden pt-8 pb-2">
        <div class="md:h-4/5 md:w-1/4 overflow-hidden mx-auto">
            <div class="w-52 h-44 overflow-hidden mx-auto rounded">
                <div style="width:200px;margin:auto">
                    <img class="rounded" style="height: 100%;width:100%;object-fit:contain" src="{{ asset($personality->featured_image) }}" alt="{{ $personality->name }}">
                </div>
            </div>
            <div class="w-full pt-1">
                @include('/components/social-media-links')
            </div>
        </div>
        <div class="pt-6 md:p-4 lg:w-3/4 text-center md:text-left space-y-4">
            @include('/typologies/components/mbti-functionalities')
            <figcaption class="font-medium">
                <div class="text-[#e3a517de] text-xl dark:text-slate-500">
                    <span class="border-l-4 pl-1 border-[#e3a517de] text-sky-400">{{ $personality->name }}s</span>
                    are known to be {{ $personality->strength }}s, this group comprises {{ $personality->prevalence }}% of the total population
                </div>
            </figcaption>
        </div>
    </figure>

    <div class="w-full rounded-lg">
        @include('/people/components/people-header')
        <div class="flex w-full my-8 justify-center">
            <div class="flex">
                <a class="text-2xl rounded-lg py-1 transition ease-in-out duration-500 px-12 font-medium text-[#2e265a]  hover:text-[#302a4c] bg-fuchsia-50 hover:bg-fuchsia-100  border border-[#2e265a] hover:border-[#302a4c]" href="{{ url('people/typologies/'.$personality->slug.'s') }}">More {{ $personality->name }}s</a>
            </div>
        </div>
    </div>
</div>@include('/templates/footer')