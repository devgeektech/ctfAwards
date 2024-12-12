<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-lg btn-primary btn-lg w-100 mt-3 mb-0']) }}>
    {{ $slot }}
</button>
