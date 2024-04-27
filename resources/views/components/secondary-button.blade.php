<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300']) }}>
    {{ $slot }}
</button>
