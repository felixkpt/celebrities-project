@include('/admin/templates/header')    
<div class="flex flex-col px-3">
    <div class="flex flex-wrap justify-center shadow rounded-lg bg-gray-50 p-1">
        <div class="w-full mb-1">
            @if($review->published == 'unapproved')
            <form action="{{ route('admin.reviews.approve') }}" method="post">
                @csrf
                <input type="hidden" name="_method" value="post">
                <input type="hidden" name="id" value="{{ $review->id }}">
                <button class="inline bg-gray-500 hover:bg-gray-800 rounded-lg font-thin text-center px-8 text-white">Approve</a>
            </form>
            @endif
        </div>

        <div class="w-full mt-3">
            <hr>
        </div>
        <div class="w-full md:w-2/12 mt-3 md:pr-2 overflow-hidden">
            <?php $user = App\Models\User::where('id', $review->user_id)->first() ?>
            <div class="w-24 h-24 md:w-4/5 md:h-3/5 mb-2 mx-auto rounded-full">
            <a href="{{ url('profile/'.$user->slug) }}">
                <img class="w-24 h-24 rounded-full mx-auto" src="{{ asset(App\Models\User::where('id', $review->user_id)->first()->avatar) }}" alt="" class="user-img rounded-circle border p-1" width="100%">
            </a>
            </div>
            <div class="w-full text-center pt-2">
                <a class="text-yellow-500 hover:text-yellow-700" href="{{ url('profile/'.$user->slug) }}">{{ $user->name }}</a>
            </div>

        </div>
        <div class="w-full mdl:w-10/12 mt-3">
            <h4 class="mb-1 text-xl font-medium text-center md:text-left">{{ $review->title }}</h4>
            @include('/admin/posts/reviews/components/stars')
            <p class="mb-0 text-center md:text-left">{!! $review->content !!}</p>
        </div>

        <div class="w-full flex flex-wrap justify-center lg:justify-end mt-2">
           
            <div class="flex justify-between w-auto text-slate-700 dark:text-slate-500 h-max">
                <a class="flex bg-purple-500 hover:bg-purple-800 rounded-lg font-thin text-center px-8 mr-1 text-white" href="{{ url('company/'.App\Models\Post::where('id', $review->post_id)->first()->slug) }}">View post</a>
                <form action="{{ route('admin.reviews.destroy') }}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="id" value="{{ $review->id }}">
                    <input type="hidden" name="redirect" value="{{ url('admin/reviews') }}">
                    <button class="flex bg-red-500 hover:bg-red-800 rounded-lg font-thin text-center px-8 text-white">Delete</a>
                </form>
            </div>
        </div>
    </div>
</div>
@include('/admin/templates/footer')
