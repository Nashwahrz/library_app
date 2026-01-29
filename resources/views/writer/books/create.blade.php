<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 tracking-tight">
                    Daftarkan <span class="text-indigo-600">Karya Baru</span>
                </h2>
                <p class="text-xs text-slate-500 mt-1 uppercase tracking-widest font-semibold">
                    Lengkapi detail informasi buku Anda
                </p>
            </div>
            <a href="{{ url()->previous() }}" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <form method="POST" action="{{ route('writer.books.store') }}" enctype="multipart/form-data" class="p-8 md:p-10">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-10">

                        {{-- Kiri: Cover dengan Preview --}}
                        <div class="md:col-span-4">
                            <label class="block text-[11px] font-black uppercase tracking-widest text-gray-400 mb-3 ml-1">
                                Cover Buku
                            </label>

                            <div class="relative group aspect-[2/3] w-full bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 flex flex-col items-center justify-center overflow-hidden hover:border-indigo-400 hover:bg-indigo-50/30 transition-all">

                                {{-- Preview Image (Akan muncul di sini) --}}
                                <img id="cover-preview" class="absolute inset-0 w-full h-full object-cover hidden" src="#" alt="Preview">

                                {{-- Placeholder (Akan hilang jika ada foto) --}}
                                <div id="placeholder-content" class="flex flex-col items-center">
                                    <svg class="w-10 h-10 text-gray-300 group-hover:text-indigo-400 mb-3 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase text-center px-4">Pilih Gambar Cover</p>
                                </div>

                                <input type="file" name="cover" id="cover-input" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*" onchange="previewImage(this)">
                            </div>
                            <p class="mt-3 text-[10px] text-gray-400 italic">Format: JPG, PNG (Rasio 2:3)</p>
                        </div>

                        {{-- Kanan: Detail --}}
                        <div class="md:col-span-8 space-y-6">
                            <div>
                                <label class="block text-[11px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Judul Buku</label>
                                <input type="text" name="book_name" placeholder="Contoh: Sang Pemimpi"
                                    class="w-full px-4 py-3 bg-gray-50 border-none ring-1 ring-gray-200 rounded-xl font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all shadow-sm" required>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[11px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Kategori</label>
                                    <select name="category" class="w-full px-4 py-3 bg-gray-50 border-none ring-1 ring-gray-200 rounded-xl font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all shadow-sm cursor-pointer" required>
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        <option value="Fiksi">Fiksi</option>
                                        <option value="Non-Fiksi">Non-Fiksi</option>
                                        {{-- <option value="Novel">Novel</option> --}}
                                        <option value="Pendidikan">Pendidikan</option>
                                        <option value="Teknologi">Teknologi</option>
                                        <option value="Sejarah">Sejarah</option>
                                        <option value="Agama">Agama</option>
                                        <option value="Novel">Novel</option>
                                        <option value="Komik">Komik</option>
                                        </select>
                                </div>
                                <div>
                                    <label class="block text-[11px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Tahun Terbit</label>
                                    <input type="number" name="tahun_terbit" placeholder="2026"
                                        class="w-full px-4 py-3 bg-gray-50 border-none ring-1 ring-gray-200 rounded-xl font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all shadow-sm" required>
                                </div>
                            </div>

                            <div>
                                <label class="block text-[11px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Sinopsis</label>
                                <textarea name="sinopsis" rows="5" placeholder="Tuliskan ringkasan cerita..."
                                    class="w-full px-4 py-3 bg-gray-50 border-none ring-1 ring-gray-200 rounded-xl text-gray-700 leading-relaxed focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all shadow-sm resize-none" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 pt-6 border-t border-gray-100 flex items-center justify-end">
                        <button type="submit" class="px-10 py-3 bg-indigo-600 text-white text-sm font-black uppercase tracking-widest rounded-xl shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all active:scale-95">
                            Simpan Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script JavaScript untuk Preview --}}
    <script>
        function previewImage(input) {
            const preview = document.getElementById('cover-preview');
            const placeholder = document.getElementById('placeholder-content');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>
