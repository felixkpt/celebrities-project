@include('/admin/templates/header')    
<div class="flex flex-col px-3">

    <div class="flex justify-between overflow-hidden w-auto text-left border-b-2 border-gray-300 pb-2">
        <div class="flex">
            <h2 class="text-2xl" id="title">{{ $title }}</h2>
        </div>
        <div class="flex my-auto">
            <a href="{{ url('admin/posts/create') }}" class="text-white rounded py-2 px-4 bg-cyan-500 hover:bg-cyan-600">Create a new</a>
        </div>
    </div>
    <div class="bg-gray-50 mt-2 shadow rounded-lg">
        <table class="table-fixed w-full">
            <thead class="flex flex-wrap mb-4">
            </thead>
            <tbody>
            @foreach($posts as $key => $post)
                <tr class="pb-2 border-b border-gray-200">

                    <td>
                    <table class="table-fixed w-full hover:bg-white lg:my-2">
                        <tr class="p-1">
                            <td>
                                <div class="flex flex-wrap">
                                    <div class="w-full mb-1">
                                        @if($post->published == 'unapproved')
                                        <form action="{{ route($route.'.approve') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="_method" value="post">
                                            <input type="hidden" name="id" value="{{ $post->id }}">
                                            <button class="inline bg-gray-500 hover:bg-gray-800 rounded-lg font-thin text-center px-8 text-white">Approve</a>
                                        </form>
                                        @endif
                                    </div>
                                    <div class="flex px-2 border border-gray-300 w-min mr-2">{{ ($key + 1) }}</div>
                                    <div class="flex flex-nowrap w-full lg:w-11/12">
                                    <img class="m-1" src="{{ isset($post->image) ? $post->image : asset('images/default-company.png') }}" alt="" style="height:40px;width:40px">
            
                                        <a class="truncate text-xl hover:underline" href="{{ url('company/'.$post->slug) }}">{{ Str::limit($post->title, 150) }}</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="pb-1 md:pb-0">
                            <td>
                                <div class="flex flex-wrap lg:justify-between">
                                    <div class="flex w-full md:w-2/3 font-thin text-sm">
                                        @include('/admin/posts/components/authors-section')
                                    </div>
                                    <div class="flex justify-between w-auto text-slate-700 dark:text-slate-500 h-max">
                                        <a class="flex bg-purple-500 hover:bg-purple-800 rounded-lg font-thin text-center px-8 mr-1 text-white" href="{{ url('admin/posts/'.$post->id.'/edit') }}">Edit</a>
                                        <form action="{{ route($route.'.destroy') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="_method" value="delete">
                                            <input type="hidden" name="id" value="{{ $post->id }}">
                                            <button class="flex bg-red-500 hover:bg-red-800 rounded-lg font-thin text-center px-8 text-white">Delete</a>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
                    </table>
                    </td>
                </tr>
            @endforeach
            @if(count($posts) < 1)
            <tr>
                <td>
                    <div class="p-4 bg-gray-100 text-xl sm:text-3xl flex flex-col md:flex-row items-baseline">
                    @if(\request()->get('category'))
                    <span class="flex p-1">No posts in this category.</span>
                    @elseif (\request()->get('author'))
                    <span class="flex p-1">No posts published by selected author.</span>
                    @else
                    <span class="flex p-1">No posts published yet.</span> <a class="flex p-1 text-purple-500 text-lg sm:text-xl font-medium" href="{{ route('admin.posts.create') }}">Start writing your first post now...</a>
                    @endif
                    </div>
                </td>
            </tr>
            @endif
            </tbody>
        </table>
    </div>
    <?php $items = $posts ?>
    @include('/admin/components/pagination')
</div>
@include('/admin/templates/footer')