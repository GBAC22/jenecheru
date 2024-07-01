<!DOCTYPE html>
<html>
<head>
    <title>Salida</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Detalles de la Salida</h2>
    <p>Numero de Salida: {{ $salida->id }}</p>


    <h4></h4>
    <table>
        <thead>
            <tr>
                <th>Articulo</th>
                <th>Costo de Salida (PEN)</th>
                <th>Cantidad</th>
                <th>SubTotal (PEN)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalleSalidas as $detalleSalida)
                <tr>
                    <td>{{ $detalleSalida->articulo->nombre }}</td>
                    <td>s/ {{ number_format($detalleSalida->precio, 2) }}</td>
                    <td>{{ $detalleSalida->cantidad }}</td>
                    <td>s/ {{ number_format($detalleSalida->cantidad * $detalleSalida->precio, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-right">Subtotal:</th>
                <th>s/ {{ number_format($subtotal, 2) }}</th>
            </tr>
            <tr>
                <th colspan="3" class="text-right">TOTAL:</th>
                <th>s/ {{ number_format($salida->total, 2) }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
