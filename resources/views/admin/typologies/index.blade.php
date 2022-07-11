@include('/admin/templates/header')    
<div class="flex flex-col px-3 overflow-x-hidden">
    <div class="flex flex-auto justify-center items-center">
        <table class="table-fixed w-10/12 bg-white rounded shadow-sm divide-y divide-gray-200 table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Name</th>
                    <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Strength</th>
                    <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Prevalence</th>
                    <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($personalities as $key => $personality)
                <tr>
                    <td class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-500 text-left">
                        <div class="flex flex-col">
                            <div class="flex">
                            #{{ $key + 1 }}
                            <span class="px-2 text-gray-600">{{ $personality->name }}</span>
                            </div>
                            <div class="flex w-24 h-16 rounded">
                                <img class="w-24 h-16 rounded" src="{{ asset($personality->featured_image) }}">
                            </div>
                        </div>
                    </td>
                    <td class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-500 text-left">{{ $personality->strength }}</td>
                    <td class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-500 text-left">{{ $personality->prevalence }}%</td>
                    <td class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-500 text-left">
                        <button id="dropdownDefault{{ $key }}" data-dropdown-toggle="dropdown{{ $key }}" class="text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center" type="button">
                            Actions 
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div id="dropdown{{ $key }}" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(352px, -12px);" data-popper-placement="top">
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault{{ $key }}">
                                <li>
                                    <a href="{{ url('typologies/'.strtolower($personality->name)) }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">View</a>
                                </li>
                                <li>
                                    <a href="{{ url('admin/typologies/'.$personality->id.'/edit') }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                </li>
                                <li>
                                    <form class="flex" action="{{ url('admin/typologies') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete">
                                    <input type="hidden" name="id" value="{{ $personality->id }}">
                                    <button class="block w-full py-2 px-4 bg-red-100 hover:bg-red-200 text-left">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
                @if(count($personalities) < 1)
                <tr>
                    <td colspan="5">
                        <div class="p-4 bg-gray-100 text-xl sm:text-3xl flex flex-col md:flex-row items-baseline">
                        <span class="flex w-full md:w-2/3 p-1">Whoops! You have not pulished typologies yet! MBTI has 16 typologies.</span> <a class="flex w-full md:w-1/3 p-1 text-purple-500 text-lg sm:text-xl font-medium" href="{{ route('admin.typologies.create') }}">Start creating typologies now...</a>
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        @if(count($personalities) < 16)
        <div class="block text-left ml-4 mt-4">
            <a href="{{ route('admin.typologies.create') }}" class="text-white rounded py-2 px-4 mr-16 bg-cyan-500 hover:bg-cyan-600">Create a new</a>
        </div>
        @endif
    </div>
</div>
@include('/admin/templates/footer')
