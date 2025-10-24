@props([
    'title' => 'null',
    'description' => 'undefined'
])

<div {{ $attributes->merge(['class'=>'']) }}>
    <a {{ $attributes }}
    class="block w-full rounded-2xl bg-white p-6 shadow-md hover:shadow-lg transition duration-300 border border-gray-200">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">
            {{ $title }}
        </h3>
        <p class="text-gray-500 text-sm">
            {{ $description }}
        </p>
    </a>
</div>