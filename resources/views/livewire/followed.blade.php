<div wire:poll.60s class="flex flex-col items-center w-12 h-full py-4 space-y-2 bg-gray-900">
    @foreach ($streams as $stream)
    <a href="{{ route('stream', ['stream' => $stream['user_name']]) }}"
        class="w-8 h-8 bg-red-500 rounded-full hover:ring-4 ring-teal-500">
        <img class="object-cover w-full h-full rounded-full" src="{{ $stream['thumbnail_url'] }}"
            alt="{{ $stream['title'] }}">
    </a>
    @endforeach
</div>
