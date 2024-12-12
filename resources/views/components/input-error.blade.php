@props(['messages'])

@if ($messages)
    <span {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1 px-2 text-danger']) }}>
        @foreach ((array) $messages as $message)
            {{ $message }}
        @endforeach
    </span>
@endif
