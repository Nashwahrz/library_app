<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 tracking-tight">
                    Tulis <span class="text-indigo-600">Bab Baru</span>
                </h2>
                <p class="text-xs text-slate-500 mt-1 uppercase tracking-widest font-semibold">
                    Buku: {{ $book->book_name }}
                </p>
            </div>
            <a href="{{ url()->previous() }}" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <form method="POST" action="{{ route('writer.chapters.store', $book) }}" class="space-y-6">
                    @csrf

                    {{-- Judul Bab --}}
                    <div>
                        <label class="block text-[11px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">
                            Judul Bab
                        </label>
                        <input type="text"
                               name="title"
                               placeholder="Masukkan judul bab..."
                               class="w-full px-4 py-3 bg-gray-50 border-none ring-1 ring-gray-200 rounded-xl font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all shadow-sm"
                               required>
                    </div>

                    {{-- Isi Bab --}}
                    <div>
                        <label class="block text-[11px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">
                            Konten Cerita
                        </label>
                        <textarea name="content"
                                  rows="12"
                                  placeholder="Mulai menulis cerita Anda di sini..."
                                  class="w-full px-4 py-4 bg-gray-50 border-none ring-1 ring-gray-200 rounded-xl text-gray-700 leading-relaxed focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all shadow-sm resize-none"
                                  required></textarea>
                    </div>

                    {{-- Tombol --}}
                    <div class="pt-4 flex items-center justify-between">
                        <p class="text-[11px] text-slate-400 italic">Draf Anda akan langsung tersimpan setelah tombol diklik.</p>
                        <button type="submit"
                                class="px-8 py-3 bg-indigo-600 text-white text-sm font-black uppercase tracking-widest rounded-xl shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all active:scale-95">
                            Simpan Bab
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
