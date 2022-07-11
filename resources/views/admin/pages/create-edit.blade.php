<div class="flex flex-wrap w-full justify-center m-1">
    <?php

    use App\Models\Option;

    $show_in_homepage = false;
    if (isset($post)) {
        $option = Option::where('name', 'show_in_homepage')->first();
        if ($option && isset($post) && $post->id == $option->value) {
            $show_in_homepage = true;
        }
    }
    ?>
    <div class="flex flex-col w-4/5 bg-white shadow-lg p-1">
        <form action="{{ route($route, ['id' => isset($post) ? $post->id : 0]) }}" method="post" class="w-full">
            @csrf
            <input type="hidden" name="_method" value="{{ $method }}">
            <input type="hidden" name="redirect" value="{{ url()->previous() }}">
            <input type="hidden" name="id" value="{{ isset($post) ? $post->id : 0 }}">
            <div class="w-full mb-4">
                <input type="checkbox" <?php if ($show_in_homepage) echo 'checked'; ?> class="m-1" name="show_in_homepage" id="use"><label for="use">Show in homepage</label>
            </div>
            <div class="mb-4 w-full">
                <label for="title">Title </label>
                <input type="text" id="title" class="w-full" name="title" value="{{ old('title') ?: @$post->title }}">
            </div>
            <div class="mb-4 w-full">
                <label for="slug">Slug (optional)</label>
                <input type="text" id="slug" class="w-full" name="slug" value="{{ old('slug') ?: @$post->slug }}">
                <small class="text-gray-500">The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</small>
            </div>
            <div class="mb-4 w-full">
                <div class="w-full" id="contentSection">
                    <label for="content">Content </label>
                    <textarea id="content" name="content" rows="15" class="w-full">
                    {{ old('content') ?: @$post->content->content }}
                    </textarea>
                    <div>
                        <?php
                        $content_count = @str_word_count(old('content') ?: $post->content) ?: 0;
                        ?>
                        <small class="text-gray-500 italic">Words: <span id="contentCount">{{ $content_count }}</span></small>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <button class="p-2 rounded-lg bg-blue-500  text-white hover:bg-blue-700 hover:text-slate-200">Publish</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('#contentSection #content').summernote({
        placeholder: 'Start typing...',
        tabsize: 2,
        height: 520,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
    wordCounter('#contentSection .note-editable', '#contentCount', false)
</script>