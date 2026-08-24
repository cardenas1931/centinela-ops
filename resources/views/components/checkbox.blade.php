@props(['disabled' => false])

<input @disabled($disabled) type="checkbox" {{ $attributes->merge(['class' => 'rounded border-white/20 bg-centinela-fondo text-centinela-acento focus:ring-centinela-acento']) }}>