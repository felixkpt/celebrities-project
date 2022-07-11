<?php
$nav_items = [
    'Home' => '', 'Posts' => 'posts', 'Birthdays' => 'birthdays', 'People' => 'people',
    'About' => 'pages/about-us'
]
?>
<nav id="primary-nav" class="sticky top-0 z-50 py-2 shadow">
    <div class="px-2 mx-auto flex flex-wrap items-center justify-between">
        <a href="{{ url('') }}" class="flex">
            <img style="background-color: #f8f6f8;border-radius: 5%;padding: 1px 4px;" src="{{ url('logo.png') }}" alt="{{ \SiteInfo::name() }} logo">
        </a>
        <button data-collapse-toggle="mobile-menu" type="button" class="md:hidden ml-3 text-gray-300 hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-300 rounded-lg inline-flex items-center justify-center" aria-controls="mobile-menu-2" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg width="24" height="24">
                <path d="M5 6h14M5 12h14M5 18h14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
            </svg>
        </button>

        <div class="hidden md:block w-full md:w-auto" id="mobile-menu">
            <ul class="flex-col md:flex-row flex md:space-x-8 mt-4 md:mt-0 md:text-sm md:font-medium">
                @foreach($nav_items as $label => $uri)
                <li class="m-none md:m-auto">
                    <a href="{{ url($uri) }}" class="nav-link">{{ $label }}</a>
                </li>
                @endforeach
                <li class="mt-2 md:m-auto">
                    @if(!Auth::user())
                    <a class="inline-block text-sm px-4 py-1 rounded border transition ease-in-out duration-700 text-white border-white bg-blue-600 hover:border-transparent hover:bg-blue-700" href="{{ route('register') }}">Register</a>
                    <a class="inline-block text-sm px-4 py-1 rounded border transition ease-in-out duration-700 text-white border-white bg-gray-500 hover:border-transparent hover:bg-gray-700" href="{{ route('login') }}">Login</a>
                    @else
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="text-gray-300 hover:bg-gray-50 border-b border-gray-100 md:hover:bg-transparent md:border-0 pl-3 pr-4 py-2 md:hover:text-teal-500 md:p-0 font-medium flex items-center justify-between w-full md:w-auto">Account </button>
                    <div id="dropdownNavbar" class="hidden bg-white text-base z-10 list-none divide-y divide-gray-100 rounded shadow my-4 w-44" data-popper-placement="bottom" data-popper-reference-hidden="" data-popper-escaped="" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 10px);">
                        <ul class="py-1" aria-labelledby="dropdownLargeButton">
                            @if (Auth::user()->hasRole('Admin'))
                            <li>
                                <a href="{{ route('admin.index') }}" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Dashboard</a>
                            </li>
                            @endif
                            <li>
                                <a href="#" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Settings</a>
                            </li>
                        </ul>
                        <div class="py-1 w-full">
                            <form class="block" action="{{ route('logout') }}" method="post">
                                <button class="w-full text-left text-sm bg-gray-200 font-medium hover:bg-gray-300 text-gray-700 hover:text-gray-500 block px-4 py-2">Logout</buttion>
                                    @csrf
                            </form>
                        </div>
                    </div>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>