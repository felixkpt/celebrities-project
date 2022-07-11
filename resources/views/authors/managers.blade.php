@include('/templates/header')
<div class="flex flex-col w-full my-2">
    <h1>Posts written & lead by {{ $author->name }}</h1>
    <div class="mt-2 p-1 bg-gray-100">
            @include('/posts/components/posts-list')
    </div>
</div>
@include('/templates/footer')