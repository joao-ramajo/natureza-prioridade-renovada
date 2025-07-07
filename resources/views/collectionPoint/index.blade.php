@extends('layouts.main_layout')

@section('content')
    <x-form.form method="POST" route="collection_point.store" title="Novo ponto de coleta" btnLabel="Cadastrar">
        <x-alerts.alert />

        <x-form.input-field label="" type="hidden" name="user_id" value="{{ Auth::user()->id }}" />


        {{-- address info --}}
        <h5 class="mb-3">Informações do Endereço</h5>
        <x-form.input-field label="Nome do Ponto" type="text" name="name" value="{{ old('name') }}" />
        <div class="row mx-auto">
            <x-form.input-field label="cep" type="text" name="cep" value="{{ old('cep') }}"
                rules=" required maxlength=9 " class="col col-6 px-0 pe-2" />
            <x-form.input-field label="Estado" type="text" name="state" value="{{ old('state') }}"
                class="col col-6 px-0 ps-2" />
        </div>
        <div id="cepMessage" class="alert alert-warning d-none "></div>
        <div class="row mx-auto">
            <x-form.input-field label="Rua" type="text" name="street" value="{{ old('street') }}"
                class="col col-6 px-0 pe-2" />
            <x-form.input-field label="Complemento" type="text" name="complement" value="{{ old('complement') }}"
                class="col col-6 px-0 ps-2" />
        </div>
        <div class="row mx-auto">
            <x-form.input-field label="Bairro" type="text" name="neighborhood" value="{{ old('neighborhood') }}"
                class="col col-6 px-0 pe-2" />
            <x-form.input-field label="Cidade" type="text" name="city" value="{{ old('city') }}"
                class="col col-6 px-0 ps-2" />
        </div>

        <hr>
        <div class="mb-3">
            <h5 class="mb-3">Tipo de coleta</h5>
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-md-4 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="categories-id[]" value="{{ $category->id }}"
                                id="category-{{ $category->id }}" class="form-check-input"
                                @if (is_array(old('categories-id')) && in_array($category->id, old('categories-id'))) checked @endif>
                            <label for="category-{{ $category->id }}" class="form-check-label">
                                {{ $category->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <hr>
        <div class="mb-3">
            <h5 class="mb-3">Horario de Funcionamento</h5>


            @php
                $days = [
                    'Seg' => 'Segunda-feira',
                    'Ter' => 'Terça-feira',
                    'Qua' => 'Quarta-feira',
                    'Qui' => 'Quinta-feira',
                    'Sex' => 'Sexta-feira',
                    'Sab' => 'Sábado',
                    'Dom' => 'Domingo',
                ];
            @endphp

            <h5>Dias da semana</h5>
            <div class="row">
                @foreach ($days as $abbr => $day)
                    <div class="col col-md-4 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="days_open[]" value="{{ $abbr }}"
                                id="day_{{ strtolower($abbr) }}" class="form-check-input"
                                @if (is_array(old('days_open')) && in_array($abbr, old('days_open'))) checked @endif>
                            <label for="day_{{ strtolower($abbr) }}" class="form-check-label">{{ $day }}</label>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mb-3">
                <h5>Horário de Funcionamento</h5>
                <div class="row">
                    <div class="col col-2">
                        <x-form.input-field label="Abre as" type="text" name="open_from" value="{{ old('open_from') }}"
                            rules="required max=9999 min=1000 placeholder=00:00 pattern=\d{2}:\d{2}" />
                    </div>
                    <div class="col col-2">
                        <x-form.input-field label="Fecha as" type="text" name="open_to" value="{{ old('open_to') }}"
                            rules="required max=9999 min=1000 placeholder=00:00 pattern=\d{2}:\d{2}" />
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="description" name="description"
                        style="height: 100px">{{ old('description') }}</textarea>
                    <label for="floatingTextarea2">Descrição</label>
                </div>
            </div>
        </div>

        </div>


    </x-form.form>


    <script type="module" src="{{ asset('assets/js/masks/cep.js') }}"></script>
    <script type="module" src="{{ asset('assets/js/masks/hour.js') }}"></script>
@endsection
