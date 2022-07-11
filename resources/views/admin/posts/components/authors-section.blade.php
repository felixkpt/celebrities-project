<div class="flex flex-wrap w-full text-lg ml-1 pl-1 border-l-4 border-sky-400 h-max">
    <span>By</span> 
    <?php 
    $authors = json_decode(json_encode($post->mainAuthors), true);
    
    usort($authors, function($a, $b) {
        if ($a['id'] == $a['pivot']['manager_id']) {
            return 0;
        }
        return 1;
    });
    ?>
    @foreach($authors as $author)
        <a class="pl-1 link-default hover:underline" href="{{ url('admin/posts?author='.Str::slug($author['name'])) }}" class="link-yellow pl-1">{{ $author['name'] }}</a>@if(isset($authors[$loop->index+1])),@endif
    @endforeach
    <span class="ml-2 pl-1 text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
</div>