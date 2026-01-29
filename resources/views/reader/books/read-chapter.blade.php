<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-[#0f172a]">
            {{ $book->book_name }}
        </h2>
        <p class="text-sm text-slate-500">
            {{ $chapter->title }}
        </p>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] min-h-screen">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow border p-8">

            <h1 class="text-2xl font-extrabold mb-6">
                Bab {{ $chapter->chapter_order }} — {{ $chapter->title }}
            </h1>

            <article class="prose max-w-none leading-relaxed text-slate-700">
                {!! nl2br(e($chapter->content)) !!}
            </article>

            <div class="mt-10 flex justify-between">
                <a href="{{ route('reader.books.read', $book) }}"
                   class="px-5 py-2 bg-slate-200 rounded-lg font-bold text-sm">
                    ← Daftar Bab
                </a>

           <span class="text-sm text-slate-500">
    ⏳ Sisa {{ floor($pinjam->berakhir_pada->diffInRealDays(now())) }} hari
</span>


            </div>

        </div>
    </div>
</x-app-layout>
