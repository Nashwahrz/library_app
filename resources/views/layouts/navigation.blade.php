<nav x-data="{ open: false }" class="bg-white border-b border-slate-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                {{-- Logo --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <div class="p-2 bg-indigo-600 rounded-xl group-hover:rotate-6 transition-transform">
                            <x-application-logo class="block h-6 w-auto fill-current text-white" />
                        </div>
                        <span class="font-black text-xl tracking-tighter text-slate-800">MY<span class="text-indigo-600">BOOKS</span></span>
                    </a>
                </div>

                {{-- Desktop Menu --}}
                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex">
                    @if(auth()->user()->role === 'reader' || auth()->user()->role === 'writer')
                        {{-- Pinjaman Reader --}}
                        <x-nav-link :href="route('reader.pinjaman.index')" :active="request()->routeIs('reader.pinjaman.*')" class="text-sm font-bold tracking-tight">
                            Pinjaman Saya
                        </x-nav-link>

                        {{-- Kelola Buku Writer --}}
                        @if(auth()->user()->role === 'writer' && auth()->user()->status === 'active')
                            <x-nav-link :href="route('writer.books.index')" :active="request()->routeIs('writer.books.*')" class="text-sm font-bold tracking-tight">
                                Kelola Buku
                            </x-nav-link>
                        @endif

                    @elseif(auth()->user()->role === 'admin')
                        {{-- Admin hanya menu konfirmasi writers --}}
                        <x-nav-link :href="route('admin.writers')" :active="request()->routeIs('admin.writers.*')" class="text-sm font-bold tracking-tight">
                            Konfirmasi Writers
                        </x-nav-link>
                    @endif
                </div>
            </div>

            {{-- User Dropdown --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border-none text-sm leading-4 font-bold rounded-xl text-slate-600 hover:text-indigo-600 transition group">
                            <div class="flex items-center gap-3 bg-slate-50 px-4 py-2 rounded-2xl group-hover:bg-indigo-50 transition">
                                <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></div>
                                <div class="max-w-[100px] truncate">{{ Auth::user()->name }}</div>
                                <svg class="h-4 w-4 opacity-40 group-hover:translate-y-0.5 transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="p-2 space-y-1">
                            <div class="px-4 py-3 mb-1 border-b border-slate-50 text-[10px] text-slate-400 font-black uppercase tracking-[0.15em]">
                                Akun Saya
                            </div>

                            <x-dropdown-link :href="route('profile.edit')" class="rounded-xl font-bold text-slate-600 hover:bg-indigo-50 hover:text-indigo-600">
                                👤 Profil
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        class="rounded-xl font-bold text-rose-500 hover:bg-rose-50 hover:text-rose-600"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    🚪 Log Out
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Hamburger --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-xl text-slate-400 hover:bg-slate-100 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" d="M4 6h16M4 12h16M4 18h16" stroke-width="2.5" stroke-linecap="round" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" d="M6 18L18 6M6 6l12 12" stroke-width="2.5" stroke-linecap="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-slate-50">
        <div class="p-4 space-y-2">
            @if(auth()->user()->role === 'reader' || auth()->user()->role === 'writer')
                <x-responsive-nav-link :href="route('reader.pinjaman.index')" :active="request()->routeIs('reader.pinjaman.*')" class="rounded-xl font-bold">
                    Pinjaman Saya
                </x-responsive-nav-link>

                @if(auth()->user()->role === 'writer' && auth()->user()->status === 'active')
                    <x-responsive-nav-link :href="route('writer.books.index')" :active="request()->routeIs('writer.books.*')" class="rounded-xl font-bold">
                        Kelola Buku
                    </x-responsive-nav-link>
                @endif
            @elseif(auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.writers')" :active="request()->routeIs('admin.writers.*')" class="rounded-xl font-bold">
                    Konfirmasi Writers
                </x-responsive-nav-link>
            @endif
        </div>

        {{-- Mobile Profile --}}
        <div class="pt-4 pb-6 border-t border-slate-100 bg-slate-50/50">
            <div class="px-6 flex items-center mb-4">
                <div class="flex-shrink-0 bg-indigo-600 text-white w-12 h-12 rounded-2xl flex items-center justify-center font-black text-lg shadow-lg shadow-indigo-100">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="ms-4">
                    <div class="font-black text-slate-800 tracking-tight">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-xs text-slate-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="px-4 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-xl font-bold">
                    Profil
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            class="rounded-xl font-bold text-rose-600 hover:bg-rose-50"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
