@props(['value'])

<label {{ $attributes->merge(['class' => 'form-control form-control-lg']) }}>
    {{ $value ?? $slot }}
</label>
