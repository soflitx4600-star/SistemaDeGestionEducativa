<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #000;
        }

        .container {
            padding: 25px;
        }

        /* HEADER */
        .header {
            display: table;
            width: 100%;
            border-bottom: 2px solid #000;
            margin-bottom: 15px;
            padding-bottom: 10px;
        }

        .logo {
            display: table-cell;
            width: 80px;
            vertical-align: middle;
        }

        .logo img {
            width: 70px;
        }

        .titulo {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
        }

        .titulo h1 {
            font-size: 14px;
            font-weight: bold;
        }

        .titulo p {
            font-size: 10px;
        }

        .fecha {
            display: table-cell;
            text-align: right;
            font-size: 10px;
            vertical-align: middle;
        }

        /* SECCIONES */
        .seccion {
            margin-top: 15px;
        }

        .seccion-titulo {
            font-weight: bold;
            border-bottom: 1px solid #000;
            margin-bottom: 5px;
            padding-bottom: 2px;
        }

        /* TABLA */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        /* FOTO (ARREGLADA) */
        .foto-container {
            width: 100px;
            height: 120px;
            border: 1px solid #000;
            text-align: center;
            vertical-align: middle;
        }

        .foto-container img {
            max-width: 100%;
            max-height: 100%;
        }

        .sin-foto {
            font-size: 10px;
            line-height: 120px;
        }

        /* TABLA HISTORIAL */
        th {
            border: 1px solid #000;
            padding: 5px;
            font-size: 10px;
            background: #eee;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9px;
        }
    </style>
</head>
<body>
<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div class="logo">
            <img src="{{ public_path('logo_olga_aredez.jpeg') }}">
        </div>

        <div class="titulo">
            <h1>ESCUELA SECUNDARIA OLGA ARÉDEZ</h1>
            <p>FICHA DEL DOCENTE</p>
        </div>

        <div class="fecha">
            {{ now()->format('d/m/Y') }}
        </div>
    </div>

    <!-- DATOS PERSONALES -->
    <div class="seccion">
        <div class="seccion-titulo">DATOS PERSONALES</div>

        <table>
            <tr>
                <td>
                    <strong>Apellido y Nombre</strong><br>
                    {{ $docente->apellido }}, {{ $docente->nombre }}
                </td>

                <td>
                    <strong>DNI</strong><br>
                    {{ $docente->dni }}
                </td>

                <td rowspan="4" class="foto-container">
                    @if($docente->foto)
                        <img src="{{ storage_path('app/public/' . $docente->foto) }}">
                    @else
                        <div class="sin-foto">SIN FOTO</div>
                    @endif
                </td>
            </tr>

            <tr>
                <td>
                    <strong>Especialidad</strong><br>
                    {{ $docente->especialidad ?? '—' }}
                </td>

                <td>
                    <strong>Email</strong><br>
                    {{ $docente->email ?? '—' }}
                </td>
            </tr>

            <tr>
                <td>
                    <strong>Teléfono</strong><br>
                    {{ $docente->telefono ?? '—' }}
                </td>

                <td>
                    <strong>Usuario del sistema</strong><br>
                    {{ $docente->user?->name ?? '—' }}
                </td>
            </tr>

            <tr>
                <td>
                    <strong>Fecha de registro</strong><br>
                    {{ $docente->created_at->format('d/m/Y') }}
                </td>

                <td colspan="2"></td>
            </tr>
        </table>
    </div>

    <!-- MATERIAS A CARGO -->
    @if($docente->materias->isNotEmpty())
    <div class="seccion">
        <div class="seccion-titulo">MATERIAS A CARGO</div>

        <table>
            <tr>
                <th>Materia</th>
                <th>Año</th>
                <th>Ciclo</th>
                <th>Ciclo Lectivo</th>
                <th>Hs/sem</th>
                <th>Rol</th>
            </tr>

            @foreach($docente->materias->sortBy([['pivot.ciclo_lectivo','desc'],['anio_cursado','asc']]) as $materia)
            <tr>
                <td>{{ $materia->nombre }}</td>
                <td>{{ $materia->anio_cursado }}°</td>
                <td>{{ $materia->ciclo === 'comun' ? 'Básico' : 'Orientado' }}</td>
                <td>{{ $materia->pivot->ciclo_lectivo }}</td>
                <td>{{ $materia->horas_semanales ?? '—' }}</td>
                <td>{{ $materia->pivot->es_titular ? 'Titular' : 'Suplente' }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    @else
    <div class="seccion">
        <div class="seccion-titulo">MATERIAS A CARGO</div>
        <p style="padding: 8px; color: #666; font-size: 10px;">Sin materias asignadas.</p>
    </div>
    @endif

    <div class="footer">
        Documento oficial generado por el Sistema de Gestión Educativa
    </div>

</div>
</body>
</html>
