<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Buku
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6">

                {{-- Section Bab --}}
<div class="mb-6 border-b pb-4">
    <div class="flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-800">
            📚 Bab Buku
        </h3>

        <a href="{{ route('writer.chapters.create', $book) }}"
           class="px-4 py-2 bg-emerald-600 text-white rounded
                  hover:bg-emerald-700">
            + Tambah Bab
        </a>
    </div>
</div>

@if ($book->chapters->count())
    <div class="mb-8">
        <ul class="space-y-3">
            @foreach ($book->chapters as $chapter)
                <li class="flex justify-between items-center
                           border rounded p-3 bg-gray-50">
                    <div>
                        <p class="font-medium text-gray-800">
                            Bab {{ $chapter->chapter_order }} :
                            {{ $chapter->title }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ Str::limit(strip_tags($chapter->content), 80) }}
                        </p>
                    </div>

                    <div class="flex gap-2">
                        {{-- nanti bisa kita isi --}}
                        <span class="text-xs text-gray-400">
                            {{ $chapter->created_at->format('d M Y') }}
                        </span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@else
    <div class="mb-8 p-4 bg-yellow-50 text-yellow-700 rounded">
        Belum ada bab untuk buku ini.
    </div>
@endif


                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                      action="{{ route('writer.books.update', $book) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Judul --}}
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Judul Buku</label>
                        <input type="text"
                               name="book_name"
                               value="{{ old('book_name', $book->book_name) }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Kategori</label>
                        <input type="text"
                               name="category"
                               value="{{ old('category', $book->category) }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    {{-- Sinopsis --}}
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Sinopsis</label>
                        <textarea name="sinopsis"
                                  rows="5"
                                  class="w-full border rounded px-3 py-2">{{ old('sinopsis', $book->sinopsis) }}</textarea>
                    </div>

                    {{-- Tahun Terbit --}}
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Tahun Terbit</label>
                        <input type="number"
                               name="tahun_terbit"
                               value="{{ old('tahun_terbit', $book->tahun_terbit) }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    {{-- Cover --}}
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Cover Buku</label>

                        @if ($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}"
                                 class="h-32 mb-2 rounded shadow">
                        @endif

                        <input type="file" name="cover">
                        <p class="text-sm text-gray-500 mt-1">
                            Kosongkan jika tidak ingin mengganti cover
                        </p>
                    </div>

                    {{-- Button --}}
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('writer.books.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Batal
                        </a>

                        <button
                            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Update Buku
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
