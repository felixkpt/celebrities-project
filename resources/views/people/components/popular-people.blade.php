<?php 
use App\Models\Person;
$items = Person::latest()->limit(8)->get();

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
    }
</style>
<div class="flex w-full flex-nowrap md:justify-center md:flex-wrap overflow-x-auto">
    @foreach($items as $person)
    <div class="flex flex-col p-1">
        <div class="h-full bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="w-48 h-48 shadow rounded m-1">
                <a class="w-full block overflow-hidden relative mx-auto" href="{{ url('professional/'.Str::slug($person->professional->slug)) }}">
                    <img style="object-fit:contain;" class="img-fadein w-48 h-48 mx-auto" src="{{ asset($person->image) }}" alt="{{ $person->first_name }}" title="{{ $person->first_name }}">
                    <div class="img-overlay">
                        <span>{{ $person->first_name.$person->last_name }}</span>
                    </div>
                </a>
            </div>
            <div class="p-1 w-56">
                <a class="link-dark mb-3 font-medium hover:underline" href="{{ url('professional/'.Str::slug($person->professional->slug)) }}">
                    {{ Str::limit($person->professional->name, 45) }}
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>