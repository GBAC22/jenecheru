<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nuevo Proveedor
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form method="post" action="{{ route('proveedores.store') }}">
                @csrf
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="nombre" class="block font-bold text-lg text-gray-700 mb-2">Nombre</label>
                        <input type="text" name="nombre" id="nombre"
                            class="form-input rounded-md shadow-sm mt-1 block w-full"
                            placeholder="Agregar nombre del Proveedor" />
                        @error('nombre')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="email" class="block font-bold text-lg text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" id="email"
                            class="form-input rounded-md shadow-sm mt-1 block w-full"
                            placeholder="Agregar email del Proveedor" />
                        @error('email')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="telefono" class="block font-bold text-lg text-gray-700 mb-2">Teléfono</label>
                        <input type="text" name="telefono" id="telefono"
                            class="form-input rounded-md shadow-sm mt-1 block w-full"
                            placeholder="Agregar teléfono del Proveedor" />
                        @error('telefono')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="direccion" class="block font-bold text-lg text-gray-700 mb-2">Dirección</label>
                        <input type="text" name="direccion" id="direccion"
                            class="form-input rounded-md shadow-sm mt-1 block w-full"
                            placeholder="Agregar dirección del Proveedor" />
                        @error('direccion')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between px-4 py-3 bg-gray-50 sm:px-6">
                        <div class="flex-1">
                            <a href="{{ route('proveedores.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Cancelar
                            </a>
                        </div>

                        <div class="flex-1 text-right">
                            <button
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
