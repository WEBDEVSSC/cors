<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Valoración Inicial</title>

    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 8.5px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .header {
            border-bottom: 2px solid #000;
            margin-bottom: 10px;
        }

        .seccion {
            margin-bottom: 6px;
        }

        .titulo-seccion {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 2px;
        }

        .texto {
            margin-top: 2px;
            white-space: pre-line;
            line-height: 1.2;
            text-align: left;
        }

        .card {
            border: 1px solid #bfbfbf;
            border-radius: 6px;
            padding: 8px;
        }

        .firma {
            position: fixed;
            bottom: 40px;
            left: 0;
            right: 0;
            text-align: center;
        }

        .footer {
            margin-top: 10px;
            text-align: right;
            font-size: 8px;
        }

        td {
            padding: 2px 3px;
            vertical-align: top;
        }

        p {
            margin: 2px 0;
        }
    </style>
</head>

<body>

<!-- ENCABEZADO -->
<table class="header">
    <tr>
        <td style="width: 60%; text-align: left;">
            <h1 style="margin: 0; font-size: 14px;">
                CENTRO ONCOLÓGICO REGIÓN SURESTE
            </h1>
            <p>COAHUILA DE ZARAGOZA</p>
        </td>

        <td style="width: 40%; text-align: right;">
            <p><strong>NOTA MÉDICA DE VALORACIÓN INICIAL</strong></p>
            <p>
                Fecha: {{ \Carbon\Carbon::parse($valoracionInicial->created_at)->format('d-m-Y') }}
            </p>
        </td>
    </tr>
</table>

<!-- DATOS DEL PACIENTE -->
<div class="seccion">
    <div class="titulo-seccion">DATOS DEL PACIENTE</div>

    <div class="card">
        <table>
            <tr>
                <!-- IZQUIERDA -->
                <td style="width:50%; padding-right:8px;">
                    <table>
                        <tr>
                            <td><strong>Nombre:</strong></td>
                            <td>{{ $valoracionInicial->paciente->nombre_completo ?? '' }}</td>
                        </tr>
                        <tr>
                            <td><strong>CURP:</strong></td>
                            <td>{{ $valoracionInicial->paciente->curp ?? '' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Edad:</strong></td>
                            <td>{{ $valoracionInicial->edad_paciente }} años</td>
                        </tr>
                        <tr>
                            <td><strong>Sexo:</strong></td>
                            <td>{{ $valoracionInicial->paciente->sexo ?? '' }}</td>
                        </tr>
                        <tr>
                            <td><strong>F. Nac.:</strong></td>
                            <td>
                                {{ $valoracionInicial->paciente->fecha_nacimiento 
                                    ? \Carbon\Carbon::parse($valoracionInicial->paciente->fecha_nacimiento)->format('d-m-Y') 
                                    : '' }}
                            </td>
                        </tr>
                    </table>
                </td>

                <!-- DERECHA -->
                <td style="width:50%; padding-left:8px;">
                    <table>
                        <tr>
                            <td><strong>Residencia:</strong></td>
                            <td>{{ $valoracionInicial->paciente->residencia ?? '' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Ocupación:</strong></td>
                            <td>{{ $valoracionInicial->paciente->ocupacion ?? '' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Afiliación:</strong></td>
                            <td>{{ $valoracionInicial->paciente->afiliacion->afiliacion ?? '' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Expediente:</strong></td>
                            <td>{{ $valoracionInicial->paciente->expediente ?? '' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Teléfono:</strong></td>
                            <td>{{ $valoracionInicial->paciente->telefono ?? '' }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>

<!-- PADECIMIENTO -->
<div class="seccion">
    <div class="titulo-seccion">PADECIMIENTO ACTUAL</div>
    <div class="texto">
        {{ $valoracionInicial->padecimiento_actual }}
    </div>
</div>

<!-- SIGNOS VITALES -->
<div class="seccion">
    <div class="titulo-seccion">SIGNOS VITALES Y EXPLORACIÓN FÍSICA</div>

    <table>
        <tr>
            <td><strong>Peso:</strong> {{ $valoracionInicial->cita->peso }} kg</td>
            <td><strong>Talla:</strong> {{ $valoracionInicial->cita->talla }} cm</td>
            <td><strong>IMC:</strong> {{ $valoracionInicial->cita->imc }}</td>
        </tr>

        <tr>
            <td><strong>PA:</strong> {{ $valoracionInicial->cita->sistolica }}/{{ $valoracionInicial->cita->diastolica }}</td>
            <td><strong>FC:</strong> {{ $valoracionInicial->cita->cardiaca }}</td>
            <td><strong>FR:</strong> {{ $valoracionInicial->cita->respiratoria }}</td>
        </tr>

        <tr>
            <td><strong>Temp:</strong> {{ $valoracionInicial->cita->temperatura }}</td>
            <td><strong>SpO₂:</strong> {{ $valoracionInicial->cita->sa02 }}</td>
            <td><strong>Dolor:</strong> {{ $valoracionInicial->cita->dolor }}</td>
        </tr>

        <tr>
            <td colspan="3">
                <strong>Caídas:</strong> {{ $valoracionInicial->cita->caidas ? 'Sí' : 'No' }}
            </td>
        </tr>
    </table>

    <div class="texto">
        <strong>Exploración física:</strong><br>
        {{ $valoracionInicial->cita->exploracion_fisica }}
    </div>
</div>

<!-- ESTUDIOS -->
<div class="seccion">
    <div class="titulo-seccion">ESTUDIOS</div>
    <div class="texto">
        {{ $valoracionInicial->estudios_laboratorio }}
    </div>
</div>

<!-- DIAGNÓSTICOS -->
<div class="seccion">
    <table>
        <tr>
            <td style="width:50%; padding-right:8px;">
                <div class="titulo-seccion">DIAGNÓSTICO</div>
                <div class="texto">
                    {{ $valoracionInicial->paciente->diagnostico->nombre ?? '' }}
                </div>
            </td>

            <td style="width:50%; padding-left:8px;">
                <div class="titulo-seccion">CIE-10</div>
                <div class="texto">
                    {{ $valoracionInicial->paciente->diagnosticoCie10->codigo ?? '' }} - 
                    {{ $valoracionInicial->paciente->diagnosticoCie10->descripcion ?? '' }}
                </div>
            </td>
        </tr>
    </table>
</div>

<!-- PRONÓSTICO -->
<div class="seccion">
    <div class="titulo-seccion">PRONÓSTICO</div>
    <div class="texto">
        {{ $valoracionInicial->pronostico }}
    </div>
</div>

<!-- ANÁLISIS -->
<div class="seccion">
    <div class="titulo-seccion">ANÁLISIS Y TRATAMIENTO</div>
    <div class="texto">
        {{ $valoracionInicial->analisis }}
    </div>
</div>

<!-- FIRMA -->
<div class="firma">
    <div style="border-top: 1px solid #000; width: 200px; margin: 0 auto 5px;"></div>

    <p><strong>{{ $valoracionInicial->medico->nombre_completo ?? '' }}</strong></p>
    <p>{{ $valoracionInicial->medico->especialidad->especialidad ?? '' }}</p>
    <p>Cédula: {{ $valoracionInicial->medico->cedula ?? '' }}</p>
</div>

</body>
</html>