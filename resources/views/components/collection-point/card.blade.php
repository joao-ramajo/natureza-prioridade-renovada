<div class="collection-card mx-auto position-relative">
    <div class="collection-card__header">
        Cadastrado por <strong>{{ $point->user->name }}</strong>
    </div>

    <div class="collection-card__body">
        <div class="collection-card__icon">
            <img src="https://placehold.co/300x300" alt="Ícone de Reciclagem">
        </div>

        <div class="collection-card__info">
            <h2 class="collection-card__title">{{ $point->name }}</h2>
            <p class="collection-card__description">
                {{ $point->description }}
            </p>
            <p class="collection-card__categories text-muted">
                @foreach ($point->categories as $category)
                    - {{ $category->name }}
                @endforeach
            </p>
        </div>
    </div>

    <!-- Botão visual decorativo -->
    <div class="position-absolute bottom-0 end-0 p-3">
        <span class="btn btn-success btn-sm d-flex align-items-center shadow-sm" style="pointer-events: none;">
            Ver detalhes
            <i class="bi bi-arrow-right ms-2"></i>
        </span>
    </div>
</div>
