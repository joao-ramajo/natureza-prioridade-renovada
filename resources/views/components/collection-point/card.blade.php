<div class="card mb-3 shadow-sm d-flex flex-row align-items-stretch" style="min-height: 140px; font-size: 0.925rem;">
    <!-- Imagem lateral ocupando 25% -->
    <div style="flex: 0 0 25%; max-width: 160px;">
        <img src="https://placehold.co/160x140" alt="Imagem do local"
            class="img-fluid h-100 w-100 object-fit-cover rounded-start">
    </div>

    <!-- Conteúdo -->
    <div class="d-flex flex-column p-3 bg-white" style="flex: 1;">
        <div>
            <h6 class="card-title mb-1 text-success fw-bold">
                <i class="bi bi-geo-alt-fill me-1"></i>{{ $point->name }}
            </h6>

            <p class="mb-1 text-dark">
                <i class="bi bi-signpost-2-fill me-1 text-secondary"></i>
                <strong>Endereço:</strong>
                <span class="text-secondary">{{ $point->street }} {{ $point->number ?? '' }}, {{ $point->neighborhood }} - {{ $point->city }}</span>
            </p>

            <p class="mb-1 text-dark">
                <i class="bi bi-clock-fill me-1 text-secondary"></i>
                <strong>Funcionamento:</strong>
                <span class="text-secondary">{{ $point->days_open }}, {{ $point->open_from }} - {{ $point->open_to }}</span>
            </p>

            @if ($point->updated_at)
                <p class="mb-0 text-dark">
                    <i class="bi bi-arrow-clockwise me-1 text-secondary"></i>
                    <strong>Atualizado:</strong>
                    <span class="text-secondary">{{ $point->updated_at->format('d/m/Y') }}</span>
                </p>
            @endif

            <div class="d-flex flex-wrap gap-2 mt-3">
                @foreach ($point->categories as $category)
                    <div class="px-3 py-1 rounded-pill bg-success text-white shadow-sm small d-flex align-items-center">
                        <i class="bi bi-recycle me-1"></i>{{ $category->name }}
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Rodapé do card com nome do usuário -->
        <div class="mt-auto text-end text-muted small pt-2">
            Adicionado por: <strong>{{ $point->user->name }}</strong>
        </div>
    </div>
</div>
