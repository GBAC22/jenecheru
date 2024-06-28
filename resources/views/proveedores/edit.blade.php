<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Actualizar Proveedor
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form method="post" action="{{ route('proveedores.update', $proveedor->id) }}">
                @csrf
                @method('PUT')
                <div class="shadow overflow-hidden sm:rounded-md">

                    <!-- Nombre -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="nombre" class="block font-bold text-lg text-gray-700 mb-2">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $proveedor->nombre) }}"
                            class="form-input rounded-md shadow-sm mt-1 block w-full @error('nombre') border-red-500 @enderror" />
                        @error('nombre')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="email" class="block font-bold text-lg text-gray-700 mb-2">Email:</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $proveedor->email) }}"
                            class="form-input rounded-md shadow-sm mt-1 block w-full @error('email') border-red-500 @enderror" />
                        @error('email')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Teléfono -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="telefono" class="block font-bold text-lg text-gray-700 mb-2">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $proveedor->telefono) }}"
                            class="form-input rounded-md shadow-sm mt-1 block w-full @error('telefono') border-red-500 @enderror" />
                        @error('telefono')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Dirección -->
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="direccion" class="block font-bold text-lg text-gray-700 mb-2">Dirección:</label>
                        <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $proveedor->direccion) }}"
                            class="form-input rounded-md shadow-sm mt-1 block w-full @error('direccion') border-red-500 @enderror" />
                        @error('direccion')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="flex items-center justify-between px-4 py-3 bg-gray-50 sm:px-6">
                        <div class="flex-1">
                            <a href="{{ route('proveedores.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900">
                                Cancelar
                            </a>
                        </div>
                        <div class="flex-1 text-right">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900">
                                Guardar cambios
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
