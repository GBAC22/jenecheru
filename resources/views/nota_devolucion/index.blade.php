<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Devoluciones
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    

                    <div class="mt-8 text-2xl">
                        Listado de Devoluciones
                    </div>

                    <div class="mt-6 text-gray-500">
                        <div class="flex justify-end mb-6">
                            <a href="{{ route('export') }}" class="bg-gray-600 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
                                PDF
                            </a>
                        </div>

                        <div class="flex justify-end mb-6">
                            <a href="{{ route('nota_devolucion.create') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                Nueva Devolucion
                            </a>
                        </div>

                        

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Id
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Fecha
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Descripcion
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Cantidad
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Precio
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Importe
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Estado
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Articulo
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($devoluciones as $devolucion)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            {{ $devolucion['id'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            {{ $devolucion['fecha'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            {{ $devolucion['descripcion'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            {{ $devolucion['cantidad'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            ${{ $devolucion['precio'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            ${{ $devolucion['importe'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            {{ $devolucion['estado'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            {{ $devolucion['articulo'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <form action="{{ route('nota_devolucion.destroy', $devolucion['id']) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
