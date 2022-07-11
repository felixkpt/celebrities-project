@include('/templates/header')
<div class="flex flex-col w-full my-2">
    <div class="flex flex-wrap">
        <h1 class="flex w-full md:w-9/12 order-2 md:order-1 my-2">People born {{ date('jS', strtotime('06/'.$day)) }} day of the month</h1>
        <div class="flex w-full md:w-3/12 order-1 md:order-2 p-1 items-center rounded-lg">
        <?php 
            $days = range(1,31);
            unset($days[array_search(date('d', strtotime('06/'.$day)), $days)]);
            ?>
            <div class="flex w-full md:justify-end">
                <select name="day" id="day" class="py-1">
                    <option value="default">Another day</option>
                    @foreach($days as $day)
                    <option value="{{ str_pad($day, 2, '0', STR_PAD_LEFT) }}">{{ $day }}</option>
                    @endforeach
                </select>
                <script>
                    document.getElementById('day').addEventListener('change', function() {
                        let url = <?php echo json_encode(url('birthdays')) ?>+'/';
                        let day = document.getElementById('day').value
                        if (day != 'default') {
                        let href = url+'day/'+day;
                            window.location.href = href;
                        }
            
                    })
                </script>    
            </div>
        </div>
    </div>
</div>
@include('/people/components/people-header')
@include('/templates/footer')
