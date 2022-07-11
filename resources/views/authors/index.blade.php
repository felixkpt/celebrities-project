@include('/templates/header')
    @foreach($authors as $author)
        <div>
            <h1>Posts written by {{ $author->name }}</h1>
            <div class="mt-2 p-1 bg-gray-100">
                    @include('/posts/components/posts-list')
            </div>
        </div> 
    @endforeach
    <div class="flex w-full my-8 justify-center">
        <div class="flex">
            {{ $authors->links('pagination::tailwind') }}
        </div>
    </div>
@include('/templates/footer')