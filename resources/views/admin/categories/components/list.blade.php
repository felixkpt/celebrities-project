<?php 
$post_cats =  old('categories') ?: (isset($post) ? array_column($post->categories->toArray(), 'id') : []);
$categories = App\Models\Category::where('parent', '=', 0)->get() ?>
<div id="category-all" class="tabs-panel mx-1">
    <div class="px-1">
        <h3 class="text-xl">Choose category</h3>
        <ul>
            @foreach($categories as $cat)
            <li>
                <label class="post-category">
                    <input value="{{ $cat->id }}" type="checkbox" name="categories[]" @if(in_array($cat->id, $post_cats)) checked @endif id="in-category-{{ $cat->id }}"> {{ $cat->name }}
                </label>
                @include('admin/categories/components/children')        
            </li>
            @endforeach
        </ul>
    </div>
</div>