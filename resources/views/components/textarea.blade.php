@props(['label', 'value'])

<div class="cg-textarea">
    <label>{{ $label }}</label>
    <textarea {{ $attributes }}>
        @if($value) {{ $value }} @endif
    </textarea>
    @error($attributes['name']) <span class="error">{{ $message }}</span> @enderror
</div>