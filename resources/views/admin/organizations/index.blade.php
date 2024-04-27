<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Организации') }}
            </h2>

            <x-success-link href="{{ route('organizations.create') }}">
                {{ __('Добавить организацию') }}
            </x-success-link>
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('status'))
            <x-alert-success>{{ session('status') }}</x-alert-success>
        @endif

        <div class="grid grid-cols-3 gap-4">
            @foreach($organizations as $organization)
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">
                        {{ $organization->name }}
                    </h5>

                    <div class="mb-3 font-normal text-gray-700">
                        {{ Str::limit($organization->description, 50) }}
                    </div>

                    <x-primary-link href="{{ route('organizations.show', $organization->id) }}">
                        {{ __('Отрыть') }}
                    </x-primary-link>

                    <x-secondary-link href="{{ route('organizations.edit', $organization->id) }}">
                        {{ __('Редактировать') }}
                    </x-secondary-link>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
