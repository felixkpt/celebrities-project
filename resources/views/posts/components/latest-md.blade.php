<?php

use App\Models\Post;

$id = isset($post) ?? $post->id;
$posts = Post::where([['post_type', 'post'], ['published', 'published'], ['id', '!=', $id]])->latest()->limit(8)->get();
?>
<div class="flex flex-col mt-4 w-full">
    <hr class="border-t-2 border-gray-500">
    <h3>{{ isset($recommended_title) ? $recommended_title : 'Recommended content' }}</h3>
    @include('/posts/components/posts-list')
</div>