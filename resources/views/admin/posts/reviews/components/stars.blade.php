<div class="flex flex-wrap mb-2">
    <div class="w-full md:w-8/12 text-center md:text-left">
        @if($review->rating > 0)
        <small>
            <?php
            $stars_count = App\Settings\Reviews::stars();
            $ratings = range(1, $stars_count);
            ?>
            @foreach($ratings as $rat)
            <svg class="w-6 h-6 inline <?php if ($rat <= $review->rating) echo 'text-lc-warning' ?>" fill="{{ $rat <= $review->rating ? 'skyblue' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
            </svg>
            @endforeach
        </small> {{ $review->rating }}/{{ count($ratings) }}
        @else
        <small class="text-lc-warning">No rating</small>
        @endif
    </div>
    <div class="w-full md:w-4/12 text-center md:text-left">
        <?php $user = App\Models\User::where('id', $review->user_id)->first() ?>
        <div class="flex flex-wrap">
            <div class="w-full">
                <span class="text-gray-500"> Reviewed {{ $review->updated_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
</div>