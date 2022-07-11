<blockquote>
    <div class="flex flex-nowrap">
        <div class="flex bg-fuchsia-50 w-1/2 justify-around pl-1 rounded-tl rounded-bl">
            <div class="flex flex-wrap bg-fuchsia-50">
                <div class="font-bold text-left w-full text-6xl text-red-600 shadow-sm">
                    {{ $functions[0] }}
                </div>
                <div class="text-sky-500 hidden sm:block">
                    {{ $map[$functions[0]] }}
                </div>
            </div>
            <div class="flex flex-wrap bg-fuchsia-50">
                <div class="font-bold text-center w-full text-6xl text-red-600 shadow-sm">{{ $functions[1] }}</div>
                <div class="w-full text-sky-500 text-center hidden sm:block">{{ $map[$functions[1]] }}</div>
            </div>
        </div>
        <div class="flex bg-fuchsia-50 w-1/2 justify-around pr-1 rounded-tr rounded-br">
            <div class="flex flex-wrap bg-fuchsia-50">
                <div class="font-bold w-full text-center text-6xl text-red-600 shadow-sm">{{ $functions[2] }}</div>
                <div class="w-full text-sky-500 text-center hidden sm:block">{{ $map[$functions[2]] }}</div>
            </div>
            <div class="flex flex-wrap bg-fuchsia-50">
                <div class="font-bold text-right w-full text-6xl text-red-600 shadow-sm">{{ $functions[3] }}</div>
                <div class="w-full text-sky-500 text-right hidden sm:block">{{ $map[$functions[3]] }}</div>
            </div>
        </div>
    </div>
    <p class="text-lg font-medium overflow-hidden">
        <?php echo substr(strip_tags($personality->description), 0, 200) ?>
    </p>
</blockquote>