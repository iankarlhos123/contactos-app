<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nuevo contacto
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('contacts.store') }}" class="space-y-6 p-6">
                    @csrf

                    @include('contacts._form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
