<?php 
$nav_items = ['User Roles' => 'admin/users/roles', 'Posts' => 'admin/posts',]
?>
<nav id="primary-nav" class="sticky top-0 z-50 bg-gray-800 py-2">
    <div class="px-2 mx-auto flex flex-wrap items-center justify-between">
                <button data-collapse-toggle="left-nav-menu" aria-controls="left-nav-menu" aria-expanded="false" type="button" class="lg:hidden text-slate-500 hover:text-slate-600 dark:text-slate-400 dark:hover:text-slate-300">
            <span class="sr-only">Navigation</span>
            <svg width="24" height="24"><path d="M5 6h14M5 12h14M5 18h14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path></svg>
        </button>
        
        <a href="{{ url('') }}" class="flex">
            <span class="self-center text-lg font-semibold whitespace-nowrap text-gray-300 md:text-gray-400 hover:text-gray-200">{{ \SiteInfo::name() }}</span>
        </a>
        <button data-collapse-toggle="mobile-menu" type="button" class="md:hidden ml-3 text-gray-400 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300 rounded-lg inline-flex items-center justify-center" aria-controls="mobile-menu-2" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg width="24" height="24"><path d="M5 6h14M5 12h14M5 18h14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path></svg>
        </button>
        
        <div class="hidden md:block w-full md:w-auto" id="mobile-menu">
            <ul class="flex-col md:flex-row flex md:space-x-8 mt-4 md:mt-0 md:text-sm md:font-medium">
                @foreach($nav_items as $label => $uri)
                <li class="m-none md:m-auto">
                    <a href="{{ url($uri) }}" class="link text-gray-400 hover:bg-gray-50 border-b border-gray-100 md:hover:bg-transparent md:border-0 block pl-3 pr-4 py-2 md:hover:text-gray-100 md:p-0">{{ $label }}</a>
                </li> 
                @endforeach
                <li class="mt-2 md:m-auto">
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="text-gray-400 hover:bg-gray-50 border-b border-gray-100 md:hover:bg-transparent md:border-0 pl-3 pr-4 py-2 md:hover:text-teal-500 md:p-0 font-medium flex items-center justify-between w-full md:w-auto">Account </button>
                    <div id="dropdownNavbar" class="hidden bg-white text-base z-10 list-none divide-y divide-gray-100 rounded shadow my-4 w-44" data-popper-placement="bottom" data-popper-reference-hidden="" data-popper-escaped="" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 10px);">
                        <ul class="py-1" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="{{ route('admin.users.show', Auth::user()->id) }}" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">My Account</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.index') }}" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">Users</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.roles.index') }}" class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2">User roles</a>
                            </li>
                        </ul>
                        <div class="py-1 w-full">
                            <form class="block" action="{{ route('logout') }}" method="post">
                                <button class="w-full text-left text-sm bg-gray-200 font-medium hover:bg-gray-300 text-gray-700 hover:text-gray-500 block px-4 py-2">Logout</buttion>
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
