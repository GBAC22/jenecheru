<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .page-break {
            page-break-after: always;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Bitácora de {{ $user->name }}</h2>
        <p>Fecha y hora de generación del PDF: {{ $currentDateTime }}</p>
    </div>

    @foreach ($bitacoras->chunk(4) as $chunk)
        <table class="table">
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
                @foreach ($chunk as $bitacora)
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
        {{-- @if ($bitacoras->hasPages())
            <p>Página {{ $bitacoras->currentPage() }} de {{ $bitacoras->lastPage() }}</p>
        @endif --}}
        @if (! $loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach

</body>
</html>
