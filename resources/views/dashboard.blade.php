<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    Добро пожаловать в mini-crm
                    <span class="font-semibold">{{ Auth::user()->name }}</span>!

                    @if (isset($organization))
                        <p class="mt-3 border-t border-gray-200 pt-3">
                            Организация: <span class="font-semibold">{{ $organization->name }}</span> <br>
                            Отдел: <span class="font-semibold">{{ $department->name ?? 'Не выбран' }}</span> <br>
                            Должность: <span class="font-semibold">{{ $position->name ?? 'Не выбран' }}</span>
                        </p>
                    @else
                        <p class="mt-3 font-medium border-t border-gray-200 pt-3">
                            Вы еще не состоите ни в одной организации! <br>
                            Пожалуйста свяжитесь с администратором для добавления вас в организацию.
                        </p>
                    @endif
                </div>
            </div>

            @if (isset($organization))
                <h3 class="mb-6 text-xl font-semibold">
                    {{ $organization->name }}
                </h3>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        {!! $organization->description !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
