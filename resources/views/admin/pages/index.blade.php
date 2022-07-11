@include('/admin/templates/header')    
<div class="flex flex-col px-3">

        <div class="flex justify-between overflow-hidden w-auto text-left border-b-2 border-gray-300 pb-2">
            <div class="flex">
                <h2 class="text-2xl">{{ $title }}</h2>
            </div>
            <div class="flex my-auto">
                <a href="{{ url('admin/pages/create') }}" class="text-white rounded py-2 px-4 bg-cyan-500 hover:bg-cyan-600">Create a new</a>
            </div>
        </div>
        <div class="bg-gray-100 mt-2 shadow rounded-lg">
            <table class="table-fixed w-full">
                <thead class="flex flex-wrap mb-4">
                </thead>
                <tbody>
                @foreach($posts as $key => $post)
                    <tr class="pb-2 border-b border-gray-200">

                        <td>
                        <table class="table-fixed w-full hover:bg-white">
                            <tr class="p-1">
                                <td>
                                    <div class="flex flex-wrap">
                                        <div class="flex px-2 border border-gray-300 w-min">{{ ($key + 1) }}</div>
                                        <div class="flex flex-wrap w-full lg:w-11/12">
                                            <a class="truncate text-xl" href="{{ url('pages/'.$post->slug) }}">{{ Str::limit($post->title, 150) }}</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="pb-1 md:pb-0">
                                <td>
                                    <div class="flex flex-wrap lg:justify-between">
                                        <div class="flex w-full md:w-2/3 font-thin text-sm">
                                            @include('/admin/pages/components/authors-section')
                                        </div>
                                        <div class="flex justify-between w-auto text-slate-700 dark:text-slate-500 h-max">
                                            <a class="flex bg-purple-500 hover:bg-purple-800 rounded-lg font-thin text-center px-8 mr-1 text-white" href="{{ url('admin/pages/'.$post->id.'/edit') }}">Edit</a>
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
                            @if (\request()->get('author'))
                            <span class="flex p-1">No pages created by selected author.</span>
                            @else
                            <span class="flex p-1">No pages created yet.</span> <a class="flex p-1 text-purple-500 text-lg sm:text-xl font-medium" href="{{ route('admin.pages.create') }}">Start writing your first page now...</a>
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