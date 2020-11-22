@extends('layouts.stream')

@section('content')
<div x-data="stream()" x-init="init()" class="fixed inset-0 flex w-full h-full">
    <div x-show="dragging" x-on:mousemove.passive="dragMove($event)" x-on:mouseup.passive="dragStop($event)"
        class="fixed inset-0 z-10 w-full h-full bg-transparent"></div>

    <main class="relative flex-grow">

        <div class="absolute top-0 right-0 flex mt-2 mr-20 space-x-2">
            <div x-on:click="toggleChat()"
                class="p-2 text-white bg-gray-500 rounded-lg cursor-pointer opacity-20 hover:opacity-100">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <div x-on:click="toggleFullscreen()"
                class="p-2 text-white bg-gray-500 rounded-lg cursor-pointer opacity-20 hover:opacity-100">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 4a1 1 0 011-1h4a1 1 0 010 2H6.414l2.293 2.293a1 1 0 11-1.414 1.414L5 6.414V8a1 1 0 01-2 0V4zm9 1a1 1 0 010-2h4a1 1 0 011 1v4a1 1 0 01-2 0V6.414l-2.293 2.293a1 1 0 11-1.414-1.414L13.586 5H12zm-9 7a1 1 0 012 0v1.586l2.293-2.293a1 1 0 111.414 1.414L6.414 15H8a1 1 0 010 2H4a1 1 0 01-1-1v-4zm13-1a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 010-2h1.586l-2.293-2.293a1 1 0 111.414-1.414L15 13.586V12a1 1 0 011-1z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>

        <div x-show="chat" x-on:mousedown.passive="dragStart($event)"
            class="absolute top-0 bottom-0 right-0 w-8 my-auto -mr-4 cursor-col-resize h-5/6"></div>

        <iframe
            src="https://player.twitch.tv/?channel={{ strtolower($stream) }}&parent={{ request()->getHttpHost() }}&scrolling=no&muted=false&autoplay=true"
            class="w-full h-full" frameborder="0" scrolling="no" allowfullscreen="no"></iframe>
    </main>
    <aside x-show="chat" x-ref="chat">
        <iframe frameborder="0" class="w-full h-full" scrolling="no"
            x-bind:src="`https://www.twitch.tv/embed/{{ strtolower($stream) }}/chat?&parent={{ request()->getHttpHost() }}${mode}`"></iframe>
    </aside>
</div>
@endsection
