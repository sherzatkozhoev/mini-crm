<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Редактирование пользователя
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="post" action="{{ route('users.update', [$user->id]) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-3 gap-6 mb-6">
                        <div>
                            <x-input-label for="name" value="Имя" />

                            <x-text-input id="name" name="name" type="text"
                                          :value="$user->name" class="mt-1 block w-full"
                                          required autofocus autocomplete="name"
                            />

                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="surname" value="Фамилия" />

                            <x-text-input id="surname" name="surname" type="text"
                                          :value="$user->surname" class="mt-1 block w-full"
                                          autocomplete="name"
                            />

                            <x-input-error class="mt-2" :messages="$errors->get('surname')" />
                        </div>

                        <div>
                            <x-input-label for="patronymic" value="Отчество" />

                            <x-text-input id="patronymic" name="patronymic" type="text"
                                          :value="$user->patronymic" class="mt-1 block w-full"
                                          autocomplete="name"
                            />

                            <x-input-error class="mt-2" :messages="$errors->get('patronymic')" />
                        </div>
                    </div>

                    <div class="mb-6">
                        <x-input-label for="birthday" value="Дата рождения" />

                        <x-text-input id="birthday" name="birthday" type="date"
                                      :value="$user->birthday" class="mt-1 block w-full"
                                      autocomplete="name"
                        />

                        <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="gender" value="Пол" />

                        <select id="gender"
                                name="gender"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >
                            <option value="">Выбрать</option>
                            <option value="male" @if($user->gender === 'male') selected @endif>Мужчина</option>
                            <option value="women" @if($user->gender === 'women') selected @endif>Женщина</option>
                        </select>

                        <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="email" value="Email" />

                        <x-text-input id="email" type="text"
                                      :value="$user->email" class="mt-1 block w-full"
                                      autocomplete="name"
                                      class="bg-gray-200 w-full"
                                      disabled
                        />
                    </div>

                    <div class="grid grid-cols-3 gap-6 mb-6">
                        <div>
                            <x-input-label for="organization_id" value="Организация" />

                            <select id="organization_id" name="organization_id"
                                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            >
                                <option value="">Выбрать</option>
                                @foreach($organizations as $organization)
                                    <option value="{{ $organization->id }}"
                                            {{ $organization->id === $user->organization_id ? 'selected' : '' }}
                                    >{{ $organization->name }}</option>
                                @endforeach
                            </select>

                            <x-input-error class="mt-2" :messages="$errors->get('organization_id')" />
                        </div>

                        <div>
                            <x-input-label for="department_id" value="Отдел" />

                            <select id="department_id" name="department_id"
                                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            >
                                <option value="">Выбрать</option>

                                @if($user->organization_id && isset($departments[$user->organization_id]))
                                    @foreach($departments[$user->organization_id] as $department)
                                        <option value="{{ $department->id }}"
                                                {{ $department->id === $user->department_id ? 'selected' : '' }}
                                        >{{ $department->name }}</option>
                                    @endforeach
                                @endif
                            </select>

                            <x-input-error class="mt-2" :messages="$errors->get('department_id')" />
                        </div>

                        <div>
                            <x-input-label for="position_id" value="Должность" />

                            <select id="position_id" name="position_id"
                                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            >
                                <option value="">Выбрать</option>

                                @if($user->department_id && isset($positions[$user->department_id]))
                                    @foreach($positions[$user->department_id] as $position)
                                        <option value="{{ $position->id }}"
                                                {{ $position->id === $user->position_id ? 'selected' : '' }}
                                        >{{ $position->name }}</option>
                                    @endforeach
                                @endif
                            </select>

                            <x-input-error class="mt-2" :messages="$errors->get('position_id')" />
                        </div>
                    </div>

                    <div class="flex items-center gap-3 border-t border-gray-200 pt-6">
                        <x-secondary-link href="{{ route('users.index') }}">
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

    @push('js')
        <script>
            const departmentsData = @json($departments);
            const positionsData = @json($positions);
            const organizationEl = document.getElementById('organization_id');
            const departmentEl = document.getElementById('department_id');
            const positionEl = document.getElementById('position_id');

            organizationEl.addEventListener('change', event => {
                const id = event.target.value;
                const departments = departmentsData[id];

                departmentEl.innerHTML = '<option value="">Выбрать</option>';
                positionEl.innerHTML = '<option value="">Выбрать</option>';

                if (!departments) return;

                departments.forEach(({ id, name }) => {
                    const option = document.createElement('option');

                    option.value = id;
                    option.textContent = name;

                    departmentEl.appendChild(option);
                });
            });

            departmentEl.addEventListener('change', event => {
                const id = event.target.value;
                const positions = positionsData[id];

                positionEl.innerHTML = '<option value="">Выбрать</option>';

                if (!positions) return;

                positions.forEach(({ id, name }) => {
                    const option = document.createElement('option');

                    option.value = id;
                    option.textContent = name;

                    positionEl.appendChild(option);
                });
            });
        </script>
    @endpush
</x-app-layout>
