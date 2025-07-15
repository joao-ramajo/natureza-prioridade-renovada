<div class="collection-card mx-auto">
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

            {{-- <div class="collection-card__rating">
                <span class="collection-card__star is-filled">★</span>
                <span class="collection-card__star is-filled">★</span>
                <span class="collection-card__star is-filled">★</span>
                <span class="collection-card__star is-filled">★</span>
                <span class="collection-card__star is-filled">★</span>
            </div> --}}
        </div>
    </div>
</div>
