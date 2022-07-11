@include('/templates/header')
<div class="flex flex-col w-full my-2">
    <div class="flex flex-wrap">
        <h1 class="flex w-full md:w-9/12 order-2 md:order-1 my-2">People born month of {{ date('F', strtotime($month.'/'.$day)) }}</h1>
        <div class="flex w-full md:w-3/12 order-1 md:order-2 p-1 items-center rounded-lg">
            <?php 
            $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']; 
            unset($months[array_search(date('F', strtotime($month.'/15')), $months)]);
            ?>
            <div class="flex w-full md:justify-end">
                <select name="month" id="month" class="py-1">
                    <option value="default">Another Month</option>
                    @foreach($months as $month)
                    <option value="{{ date('m', strtotime($month)) }}">{{ $month }}</option>
                    @endforeach
                </select>
                <script>
                    document.getElementById('month').addEventListener('change', function() {
                        let url = <?php echo json_encode(url('birthdays')) ?>+'/';
                        let month = document.getElementById('month').value
                        if (month != 'default') {
                        let href = url+'month/'+month;
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
