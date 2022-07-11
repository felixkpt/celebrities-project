@include('/admin/templates/header')    
<div class="flex flex-col px-3">

    <div class="flex flex-wrap w-full justify-center shadow rounded-lg">
        <div class="w-full sm:w-11/12">
            <div class="flex justify-between overflow-hidden w-auto text-left border-b-2 border-gray-300 pb-2">
                <div class="flex">
                    <h2 class="text-2xl">All Categories ({{ \App\Models\Category::count() }})</h2>
                </div>
                <div class="flex my-auto">
                    <a href="{{ url('admin/categories/create') }}" class="text-white rounded py-2 px-4 bg-cyan-500 hover:bg-cyan-600">Create a new</a>
                </div>
            </div>
            <div class="flex flex-wrap w-full mt-3">
                <?php foreach($categories as $key =>  $category): ?>
                <div class="flex flex-wrap justify-between w-full bg-gray-50 hover:bg-gray-100 p-1 mb-1">
                    <div class="flex">
                        <div class="flex px-2 border border-gray-300 w-min mr-2">{{ $key + 1 }}</div>
                        <div class="flex">
                            <span class="text-gray-700 text-lg">{{ $category->name }}</span>
                        </div>
                    </div>
                    <div class="flex w-max">
                        <a href="{{ url('admin/posts?category='.$category->slug) }}" class="text-sm text-gray-500 hover:text-gray-700 hover:underline">Posts in this category</a>
                    </div>
                    <div class="w-full flex flex-wrap md:justify-between">
                        <div class="flex w-full sm:w-2/3 text-base">
                            <img class="m-1" src="{{ isset($category->image) ? $category->image : asset('images/default-category.png') }}" alt="" style="height:40px;width:40px">
                            {{ Str::limit(strip_tags($category->description), 100) }}
                        </div>
                        <div class="flex justify-between w-auto text-slate-700 dark:text-slate-500 h-max">
                            <a class="flex bg-purple-500 hover:bg-purple-800 rounded-lg font-thin text-center px-8 mr-1 text-white" href="{{ url('admin/categories/'.$category->id.'/edit') }}">Edit</a>
                            <form action="{{ route('admin.categories.destroy') }}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="id" value="{{ $category->id }}">
                                <button class="flex bg-red-500 hover:bg-red-800 rounded-lg font-thin text-center px-8 text-white">Delete</a>
                            </form>
                        </div>
                    </div>
                </div>       
                <?php endforeach; ?>
            </div>
            @if(count($categories) < 1)
            <div class="flex w-full bg-gray-100">
                <div class="flex flex-col w-full">
                    <div class="p-4 bg-gray-100 text-xl sm:text-3xl flex flex-col md:flex-row items-baseline">
                    <span class="flex p-1">Categories created yet!</span> <a class="flex p-1 text-purple-500 text-lg sm:text-xl font-medium" href="{{ route('admin.categories.create') }}">Start creating a category</a>
                    </div>
                </div>
            </div>
            @endif
            <?php $items = $categories; ?>
            @include('/admin/components/pagination')
        </div>
    </div>
</div>
@include('/admin/templates/footer')
