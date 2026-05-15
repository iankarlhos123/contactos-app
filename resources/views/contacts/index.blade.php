<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Contactos') }}
            </h2>

            <a href="{{ route('contacts.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                Nuevo contacto
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($contacts->isEmpty())
                        <div class="text-center text-gray-600">
                            No tienes contactos registrados.
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Nombre
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Telefono
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Creado
                                        </th>
                                         <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                            Hora de creación
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($contacts as $contact)
                                        <tr>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                                <a href="{{ route('contacts.show', $contact) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    {{ $contact->name }}
                                                </a>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                                {{ $contact->phone_number }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                                {{ $contact->created_at->format('d/m/Y') }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                                {{ $contact->created_at->format('H:i') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $contacts->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
