      <div class="form-input">
          <label for="email" class="form-input__label">{{ $label }}</label>
          <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="form-input__input"
              placeholder="{{ $placeholder }}" value="{{ $value }}" {{ $attributes }}>
          @if ($type == 'password')
              <x-form.show-pass />
          @endif
          <div class="text-danger mt-2">
              @error($name)
                  {{ $message }}
              @else
                  <span class="opacity-0">generico</span>
              @enderror
          </div>

      </div>
