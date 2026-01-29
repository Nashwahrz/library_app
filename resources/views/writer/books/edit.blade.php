<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <nav class="flex mb-2 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">
                    <a href="{{ route('writer.books.index') }}" class="hover:text-[#0f172a]">Koleksi Saya</a>
                    <span class="mx-2">/</span>
                    <span class="text-[#0f172a]">Manajemen Buku</span>
                </nav>
                <h2 class="font-black text-3xl text-[#0f172a] tracking-tight">
                    Edit <span class="text-blue-600 italic font-serif">Karya.</span>
                </h2>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('writer.books.index') }}" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-red-600 transition-colors">
                    Batal
                </a>
                <button form="update-book-form" class="px-6 py-2.5 bg-[#0f172a] text-white text-sm font-black uppercase tracking-widest rounded-xl shadow-lg shadow-blue-900/20 hover:-translate-y-1 transition-all">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#fcfdfe] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                {{-- LEFT SIDE: MANAJEMEN BAB --}}
                <div class="lg:col-span-5 space-y-6">
                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                            <h3 class="font-black text-[#0f172a] uppercase text-xs tracking-[0.15em]">Struktur Bab</h3>
                            <a href="{{ route('writer.chapters.create', $book) }}" class="inline-flex items-center text-xs font-bold text-blue-600 hover:text-blue-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                Tambah Bab
                            </a>
                        </div>

                        <div class="p-6">
                            @if ($book->chapters->count())
                                <div class="space-y-3">
                                    @foreach ($book->chapters as $chapter)
                                        <div class="group flex items-center justify-between p-4 bg-white border border-slate-100 rounded-2xl hover:border-blue-200 hover:shadow-md hover:shadow-blue-900/5 transition-all">
                                            <div class="flex-1 min-w-0 mr-4">
                                                <div class="flex items-center gap-2 mb-0.5">
                                                    <span class="text-[10px] font-black text-slate-300 uppercase tracking-tighter">Bab {{ $chapter->chapter_order }}</span>
                                                    <div class="h-px w-4 bg-slate-100"></div>
                                                </div>
                                                <h4 class="text-sm font-bold text-[#0f172a] truncate">{{ $chapter->title }}</h4>
                                            </div>

                                            <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <a href="{{ route('writer.chapters.edit', [$book, $chapter]) }}" class="p-2 text-slate-400 hover:text-amber-500 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                                </a>
                                                <form method="POST" action="{{ route('writer.chapters.destroy', [$book, $chapter]) }}" onsubmit="return confirm('Hapus bab ini?')">
                                                    @csrf @method('DELETE')
                                                    <button class="p-2 text-slate-400 hover:text-red-500 transition-colors">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-10 px-6 border-2 border-dashed border-slate-100 rounded-[2rem]">
                                    <p class="text-sm text-slate-400 font-medium italic">Belum ada bab yang dibuat.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- RIGHT SIDE: FORM EDIT BUKU --}}
                <div class="lg:col-span-7">
                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8 sm:p-10">
                        <h3 class="font-black text-[#0f172a] uppercase text-xs tracking-[0.15em] mb-8 pb-4 border-b border-slate-50">Informasi Dasar</h3>

                        @if ($errors->any())
                            <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl">
                                <ul class="text-xs text-red-600 font-bold space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>• {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form id="update-book-form" method="POST" action="{{ route('writer.books.update', $book) }}" enctype="multipart/form-data" class="space-y-6">
                            @csrf @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Judul Buku</label>
                                        <input type="text" name="book_name" value="{{ old('book_name', $book->book_name) }}" class="w-full px-5 py-3.5 bg-slate-50 border-none ring-1 ring-slate-200 rounded-2xl text-sm font-bold focus:ring-2 focus:ring-[#0f172a] transition-all">
                                    </div>

                                    <div>
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Kategori</label>
                                        <select name="category" class="w-full px-5 py-3.5 bg-slate-50 border-none ring-1 ring-slate-200 rounded-2xl text-sm font-bold focus:ring-2 focus:ring-[#0f172a] transition-all">
                                            @foreach (['Fiksi','Non-Fiksi','Pendidikan','Teknologi','Sejarah','Agama','Novel','Komik'] as $kategori)
                                                <option value="{{ $kategori }}" {{ old('category', $book->category) == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Tahun Terbit</label>
                                        <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $book->tahun_terbit) }}" class="w-full px-5 py-3.5 bg-slate-50 border-none ring-1 ring-slate-200 rounded-2xl text-sm font-bold focus:ring-2 focus:ring-[#0f172a] transition-all">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Cover Saat Ini</label>
                                    <div class="relative group aspect-[3/4] rounded-[1.5rem] overflow-hidden bg-slate-100 border border-slate-200">
                                        @if ($book->cover)
                                            <img src="{{ asset('storage/'.$book->cover) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-300 italic text-xs uppercase font-black">No Cover</div>
                                        @endif
                                        <div class="absolute inset-0 bg-[#0f172a]/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center p-4">
                                            <input type="file" name="cover" class="absolute inset-0 opacity-0 cursor-pointer">
                                            <svg class="w-8 h-8 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                            <span class="text-[10px] text-white font-black uppercase tracking-widest">Ganti Cover</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Sinopsis Cerita</label>
                                <textarea name="sinopsis" rows="6" class="w-full px-5 py-4 bg-slate-50 border-none ring-1 ring-slate-200 rounded-[1.5rem] text-sm leading-relaxed focus:ring-2 focus:ring-[#0f172a] transition-all resize-none">{{ old('sinopsis', $book->sinopsis) }}</textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
