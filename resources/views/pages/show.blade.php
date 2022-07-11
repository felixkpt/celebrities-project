@include('/templates/header')
<div class="flex flex-col w-full my-2 px-1 rounded-lg">
    <div class="flex justify-start w-full mt-4 p-1 rounded">
        <div>
            {!! $post->content->content !!}
        </div>
    </div>
</div>
@include('/templates/footer')