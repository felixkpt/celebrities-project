@include('/admin/templates/header')    
<div class="flex flex-col px-3">

    <div class="min-h-screen bg-blue-50">
        
        <!-- Grid starts here -->
        <div class="mt-8 grid gap-10 sm:grid-col-2 lg:grid-cols-3">
            
            <div class="flex items-center bg-white rounded shadow-sm justify-between p-5">
                <div>
                    <div class="text-sm rounded text-gray-400">Page views today</div>
                    <div class="text-3xl font-medium text-gray-600">{{ $page_views }}</div>
                </div>
                <div class="text-pink-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
            </div>

            <div class="flex items-center bg-white shadow-sm justify-between p-5">
                <a class="block w-full" href="{{ route('admin.users.index', ['registered-days' => 7]) }}">
                    <div class="text-sm rounded text-gray-400">Registered users this week</div>
                    <div class="text-3xl font-medium text-gray-600">{{ $users_this_week  }}</div>
                </a>    
                <div class="text-pink-500">
                    <a class="block w-full" href="{{ route('admin.users.index', ['registered-days' => 7]) }}">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    </a>
                </div>
            </div>
            
            <div class="flex items-center bg-white shadow-sm justify-between p-5">
                <div class="flex-grow">
                    <a class="block w-full" href="{{ route('admin.users.index') }}">
                        <div class="text-sm rounded text-gray-400">All users</div>
                        <div class="text-3xl font-medium text-gray-600">{{ $users_all }}</div>
                    </a>
                </div>
                <div class="text-pink-500">
                    <a class="block w-full" href="{{ route('admin.users.index') }}">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Grid ends here -->
        </div>

        <!-- Grid starts here -->
        <div class="mt-8 grid gap-10 sm:grid-col-2 lg:grid-cols-2">
            
            <div class="flex items-center bg-white rounded shadow-sm justify-between p-5">
                <div class="flex-grow">
                    <a class="block w-full" href="{{ route('admin.posts.index') }}">
                        <div class="text-sm rounded text-gray-400">Total posts</div>
                        <div class="text-3xl font-medium text-gray-600">{{ $posts }}</div>
                    </a>
                </div>
                <div class="text-pink-500">
                    <a class="block w-full" href="{{ route('admin.posts.index') }}">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </a>
                </div>
            </div>

            <div class="flex items-center bg-white shadow-sm justify-between p-5">
                <div class="flex-grow">
                    <a class="block w-full" href="{{ route('admin.pages.index') }}">
                        <div class="text-sm rounded text-gray-400">Total pages</div>
                        <div class="text-3xl font-medium text-gray-600">{{ $pages }}</div>
                    </a>
                </div>
                <div class="text-pink-500">
                    <a class="block w-full" href="{{ route('admin.pages.index') }}">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                    </a>
                </div>
            </div>
            
            <!-- Grid ends here -->
        </div>

        <!-- Grid starts here -->
        <div class="mt-8 grid gap-10 sm:grid-col-2 lg:grid-cols-3">
            <div class="md:col-span-2 flex items-center bg-white rounded shadow-sm justify-between p-5">
                <b class="flex flex-row font-bold text-gray-500">Reviews this week</b>
                <!-- <canvas>
                    Cnavas here
                </canvas> -->
                <span class="text-2xl font-medium text-gray-500">{{ $reviews_this_week }}</span>
            </div>
            <div class="flex items-center bg-white rounded shadow-sm justify-between p-5">
                <b class="flex flex-row font-bold text-gray-500">Total Reviews</b>
                <!-- <canvas>Another canvas</canvas> -->
                <span class="text-2xl font-medium text-gray-500">{{ $reviews_all }}</span>
            </div>
        </div>
        <!-- Another grid ends here -->
        <!-- Table starts here -->
        <div class="mt-8 border-t-2 border-gray-300 font-bold text-gray-600">
            <div class="flex w-full justify-between py-1">
                <span>Clients ({{ $users->total() }})</span>
                <a class="bg-white rounded-lg py-1 transition ease-in-out duration-1000 px-8 text-white bg-cyan-500 hover:bg-cyan-600 hover:text-white" href="{{ route('admin.users.index') }}">View all</a>
            </div>
        </div>
        <div class="grid gap-3 lg:grid-cols-2">
            @foreach($users as $user)
            @include('/admin/users/components/list')
            @endforeach
        </div>
        <!-- Table end here -->
    </div>
</div>
@include('/admin/templates/footer')