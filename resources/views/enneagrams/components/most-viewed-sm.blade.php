<?php
$enneagrams = App\Models\Enneagram::limit(5)->get();
?>
<div class="flex w-full flex-wrap justify-center">
    <hr class="border-t-2 border-gray-500">
    <h3>Trending by Enneagram</h3>
    @foreach($enneagrams as $enneagram)
    <div class="w-full py-3 border-t border-gray-400">
        <div class="flex flex-row py-2">
            <a href="{{ url('enneagrams/'.$enneagram->slug) }}" class="flex items-center gap-1 hover:shadow p-1 link-secondary">
                <div>
                    <div class="image-wrapper-sm">
                        <img class="rounded" src="{{ asset($enneagram->image) }}" alt="{{ $enneagram->name }}">
                    </div>
                </div>
                <div>
                    <h4 class="font-medium">{{ $enneagram->name }}</h4>
                    <h5>{{ $enneagram->strength }}</h5>
                    <p>{{ Str::limit($enneagram->description, 50) }}</p>
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>