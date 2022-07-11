<div class="flex flex-auto bg-white rounded shadow-sm items-center">
    <table class="table-fixed w-full divide-y divide-gray-200 table-auto">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-2 py-2 lg:px-6 lg:py-4 text-left tex-xs font-medium text-gray-500 upercase tracking-wider">Name</th>
                <th scope="col" class="hidden sm:block px-2 py-2 lg:px-6 lg:py-4 text-left tex-xs font-medium text-gray-500 upercase tracking-wider">Role</th>
                <th scope="col" class="px-2 py-2 lg:px-6 lg:py-4 text-left tex-xs font-medium text-gray-500 upercase tracking-wider">Status</th>
                <th scope="col" class="px-2 py-2 lg:px-6 lg:py-4 text-left tex-xs font-medium text-gray-500 upercase tracking-wider">Edit</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="px-2 py-2 lg:px-6 lg:py-4 truncate">
                    <div class="flex flex-col">
                        <div class="text-sm font-medium text-gray-600" title="Name">
                            {{ $user->name }}
                        </div>
                        <div class="flex-shrink-0 w-12 h-12">
                            <img class="w-12 h-12 rounded-full" src="{{ asset($user->avatar ?? 'uploads/images/users/default.jpg') }}" alt="">
                        </div>
                        <div class="text-sm text-gray-600" title="Email">{{ $user->email }}</div>
                    </div>
                </td>
                <td class="hidden sm:block px-2 py-2 lg:px-6 lg:py-4 truncate text-xs font-medium text-gray-500" title="Role">
                    @if($user->getRoleNames())
                    @foreach($items = $user->getRoleNames() as $item) 
                        <span class="text-gray-500">{{ $item }}</span>@if(isset($items[$loop->index+1])), @endif
                    @endforeach
                    @endif
                </td>
                <td class="px-2 py-2 lg:px-6 lg:py-4 truncate">
                    <span class="px-2 inline-flex text-xs loading-5 font-semi-bold rounded-full bg-green-100 text-green-800 py-1">Active</span>
                </td>
                <td class="px-2 py-2 lg:px-6 lg:py-4 truncate text-xs font-medium text-gray-500" title="Supervisor">
                    <div class="flex flex-col md:flex-row md:justify-between w-full">
                        <div class="flex">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                Edit
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>