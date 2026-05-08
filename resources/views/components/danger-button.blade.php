<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn inline-flex items-center justify-center rounded-xl px-4 py-2.5 text-sm font-semibold text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 transition']) }}>
    {{ $slot }}
</button>
