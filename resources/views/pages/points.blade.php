@extends('layouts.main_layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/home/hero/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home/collection-card/collection-card.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home/collection-point/collection-point.css') }}">
@endsection

@section('content')
    <x-layout.header></x-layout.header>
@endsection
