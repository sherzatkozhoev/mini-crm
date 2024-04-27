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
                    Добро пожаловать в админ панель!
                </div>
            </div>

            <div class="relative overflow-x-auto shadow-sm sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Организации</th>
                            <th scope="col" class="px-6 py-3">Отделы</th>
                            <th scope="col" class="px-6 py-3">Должности</th>
                            <th scope="col" class="px-6 py-3">Сотрудники</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($organizations as $organization)
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                                    {{ $organization->name }}
                                </th>
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $organization->departments->count() }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $organization->positions->count() }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $organization->users->count() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
