@include('/templates/header')
<div class="flex flex-col w-full my-2">
    <?php
    $functions = str_split($person->typology);
    $map = ['I' => 'Introverted', 'E' => 'Extroverted', 'S' => 'Sensing', 'N' => 'iNtuition', 'F' => 'Feeling', 'T' => 'Thinking', 'J' => 'Judging', 'P' => 'Perceiving'];
    $personality = $person->personality;
    ?>
    @include('/people/components/personal-header')
    <div id="person-content" class="w-full bg-fuchica-50 p-2 rounded-lg">
        <div class="text-lg bg-white my-3">
            <div>
                {!! $person->content->content !!}
            </div>
        </div>
            <div class="bg-gray-100 p-2 rounded">
                @include('/mbti/components/mbti-functionalities')
                @include('/people/components/vote-typology')
            </div>
            <p class="text-lg">
                <?php echo substr(strip_tags($person->personality->profession), 0, 200) ?>
            </p>
        <div class="flex w-full my-8 justify-center">
            <div class="flex">
                <a class="text-2xl rounded-lg py-1 transition ease-in-out duration-500 px-12 font-medium text-[#2e265a]  hover:text-[#302a4c] bg-fuchsia-50 hover:bg-fuchsia-100  border border-[#2e265a] hover:border-[#302a4c]" href="{{ url('people/mbti/'.$person->personality->slug.'s') }}">More {{ $person->personality->name }}s</a>
            </div>
        </div>
    </div>
</div>
@include('/templates/footer')