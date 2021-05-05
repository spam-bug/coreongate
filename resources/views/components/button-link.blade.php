@props(['type' => 'primary'])

<a {{ $attributes->merge(['class' => 'cg-btn-link cg-btn-link-'.$type]) }}>{{ $slot }}</a>