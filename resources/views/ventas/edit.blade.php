<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Venta
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <form method="post" action="{{ route('ventas.update', $venta->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="user_id" class="block text-sm font-medium text-gray-700">Cliente</label>
                            <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @if ($user->id == $venta->user_id) selected @endif>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $venta->fecha }}</p>
                        </div>

                        <div class="mb-6">
                            <label for="total" class="block text-sm font-medium text-gray-700">Total</label>
                            <input type="number" step="0.01" name="total" id="total" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ $venta->total }}" />
                            @error('total')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="articulos" class="block text-sm font-medium text-gray-700">Artículos</label>
                            <div class="grid grid-cols-3 gap-4 mt-2">
                                @foreach ($articulos as $articulo)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="articulos[{{ $articulo->id }}][id]" id="articulo_{{ $articulo->id }}" value="{{ $articulo->id }}"
                                            @foreach ($venta->articulos as $ventaArticulo)
                                                @if ($ventaArticulo->id == $articulo->id) checked @endif
                                            @endforeach
                                            class="form-checkbox h-5 w-5 text-indigo-600">
                                        <label for="articulo_{{ $articulo->id }}" class="ml-2 text-sm text-gray-700">{{ $articulo->nombre }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('ventas.index') }}" class="mr-4 inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-700 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Cancelar
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-600 active:bg-indigo-700 focus:outline-none focus:border-indigo-900 focus:shadow-outline-indigo disabled:opacity-25 transition ease-in-out duration-150">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
