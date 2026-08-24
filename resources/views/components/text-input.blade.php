@props(['disabled' => false])

<input @disabled($disabled) {!! $attributes->merge(['class' => 'w-full bg-centinela-fondo border border-white/10 rounded-md px-3 py-2 text-centinela-texto placeholder-centinela-texto-secondary focus:outline-none focus:border-centinela-acento']) !!}>