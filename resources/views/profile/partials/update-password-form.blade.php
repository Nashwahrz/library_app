<section class="bg-white rounded-3xl border border-slate-100 p-8 shadow-sm">
    <header class="mb-8 border-b border-slate-50 pb-6">
        <h2 class="text-xl font-black text-[#0f172a] tracking-tight flex items-center gap-2">
            <span class="p-2 bg-rose-50 text-rose-600 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </span>
            Keamanan Akun
        </h2>
        <p class="mt-2 text-xs font-bold text-slate-400 uppercase tracking-widest leading-relaxed">
            Pastikan akun Anda menggunakan kata sandi yang kuat untuk tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        {{-- Password Saat Ini --}}
        <div>
            <label class="block text-[11px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Kata Sandi Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" 
                   class="w-full px-4 py-3 bg-gray-50 border-none ring-1 ring-gray-200 rounded-xl font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all shadow-sm"
                   autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-xs font-bold text-rose-500" />
        </div>

        {{-- Password Baru --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[11px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Kata Sandi Baru</label>
                <input id="update_password_password" name="password" type="password" 
                       class="w-full px-4 py-3 bg-gray-50 border-none ring-1 ring-gray-200 rounded-xl font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all shadow-sm"
                       autocomplete="new-password">
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-xs font-bold text-rose-500" />
            </div>

            <div>
                <label class="block text-[11px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Konfirmasi Kata Sandi</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                       class="w-full px-4 py-3 bg-gray-50 border-none ring-1 ring-gray-200 rounded-xl font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all shadow-sm"
                       autocomplete="new-password">
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-xs font-bold text-rose-500" />
            </div>
        </div>

        {{-- Footer & Action --}}
        <div class="flex items-center gap-4 pt-4 border-t border-slate-50">
            <button type="submit" 
                    class="px-8 py-3 bg-[#0f172a] text-white text-xs font-black uppercase tracking-widest rounded-xl shadow-lg shadow-slate-200 hover:bg-indigo-600 hover:-translate-y-0.5 transition-all active:scale-95">
                Perbarui Password
            </button>

            @if (session('status') === 'password-updated')
                <div x-data="{ show: true }"
                     x-show="show"
                     x-transition
                     x-init="setTimeout(() => show = false, 3000)"
                     class="flex items-center gap-2 text-emerald-600 font-black text-[10px] uppercase tracking-widest">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    Password Diperbarui
                </div>
            @endif
        </div>
    </form>
</section>