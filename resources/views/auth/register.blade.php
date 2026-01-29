<x-guest-layout>
    <div class="mb-10 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-50 rounded-2xl mb-4 border border-slate-100 shadow-sm">
            <span class="text-3xl">✍️</span>
        </div>
        <h2 class="text-2xl font-extrabold text-[#0f172a] tracking-tight">Buat Akun Baru</h2>
        <p class="text-slate-500 mt-2 text-sm">Lengkapi data di bawah untuk mulai menjelajah.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-5">
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-slate-700 font-bold mb-1 ml-1" />
            <x-text-input id="name"
                class="block w-full px-4 py-3 bg-white border-slate-300 text-slate-900 focus:ring-2 focus:ring-[#0f172a]/10 focus:border-[#0f172a] rounded-xl transition-all placeholder-slate-400 shadow-none"
                type="text" name="name" :value="old('name')" required autofocus
                placeholder="Nama sesuai identitas..." />
            <x-input-error :messages="$errors->get('name')" class="mt-1 ml-1" />
        </div>

        <div class="mb-5">
            <x-input-label for="email" :value="__('Alamat Email')" class="text-slate-700 font-bold mb-1 ml-1" />
            <x-text-input id="email"
                class="block w-full px-4 py-3 bg-white border-slate-300 text-slate-900 focus:ring-2 focus:ring-[#0f172a]/10 focus:border-[#0f172a] rounded-xl transition-all placeholder-slate-400 shadow-none"
                type="email" name="email" :value="old('email')" required
                placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1 ml-1" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-bold mb-1 ml-1" />
                <x-text-input id="password"
                    class="block w-full px-4 py-3 bg-white border-slate-300 text-slate-900 focus:ring-2 focus:ring-[#0f172a]/10 focus:border-[#0f172a] rounded-xl transition-all shadow-none"
                    type="password" name="password" required
                    placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-1 ml-1" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Ulangi Password')" class="text-slate-700 font-bold mb-1 ml-1" />
                <x-text-input id="password_confirmation"
                    class="block w-full px-4 py-3 bg-white border-slate-300 text-slate-900 focus:ring-2 focus:ring-[#0f172a]/10 focus:border-[#0f172a] rounded-xl transition-all shadow-none"
                    type="password" name="password_confirmation" required
                    placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 ml-1" />
            </div>
        </div>

        <div class="relative overflow-hidden bg-white border-2 border-[#0f172a]/10 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow mb-8 group">
            <div class="absolute -right-4 -bottom-4 text-slate-100 opacity-20 group-hover:scale-110 transition-transform">
                <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M21.707 13.293l-5-5a.999.999 0 00-1.414 0l-1 1L11.586 6.586a.999.999 0 00-1.414 0l-8 8a.999.999 0 000 1.414l5 5a.999.999 0 001.414 0l1-1 2.707 2.707a.999.999 0 001.414 0l8-8a.999.999 0 000-1.414z"/></svg>
            </div>

            <div class="flex items-start relative z-10">
                <div class="flex items-center h-6">
                    <input id="is_writer" type="checkbox" name="is_writer" value="1"
                           class="w-6 h-6 rounded-lg border-slate-300 text-[#0f172a] focus:ring-[#0f172a] transition-all cursor-pointer">
                </div>
                <div class="ms-4">
                    <label for="is_writer" class="font-extrabold text-[#0f172a] text-lg cursor-pointer flex items-center gap-2">
                        Daftar sebagai Penulis
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-[#0f172a] text-white uppercase tracking-wider">Penting</span>
                    </label>
                    <p class="text-slate-600 mt-2 text-sm leading-relaxed">
                        Centang ini jika Anda ingin memiliki akses untuk mengirimkan buku atau karya tulis ke perpustakaan.
                    </p>
                    <div class="mt-3 flex items-center gap-2 text-amber-600">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-xs font-bold italic">Akun akan ditinjau oleh Admin terlebih dahulu.</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <x-primary-button class="w-full justify-center py-4 bg-[#0f172a] hover:bg-[#1e293b] text-white text-sm font-bold rounded-2xl shadow-xl shadow-slate-200 transition-all hover:-translate-y-0.5 active:translate-y-0">
                {{ __('Daftar Sekarang') }}
            </x-primary-button>

            <p class="text-center text-sm text-slate-500 font-medium">
                Sudah punya akun?
                <a class="text-[#0f172a] font-bold hover:underline underline-offset-4" href="{{ route('login') }}">
                    Masuk di sini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
