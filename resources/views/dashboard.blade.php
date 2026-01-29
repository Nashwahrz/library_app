<x-app-layout>
    <x-slot name="header">
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
    {{-- Input Pencarian Teks --}}
    <div class="relative w-full sm:w-80 group">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari judul, penulis..."
            class="w-full pl-12 pr-4 py-3 text-sm rounded-2xl border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-[#0f172a] transition-all bg-white shadow-sm placeholder-slate-400"
        >
        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-[#0f172a] transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
    </div>

    {{-- Dropdown Kategori --}}
    <select name="category" class="w-full sm:w-40 px-4 py-3 rounded-2xl border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-[#0f172a] bg-white shadow-sm text-sm placeholder-slate-400">
        <option value="">Semua Kategori</option>
        @foreach($categories as $category)
            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                {{ $category }}
            </option>
        @endforeach
    </select>

    {{-- Tombol Submit (Opsional, karena GET otomatis juga bisa) --}}
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
    </x-slot>

    <div class="py-12 bg-[#fcfdfe] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- 🔔 NOTIFIKASI VERIFIKASI (Merespons status 'pending' atau 'unverified') --}}
            @auth
                @php
                    $user = auth()->user();
                    $isPending = ($user->role === 'writer' || $user->is_writer) && (
                        (isset($user->status) && $user->status === 'pending') ||
                        (isset($user->is_verified) && !$user->is_verified) ||
                        (isset($user->verified_at) && is_null($user->verified_at))
                    );
                @endphp

                @if($isPending)
                    <div class="relative mb-12 overflow-hidden bg-white border border-amber-200 rounded-3xl shadow-sm ring-1 ring-black/5">
                        <div class="absolute left-0 top-0 w-2 h-full bg-amber-400"></div>
                        <div class="p-6 flex items-start gap-6">
                            <div class="hidden sm:flex w-12 h-12 bg-amber-50 rounded-2xl items-center justify-center border border-amber-200 shadow-inner">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                    <h3 class="text-lg font-black text-[#0f172a] tracking-tight">Menunggu Validasi Admin</h3>
                                    <span class="inline-flex items-center px-3 py-1 text-[10px] font-black uppercase tracking-[0.2em] rounded-lg bg-amber-100 text-amber-700 border border-amber-200">Processing</span>
                                </div>
                                <p class="mt-2 text-sm text-slate-500 leading-relaxed max-w-3xl">
                                    Halo, <strong>{{ $user->name }}</strong>. Akun Anda saat ini sedang dalam antrean verifikasi. Beberapa fitur seperti peminjaman buku dan akses baca penuh akan diaktifkan segera setelah tim admin menyetujui pendaftaran Anda.
                                </p>
                                <div class="mt-4 flex items-center gap-4">
                                    <div class="flex items-center gap-1.5">
                                        <span class="w-2 h-2 bg-amber-400 rounded-full animate-bounce"></span>
                                        <span class="w-2 h-2 bg-amber-400 rounded-full animate-bounce [animation-delay:-0.3s]"></span>
                                        <span class="w-2 h-2 bg-amber-400 rounded-full animate-bounce [animation-delay:-0.5s]"></span>
                                    </div>
                                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest italic">Biasanya diverifikasi dalam 1x24 jam</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth

            {{-- 📚 GRID KOLEKSI BUKU --}}
            @if($books->count())
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-x-6 gap-y-12">
                    @foreach ($books as $book)
                        <div class="group flex flex-col h-full">
                            {{-- Cover Card --}}
                            <div class="relative aspect-[2/3] overflow-hidden rounded-2xl shadow-xl shadow-slate-200 bg-slate-100 border border-slate-100 transition-all duration-500 group-hover:shadow-2xl group-hover:shadow-blue-900/10 group-hover:-translate-y-1">
                                @if($book->cover)
                                    <img src="{{ asset('storage/'.$book->cover) }}" class="w-full h-full object-cover" loading="lazy">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-300">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                @endif

                                {{-- Category Badge --}}
                                <div class="absolute top-3 left-3">
                                    <span class="backdrop-blur-md bg-white/80 text-[#0f172a] text-[9px] font-black px-2 py-1 rounded-md border border-white/50 shadow-sm uppercase tracking-tighter">
                                        {{ $book->category }}
                                    </span>
                                </div>
                            </div>

                            {{-- Info Section --}}
                            <div class="mt-5 flex flex-col flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest">{{ $book->tahun_terbit }}</span>
                                    <div class="h-px flex-1 bg-slate-100"></div>
                                </div>

                                <h3 class="text-[13px] font-black text-[#0f172a] leading-tight line-clamp-2 mb-1 group-hover:text-blue-700 transition-colors">
                                    {{ $book->book_name }}
                                </h3>

                                <p class="text-[11px] text-slate-400 font-medium mb-4">
                                    {{ $book->penulis }}
                                </p>

                                {{-- Button - Sekarang diletakkan di bawah --}}
                                <div class="mt-auto">
                                    <a href="{{ route('books.show', $book) }}" class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-white border border-slate-200 text-[#0f172a] text-[11px] font-extrabold rounded-xl transition-all shadow-sm hover:bg-[#0f172a] hover:text-white hover:border-[#0f172a] active:scale-[0.98]">
                                        Detail Buku
                                        <svg class="w-3.5 h-3.5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
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

        </div>
    </div>
</x-app-layout>
