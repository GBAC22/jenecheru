<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Venta
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mt-8 text-2xl">
                        Formulario de Venta
                    </div>

                    <div class="mt-6">
                        <form method="POST" action="{{ route('ventas.store') }}">
                            @csrf

                            <div class="flex flex-wrap -mx-4">
                                <div class="w-full px-4">
                                    <label for="cliente_id" class="block font-medium text-sm text-gray-700">Cliente</label>
                                    <select name="cliente_id" id="cliente_id" class="form-select mt-1 block w-full">
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('cliente_id')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="w-full px-4 mt-4">
                                    <label for="fecha" class="block font-medium text-sm text-gray-700">Fecha</label>
                                    <input type="date" name="fecha" id="fecha" class="form-input mt-1 block w-full">
                                    @error('fecha')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="w-full px-4 mt-4">
                                    <label for="articulos" class="block font-medium text-sm text-gray-700">Artículos</label>
                                    <div class="space-y-4 mt-1">
                                        @foreach ($articulos as $articulo)
                                            <div class="flex items-center">
                                                <input type="checkbox" name="articulos[{{ $articulo->id }}][id]" value="{{ $articulo->id }}" class="form-checkbox h-4 w-4 text-purple-600">
                                                <span class="ml-2 text-gray-700">{{ $articulo->nombre }}</span>
                                            </div>
                                            <div class="flex items-center mt-2 ml-6">
                                                <label for="cantidad_{{ $articulo->id }}" class="block text-sm text-gray-700">Cantidad:</label>
                                                <input type="number" name="articulos[{{ $articulo->id }}][cantidad]" id="cantidad_{{ $articulo->id }}" class="form-input rounded-md shadow-sm mt-1 block w-20 ml-2">
                                                <label for="precio_unitario_{{ $articulo->id }}" class="block text-sm text-gray-700 ml-4">Precio Unitario:</label>
                                                <input type="number" step="0.01" name="articulos[{{ $articulo->id }}][precio_unitario]" id="precio_unitario_{{ $articulo->id }}" class="form-input rounded-md shadow-sm mt-1 block w-32 ml-2">
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('articulos')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('ventas.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded-lg mr-2">Cancelar</a>
                                <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white py-2 px-4 rounded-lg">Guardar Venta</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
