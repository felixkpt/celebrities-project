<?php
$years = range(date('Y', strtotime('-10 years')), date('Y', strtotime('-130 years')));
$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
$days = range(1, 31);
?>
<h1 class="flex w-full md:w-7/12 order-2 md:order-1 my-2">{{ $title }}</h1>
<div class="flex w-full md:w-5/12 order-1 md:order-2 rounded-lg">
    <form id="selection-form" class="flex w-full h-min my-auto">
        <div class="flex w-full font-sm md:justify-end">
            <select name="year" id="year" class="py-1 w-1/4">
                <option class="md:px-1" value="default">Year</option>
                @foreach($years as $year)
                <option class="md:px-1" value="{{ date('Y', strtotime($year)) }}">{{ $year }}</option>
                @endforeach
            </select>
            <select name="month" id="month" class="py-1 w-1/4">
                <option value="default">Month</option>
                @foreach($months as $month)
                <option value="{{ date('m', strtotime($month)) }}">{{ $month }}</option>
                @endforeach
            </select>
            <select name="day" id="day" class="py-1 w-1/4">
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
            let year = document.getElementById('year').value
            let month = document.getElementById('month').value
            let day = document.getElementById('day').value
            let url = <?php echo json_encode(url('birthdays')) ?> + '/';
            let href = '';
            let run = false
            if (year != 'default') {
                run = true;
                href = url + 'year/' + year;
                if (month != 'default') {
                    href = url + 'year/' + year + '/month/' + month;
                    if (day != 'default') {
                        href = url + 'year/' + year + '/month/' + month + '/day/' + day;
                    }
                }
            } else if (month != 'default') {
                run = true;
                href = url + 'month/' + month;
                if (day != 'default') {
                    href = url + 'month/' + month + '/day/' + day;
                }
            } else if (day != 'default') {
                run = true;
                href = url + 'day/' + day;
            } else {
                invalidDateRange();
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