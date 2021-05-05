@props(['label'])

<div class="cg-textfield">
    <label>{{ $label }}</label>
    <input {{ $attributes }}>
    @error($attributes['name']) <span class="error">{{ $message }}</span> @enderror
</div>