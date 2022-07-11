<?php 
$children = App\Models\Category::where('parent', $cat->id)->get();
?>
@if(count($children) > 0)
<ul id="categorychecklist" class="ml-4 categorychecklist form-no-clear">
    @foreach($children as $cat)
    <li id="category-{{ $cat->id }}" class="popular-category">
        <label class="post-category">
            <input value="{{ $cat->id }}" type="checkbox" name="categories[]" @if(in_array($cat->id, $post_cats)) checked @endif id="in-category-{{ $cat->id }}"> {{ $cat->name }}
        </label>
    </li>
    @endforeach
</ul>
@endif