<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $department->name }}
                (<a href="{{ route('organizations.show', $organization->id) }}"
                    class="text-blue-600"
                >{{ $organization->name }}</a>)
            </h2>

            <x-success-link href="{{ route('organizations.departments.positions.create', [
                $organization->id,
                $department->id,
            ]) }}"
            >{{ __('Добавить должность') }}</x-success-link>
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('status'))
            <x-alert-success>{{ session('status') }}</x-alert-success>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900">
                <p class="mb-4 font-medium border-b border-gray-100 pb-4">{{ __('Информация об отделе') }}</p>
                {!! $department->description !!}
            </div>
        </div>

        <h3 class="mb-6 text-xl font-semibold">{{ __('Должности отдела') }}</h3>

        @if ($positions->count())
            <div class="grid grid-cols-3 gap-4">
                @foreach($positions as $position)
                    <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                        <h5 class="mb-4 text-xl font-semibold tracking-tight text-gray-900">
                            {{ $position->name }}
                        </h5>

                        <x-secondary-link href="{{ route('organizations.departments.positions.edit', [
                            $organization->id,
                            $department->id,
                            $position->id,
                        ]) }}"
                        >{{ __('Редактировать') }}</x-secondary-link>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('В отделе нет должностей') }}
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
