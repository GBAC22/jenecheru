<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles del Modelo
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="block mb-8">
            <a href="{{ route('modelos.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded inline-block mb-4">Volver al listado</a>
        </div>
        <div class="overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $modelo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre
                        </th>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $modelo->nombre }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Descripción
                        </th>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $modelo->descripcion ?? 'No disponible' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-8">
            <a href="{{ route('modelos.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded inline-block">Volver al listado</a>
        </div>
    </div>
</x-app-layout>

