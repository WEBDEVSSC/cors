<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Citas</title>

    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 9px;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 16px;
        }

        .header p {
            margin: 2px;
        }

        .card {
            border: 1px solid #bfbfbf;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 20px;
        }

        .card-title {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 10px;
            border-bottom: 1px solid #bfbfbf;
            padding-bottom: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .tabla-datos td {
            padding: 6px;
            border: 1px solid #ddd;
        }

        .tabla-citas th {
            background-color: #2c3e50;
            color: #fff;
            padding: 8px;
        }

        .tabla-citas td {
            border: 1px solid #ddd;
            padding: 7px;
            text-align: center;
        }

        .tabla-citas tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
        }
    </style>
</head>

<body>

    <!-- ENCABEZADO -->
    <table style="width: 100%; border-bottom: 2px solid #000; margin-bottom: 20px;">
    <tr>
        <!-- LADO IZQUIERDO -->
        <td style="width: 60%; text-align: left; vertical-align: top;">
            <h1 style="margin: 0; font-size: 16px;">
                CENTRO ONCOLÓGICO REGIÓN SURESTE
            </h1>
            <p style="margin: 2px;">COAHUILA DE ZARAGOZA</p>
        </td>

        <!-- LADO DERECHO -->
        <td style="width: 40%; text-align: right; vertical-align: top;">
            <p style="margin: 2px;"><strong>REPORTE DE CITAS</strong></p>
            <p style="margin: 2px;">Fecha: {{ $fecha }}</p>
        </td>
    </tr>
</table>

    <!-- TARJETA MÉDICO -->
    <div class="card">
        <div class="card-title">DATOS DEL MÉDICO</div>

        <table class="tabla-datos">
            <tr>
                <td><strong>Nombre:</strong></td>
                <td>{{ $medico->nombre_completo }}</td>
                <td><strong>Cédula:</strong></td>
                <td>{{ $medico->cedula ?? 'N/A' }}</td>
            </tr>

            <tr>
                <td><strong>Especialidad:</strong></td>
                <td>{{ optional($medico->especialidad)->especialidad ?? 'N/A' }}</td>
                <td><strong>Teléfono:</strong></td>
                <td>{{ $medico->celular ?? 'N/A' }}</td>
            </tr>

            <tr>
                <td><strong>Correo:</strong></td>
                <td colspan="3">{{ $medico->correo ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <!-- TABLA DE CITAS -->
    <table class="tabla-citas">
        <thead>
            <tr>
                <th>Horario</th>
                <th>Paciente</th>
                <th>Diagnóstico</th>
                <th>Afiliación</th>
                <th>Expediente</th>
            </tr>
        </thead>

        <tbody>
@foreach ($horarios as $hora)

    @php
        $cita = $citasPorHora[$hora] ?? null;
    @endphp

    <tr>
        <td>{{ $hora }}</td>

        @if($cita)
            <td>{{ optional($cita->paciente)->nombre_completo }}</td>
            <td>{{ optional($cita->paciente->diagnostico)->nombre }}</td>
            <td>{{ optional($cita->paciente->afiliacion)->afiliacion }}</td>
            <td>{{ $cita->paciente->expediente ?? '' }}</td>
        @else
            <td colspan="4" style="color:#999; background:#f5f5f5;">
                SIN CITA
            </td>
        @endif
    </tr>

@endforeach
</tbody>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        Generado el {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
    </div>

</body>
</html>