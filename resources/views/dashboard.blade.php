<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <h2 class="font-bold text-3xl text-[#0f172a] tracking-tight">
                    📚 Koleksi Perpustakaan
                </h2>
                <p class="text-slate-500 text-sm mt-1">
                    Temukan inspirasi dalam setiap lembaran cerita.
                </p>
            </div>

            <div class="flex items-center gap-4">
                <span class="hidden sm:inline-block text-xs font-bold text-[#0f172a] bg-slate-100 px-4 py-2 rounded-full border border-slate-200">
                    {{ $books->count() }} Judul Tersedia
                </span>

                <div class="relative group">
                    <input type="text" placeholder="Cari buku..."
                        class="w-full sm:w-72 pl-10 pr-4 py-2.5 text-sm rounded-xl border-slate-200 focus:border-[#0f172a] focus:ring-[#0f172a] transition-all bg-white shadow-sm">
                    <svg class="w-4 h-4 absolute left-3.5 top-3.5 text-slate-400 group-focus-within:text-[#0f172a] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#f8fafc] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($books->count())
                {{-- PERBAIKAN 1: Menambah jumlah kolom grid agar card mengecil --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-5">

                    @foreach ($books as $book)
                        {{-- PERBAIKAN 2: Menghapus max-w-sm dan menggantinya dengan max-w-[200px] agar konsisten kecil --}}
                        <div class="group bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-slate-200 flex flex-col h-full overflow-hidden transform hover:-translate-y-1 w-full max-w-[220px] mx-auto">

                            {{-- Cover Section (Dibuat lebih compact) --}}
                            <div class="relative aspect-[2/3] overflow-hidden bg-slate-100">
                                @if($book->cover)
                                    <img src="{{ asset('storage/'.$book->cover) }}"
                                         class="w-full h-full object-cover transform group-hover:scale-105 transition-all duration-500"
                                         loading="lazy">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 p-4">
                                        <svg class="w-10 h-10 mb-1 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                        <span class="text-[8px] font-bold uppercase tracking-widest text-center">No Cover</span>
                                    </div>
                                @endif

                                {{-- Overlay Badge (Dikecilkan) --}}
                                <div class="absolute top-2 left-2">
                                    <span class="bg-[#0f172a]/80 backdrop-blur-sm text-white text-[8px] font-bold px-2 py-0.5 rounded shadow-sm uppercase tracking-tighter">
                                        {{ $book->category }}
                                    </span>
                                </div>
                            </div>

                            {{-- Content Section (Padding dikecilkan) --}}
                            <div class="p-3 flex flex-col flex-grow">
                                <div class="mb-2">
                                    <div class="flex items-center gap-1 mb-1">
                                        <span class="text-[9px] font-bold text-slate-400 uppercase">{{ $book->tahun_terbit }}</span>
                                    </div>
                                    <h3 class="text-sm font-bold text-[#0f172a] leading-tight line-clamp-2 group-hover:text-blue-700 transition-colors">
                                        {{ $book->book_name }}
                                    </h3>
                                    <p class="text-[10px] text-slate-400 mt-1 truncate italic">Oleh: {{ $book->penulis }}</p>
                                </div>

                                {{-- Sinopsis disembunyikan di card kecil agar lebih rapi, atau dibuat sangat singkat --}}
                                <p class="text-[11px] text-slate-500 line-clamp-2 mb-3 leading-snug">
                                    {{ $book->sinopsis }}
                                </p>

                                <div class="mt-auto">
                                    <a href="#" class="inline-flex items-center justify-center w-full px-3 py-2 bg-[#0f172a] hover:bg-blue-800 text-white text-[10px] font-bold rounded-lg transition-all shadow-sm group/btn">
                                        Detail
                                        <svg class="w-3 h-3 ml-1 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            @else
                <div class="flex flex-col items-center justify-center py-32 bg-white rounded-[2rem] border border-dashed border-slate-200">
                    <h3 class="text-xl font-bold text-[#0f172a]">Belum Ada Cerita</h3>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
