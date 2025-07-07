@extends('layouts.main_layout')

@section('content')
    <section id="colletionPoints" class="container py-5">
        <x-alerts.alert/>
        <div class="row mx-auto">
            @foreach ($data as $point)
                <div class="col col-lg-6 col-12">
                    <x-collection-point.card :point="$point" />
                </div>
            @endforeach
            {{ $data->links() }}
        </div>
    </section>
@endsection
