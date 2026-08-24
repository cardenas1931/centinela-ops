<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-transparent border border-white/20 rounded-md font-semibold text-xs text-centinela-texto-secundario uppercase tracking-widest hover:border-white/40 hover:text-centinela-texto focus:outline-none disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>