<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-centinela-acento text-white text-sm font-medium px-4 py-2 rounded-md hover:opacity-90 uppercase tracking-wide']) }}>
    {{ $slot }}
</button>