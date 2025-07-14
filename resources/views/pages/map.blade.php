@extends('layouts.main_layout')

@section('content')
    <x-layout.header></x-layout.header>
    <div style="width: 100%; height: 600px;">
        {{-- <iframe src="https://www.google.com/maps/d/embed?mid=1ssfGnY7Sw5PLblWZ99n6Cn8j9c7diOY&ehbc=2E312F" width="100%"
            height="100%" style="border: none;" allowfullscreen loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
        <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1Nv33y2Lxhz-f-ndQTAHvZZ0J_ArGXKE&ehbc=2E312F&noprof=1"
            width="100%" height="100%" style="border: none;" allowfullscreen loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
@endsection
