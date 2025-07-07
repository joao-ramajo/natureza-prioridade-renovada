@extends('layouts.main_layout')

@section('content')
    <section id="collectionPoints" class="container py-5">

      

        <h2 class="mb-4 text-center">Pontos de Coleta</h2>

        <form method="GET" action="{{ route('home') }}" class="mb-4 d-flex justify-content-center">
            <select name="category" class="form-select w-auto" onchange="this.form.submit()">
                <option value="">Todas as categorias</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </form>

        <div class="row g-4">
            @forelse ($points as $point)
                <div class="col-lg-6 col-md-8 col-sm-12 mx-auto">
                    <a href="{{ route('collection_point.view', ['id' => Crypt::encrypt($point->id)]) }}"><x-collection-point.card
                            :point="$point" /></a>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">Nenhum ponto de coleta encontrado para essa categoria.</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $points->links() }}
        </div>

    </section>
@endsection
