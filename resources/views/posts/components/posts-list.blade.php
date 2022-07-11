<div class="grid grid-col-s-1 md:grid-cols-2 gap-2">
    <?php
    $items = $posts;
    foreach ($items as $key =>  $post) : ?>
        <div class="shadow flex flex-col justify-center items-center border-b-4 p-1 bg-fuchsia-50">

            <div class="">
                <a href="{{ url('posts/'.$post->slug) }}">
                    <div class="image-wrapper-md">
                        <img src="{{ $post->image }}" alt="{{ Str::limit($post->title, 50) }}">
                    </div>
                </a>
            </div>
            <div class="px-1 pt-2 border-gray-400 h-full">
                <div class="flex flex-col justify-between items-center h-full">
                    <a class="link-primary font-medium" href="{{ url('posts/'.$post->slug) }}">{{ $post->title }}</a>
                    <p class="text-xl">{{ Str::limit($post->description, 170) }}</p>
                    @include('/posts/components/authors-section')
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
@if (method_exists($items, 'links'))
<div class="flex w-full my-8 justify-center">
    <div class="flex">
        {{ $items->links('pagination::tailwind') }}
    </div>
</div>
@endif