<x-app-layout>
    <div class="max-w-2xl mx-auto py-6">

        <h1 class="text-2xl font-bold mb-4">
            Editar contacto
        </h1>

        <form action="{{ route('contacts.update', $contact) }}" method="POST">

            @csrf
            @method('PUT')

            @include('contacts._form', ['contact' => $contact])

            <button
                type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded"
            >
                Actualizar
            </button>

        </form>

    </div>
</x-app-layout>