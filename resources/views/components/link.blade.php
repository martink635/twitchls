<a {{ $attributes->merge(['class' => 'transition duration-150 cursor-pointer hover:text-teal-500 group']) }}>
    {{ $slot }}
    <div class="w-4 mt-2 transition-all duration-150 bg-black h-2px group-hover:bg-teal-500 group-hover:w-full"></div>
</a>
