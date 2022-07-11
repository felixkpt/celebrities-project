<div class="flex flex-wrap w-full">
    <?php
    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    $days = range(1, 31);
    ?>
    <div class="flex-1 w-full md:w-8/12 order-2 md:order-1 my-2">
        <h1>People's birthdays by month</h1>
    </div>
    <div class="w-full md:w-4/12 order-1 md:order-2 items-center rounded-lg md:pl-2 self-center">
        <form id="selection-form" class="flex w-full h-min my-auto">
            <div class="flex justify-center w-full font-sm">
                <select name="month" id="month" class="py-1 w-1/2">
                    <option value="default">Month</option>
                    @foreach($months as $month)
                    <option value="{{ date('m', strtotime($month)) }}">{{ $month }}</option>
                    @endforeach
                </select>
                <select name="day" id="day" class="py-1 w-1/2">
                    <option class="md:px-1" value="default">Day</option>
                    @foreach($days as $day)
                    <option class="md:px-1" value="{{ str_pad($day, 2, '0', STR_PAD_LEFT) }}">{{ $day }}</option>
                    @endforeach
                </select>
                <button class="px-3 ml-1 rounded-lg link-default bg-white">Check</button>
            </div>
        </form>
        <script>
            document.getElementById('selection-form').addEventListener('submit', function(e) {
                e.preventDefault();
                let month = document.getElementById('month').value
                let day = document.getElementById('day').value
                let url = <?php echo json_encode(url('birthdays')) ?> + '/';
                let href = '';
                let run = false
                if (month != 'default') {
                    run = true;
                    href = url + 'month/' + month;
                    if (day != 'default') {
                        href = url + 'month/' + month + '/day/' + day;
                    }
                } else if (day != 'default') {
                    run = true;
                    href = url + 'day/' + day;
                } else {
                    invalidDateRange()
                }

                if (run == true) {
                    setTimeout(() => {
                        return window.location.href = href;
                    }, 1000);
                }

            })
            invalidDateRange('clear');
        </script>
    </div>
</div>