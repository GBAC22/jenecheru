<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Agregar Artículo
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('livewire..inventario.articulo-create') }}">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="codigo" class="block font-medium text-sm text-gray-700">Código</label>
                            <input type="text" name="codigo" id="codigo"
                                class="form-input rounded-md shadow-sm mt-1 block w-full"
                                value="{{ old('codigo', '') }}" />
                            @error('codigo')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="nombre" class="block font-medium text-sm text-gray-700">Nombre</label>
                            <input type="text" name="nombre" id="nombre"
                                class="form-input rounded-md shadow-sm mt-1 block w-full"
                                value="{{ old('nombre', '') }}" />
                            @error('nombre')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="imagen" class="block font-medium text-sm text-gray-700">Imagen</label>
                            <input type="text" name="imagen" id="imagen"
                                class="form-input rounded-md shadow-sm mt-1 block w-full"
                                value="{{ old('imagen', '') }}" />
                            @error('imagen')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="tipo" class="block font-medium text-sm text-gray-700">Tipo</label>
                            <input type="text" name="tipo" id="tipo"
                                class="form-input rounded-md shadow-sm mt-1 block w-full"
                                value="{{ old('tipo', '') }}" />
                            @error('tipo')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="precio_unitario" class="block font-medium text-sm text-gray-700">Precio
                                Unitario</label>
                            <input type="number" name="precio_unitario" id="precio_unitario"
                                class="form-input rounded-md shadow-sm mt-1 block w-full"
                                value="{{ old('precio_unitario', '') }}" />
                            @error('precio_unitario')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="precio_mayor" class="block font-medium text-sm text-gray-700">Precio
                                Mayorista</label>
                            <input type="number" name="precio_mayor" id="precio_mayor"
                                class="form-input rounded-md shadow-sm mt-1 block w-full"
                                value="{{ old('precio_mayor', '') }}" />
                            @error('precio_mayor')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="precio_promedio" class="block font-medium text-sm text-gray-700">Precio
                                Promedio</label>
                            <input type="number" name="precio_promedio" id="precio_promedio"
                                class="form-input rounded-md shadow-sm mt-1 block w-full"
                                value="{{ old('precio_promedio', '') }}" />
                            @error('precio_promedio')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="stock" class="block font-medium text-sm text-gray-700">Stock</label>
                            <input type="number" name="stock" id="stock"
                                class="form-input rounded-md shadow-sm mt-1 block w-full"
                                value="{{ old('stock', '') }}" />
                            @error('stock')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="descripcion" class="block font-medium text-sm text-gray-700">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-textarea rounded-md shadow-sm mt-1 block w-full">{{ old('descripcion', '') }}</textarea>
                            @error('descripcion')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Crear
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
