<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $organization->name }}
            </h2>

            <x-success-link href="{{ route('organizations.departments.create', [$organization->id]) }}">
                {{ __('Добавить отдел') }}
            </x-success-link>
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('status'))
            <x-alert-success>{{ session('status') }}</x-alert-success>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900">
                <p class="mb-4 font-medium border-b border-gray-100 pb-4">{{ __('Информация об организации') }}</p>
                {!! $organization->description !!}
            </div>
        </div>

         <h3 class="mb-6 text-xl font-semibold">{{ __('Отделы организации') }}</h3>

        <div class="grid grid-cols-3 gap-4">
            @foreach($departments as $department)
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                    <h5 class="mb-4 text-xl font-bold tracking-tight text-gray-900">
                        {{ $department->name }}
                    </h5>

                    <div class="mb-3 font-normal text-gray-700">
                        {!! Str::limit($department->description, 50) !!}
                    </div>

                    <x-primary-link href="{{ route('organizations.departments.show', [$organization->id, $department->id]) }}">
                        {{ __('Отрыть') }}
                    </x-primary-link>

                    <x-secondary-link href="{{ route('organizations.departments.edit', [$organization->id, $department->id]) }}">
                        {{ __('Редактировать') }}
                    </x-secondary-link>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
