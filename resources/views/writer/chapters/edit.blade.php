<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Edit Bab
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <div class="bg-white shadow rounded p-6">

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
                  action="{{ route('writer.chapters.update', [$book, $chapter]) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-medium mb-1">Judul Bab</label>
                    <input type="text"
                           name="title"
                           value="{{ old('title', $chapter->title) }}"
                           class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Isi Cerita</label>
                    <textarea name="content"
                              rows="10"
                              class="w-full border rounded px-3 py-2">{{ old('content', $chapter->content) }}</textarea>
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ route('writer.chapters.show', [$book, $chapter]) }}"
                       class="px-4 py-2 bg-gray-500 text-white rounded">
                        Batal
                    </a>

                    <button
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Perbarui Cerita
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
