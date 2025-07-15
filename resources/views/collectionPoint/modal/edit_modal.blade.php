<!-- Botão para abrir o modal -->
<button class="col-3 btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#editCollectionPointModal">
    <i class="bi bi-pencil-square me-1"></i> Editar 
</button>

{{-- <a href="#" class="col-3 btn btn-outline-info">Editar</a> --}}

<!-- Modal de Edição do Ponto de Coleta -->
<div class="modal fade" id="editCollectionPointModal" tabindex="-1" aria-labelledby="editCollectionPointModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('collection_point.update', ['id' => Crypt::encrypt($point->id)]) }}" method="POST"
                class="form w-100">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="editCollectionPointModalLabel">
                        <i class="bi bi-pencil-square me-2"></i>Editar Ponto de Coleta
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <x-form.input label="" type="hidden" name="user_id" value="{{ Auth::user()->id }}" />

                <div class="modal-body">
                    <div class="d-flex gap-2 gap-2">
                        <x-form.input label="Nome do Ponto" type="text" name="name"
                            value="{{ old('name', $point->name) }}" class='w-50' />
                        <x-form.input label="CEP" type="text" name="cep" value="{{ old('cep', $point->cep) }}"
                            class='w-50' />
                    </div>

                    <div class="d-flex gap-2 gap-2">
                        <x-form.input label="Estado" type="text" name="state"
                            value="{{ old('state', $point->state) }}" class='w-50' />
                        <x-form.input label="Cidade" type="text" name="city"
                            value="{{ old('city', $point->city) }}" class='w-50' />
                    </div>
                    <div class="d-flex gap-2">
                        <x-form.input label="Bairro" type="text" name="neighborhood"
                            value="{{ old('neighborhood', $point->neighborhood) }}" class='w-50' />
                        <x-form.input label="Rua" type="text" name="street"
                            value="{{ old('street', $point->street) }}" class='w-50' />
                    </div>
                    <div class="d-flex gap-2">
                        <x-form.input label="Número" type="text" name="number"
                            value="{{ old('number', $point->number) }}" class='w-50' />
                        <x-form.input label="Complemento" type="text" name="complement"
                            value="{{ old('complement', $point->complement) }}" class='w-50' />
                    </div>

                    <div class="d-flex gap-2">
                        <x-form.input label="Abre às" type="text" name="open_from"
                            value="{{ old('open_from', $point->open_from) }}" class='w-50' />
                        <x-form.input label="Fecha às" type="text" name="open_to"
                            value="{{ old('open_to', $point->open_to) }}" class='w-50' />
                    </div>


                    {{-- Dias da semana --}}
                    @php
                        $weekdays = [
                            'Seg' => 'Segunda',
                            'Ter' => 'Terça',
                            'Qua' => 'Quarta',
                            'Qui' => 'Quinta',
                            'Sex' => 'Sexta',
                            'Sab' => 'Sábado',
                            'Dom' => 'Domingo',
                        ];
                        $daysSelected = explode(' - ', $point->days_open);
                    @endphp

                    <div class="mb-3 mt-3">
                        <label class="form-label">Dias de Funcionamento</label>
                        <div class="row">
                            @foreach ($weekdays as $abbr => $label)
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input type="checkbox" name="days_open[]" value="{{ $abbr }}"
                                            class="form-check-input" id="day_{{ $abbr }}"
                                            {{ in_array($abbr, old('days_open', $daysSelected)) ? 'checked' : '' }}>
                                        <label for="day_{{ $abbr }}"
                                            class="form-check-label">{{ $label }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Categorias --}}
                    <div class="mb-3">
                        <label class="form-label">Categorias</label>
                        <div class="row">
                            @foreach ($categories as $category)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" name="categories-id[]" value="{{ $category->id }}"
                                            id="category-{{ $category->id }}" class="form-check-input"
                                            {{ in_array($category->id, old('categories-id', $point->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        <label for="category_{{ $category->id }}" class="form-check-label">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-floating mt-3">
                        <textarea class="form-control" id="description" name="description" style="height: 100px">{{ old('description', $point->description) }}</textarea>
                        <label for="description">Descrição</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>Salvar alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="module" src="{{ asset('assets/js/masks/cep.js') }}"></script>
<script type="module" src="{{ asset('assets/js/masks/hour.js') }}"></script>
