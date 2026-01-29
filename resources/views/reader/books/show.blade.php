<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-[#0f172a]">
            📖 Detail Buku
        </h2>
    </x-slot>

    <div class="py-12 bg-[#f8fafc] min-h-screen">
        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-10">

            {{-- COVER --}}
            <div class="md:col-span-1">
                <div class="bg-white rounded-2xl shadow border overflow-hidden">
                    @if($book->cover)
                        <img src="{{ asset('storage/'.$book->cover) }}"
                             class="w-full object-cover aspect-[2/3]">
                    @else
                        <div class="aspect-[2/3] flex items-center justify-center text-slate-300">
                            No Cover
                        </div>
                    @endif
                </div>
            </div>

            {{-- DETAIL --}}
            <div class="md:col-span-2 bg-white rounded-2xl shadow border p-8">

                <span class="inline-block mb-2 text-xs font-bold px-3 py-1 rounded-full bg-slate-100">
                    {{ $book->category }}
                </span>

                <h1 class="text-3xl font-extrabold text-[#0f172a] mt-2">
                    {{ $book->book_name }}
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    ✍️ {{ $book->penulis }} • {{ $book->tahun_terbit }}
                </p>

                <hr class="my-6">

                <h3 class="font-bold text-lg mb-2">📌 Sinopsis</h3>
                <p class="text-slate-600 leading-relaxed">
                    {{ $book->sinopsis }}
                </p>

                <hr class="my-6">

                {{-- STATUS PINJAM --}}
               @auth
    @if($pinjam && $pinjam->isActive())
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-4">
            <p class="text-green-700 font-semibold">
                ✅ Buku sedang dipinjam
            </p>
            <p class="text-sm text-green-600">
               Sisa {{ ceil($pinjam->sisaHari()) }} hari
            </p>
        </div>

        <a href="{{ route('reader.books.read', $book) }}"
           class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl">
            📖 Baca Buku
        </a>
    @else
        <form method="POST" action="{{ route('reader.pinjam.store', $book) }}">
            @csrf
            <button class="px-6 py-3 bg-[#0f172a] hover:bg-blue-800 text-white font-bold rounded-xl">
                📚 Pinjam Buku (3 Hari)
            </button>
        </form>
    @endif
@else
    <a href="{{ route('login') }}"
       class="px-6 py-3 bg-slate-800 text-white font-bold rounded-xl">
        Login untuk meminjam
    </a>
@endauth

            </div>
        </div>
    </div>
</x-app-layout>
