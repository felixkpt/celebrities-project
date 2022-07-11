@include('/templates/header')
<div class="flex flex-col w-full my-2">
    <div class="flex flex-wrap w-full">
        @include('/birthdays/components/yyyy-mm-dd')
    </div>
    <div class="flex flex-wrap w-full rounded">
        <?php 
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']; 
        foreach($months as $key => $month):
        ?>
            <div class="flex w-full sm:w-4/12 md:w-3/12 h-64 p-4">
                <div class="w-full shadow">
                    <div class="flex h-full rounded-lg overflow-hidden">
                        <a class="rounded-lg img-fadein link-default flex items-center justify-center h-full block w-full shadow-lg text-3xl bg-fuchsia-50" href="{{ url('birthdays/month/'.date('m', strtotime($month))) }}">{{ $month  }}</a>
                    </div>
                </div>
            </div>
        <?php 
        endforeach; 
        ?>
    </div>
</div>
@include('/templates/footer')
