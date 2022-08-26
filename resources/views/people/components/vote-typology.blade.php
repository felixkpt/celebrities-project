<div class="flex flex-col items-center w-full">
    <div class="flex flex-wrap justify-center border w-full md:w-11/12 my-1">
        <p class="font-medium text-gray-600 font-italic text-sm bg-gray-50 px-1 py-2" style="font-family: cursive;">
            We sort votes by our users and assign the MBTI type. Please cast your vote now, and we will really appreciate it!
        </p>
        <form action="{{ route('people.vote') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $person->id }}">
            <div class="my-2 border p-1">
                <label for="vote" class="w-full block sm:inline bg-pink-200 rounded px-1 mb-1 sm:mb-0 sm:bg-white">Your vote</label>
                <select name="vote" id="vote" style="padding: 0 30px;" class="rounded">
                    <option>--Select--</option>
                    @foreach(App\Models\MBTI::all() as $typology)
                    <option <?php if ($vote && $vote->vote == $typology->name) { echo 'selected'; } ?>>{{$typology->name }}</option>
                    @endforeach
                </select>
                <button style="padding: 0.10rem 0.20rem;" class="bg-gray-600 text-white rounded hover:bg-gray-800 transition-ease duration-1000">Cast now!</button>
            </div>
        </form>
    </div>
</div>