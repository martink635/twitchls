@extends('layouts.stream')

@section('content')
    <div
        x-data="stream()"
        x-init="init()"
        class="fixed w-full h-full inset-0 flex"
    >
        <div x-show="dragging" x-on:mousemove.passive="dragMove($event)" x-on:mouseup.passive="dragStop($event)" class="z-10 bg-transparent fixed inset-0 w-full h-full"></div>

        <main class="flex-grow relative">

            <div class="absolute top-0 right-0 mr-4 mt-4 flex space-x-2">
                <div x-on:click="toggleChat()" class="cursor-pointer bg-gray-500 opacity-25 hover:opacity-100 text-white rounded-lg p-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                </div>
                <div x-on:click="toggleFullscreen()" class="cursor-pointer bg-gray-500 opacity-25 hover:opacity-100 text-white rounded-lg p-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 4a1 1 0 011-1h4a1 1 0 010 2H6.414l2.293 2.293a1 1 0 11-1.414 1.414L5 6.414V8a1 1 0 01-2 0V4zm9 1a1 1 0 010-2h4a1 1 0 011 1v4a1 1 0 01-2 0V6.414l-2.293 2.293a1 1 0 11-1.414-1.414L13.586 5H12zm-9 7a1 1 0 012 0v1.586l2.293-2.293a1 1 0 111.414 1.414L6.414 15H8a1 1 0 010 2H4a1 1 0 01-1-1v-4zm13-1a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 010-2h1.586l-2.293-2.293a1 1 0 111.414-1.414L15 13.586V12a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                </div>
            </div>

            <div x-show="chat" x-on:mousedown.passive="dragStart($event)" class="cursor-move h-40 w-8 absolute right-0 top-0 bottom-0 my-auto -mr-4 "></div>

            {{-- <iframe
                src="https://player.twitch.tv/?channel={{ strtolower($stream) }}&parent={{ request()->getHttpHost() }}&scrolling=no&muted=false&autoplay=true"
                class="w-full h-full"
                frameborder="0"
                scrolling="no"
                allowfullscreen="no"
            ></iframe> --}}
        </main>
        <aside x-show="chat" x-ref="chat">
            <iframe
                frameborder="0"
                class="w-full h-full"
                scrolling="no"
                id="twitch_embed_chat"
                x-bind:src="`https://www.twitch.tv/embed/{{ strtolower($stream) }}/chat?&parent={{ request()->getHttpHost() }}${mode}`"
            ></iframe>
        </aside>
    </div>
@endsection
