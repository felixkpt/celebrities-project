@include('templates/header')
<div class="flex flex-wrap justify-center w-full p-1">
    <div class="w-full text-2xl bg-white shadown-lg m-4 rounded-lg">
        <span class="block w-full p-2">Tagged timezone offset {{ $timezone }}</span>
        <span class="block w-full p-2 text-gray-500">({{ $timezone_description }})</span>
    </div>
</div>
@include('/people/components/people-header')

@include('templates/footer')