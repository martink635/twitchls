@extends('layouts.default')

@section('content')

    <h1 class="text-2xl md:text-3xl lg:text-5xl font-semibold py-8 md:py-12">What would you like to watch <span class="text-teal-500">today?</span></h1>

    @livewire('streams')
@endsection
