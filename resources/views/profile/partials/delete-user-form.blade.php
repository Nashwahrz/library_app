<section class="bg-white rounded-3xl border border-rose-100 p-8 shadow-sm">
    <header class="mb-6">
        <h2 class="text-xl font-black text-rose-600 tracking-tight flex items-center gap-2">
            <span class="p-2 bg-rose-50 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </span>
            Hapus Akun
        </h2>
        <p class="mt-3 text-sm text-slate-500 leading-relaxed font-medium">
            Setelah akun Anda dihapus, semua data dan sumber daya di dalamnya akan dihapus secara permanen. Mohon unduh data yang ingin Anda simpan sebelum melanjutkan.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-6 py-3 bg-rose-50 text-rose-600 text-xs font-black uppercase tracking-widest rounded-xl hover:bg-rose-600 hover:text-white transition-all active:scale-95"
    >
        {{ __('Hapus Akun Saya') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-xl font-black text-[#0f172a] tracking-tight">
                Apakah Anda yakin?
            </h2>

            <p class="mt-3 text-sm text-slate-500 font-medium">
                Tindakan ini tidak dapat dibatalkan. Masukkan kata sandi Anda untuk mengonfirmasi penghapusan akun secara permanen.
            </p>

            <div class="mt-6">
                <label for="password" class="block text-[11px] font-black uppercase tracking-widest text-gray-400 mb-2">Konfirmasi Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full px-4 py-3 bg-gray-50 border-none ring-1 ring-gray-200 rounded-xl font-bold text-gray-800 focus:ring-2 focus:ring-rose-500 focus:bg-white transition-all"
                    placeholder="Masukkan password Anda"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-xs font-bold text-rose-500" />
            </div>

            <div class="mt-8 flex flex-col sm:flex-row justify-end gap-3">
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="px-6 py-3 bg-white border border-slate-200 text-slate-400 text-xs font-black uppercase tracking-widest rounded-xl hover:bg-slate-50 transition"
                >
                    {{ __('Batal') }}
                </button>

                <button
                    type="submit"
                    class="px-6 py-3 bg-rose-600 text-white text-xs font-black uppercase tracking-widest rounded-xl shadow-lg shadow-rose-100 hover:bg-rose-700 transition-all active:scale-95"
                >
                    {{ __('Ya, Hapus Akun') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
