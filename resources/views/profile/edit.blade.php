<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-black text-3xl text-[#0f172a] tracking-tight">
                    Pengaturan <span class="text-indigo-600 italic font-serif">Profil.</span>
                </h2>
                <p class="text-xs text-slate-500 mt-1 uppercase tracking-widest font-semibold">
                    Kelola identitas dan keamanan akun Anda
                </p>
            </div>
            <div class="hidden md:block">
                <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-black text-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="text-left">
                        <p class="text-[10px] font-black text-slate-400 uppercase leading-none mb-1">Login Sebagai</p>
                        <p class="text-xs font-bold text-slate-700 leading-none">{{ Auth::user()->role }}</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#f8fafc] min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{--Update Informasi Profil --}}
            <div class="transition-all duration-300 hover:translate-y-[-2px]">
                @include('profile.partials.update-profile-information-form')
            </div>

            {{--Update Password --}}
            <div class="transition-all duration-300 hover:translate-y-[-2px]">
                @include('profile.partials.update-password-form')
            </div>

            {{--Hapus Akun --}}
            <div class="transition-all duration-300 hover:translate-y-[-2px] opacity-90 hover:opacity-100">
                @include('profile.partials.delete-user-form')
            </div>

            {{-- Footer Info --}}
            <div class="text-center pt-6">
                <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em]">
                    Terdaftar sejak {{ Auth::user()->created_at->format('M Y') }}
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
