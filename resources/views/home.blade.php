@extends('layouts.main_layout')

@section('content')
    <section id="colletionPoints" class="container py-5">
        <div class="row mx-auto">
            @foreach ($data as $point)
               <div class="col col-lg-6 col-12">
                   <x-card />
               </div>
               <div class="col col-lg-6 col-12">
                   <x-card />
               </div>
               <div class="col col-lg-6 col-12">
                   <x-card />
               </div>
               <div class="col col-lg-6 col-12">
                   <x-card />
               </div>
            @endforeach
        </div>
    </section>
@endsection
