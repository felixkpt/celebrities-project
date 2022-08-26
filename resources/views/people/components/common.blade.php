<div class="flex flex-col md:flex-row">
    <div class="flex bg-fuchsia-50 w-full md:w-1/2 justify-between pl-1 rounded-tl rounded-bl">
        <div class="flex flex-wrap overflow-hidden">
            <div class="w-full pt-1">
                <a href="{{ url('countries/'.Str::slug($person->country)) }}" data-toggle="tooltip" title="{{ $person->country }}"><img class="w-8 h-8 rounded-full" style="width: 30px; height:30px" src="{{ asset('images/countries/flags/'.strtolower($person->country_code).'.png') }}"></a>
            </div>
            @if (\Route::current()->getName() == 'people.person')
            <div class="truncate mt-auto">
                <a class="link-secondary" href="{{ url('countries/'.Str::slug($person->country)) }}">{{ $person->country }}</a>
            </div>
            @endif
        </div>
        <div class="flex flex-wrap overflow-hidden">
            <div class="font-medium text-right md:text-left w-full">Born</div>
            <div class="w-full md:w-auto text-right md:text-left truncate mt-auto">
                <a class="link-secondary" href="{{ url('birthdays/month/'.date('m', strtotime($person->dob)).'/day/'.date('d', strtotime($person->dob))) }}">{{ date('M jS', strtotime($person->dob)) }}</a>
            </div>
        </div>
    </div>
    <div class="flex bg-fuchsia-50 w-full md:w-1/2 justify-between pr-1 rounded-tr rounded-br">
        <div class="flex flex-wrap overflow-hidden">
            <div class="font-medium w-full text-left">MBTI</div>
            <div class="text-sky-500 truncate mt-auto">
                <a class="link-secondary" href="{{ url('mbti/'.strtolower($person->typology)) }}">{{ $person->typology }}</a>
            </div>
        </div>
        <div class="flex flex-wrap overflow-hidden">
            <div class="font-medium text-right w-full">Enneagram</div>
            <div class="w-full text-right truncate mt-auto">
                <a class="link-secondary" href="{{ url('enneagrams/'.Str::slug($person->enneagram)) }}">{{ $person->enneagram }}</a>
            </div>
        </div>
    </div>
</div>