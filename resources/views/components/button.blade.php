@props(['type' => 'submit'])

<button {{ $attributes->merge(['class' => 'cg-btn cg-btn-'.$type]) }}>{{ $slot }}</button>