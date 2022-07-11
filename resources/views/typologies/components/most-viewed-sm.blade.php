<?php
$personalities = App\Models\Typology::limit(5)->get();
?>
<div class="flex w-full flex-wrap justify-center">
    <hr class="border-t-2 border-gray-500">
    <h3>Most viewed by typologies</h3>
    @foreach($personalities as $personality)
    <div class="w-full py-3 border-t border-gray-400">
        <div class="flex flex-row py-2">
            <a href="{{ url('typologies/'.$personality->slug) }}" class="flex items-center gap-1 hover:shadow p-1 link-secondary">
                <div>
                    <div class="image-wrapper-sm">
                        <img class="rounded" src="{{ asset($personality->featured_image) }}" alt="ISFP">
                    </div>
                </div>
                <div>
                    <h4 class="font-medium">{{ $personality->name.' The '.$personality->strength }}</h4>
                    <p>{{ Str::limit($personality->description, 50) }}</p>
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>