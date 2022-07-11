@include('/admin/templates/header')    
<div class="flex flex-col px-3">

    <div class="flex w-full">
        <div class="flex w-full justify-between">
            <div class="flex w-1/2">
                <h2 class="text-2xl">Roles Management</h2>
            </div>
            <div class="flex justify-end w-1/2">
                <a class="bg-purple-500 hover:bg-purple-700 text-white p-2 my-2 rounded-lg font-medium" href="{{ route('admin.users.roles.create') }}"> Create New Role</a>
            </div>
        </div>
    </div>

    <div class="flex flex-auto bg-white rounded shadow-sm items-center">
        <table class="table-fixed w-full divide-y divide-gray-200 table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-2 py-2 lg:px-6 lg:py-4 text-left tex-xs font-medium text-gray-500 upercase tracking-wider">No</th>
                    <th scope="col" class="px-2 py-2 lg:px-6 lg:py-4 text-left tex-xs font-medium text-gray-500 upercase tracking-wider">Name</th>
                    <th scope="col" class="px-2 py-2 lg:px-6 lg:py-4 text-left tex-xs font-medium text-gray-500 upercase tracking-wider">Role/Actions</th>
                </tr>
            </thead>
            <tbody>
                </tr>
                @foreach ($roles as $key => $role)
                <tr>
                    <td class="px-2 py-2 lg:px-6 lg:py-4 truncate">{{ ++$i }}</td>
                    <td class="px-2 py-2 lg:px-6 lg:py-4 truncate">{{ $role->name }}</td>
                    <td class="px-2 py-2 lg:px-6 lg:py-4 truncate">
                        <a class="btn btn-info" href="{{ route('admin.users.roles.show',$role->id) }}">Show</a>
                        @can('role-edit')
                            <a class="p-1 text-indigo-600 hover:text-indigo-900" href="{{ route('admin.users.roles.edit',$role->id) }}">Edit</a>
                        @endcan
                        @can('role-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['admin.users.roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'p-1 text-red-500 hover:text-red-700 cursor-pointer']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {!! $roles->render() !!}

</div>
@include('/admin/templates/footer')