<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-800 tracking-tight">
                Buku <span class="text-indigo-600">Saya</span>
            </h2>
            <a href="{{ route('writer.books.create') }}"
               class="px-5 py-2 bg-indigo-600 text-white text-sm font-bold rounded-lg hover:bg-indigo-700 transition shadow-sm">
                + Tambah Buku
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 text-sm font-bold rounded-xl border border-emerald-100">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-gray-400">Judul & Kategori</th>
                            <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-gray-400 text-center">Tahun</th>
                            <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-gray-400 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($books as $book)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        @if($book->cover)
                                            <img src="{{ asset('storage/'.$book->cover) }}" class="w-10 h-14 object-cover rounded shadow-sm">
                                        @else
                                            <div class="w-10 h-14 bg-gray-100 rounded flex items-center justify-center text-gray-300 text-[10px] font-bold">NO</div>
                                        @endif
                                        <div>
                                            <div class="font-bold text-gray-900 leading-none mb-1">{{ $book->book_name }}</div>
                                            <span class="text-[10px] font-bold text-indigo-500 uppercase tracking-tighter">{{ $book->category }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-center text-sm font-medium text-gray-500">
                                    {{ $book->tahun_terbit }}
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex justify-end items-center gap-3">
                                        <a href="{{ route('writer.books.edit', $book) }}" class="text-sm font-bold text-gray-400 hover:text-amber-500 transition">
                                            Edit
                                        </a>
                                        <span class="text-gray-200">|</span>
                                        <form method="POST" action="{{ route('writer.books.destroy', $book) }}" onsubmit="return confirm('Hapus buku?')">
                                            @csrf @method('DELETE')
                                            <button class="text-sm font-bold text-gray-400 hover:text-rose-500 transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-16 text-center text-gray-400 italic text-sm">
                                    Belum ada karya yang tersimpan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
