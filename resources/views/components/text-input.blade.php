@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-slate-300 bg-white text-slate-900 focus:border-[#0f172a] focus:ring-[#0f172a] rounded-xl shadow-sm placeholder-slate-400 transition-all']) !!}>
