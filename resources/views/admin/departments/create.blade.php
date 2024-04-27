<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Создание отдела в организации "{{ $organization->name }}"
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="post" action="{{ route('organizations.departments.store', [$organization->id]) }}">
                    @csrf
                    @method('post')

                    <div class="mb-6">
                        <x-input-label for="name" value="Наименование" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="name" value="Описание" />

                        <textarea id="description" name="description"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                  rows="5"
                        ></textarea>

                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="flex items-center gap-3">
                        <x-secondary-link href="{{ route('organizations.show', [$organization->id]) }}">
                            {{ __('Отмена') }}
                        </x-secondary-link>

                        <x-primary-button>
                            {{ __('Сохранить') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
