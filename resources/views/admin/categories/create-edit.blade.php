<div class="flex flex-wrap w-full justify-center m-1">
    <div class="flex w-4/5 bg-white shadow-lg p-1">
        <form action="{{ route($route, ['id' => isset($category) ? $category->id : 0]) }}" method="post" class="w-full" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="{{ $method }}">
            <input type="hidden" name="redirect" value="{{ url()->previous() }}">
            <input type="hidden" name="id" value="{{ isset($category) ? $category->id : 0 }}">
            <div class="mb-4 w-full">
                <label for="name">Name </label>
                <input type="text" id="title" class="w-full" name="name" value="{{ old('name') ?: @$category->name }}">
            </div>
            <div class="mb-4 w-full">
                <label for="slug">Slug (optional)</label>
                <input type="text" id="slug" class="w-full" name="slug" value="{{ old('slug') ?: @$category->slug }}">
                <small class="text-gray-500">The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</small>
            </div>
            <div class="mb-4 w-full">
                <label for="parent">Parent category </label>
                <select name="parent" id="parent">
                    <option value="0">None</option>
                    @foreach($categories as $cat)
                    <option value="{{$cat->id }}" @if(isset($category) && $cat->id === $category->parent) selected @endif>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <small class="block text-gray-500">Categories, unlike tags, can have a hierarchy. You might have a Jazz category, and under that have children categories for Bebop and Big Band. Totally optional.</small>
            </div>
            <div class="mb-4 w-full">
                <label for="description">Description </label>
                <div class="w-full">
                <textarea name="description" rows="6" class="w-full mb-2">{{ old('description') ?? @$category->description }}</textarea>
                </textarea>
                </div>
            </div>
            <div class="my-4">
                <div class="flex flex-wrap w-full justify-between">
                    <div class="w-full md:w-1/2 h-48">
                        <?php $image = isset($category->image) ? $category->image : ''; $purpose = 'Use'; $label = 'Category image' ?>
                        @include('/admin/media/components/quick-uploader')
                    </div>
                    <div class="w-full md:w-1/2 text-right mt-2 md:mt-auto">
                        <button class="px-3 py-2 rounded-lg bg-blue-500  text-white hover:bg-blue-700 hover:text-slate-200">Publish</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>