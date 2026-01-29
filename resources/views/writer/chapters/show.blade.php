<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            {{ $chapter->title }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded p-6">
            <div class="prose max-w-none whitespace-pre-line">
                {{ $chapter->content }}
            </div>

            <div class="flex justify-end mt-6 gap-2">
                <a href="{{ route('writer.books.edit', $book) }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded">
                    Kembali
                </a>

                <a href="{{ route('writer.chapters.edit', [$book, $chapter]) }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded">
                    Perbarui Cerita
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
