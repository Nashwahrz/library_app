<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-end">
            <div>
                <h2 class="font-black text-3xl text-[#0f172a] tracking-tight">
                    Pinjaman <span class="text-indigo-600 italic font-serif">Saya.</span>
                </h2>
                <p class="text-xs text-slate-500 mt-1 uppercase tracking-widest font-semibold">
                    Daftar bacaan aktif dan riwayat pinjaman
                </p>
            </div>
            <div class="hidden md:block text-right">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Total Koleksi</span>
                <p class="text-xl font-black text-slate-800 leading-none">{{ $pinjams->count() }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($pinjams->count())
                <div class="grid gap-4">
                    @foreach ($pinjams as $pinjam)
                        <div class="group bg-white rounded-3xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-all flex flex-col sm:flex-row items-center gap-6">

                            {{-- Preview Cover --}}
                            <div class="relative flex-shrink-0">
                                <div class="w-24 h-32 bg-slate-100 rounded-2xl overflow-hidden shadow-sm">
                                    @if($pinjam->book->cover)
                                        <img src="{{ asset('storage/'.$pinjam->book->cover) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300 italic text-[10px]">No Cover</div>
                                    @endif
                                </div>
                                {{-- Badge Status di atas Foto --}}
                                <div class="absolute -top-2 -right-2">
                                    @if($pinjam->status === 'aktif')
                                        <span class="flex h-5 w-5">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-5 w-5 bg-emerald-500 border-2 border-white"></span>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Info Buku --}}
                            <div class="flex-1 text-center sm:text-left">
                                <span class="text-[10px] font-black text-indigo-500 uppercase tracking-widest">{{ $pinjam->book->category }}</span>
                                <h3 class="font-black text-xl text-[#0f172a] leading-tight mb-1">
                                    {{ $pinjam->book->book_name }}
                                </h3>
                                <p class="text-sm text-slate-500 font-medium italic mb-3">
                                    Oleh: {{ $pinjam->book->penulis }}
                                </p>

                                <div class="flex flex-wrap justify-center sm:justify-start items-center gap-4 text-[11px] font-bold uppercase tracking-tighter">
                                    <div class="flex items-center text-slate-400">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        Berakhir: <span class="ml-1 text-slate-600">{{ $pinjam->berakhir_pada->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex items-center {{ $pinjam->status === 'aktif' ? 'text-emerald-600' : 'text-rose-500' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $pinjam->status === 'aktif' ? 'bg-emerald-500' : 'bg-rose-500' }} mr-1.5"></span>
                                        {{ $pinjam->status === 'aktif' ? 'Akses Aktif' : 'Akses Berakhir' }}
                                    </div>
                                </div>
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="w-full sm:w-auto">
                                @if($pinjam->status === 'aktif')
                                    <a href="{{ route('reader.books.read', $pinjam->book) }}"
                                       class="flex items-center justify-center gap-2 px-8 py-3 bg-[#0f172a] text-white text-xs font-black uppercase tracking-widest rounded-2xl hover:bg-indigo-600 hover:-translate-y-1 transition-all active:scale-95 shadow-lg shadow-indigo-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        Mulai Baca
                                    </a>
                                @else
                                    <button disabled
                                       class="w-full sm:w-auto flex items-center justify-center gap-2 px-8 py-3 bg-gray-100 text-gray-400 text-xs font-black uppercase tracking-widest rounded-2xl cursor-not-allowed">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                        Terkunci
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Empty State --}}
                <div class="bg-white rounded-[3rem] border border-dashed border-gray-200 p-20 text-center">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <h3 class="text-xl font-black text-[#0f172a] tracking-tight">Rak Buku Kosong</h3>
                    <p class="text-slate-400 mt-2 max-w-xs mx-auto text-sm">Anda belum meminjam buku apa pun. Yuk, cari bacaan menarik di katalog!</p>
                    <a href="{{ route('dashboard') }}" class="inline-block mt-8 px-8 py-3 bg-indigo-600 text-white text-xs font-black uppercase tracking-widest rounded-2xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                        Jelajahi Katalog
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
