@include('/templates/header')
<div class="flex flex-col w-full my-2">
    <div class="flex flex-wrap">
        <h1 class="flex w-full md:w-9/12 order-2 md:order-1 my-2">People born {{ $year }}</h1>
        <div class="flex w-full md:w-3/12 order-1 md:order-2 bg-gray-100 p-1 items-center rounded-lg">
            <div class="flex w-full"><a class="link-default" href="{{ url('birthdays/year/'.$year) }}" class="text-sky-500">Born {{ $year }}</a></div>
        </div>
    </div>
    @include('/people/components/people-header')
</div>        
@include('/templates/footer')
