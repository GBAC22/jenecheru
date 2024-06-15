
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bitácora de {{ $user->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        th {
            background-color: #f0f0f0;
            text-align: left;
            font-weight: bold;
        }
        td {
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Bitácora de {{ $user->name }}</h2>
    <p>Fecha y hora de generación del PDF: {{ $currentDateTime }}</p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Acción</th>
                <th>Detalle</th>
                <th>Fecha y Hora</th>
                <th>IP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bitacoras as $bitacora)
                <tr>
                    <td>{{ $bitacora->id }}</td>
                    <td>{{ $bitacora->action }}</td>
                    <td>{{ $bitacora->details }}</td>
                    <td>{{ $bitacora->created_at }}</td>
                    <td>{{ $bitacora->ip_address ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Si hay más de una página, muestra el número de página -->
    @if ($bitacoras->hasPages())
        <p>Página {{ $bitacoras->currentPage() }} de {{ $bitacoras->lastPage() }}</p>
    @endif
</body>
</html>
