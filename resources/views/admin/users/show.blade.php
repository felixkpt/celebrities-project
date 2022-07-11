@include('/admin/templates/header')    
<div class="flex flex-col px-3">
<div class="w-full">
    <a class="hover:text-gray-900 hover:underline" href="{{ route('admin.users.index') }}"><svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg> Back</a>
</div>

<div class="w-full">
    <?php $user = isset($user) ? $user : $author ?>
    <div class="flex flex-wrap justify-center bg-gray-100 space-y-3 px-1 pb-4 rounded">
        <div class="w-full sm:w-1/2">
            <div class="flex flex-wrap justify-center">
                <div class="p-2">
                    <div class="w-36 h-36 mx-auto rounded-full border-1 border-gray-100">
                        <img class="w-36 h-36 mx-auto rounded-full border-1 border-gray-100" src="{{ $user->avatar ?? asset('images/default-user.png') }}">
                    </div>
                    <p class="md:text-xl font-medium text-gray-700 text-center">{{ $user->name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="flex flex-wrap w-full space-y-3">
    <div class="w-full sm:w-1/2">
        <div class="form-group">
            <div class="inline text-gray-700 font-medium">Name:</div>
            {{ $user->name }}
        </div>
    </div>
    <div class="w-full sm:w-1/2">
        <div class="form-group">
            <div class="inline text-gray-700 font-medium">Email:</div>
            {{ $user->email }}
        </div>
    </div>
    <div class="w-full sm:w-1/2">
        <div class="form-group">
            <div class="inline text-gray-700 font-medium">Roles:</div>
            @if(count($user->getRoleNames()))
            @foreach($items = $user->getRoleNames() as $item) 
            <span class="text-gray-500">{{ $item }}</span>@if(isset($items[$loop->index+1])), @endif
            @endforeach
            @else
            Subscriber
            @endif
        </div>
    </div>
    <div class="w-full sm:w-1/2">
        <div class="inline text-gray-700 font-medium">Registered:</div>
        <span>{{ $user->created_at->diffForHumans() }}</span>
    </div>
    <div class="w-full sm:w-1/2">
        <div class="inline text-gray-700 font-medium">No of posts written:</div>
        <span>
        <?php 
        if ($user->posts->count()) {
            ?>
            <a class="pl-1 link-default hover:underline w-full" href="{{ url('admin/posts?author='.Str::slug($user->slug)) }}" class="link-yellow pl-1">
                <svg class="w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg><span class="ml-2">{{ $user->posts()->count() }}</span>
            </a>
            <?php
        }else {
            ?>
            <span class="link-default">
                <svg class="w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg><span class="ml-2">0</span>
            </span>
            <?php
        } ?>
        </span>
    </div>
    <div class="w-full sm:w-1/2">
        <div class="inline text-gray-700 font-medium">No of reviews written:</div>
        <span>
        <?php 
        if ($user->reviews->count()) {
            ?>
            <a class="pl-1 link-default hover:underline w-full" href="{{ url('admin/reviews?author='.Str::slug($user->slug)) }}" class="link-yellow pl-1">
                <svg class="w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg><span class="ml-2">{{ $user->reviews()->count() }}</span>
            </a>
            <?php
        }else {
            ?>
            <span class="link-default">
                <svg class="w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg><span class="ml-2">0</span>
            </span>
            <?php
        } ?>
        </span>
    </div>
</div>

<hr class="my-4">
<div>
<a class="p-1 text-indigo-600 hover:text-indigo-900" href="{{ route('admin.users.edit',$user->id) }}">Edit</a>
</div>

</div>
@include('/admin/templates/footer')