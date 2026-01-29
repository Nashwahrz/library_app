<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Konfirmasi Penulis
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded p-6">
                <table class="w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border">Nama</th>
                            <th class="p-2 border">Email</th>
                            <th class="p-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($writers as $writer)
                            <tr>
                                <td class="p-2 border">{{ $writer->name }}</td>
                                <td class="p-2 border">{{ $writer->email }}</td>
                                <td class="p-2 border">
                                    <form method="POST"
                                          action="{{ route('admin.writers.approve', $writer) }}">
                                        @csrf
                                        @method('PATCH')
                    <button
                          class="px-3 py-1.5 bg-blue-600 text-white text-sm rounded
                           hover:bg-blue-700 shadow-md">
                            ✔ Setujui
                    </button>

                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center p-4">
                                    Tidak ada penulis menunggu konfirmasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
