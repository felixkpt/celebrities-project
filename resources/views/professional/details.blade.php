@include('/templates/header')
<div class="flex flex-col w-full my-2">
    <div class="text-2xl bg-white shadown-lg m-4 rounded-lg">
        <div class="w-full p-2">
            <h1>{{ $title }}</h1>
        </div>
    </div>
    @include('/people/components/people-header')
</div>
@include('/templates/footer')