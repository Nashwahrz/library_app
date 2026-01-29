<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Buku / Cerita
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6">

                <form method="POST" action="{{ route('writer.books.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-1">Judul Buku</label>
                        <input type="text" name="book_name" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Kategori</label>
                        <input type="text" name="category" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Sinopsis Cerita</label>
                        <textarea name="sinopsis" rows="6" class="w-full border rounded p-2" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Cover</label>
                        <input type="file" name="cover" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="w-full border rounded p-2" required>
                    </div>

                    <button class="px-4 py-2 bg-indigo-600 text-dark rounded hover:bg-indigo-700">
                        Simpan
                    </button>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
