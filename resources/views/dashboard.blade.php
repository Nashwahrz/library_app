<x-app-layout>
    <x-slot name="header">
        @if(!auth()->user()->role === 'admin')
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-6 pb-2">
            <div>
                <nav class="flex mb-3 text-xs font-semibold uppercase tracking-widest text-slate-400">
                    <span class="hover:text-[#0f172a] cursor-pointer">Perpustakaan Digital</span>
                    <span class="mx-2">/</span>
                    <span class="text-[#0f172a]">Katalog</span>
                </nav>
                <h2 class="font-extrabold text-4xl text-[#0f172a] tracking-tight leading-none">
                    Eksplorasi <span class="text-blue-600 italic font-serif">Koleksi.</span>
                </h2>
                <p class="text-slate-500 text-sm mt-3 max-w-md leading-relaxed">
                    Akses ribuan literatur digital. Temukan referensi terbaik untuk mendukung riset dan hobi membaca Anda.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
                {{-- Fitur Pencarian --}}
                <form method="GET" action="{{ route('dashboard') }}" class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                    {{-- Input & Kategori --}}
                    <div class="relative w-full sm:w-80 group">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul, penulis..."
                            class="w-full pl-12 pr-4 py-3 text-sm rounded-2xl border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-[#0f172a] transition-all bg-white shadow-sm placeholder-slate-400">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-[#0f172a] transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>

                    <select name="category" class="w-full sm:w-40 px-4 py-3 rounded-2xl border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-[#0f172a] bg-white shadow-sm text-sm placeholder-slate-400">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="px-5 py-3 bg-[#0f172a] text-white rounded-2xl shadow-lg hover:bg-blue-700 transition-all font-semibold text-sm">
                        Cari
                    </button>
                </form>

                <div class="flex items-center gap-2 px-5 py-3 bg-[#0f172a] text-white rounded-2xl shadow-lg shadow-blue-900/20">
                    <span class="text-xs font-black uppercase tracking-tighter">{{ $books->count() }}</span>
                    <span class="text-[10px] font-medium opacity-80 uppercase tracking-widest">Judul</span>
                </div>
            </div>
        </div>
        @endif
    </x-slot>

    {{-- Konten Utama --}}
    <div class="py-12 bg-[#fcfdfe] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(!auth()->user()->role === 'admin')
      
                @if($books->count())
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-x-6 gap-y-12">
                        @foreach ($books as $book)
                            {{-- Card buku --}}
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-40 bg-white rounded-[3rem] border border-dashed border-slate-200 shadow-inner">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-300 italic tracking-tighter uppercase">No Results Found</h3>
                        <p class="text-sm text-slate-400 mt-1">Coba gunakan kata kunci pencarian yang berbeda.</p>
                    </div>
                @endif
            @else

                <div class="text-center py-40">
                    <h2 class="text-2xl font-black text-slate-700">Admin Dashboard</h2>
                    <p class="text-sm text-slate-500 mt-2">Silakan akses menu <a href="{{ route('admin.writers') }}" class="text-indigo-600 font-bold underline">Konfirmasi Writers</a>.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
