<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-[#0f172a]">
            📖 {{ $book->book_name }}
        </h2>
        <p class="text-sm text-slate-500">
              ⏳ Sisa {{ floor($pinjam->berakhir_pada->diffInRealDays(now())) }} hari
        </p>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] min-h-screen">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow border p-6">

            <h3 class="font-bold text-lg mb-4">
                Daftar Bab
            </h3>

            <ul class="space-y-3">
                @foreach ($chapters as $chapter)
                    <li class="flex justify-between items-center
                               p-4 border rounded-lg hover:bg-slate-50">

                        <div>
                            <p class="font-semibold">
                                Bab {{ $chapter->chapter_order }}
                            </p>
                            <p class="text-sm text-slate-500">
                                {{ $chapter->title }}
                            </p>
                        </div>

                        <a href="{{ route('reader.books.read.chapter', [$book, $chapter]) }}"
                           class="px-4 py-2 bg-[#0f172a] text-white rounded-lg text-sm font-bold">
                            Baca →
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>
    </div>
</x-app-layout>
