<div class="mb-3 {{ $class }}">
    @if ($label)
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        class="form-control @error($name) is-invalid @enderror" value="{{ old($name, $value) }}" {{ $rules }}>

    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
