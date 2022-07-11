@include('/templates/header')
<div class="flex flex-col w-full my-2">
    <div class="text-2xl bg-white shadown-lg m-4 rounded-lg">
        <div class="flex items-center w-full p-2">
            <img class="w-16 h-16 rounded-full pr-2" height="40px" width="40px" src="{{ asset('images/countries/flags/'.(strtolower($country->code) ?? 'default').'.png') }}" alt="Country Flag">
            <h1 class="flex-1">{{ $title }}</h1>
        </div>
    </div>
    @include('/people/components/people-header')
</div>
@include('/templates/footer')