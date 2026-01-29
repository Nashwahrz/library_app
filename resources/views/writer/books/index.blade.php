<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            📚 Buku Saya
        </h2>
    </x-slot>

    <div class="p-6 bg-white rounded-lg shadow-sm">

        <a href="{{ route('writer.books.create') }}"
           class="inline-block px-4 py-2 mb-4 bg-emerald-600
                  hover:bg-emerald-700 text-white rounded transition">
            + Tambah Buku
        </a>

        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-emerald-100 text-emerald-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 text-sm">
                <thead>
                    <tr class="bg-gray-50 text-gray-700">
                        <th class="p-3 text-left">Judul</th>
                        <th class="p-3 text-left">Kategori</th>
                        <th class="p-3 text-center">Tahun</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($books as $book)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 font-medium text-gray-800">
                                {{ $book->book_name }}
                            </td>

                            <td class="p-3 text-gray-600">
                                {{ $book->category }}
                            </td>

                            <td class="p-3 text-center text-gray-600">
                                {{ $book->tahun_terbit }}
                            </td>

                            <td class="p-3 flex justify-center gap-2">
                                <a href="{{ route('writer.books.edit', $book) }}"
                                   class="px-3 py-1 bg-amber-500
                                          hover:bg-amber-600 text-white rounded">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('writer.books.destroy', $book) }}"
                                      onsubmit="return confirm('Yakin hapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="px-3 py-1 bg-rose-600
                                               hover:bg-rose-700 text-white rounded">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">
                                Belum ada buku yang dibuat
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
