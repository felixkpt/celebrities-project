<div class="flex flex-wrap justify-center w-full rounded-lg pt-2">
    <?php foreach($people as $key =>  $person): ?>
        <div class="flex w-full md:w-1/2 p-1">
            <figure style="background: radial-gradient(#00000029, transparent);" class="w-full h-full lg:flex bg-slate-50 rounded-xl overflow-hidden">
                <div class="lg:w-1/4 lg:h-auto w-32 h-32 overflow-hidden lg:rounded-none rounded-full mx-auto">
                    <a class="text-2xl" href="{{ url('people/'.$person->id.'/'.Str::slug($person->first_name.' '.$person->last_name, '-')) }}">
                        <img class="img-fadein lg:rounded-none rounded-full mx-auto" src="{{ asset($person->image) }}" alt="" width="384" height="512">
                    </a>
                </div>
                <div class="pt-6 lg:p-1 lg:py-3 bg-fuchsia-50 lg:bg-none lg:w-3/4 text-center lg:text-left space-y-4">
                    <blockquote>
                        @include('/people/components/common')
                    </blockquote>
                    <figcaption class="font-medium">
                        <div>
                            <a class="link-default text-2xl" href="{{ url('people/'.$person->id.'/'.Str::slug($person->first_name.' '.$person->last_name, '-')) }}">{{ $person->first_name.' '.$person->last_name }}</a>
                        </div>
                        <div class="text-slate-700 dark:text-slate-500 truncate">
                            <a href="{{ url('professional/'.$person->professional->slug) }}">{{ $person->professional->name }}</a>
                        </div>
                    </figcaption>
                </div>
            </figure>
        </div>
    <?php endforeach; ?>
    @include('/components/pagination')
</div>
