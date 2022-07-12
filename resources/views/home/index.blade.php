@include('/templates/header')
<div class="flex flex-col">
    <div class="w-full">
        @include('/home/slider')
    </div>
    <div class="w-full rounded-lg mt-12">
        <h2 class="flex justify-between w-full">People born this month <a class="text-center rounded-lg transition ease-in-out duration-1000 p-2 text-xl link-default" href="{{ url('birthdays/month/'.date('m')) }}">Birthdays this month</a></h2>
        @include('/people/components/people-header')
    </div>
    <div class="flex flex-wrap w-full border-top rounded-lg">
        <h2 class="flex justify-between w-full">Typologies by Mayers Briggs <a class="text-center rounded-lg transition ease-in-out duration-1000 p-2 text-xl link-default" href="{{ url('typologies') }}">View all typologies</a></h2>
        <div class="w-full">
            @include('/home/mbti')
        </div>
    </div>
    <div class="flex flex-wrap w-full">
        <?php $recommended_title = "Latest Posts" ?>
        @include('/posts/components/latest-md')
    </div>

</div>
@include('/templates/footer')