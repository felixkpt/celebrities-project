@include('/admin/templates/header')    
<div class="flex flex-col px-3">

    <div class="flex flex-wrap w-full justify-center shadow rounded-lg">
        <div class="w-full sm:w-11/12">
            <div class="flex justify-between overflow-hidden w-auto text-left border-b-2 border-gray-300 pb-2">
                <div class="flex">
                    <h2 class="text-2xl">{{ $title }}</h2>
                </div>
            </div>

            <div class="flex flex-wrap w-full mt-3">
            <?php foreach($reviews as $key =>  $review): ?>
            <div class="flex flex-wrap justify-between w-full bg-gray-50 hover:bg-gray-100 p-1 mb-1">
                <div class="w-full mb-1">
                    @if($review->published == 'unapproved')
                    <form action="{{ route('admin.reviews.approve') }}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="post">
                        <input type="hidden" name="id" value="{{ $review->id }}">
                        <button class="inline bg-gray-500 hover:bg-gray-800 rounded-lg fonrt-normal text-center px-8 text-white">Approve</a>
                    </form>
                    @endif
                </div>
                <div class="flex">
                    <div class="flex px-2 border border-gray-300 w-min mr-2">{{ $key + 1 }}</div>
                    <div class="flex">
                        <span class="text-gray-700">{{ $review->title }}</span>
                    </div>
                </div>
                <div class="flex w-max">
                    <a href="{{ url('admin/reviews?post='.$review->post->slug) }}" class="text-sm text-gray-500 hover:text-gray-700 hover:underline">Reviewing {{ $review->post->company_name }}</a>
                </div>
                <div class="w-full flex flex-wrap md:justify-between">
                    <div class="flex w-full sm:w-2/3 text-sm">
                        <div class="">
                            <a class="pl-1 link-default hover:underline w-full" href="{{ url('admin/reviews?author='.Str::slug($review->author->slug)) }}" class="link-yellow pl-1">{{ $review->author->name }}</a>
                            <span class="ml-2 pl-1 text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="flex justify-between w-auto text-slate-700 dark:text-slate-500 h-max">
                        <a class="flex bg-purple-500 hover:bg-purple-800 rounded-lg fonrt-normal text-center px-8 mr-1 text-white" href="{{ url('admin/reviews/'.$review->id.'/show') }}">Show</a>
                        <form action="{{ route('admin.reviews.destroy') }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                            <input type="hidden" name="id" value="{{ $review->id }}">
                            <button class="flex bg-red-500 hover:bg-red-800 rounded-lg fonrt-normal text-center px-8 text-white">Delete</a>
                        </form>
                    </div>
                </div>
            </div>       
            <?php endforeach; ?>
            </div>
            @if(count($reviews) < 1)
            <div class="flex w-full bg-gray-100">
                <div class="flex flex-col w-full">
                    <div class="p-4 bg-gray-100 text-xl sm:text-3xl flex flex-col md:flex-row items-baseline">
                    <span class="flex p-1">No reviews yet!</span>
                    </div>
                </div>
            </div>
            @endif
            <?php $items = $reviews; ?>
            @include('/admin/components/pagination')
        </div>
    </div>
</div>
@include('/admin/templates/footer')
