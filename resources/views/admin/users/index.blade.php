@include('/admin/templates/header')
<div class="flex flex-col px-3">

<div class="flex w-full">
    <div class="flex w-full justify-between border-b-2 border-gray-300 pb-2">
        <div class="flex">
            <h2 class="text-2xl">{{ $title }}</h2>
        </div>
        <div class="flex justify-end overflow-hidden w-auto my-auto text-left">
            <a href="{{ route('admin.users.create') }}" class="text-white rounded py-2 px-4 bg-cyan-500 hover:bg-cyan-600">Create a new</a>
        </div>
    </div>
</div>

<div class="flex flex-col justify-center items-center mt-2">
  <table class="table-fixed w-full lg:w-11/12 bg-white rounded shadow-sm divide-y divide-gray-200 table-auto">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-2 py-2 lg:px-6 lg:py-4 text-left text-normal font-medium text-gray-500 upercase tracking-wider">Name</th>
            <th scope="col" class="px-2 py-2 lg:px-6 lg:py-4 text-left text-normal font-medium text-gray-500 upercase tracking-wider">Registered</th>
            <th scope="col" class="px-2 py-2 lg:px-6 lg:py-4 text-left text-normal font-medium text-gray-500 upercase tracking-wider">Role</th>
        </tr>
    </thead>
    @foreach ($users as $key => $user)
    <tr>
      <td class="px-2 py-2 lg:px-6 lg:py-4 truncate">
          <div class="flex flex-col">
              <div class="text-normal font-medium text-gray-600" title="Name">
                  <a class="text-indigo-600 hover:text-indigo-900" href="{{ url('profile/'.$user->slug) }}">{{ $user->name }}</a>
              </div>
              <div class="flex-shrink-0 w-16 h-16">
              <a class="block w-full" href="{{ url('profile/'.$user->slug) }}">
                <img class="w-16 h-16 rounded-full" src="{{ isset($user->avatar) ? $user->avatar : asset('images/default-user.png') }}" alt="">
              </a>
              </div>
              <div class="text-sm text-gray-600" title="Email">{{ $user->email }}</div>
          </div>
      </td>
      <td class="px-2 py-2 lg:px-6 lg:py-4">
          <div class="flex flex-wrap">
              <span class="px-2 inline-flex text-sm text-gray-500 py-1">{{ $user->created_at->diffForHumans() }}</span>
              <span class="px-2 inline-flex text-xs loading-5 font-semi-bold rounded-full bg-green-100 text-green-800 py-1">Active</span>
          </div>
      </td>
      <td class="px-2 py-2 lg:px-6 lg:py-4 truncate text-sm font-medium text-gray-500">
          <div class="flex flex-col md:flex-row md:justify-between w-full">
              <div class="flex p-1">
              @if(count($user->getRoleNames()))
                @foreach($items = $user->getRoleNames() as $item) 
                <a href="{{ url('admin/users?role='.$item) }}" class="text-gray-500 hover:underline">{{ $item }}</a>@if(isset($items[$loop->index+1])), @endif
                @endforeach
              @else
                <a href="{{ url('admin/users?role=Subscriber') }}" class="text-gray-500 hover:underline">Subscriber</a>
              @endif
              </div>
              <div class="flex flex-wrap p-1">
                  <a class="p-1 text-indigo-600 hover:text-indigo-900" href="{{ route('admin.users.show',$user->id) }}">
                    Show
                  </a>
                  <a class="p-1 text-indigo-600 hover:text-indigo-900" href="{{ route('admin.users.edit',$user->id) }}">
                    Edit
                  </a>
                  {!! Form::open(['method' => 'DELETE','route' => ['admin.users.destroy', $user->id],'style'=>'display:inline']) !!}
                      {!! Form::submit('Delete', ['class' => 'p-1 text-red-500 hover:text-red-700 cursor-pointer']) !!}
                  {!! Form::close() !!}
              </div>
          </div>
      </td>
    </tr>
  @endforeach
  @if(count($users) < 1)
                <tr>
                    <td colspan="3">
                        <div class="p-4 bg-gray-100 text-xl sm:text-3xl flex flex-col md:flex-row items-baseline">
                        <span class="flex p-1">No users yet!</span>
                        </div>
                    </td>
                </tr>
                @endif
  </table>
  <?php $items = $users; ?>
  @include('/admin/components/pagination')
</div>

</div>
@include('/admin/templates/footer')