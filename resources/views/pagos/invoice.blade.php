<!-- resources/views/invoice.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6">Factura de Venta</h1>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($cartItems as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item['name'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item['quantity'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${{ $item['price'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${{ $item['price'] * $item['quantity'] }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="px-6 py-4 text-right font-bold">Total</td>
                    <td class="px-6 py-4 font-bold">${{ $total }}</td>
                </tr>
            </tbody>
        </table>
        <button onclick="window.print()" class="mt-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Imprimir Factura</button>
    </div>
</body>
</html>

