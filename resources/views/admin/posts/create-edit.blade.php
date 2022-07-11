<div class="flex flex-wrap w-full justify-center">
    <form action="{{ route($route, ['id' => isset($post) ? $post->id : 0]) }}" method="post" class="w-full" enctype="multipart/form-data">
        <div class="flex flex-wrap w-full justify-center">
            <div class="flex w-full justify-end">
                <button data-collapse-toggle="cats-nav" type="button" class="mb-4 md:hidden text-gray-400 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300 rounded-lg inline-flex mr-3 items-center justify-center" aria-controls="cats-nav" aria-expanded="false">
                    Category menu
                    <svg width="24" height="24">
                        <path d="M5 6h14M5 12h14M5 18h14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                    </svg>
                </button>
            </div>
            <div class="flex flex-col items-between w-full md:w-9/12 bg-white shadow-lg p-1 relative">
                @csrf
                <input type="hidden" name="_method" value="{{ $method }}">
                <input type="hidden" name="redirect" value="{{ url()->previous() }}">
                <input type="hidden" name="id" value="{{ isset($post) ? $post->id : 0 }}">
                <div class="mb-4 w-full">
                    <label for="title" class="text-gray-600">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') ?: @$post->title }}">
                </div>
                <div class="mb-4 w-full">
                    <div class="w-full" id="contentSection">
                        <label for="content" class="text-gray-600">Content</label>
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
                <div class="optional-section mb-4 bg-gray-100 p-1 rounded">
                    <div id="optionalsToggler" class="flex justify-between w-full cursor-pointer">
                        <span class="text-gray-700">Optional fields</span>
                        <svg class="inline w-6 h-6 chevron-down" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                        <svg class="inline w-6 h-6 chevron-up hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                        </svg>
                    </div>
                    <div id="optionals" class="border m-2 p-2 hidden">
                        <div class="mb-4 w-full">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" class="basic-input" name="slug" value="{{ old('slug') ?: @$post->slug }}">
                            <small class="text-gray-500">The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</small>
                        </div>
                        <div class="mb-4 w-full">
                            <label for="description">Description</label>
                            <textarea id="description" class="w-full" name="description" rows="3">{{ old('description') ?: @$post->description }}</textarea>
                            <small class="text-gray-500">The meta description length should be kept descriptive and between 150 and 160 characters for optimal length, and this includes space.</small>
                            <div>
                                <?php
                                $description_count = @strlen(old('description') ?: $post->description) ?: 0;
                                ?>
                                <small class="text-gray-500 italic">Characters: <span id="descriptionCount">{{ $description_count }}</span></small>
                            </div>
                            <script>
                                wordCounter('[id="description"]', '#descriptionCount', true)
                            </script>
                        </div>
                    </div>
                    <script>
                        var optionals = document.querySelector('#optionals')
                        var optionalsToggler = document.querySelector('#optionalsToggler')
                        optionals.style.transition = '300ms ease'
                        optionalsToggler.addEventListener('click', function() {
                            if (optionals.classList.contains('hidden')) {
                                optionals.classList.remove('hidden')
                                optionalsToggler.querySelector('.chevron-up').classList.remove('hidden')
                                optionalsToggler.querySelector('.chevron-down').classList.add('hidden')
                            } else {
                                optionals.classList.add('hidden')
                                optionalsToggler.querySelector('.chevron-up').classList.add('hidden')
                                optionalsToggler.querySelector('.chevron-down').classList.remove('hidden')
                            }

                        })
                    </script>
                </div>
                <div class="w-full mt-2">
                    <button class="px-3 py-2 w-full rounded-lg bg-blue-500 text-white hover:bg-blue-700 hover:text-slate-200">Publish</button>
                </div>
            </div>
            <div id="cats-nav" class="bg-gray-50 min-h-screen hidden mt-8 md:mt-0 md:flex flex-wrap absolute md:relative z-40 right-0 md:w-3/12">
                <div class="w-full">
                    @include('admin/categories/components/list')
                </div>
                <div class="w-full my-4 p-1">
                    <div class="flex flex-wrap w-full justify-between">
                        <div class="w-full h-48">
                            <?php $image = isset($post->image) ? $post->image : '';
                            $purpose = 'Use' ?>
                            @include('/admin/media/components/quick-uploader')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
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