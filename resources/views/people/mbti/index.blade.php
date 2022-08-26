@include('/templates/header')
<div class="flex flex-col">
    <div class="flex flex-wrap">
        @include('/birthdays/components/yyyy-mm-dd')
    </div>
    @include('/people/components/people-header')
</div>
@include('/templates/footer')
