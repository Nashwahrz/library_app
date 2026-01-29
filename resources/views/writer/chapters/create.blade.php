<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            ✍️ Tambah Bab – {{ $book->book_name }}
        </h2>
    </x-slot>

    <div class="p-6 max-w-3xl bg-white rounded shadow">
        <form method="POST"
              action="{{ route('writer.chapters.store', $book) }}">
            @csrf

            <div class="mb-4">
                <label class="block font-medium mb-1">Judul Bab</label>
                <input type="text"
                       name="title"
                       class="w-full border rounded p-2"
                       required>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Isi Bab</label>
                <textarea name="content"
                          rows="8"
                          class="w-full border rounded p-2"
                          required></textarea>
            </div>

            <button class="px-4 py-2 bg-emerald-600
                           hover:bg-emerald-700 text-white rounded">
                Simpan Bab
            </button>
        </form>
    </div>
</x-app-layout>
