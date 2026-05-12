<nav class="bg-white/10 backdrop-blur-xl border-b border-white/20 relative z-[1000]">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between text-white">

        <!-- LEFT SIDE -->
        <div class="flex items-center gap-10">

            <!-- LOGO -->
            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
                class="text-2xl font-bold tracking-tight">
                Los<span class="text-pink-400">Found</span>
            </a>

            <!-- NAV LINKS -->
            <div class="hidden md:flex items-center gap-6 text-sm">

                <a href="{{ route('dashboard') }}"
                    class="no-underline {{ request()->routeIs('dashboard') ? 'font-semibold text-white' : 'text-white/70 hover:text-white' }}">
                    Home
                </a>

                <a href="{{ route('report.lostitem') }}"
                    class="no-underline {{ request()->routeIs('report.lostitem') ? 'font-semibold text-white' : 'text-white/70 hover:text-white' }}">
                    Lost Item
                </a>

                <a href="{{ route('report.founditem') }}"
                    class="no-underline {{ request()->routeIs('report.founditem') ? 'font-semibold text-white' : 'text-white/70 hover:text-white' }}">
                    Found Item                    
                </a>

                <a href="{{ route('item.my_item') }}"
                    class="no-underline {{ request()->routeIs('item.my_item') ? 'font-semibold text-white' : 'text-white/70 hover:text-white' }}">
                    My Items                   
                </a>
                
                <!-- <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"> 
                <x-nav-link :href="route('item.my_item')" :active="request()->routeIs('item.my_item')"> 
                {{ __('My Items') }} 
                </x-nav-link> 
                </div>                  -->

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.usermanagement') }}" class="text-white/70 hover:text-white">
                        Users
                    </a>

                    <a href="{{ route('admin.postmanagement') }}" class="text-white/70 hover:text-white">
                        Posts
                    </a>

                    <a href="{{ route('admin.requests') }}" class="text-white/70 hover:text-white">
                        Requests
                    </a>
                @endif

            </div>
        </div>

        <!-- RIGHT SIDE (DROPDOWN) -->
        <div x-data="{ open: false }" class="relative">

            <button @click="open = !open" class="flex items-center gap-2 px-4 py-2 rounded-xl
                bg-white/10 border border-white/20
                hover:bg-white/20 transition">

                {{ Auth::user()->name }}

                <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- DROPDOWN -->
            <div x-show="open" @click.outside="open = false" x-transition.origin.top.right class="absolute right-0 mt-3 w-44 
    bg-white/10 backdrop-blur-2xl border border-white/20
    rounded-xl shadow-xl z-[9999] overflow-hidden">

                <!-- PROFILE -->
                <a href="{{ route('profile.index') }}"
                    class="block px-4 py-3 text-sm hover:bg-white/10 transition no-underline">
                    Profile
                </a>

                <!-- DIVIDER -->
                <div class="border-t border-white/20"></div>

                <!-- CHANGE ACCOUNT -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <input type="hidden" name="change_account" value="1">

                    <button type="submit" class="w-full text-left px-4 py-3 text-sm
            hover:bg-yellow-500/20 transition text-yellow-300">
                        Change Account
                    </button>
                </form>

                <!-- LOGOUT -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="w-full text-left px-4 py-3 text-sm
            hover:bg-red-500/20 transition text-red-300">
                        Logout
                    </button>
                </form>

            </div>
        </div>

    </div>

</nav>