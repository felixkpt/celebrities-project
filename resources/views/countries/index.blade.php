@include('/templates/header')
<div class="flex flex-col w-full my-2">
    <div class="text-2xl bg-white shadown-lg m-4 rounded-lg">
        <div class="w-full p-2">
            <h1>{{ $title }}</h1>
        </div>
    </div>
    <div class="grid gap-1 grid-cols-1 md:grid-cols-2">
    @foreach($countries as $country)
    <div class="flex bg-fuchsia-50">
        <div class="w-full text-2xl bg-white shadown-lg m-4 rounded-lg">
            <a class="block w-full p-2 truncate" href="{{ url('countries/'.$country->slug) }}">
                <img class="w-16 h-16 rounded-full" height="40px" width="40px" src="{{ asset('images/countries/flags/'.(strtolower($country->code) ?? 'default').'.png') }}" alt="Country Flag">
                {{ $country->name }}</a>
        </div>
    </div>
    @endforeach
    </div>

    @include('/components/pagination')
</div>
@include('/templates/footer')