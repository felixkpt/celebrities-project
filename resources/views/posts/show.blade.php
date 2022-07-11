@include('/templates/header')
<div class="flex flex-col w-full my-2 px-1 rounded-lg">
    <div class="flex flex-wrap w-full">
        @include('/posts/components/authors-section')
    </div>
    <div class="flex flex-wrap justify-start w-full mt-4 p-1 rounded">
        <div class="float-sm-start w-full md:w-1/2">
            {{ $post->description }}
        </div>
        <div class="float-sm-end w-full md:w-1/2 md:pl-2">
            <figure>
                <div class="image-wrapper-lg">
                    <?php $image = $post->image; ?>
                    <img src="{{ $image }}" alt="{{ Str::limit($post->title, 50) }}">
                </div>
            </figure>
        </div>
        <div class="my-3">
            {!! $post->content->content !!}
        </div>
    </div>
    <div class="flex flex-wrap w-full">
        @include('/posts/components/latest-md')
    </div>
</div>
@include('/templates/footer')