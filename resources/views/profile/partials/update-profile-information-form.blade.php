<section class="bg-white rounded-3xl border border-slate-100 p-8 shadow-sm">
    <header class="mb-8 border-b border-slate-50 pb-6">
        <h2 class="text-xl font-black text-[#0f172a] tracking-tight flex items-center gap-2">
            <span class="p-2 bg-indigo-50 text-indigo-600 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </span>
            Detail Profil
        </h2>
        <p class="mt-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            Perbarui informasi dasar akun Anda di sini
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        {{-- Nama --}}
        <div>
            <label class="block text-[11px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Nama Lengkap</label>
            <input id="name" name="name" type="text"
                   value="{{ old('name', $user->name) }}"
                   class="w-full px-4 py-3 bg-gray-50 border-none ring-1 ring-gray-200 rounded-xl font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all shadow-sm"
                   required autofocus autocomplete="name">
            <x-input-error class="mt-2 text-xs font-bold" :messages="$errors->get('name')" />
        </div>

        {{-- Email --}}
        <div>
            <label class="block text-[11px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Alamat Email</label>
            <input id="email" name="email" type="email"
                   value="{{ old('email', $user->email) }}"
                   class="w-full px-4 py-3 bg-gray-50 border-none ring-1 ring-gray-200 rounded-xl font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all shadow-sm"
                   required autocomplete="username">
            <x-input-error class="mt-2 text-xs font-bold" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-amber-50 rounded-xl border border-amber-100">
                    <p class="text-[11px] font-bold text-amber-700 uppercase tracking-tight">
                        Email Anda belum terverifikasi.
                        <button form="send-verification" class="ml-2 underline hover:text-amber-900 transition">
                            Klik di sini untuk kirim ulang.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-black text-[10px] text-emerald-600 uppercase">
                            ✓ Link verifikasi baru telah dikirim!
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Footer & Button --}}
        <div class="flex items-center gap-4 pt-4 border-t border-slate-50">
            <button type="submit"
                    class="px-8 py-3 bg-[#0f172a] text-white text-xs font-black uppercase tracking-widest rounded-xl shadow-lg shadow-slate-200 hover:bg-indigo-600 hover:-translate-y-0.5 transition-all active:scale-95">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }"
                     x-show="show"
                     x-transition
                     x-init="setTimeout(() => show = false, 3000)"
                     class="flex items-center gap-2 text-emerald-600 font-black text-[10px] uppercase tracking-widest">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    Berhasil Disimpan
                </div>
            @endif
        </div>
    </form>
</section>
