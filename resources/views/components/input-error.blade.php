@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'mt-2 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <div class="flex items-center gap-2 px-3 py-2 rounded-xl bg-rose-50 border border-rose-100 text-rose-700 text-xs font-bold animate-shake">
                <svg class="w-4 h-4 shrink-0 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ $message }}</span>
            </div>
        @endforeach
    </div>
@endif
