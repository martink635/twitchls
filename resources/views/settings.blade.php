@extends('layouts.default')

@section('content')
<div class="max-w-2xl">

    <x-title>Settings</x-title>

    <p class="text-sm italic">Once logged in you configure some settings that will persist to your user account.</p>

    <livewire:settings />

</div>
@endsection
