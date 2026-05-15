<div>
    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
    <input
        id="name"
        name="name"
        type="text"
        value="{{ old('name', $contact->name ?? '') }}"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
    >
    @error('name')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="phone_number" class="block text-sm font-medium text-gray-700">Telefono</label>
    <input
        id="phone_number"
        name="phone_number"
        type="text"
        value="{{ old('phone_number', $contact->phone_number ?? '') }}"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
    >
    @error('phone_number')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center gap-4">
    <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
        Guardar
    </button>

    <a href="{{ route('contacts.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">
        Cancelar
    </a>
</div>
