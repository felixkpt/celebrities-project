<?php

use App\Models\Post;

$id = isset($post) ?? $post->id;
$posts = Post::where([['post_type', 'post'], ['published', 'published'], ['id', '!=', $id]])->latest()->limit(8)->get();
?>
<div class="flex flex-col">
    <hr class="border-t-2 border-gray-500">
    <h3>Latest news</h3>
    @foreach($posts as $post)
    <div class="w-full py-3 border-t border-gray-400">
        <a href="{{ url('posts/'.$post->slug) }}" class="flex items-center hover:shadow p-1 link-primary">
            <?php $image = $post->image ?>
            <div>
                <div class="image-wrapper-sm p-2">
                    <img src="{{ $image }}" alt="{{ Str::limit($post->title, 50) }}" class="rounded-sm">
                </div>
            </div>
            <p>
                {{ Str::limit($post->title, 70) }}
            </p>
        </a>
    </div>
    @endforeach
</div>