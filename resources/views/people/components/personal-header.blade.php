<figure style="background: radial-gradient(#eae5eb99, #0000000a);" class="w-full h-full lg:flex bg-fuchsia-50 rounded-xl overflow-hidden pt-8 pb-2">

    <div class="md:h-4/5 md:w-1/4 overflow-hidden m-auto">
        <div class="w-48 h-44 m-auto">
            <img style="min-height: 100px!important" class="h-full mx-auto rounded-lg md:rounded" src="{{ asset( $person->image) }}" alt="">
        </div>
        <div class="m-auto pt-1">
            @include('/components/social-media-links')
        </div>
    </div>
    <div class="pt-6 md:p-4 lg:w-3/4 text-center md:text-left space-y-4">
        <blockquote>
            @include('/people/components/common')
        </blockquote>
        <figcaption class="font-medium">
            <div>
                <h1 class="text-3xl">{{ $person->first_name.' '.$person->last_name }}</h1>
            </div>
            <div class="text-slate-700 dark:text-slate-500">
                <a href="{{ url('professional/'.$person->professional->slug) }}">{{ $person->professional->name }}</a>
            </div>
            <div class="text-yellow-400 text-xl">
                <a href="{{ url('birthdays/year/'.date('Y', strtotime($person->dob)).'/month/'.date('m', strtotime($person->dob)).'/day/'.date('d', strtotime($person->dob))) }}">Born {{ date('Y, F, jS', strtotime($person->dob)) }}</a>
            </div>
        </figcaption>
    </div>
</figure>