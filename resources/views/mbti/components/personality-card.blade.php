<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-2 rounded drop-shadow-lg mb-3 p-2">
    <?php foreach ($personalities as $key => $personality) : ?>
        <?php
        $functions = str_split($personality->name);
        $map = ['I' => 'Introverted', 'E' => 'Extroverted', 'S' => 'Sensing', 'N' => 'iNtuition', 'F' => 'Feeling', 'T' => 'Thinking', 'J' => 'Judging', 'P' => 'Perceiving'];
        ?>
        <div class="bg-fuchsia-50 flex flex-col w-full p-2 overflow-hidden">
            <div class="relative mx-auto">
                <a href="{{ url('mbti/'.$personality->slug) }}">
                    <div class="image-wrapper-md">
                        <img class="rounded img-fadein" src="{{ asset($personality->featured_image) }}" alt="ISFP">
                    </div>
                    <div style="position: absolute;bottom:3px;">
                        <div class="flex flex-wrap w-full overflow-hidden">
                            <blockquote class="flex w-64">
                                <div class="flex w-full text-lg lg:text-xl">
                                    <div class="flex">
                                        <div class="flex flex-nowrap bg-green-300 text-red-600">
                                            <div class="flex bg-gray-200 w-1/2 justify-around pl-1">
                                                <div class="flex flex-wrap">
                                                    <div class="font-bold text-left w-full shadow-sm">
                                                        {{ $functions[0] }}
                                                    </div>
                                                </div>
                                                <div class="flex flex-wrap">
                                                    <div class="font-bold text-center w-full shadow-sm">{{ $functions[1] }}</div>
                                                </div>
                                            </div>
                                            <div class="flex bg-gray-200 w-1/2 justify-around pr-1">
                                                <div class="flex flex-wrap">
                                                    <div class="font-bold w-full text-center shadow-sm">{{ $functions[2] }}</div>
                                                </div>
                                                <div class="flex flex-wrap">
                                                    <div class="font-bold text-right w-full shadow-sm">{{ $functions[3] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="flex w-full">
                                            <p class="text-white px-1 bg-gray-600">The {{ $personality->strength }}</p>
                                        </div>
                                    </div>
                                </div>
                            </blockquote>
                        </div>
                    </div>
                </a>
            </div>
            <div>
                <p>{{ Str::limit($personality->description, 100) }}</p>
            </div>
        </div>
    <?php endforeach; ?>
</div>