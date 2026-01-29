<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 tracking-tight">
                    Edit <span class="text-indigo-600">Bab Cerita</span>
                </h2>
                <p class="text-xs text-slate-500 mt-1 uppercase tracking-widest font-semibold">
                    Buku: {{ $book->book_name }}
                </p>
            </div>
            <a href="{{ route('writer.books.edit', $book) }}" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Alert Error Sederhana --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-rose-50 border border-rose-100 rounded-xl">
                    <div class="flex items-center mb-2">
                        <svg class="w-4 h-4 text-rose-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm font-black text-rose-800 uppercase tracking-tight">Periksa Kembali:</span>
                    </div>
                    <ul class="text-xs text-rose-600 font-medium list-disc ml-6 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-10">
                <form method="POST" action="{{ route('writer.chapters.update', [$book, $chapter]) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Judul Bab --}}
                    <div>
                        <label class="block text-[11px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">
                            Judul Bab
                        </label>
                        <input type="text"
                               name="title"
                               value="{{ old('title', $chapter->title) }}"
                               class="w-full px-4 py-3 bg-gray-50 border-none ring-1 ring-gray-200 rounded-xl font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all shadow-sm"
                               required>
                    </div>

                    {{-- Isi Bab --}}
                    <div>
                        <label class="block text-[11px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">
                            Isi Cerita
                        </label>
                        <textarea name="content"
                                  rows="15"
                                  class="w-full px-4 py-4 bg-gray-50 border-none ring-1 ring-gray-200 rounded-xl text-gray-700 leading-relaxed focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all shadow-sm resize-none"
                                  required>{{ old('content', $chapter->content) }}</textarea>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="pt-6 border-t border-gray-50 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest italic">Penyuntingan Terakhir: {{ $chapter->updated_at->diffForHumans() }}</p>

                        <div class="flex items-center gap-3 w-full sm:w-auto">
                            <a href="{{ route('writer.books.edit', $book) }}"
                               class="w-full sm:w-auto text-center px-6 py-3 bg-white border border-gray-200 text-gray-400 text-sm font-bold rounded-xl hover:bg-gray-50 transition shadow-sm">
                                Batal
                            </a>
                            <button type="submit"
                                    class="w-full sm:w-auto px-8 py-3 bg-indigo-600 text-white text-sm font-black uppercase tracking-widest rounded-xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all active:scale-95">
                                Perbarui Cerita
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
