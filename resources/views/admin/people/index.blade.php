@include('/admin/templates/header')    
<div class="flex flex-col px-3 overflow-x-hidden">

    <div class="flex justify-end overflow-hidden w-auto text-left border-b-2 border-gray-300 pb-2">
        <a href="{{ url('admin/people/create') }}" class="text-white rounded py-2 px-4 bg-cyan-500 hover:bg-cyan-600">Create a new</a>
        <span class="px-2 my-auto underline text-gray-700">OR</span>
        <a href="{{ url('admin/people/fetch') }}" class="text-white rounded py-2 px-4 bg-cyan-500 hover:bg-cyan-600">Fetch</a>
    </div>
    <div class="flex flex-wrap">
        <?php foreach($people as $key =>  $person): ?>
                <figure class="w-full md:flex m-1 md:m-4 bg-slate-100 rounded-xl p-4 md:p-0 dark:bg-slate-800">
                    <div class="w-32 h-32 md:w-1/5 md:h-auto overflow-hidden md:rounded-none rounded-full mx-auto">
                        <a class="text-2xl" href="{{ url('people/'.$person->id.'/'.Str::slug($person->first_name.' '.$person->last_name, '-')) }}">
                            <img class="img-fadein md:rounded-none rounded-full mx-auto" src="{{ asset($person->image) }}" alt="" width="100" height="100">
                        </a>
                    </div>
                    <div class="pt-6 md:p-4 md:w-4/5 text-center md:text-left space-y-4">
                        <blockquote>
                            <div class="flex flex-col md:flex-row">
                                <div class="flex bg-gray-200 w-full md:w-1/2 justify-between pl-1 rounded-tl rounded-bl">
                                    <div class="flex flex-wrap">
                                        <div class="w-full pt-1">
                                            <img class="w-8 h-8 rounded-full" style="width: 30px; height:30px" src="{{ asset('images/countries/flags/'.strtolower($person->country_code).'.png') }}">
                                        </div>
                                        <div class="text-sky-500">
                                        {{ $person->country }}
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap">
                                        <div class="font-medium text-right md:text-left w-full">Born</div>
                                        <div class="w-full md:w-auto text-right md:text-left text-sky-500">{{ date('M jS, Y', strtotime($person->dob)) }}</div>
                                    </div>
                                </div>
                                <div class="flex bg-gray-200 w-full md:w-1/2 justify-between pr-1 rounded-tr rounded-br">
                                    <div class="flex flex-wrap">
                                        <div class="font-medium w-full text-left">Personalites</div>
                                        <div class="text-sky-500">{{ $person->typology }}</div>
                                    </div>
                                    <div class="flex flex-wrap">
                                        <div class="font-medium text-right w-full">Timezone</div>
                                        <div class="w-full text-sky-500 text-right">{{ $person->timezone_description }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-lg font-medium">
                                <div>{{ $person->first_name }} {{ $person->last_name }} {{ $person->nickname }}</div>
                            </div>
                        </blockquote>
                        <figcaption class="font-medium">
                            
                            <div class="flex justify-between w-1/3 text-slate-700 dark:text-slate-500">
                                <a class="flex bg-purple-500 hover:bg-purple-800 rounded-lg font-thin text-center px-8 text-white" href="{{ url('admin/people/'.$person->id.'/edit') }}">Edit</a>
                                <form action="{{ route('admin.people.delete') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete">
                                    <input type="hidden" name="id" value="{{ $person->id }}">
                                    <button class="flex bg-red-500 hover:bg-red-800 rounded-lg font-thin text-center px-8 text-white">Delete</a>
                                </form>
                            </div>
                        </figcaption>
                    </div>
                </figure>
        <?php endforeach; ?>
        @if(count($people) < 1)
        <div class="flex w-full bg-gray-100">
            <div class="flex flex-col w-full my-2">
                <div class="p-4 bg-gray-100 text-xl sm:text-3xl flex flex-col md:flex-row items-baseline">
                <span class="flex p-1">No people created yet!</span> <a class="flex p-1 text-purple-500 text-lg sm:text-xl font-medium" href="{{ route('admin.people.create') }}">Start writing your first celeb article now...</a>
                </div>
            </div>
        </div>
        @endif

        @include('/components/pagination')
    </div>
</div>
@include('/admin/templates/footer')
