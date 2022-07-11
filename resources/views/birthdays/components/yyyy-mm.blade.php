<?php 
$years = range(date('Y', strtotime('-10 years')), date('Y', strtotime('-130 years')));
$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']; 
$days = range(1,31);
?>
<h1 class="flex w-full md:w-8/12 order-2 md:order-1 my-2">People's birthdays by month</h1>
    <div class="flex w-full md:w-4/12 order-1 md:order-2 rounded-lg">
        <form id="selection-form" class="flex w-full h-min my-auto">
            <div class="flex w-full font-sm">
                <select name="year" id="year" class="py-1 w-1/2">
                    <option class="md:px-1" value="default">Year</option>
                    @foreach($years as $year)
                    <option class="md:px-1" value="{{ date('Y', strtotime($year)) }}">{{ $year }}</option>
                    @endforeach
                </select>
                <select name="month" id="month" class="py-1 w-1/2">
                    <option value="default">Month</option>
                    @foreach($months as $month)
                    <option value="{{ date('m', strtotime($month)) }}">{{ $month }}</option>
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
                let url = <?php echo json_encode(url('birthdays')) ?>+'/';
                let href = '';
                let run = false
                if (year != 'default') {
                    run = true;
                    href = url+'year/'+year;
                    if (month != 'default') {
                        href = url+'year/'+year+'/month/'+month;
                    }
                }else if(month != 'default') {
                    run = true;
                    href = url+'month/'+month;
                }else {
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
</div>