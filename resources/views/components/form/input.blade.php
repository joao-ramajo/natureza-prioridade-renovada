      <div class="form-input  {{ $class }}">
          <label for="email" class="form-input__label">{{ $label }}</label>
          <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="form-input__input"
              placeholder="{{ $placeholder }}" value="{{ $value }}" {{ $attributes }}>

          <div class="text-danger mt-1 form-input__error">
              @error($name)
                  {{ $message }}
              @else
                  <span class="opacity-0">generico</span>
              @enderror
          </div>
          @if ($type == 'password' && $name === 'password')
              <x-form.show-pass />
          @endif

      </div>
