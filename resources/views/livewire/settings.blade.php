<div>
    <div x-data="{ on: $wire.followed }" x-on:click="on = !on" wire:click="toggleFollowed"
        class="flex justify-between w-full my-6 cursor-pointer">
        <span>Show followed sidebar on stream screen</span>
        <button type="button" aria-pressed="false" :class="{ 'bg-teal-500': on, 'bg-gray-100 dark:bg-gray-500': !on }"
            class="relative inline-flex flex-shrink-0 h-6 transition-colors duration-200 ease-in-out border-2 border-transparent rounded-full cursor-pointer w-11 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
            <span class="sr-only">Use setting</span>
            <span aria-hidden="true" :class="{ 'translate-x-5': on, 'translate-x-0': !on }"
                class="inline-block w-5 h-5 transition duration-200 ease-in-out transform bg-white rounded-full shadow dark:bg-black ring-0"></span>
        </button>
    </div>

    <div class="flex justify-between w-full my-6">
        <span>Color scheme (coming soon)</span>
        <select disabled
            class="w-20 px-2 text-gray-500 rounded-lg outline-none dark:bg-black dark:text-white focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 ">
            <option>Auto</option>
            <option>Dark</option>
            <option>Light</option>
        </select>
    </div>
</div>
