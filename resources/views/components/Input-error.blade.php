@props(['messages'])

@if ($messages)
    <ul style="list-style-type: none; margin-bottom: 0.5rem; padding-bottom: 0px; padding-left: 1rem;" {{ $attributes->merge(['class' => 'text-danger ml-3']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
