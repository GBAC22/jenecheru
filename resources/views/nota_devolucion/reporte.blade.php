<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devolucion - Jenecheru</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .header, .footer {
            background-color: #4A90E2;
            color: white;
            padding: 15px 0;
            text-align: center;
        }
        .container {
            background-color: white;
            padding: 30px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 800px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
            color: #333;
        }
        .btn-print, .btn-back {
            background-color: #4A90E2;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s;
        }
        .btn-print:hover, .btn-back:hover {
            background-color: #357ABD;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #4A90E2;
            padding-bottom: 10px;
        }
        .invoice-header .company-details {
            text-align: left;
        }
        .invoice-header .invoice-title {
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            margin: 0;
        }
        .invoice-header .invoice-meta {
            text-align: right;
        }
        .company-details p, .invoice-meta p {
            margin: 0;
            line-height: 1.5;
        }
        @media print {
            @page {
                size: letter;
                margin-top: 1cm;
                margin-right: 1cm;
                margin-bottom: 0;
                margin-left: 1cm;
            }
            .btn-print, .btn-back {
                display: none;
            }
            .container {
                box-shadow: none;
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>

<body>
    
    <div class="container mx-auto py-10">
        
        
            
                <div class="invoice-header">
                    <div class="company-details">
                        <p><strong>Jenecheru</strong></p>
                        <p>Dirección de la Empresa</p>
                        <p>Teléfono: +123 456 789</p>
                        <p>Email: info@jenecheru.com</p>
                    </div>
                    <div class="invoice-title">
                        <h2>Devolucion</h2>
                    </div>
                    <div class="invoice-meta">
                        <p><strong>Fecha y Hora:</strong> {{ $currentDateTime }}</p>
                        <p><strong>Usuario:</strong> {{ $user->name }}</p>
                    </div>
                </div>
            

            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Descripcion</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Importe</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Articulo</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($devoluciones as $devolucion)

                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $devolucion['fecha'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $devolucion['descripcion'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $devolucion['cantidad'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $devolucion['precio'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $devolucion['importe'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $devolucion['estado'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $devolucion['articulo'] }}</td>
                            </tr>
                        
                    @endforeach
                </tbody>
            </table>
            
            
        
        
    </div>
    <div class="footer">
        <p>&copy; 2024 Jenecheru. Todos los derechos reservados.</p>
    </div>
    
</body>

</html>
