@include('/admin/templates/header')
    <div class="flex flex-col px-3">
        <div class="flex w-full justify-center">
            <div class="w-1/2 p-3 bg-gray-50 shadow">
                <form action="{{ route('admin.people.fetcher') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="url">Input url</label>
                        <input class="basic-input" id="url" type="url" name="url" value="">
                    </div>
                    <div class="mb-4">
                        <input type="checkbox" name="single" id="single">
                        <label for="single">Single celeb url?</label>
                    </div>

                    <button class="button-default">Okay</button>
                </form>
            </div>    
        </div>
    </div>
@include('/admin/templates/footer')
