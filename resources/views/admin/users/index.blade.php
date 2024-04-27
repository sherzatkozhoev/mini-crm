<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Пользователи') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('status'))
            <x-alert-success>{{ session('status') }}</x-alert-success>
        @endif

        <div class="grid grid-cols-3 gap-4">
            @foreach($users as $user)
                @if (!$user->hasRole('Admin'))
                    <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                        <h5 class="mb-4 text-xl font-bold tracking-tight text-gray-900">
                            {{ $user->name }}
                        </h5>

                        <x-primary-link href="{{ route('users.edit', $user->id) }}">
                            {{ __('Редактировать') }}
                        </x-primary-link>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
