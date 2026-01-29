<nav x-data="{ open: false }" class="bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-18 py-1">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-[#0f172a]" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-slate-600 hover:text-[#0f172a] font-medium">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    {{-- Menu Kelola Buku untuk Writer --}}
                    @if(auth()->user()->role === 'writer' && auth()->user()->status === 'active')
                        <x-nav-link :href="route('writer.books.index')" :active="request()->routeIs('writer.books.*')" class="text-slate-600 hover:text-[#0f172a] font-medium">
                            📚 {{ __('Kelola Buku') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-slate-100 text-sm leading-4 font-semibold rounded-xl text-slate-600 bg-slate-50 hover:bg-slate-100 hover:text-[#0f172a] focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center">
                                <div class="w-2 h-2 rounded-full bg-emerald-500 me-2"></div>
                                {{ Auth::user()->name }}
                            </div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4 opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-slate-50 text-xs text-slate-400 font-bold uppercase tracking-widest">
                            Akun Saya
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="hover:bg-slate-50">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    class="text-red-600 hover:bg-red-50"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-400 hover:text-[#0f172a] hover:bg-slate-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-slate-50 border-t border-slate-100">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(auth()->user()->role === 'writer' && auth()->user()->status === 'active')
                <x-responsive-nav-link :href="route('writer.books.index')" :active="request()->routeIs('writer.books.*')">
                    📚 {{ __('Kelola Buku') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-slate-200">
            <div class="px-4 flex items-center">
                <div class="flex-shrink-0 bg-[#0f172a] text-white w-10 h-10 rounded-full flex items-center justify-center font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="ms-3">
                    <div class="font-bold text-base text-[#0f172a]">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            class="text-red-600"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
