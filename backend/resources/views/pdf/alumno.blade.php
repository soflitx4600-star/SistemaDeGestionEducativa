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

        /* FOTO */
        .foto-container {
            width: 113px;
            height: 113px;
            border: 1px solid #000;
            text-align: center;
            vertical-align: middle;
            overflow: hidden;
        }

        .foto-container img {
            width: 113px;
            height: 113px;
            object-fit: cover;
        }

        .sin-foto {
            font-size: 10px;
            line-height: 113px;
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
            <p>LEGAJO DEL ALUMNO</p>
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
                    {{ $alumno->apellido }}, {{ $alumno->nombre }}
                </td>

                <td>
                    <strong>DNI</strong><br>
                    {{ $alumno->dni }}
                </td>

                <td rowspan="4" class="foto-container">
                    @if($alumno->foto)
                        <img src="{{ storage_path('app/public/' . $alumno->foto) }}">
                    @else
                        <div class="sin-foto">SIN FOTO</div>
                    @endif
                </td>
            </tr>

            <tr>
                <td>
                    <strong>Fecha Nacimiento</strong><br>
                    {{ $alumno->fecha_nacimiento->format('d/m/Y') }}
                </td>

                <td>
                    <strong>Género</strong><br>
                    {{ ucfirst($alumno->genero) }}
                </td>
            </tr>

            <tr>
                <td>
                    <strong>Domicilio</strong><br>
                    {{ $alumno->domicilio }}
                </td>

                <td>
                    <strong>Teléfono</strong><br>
                    {{ $alumno->telefono ?? '—' }}
                </td>
            </tr>

            <tr>
                <td>
                    <strong>Email</strong><br>
                    {{ $alumno->email ?? '—' }}
                </td>

                <td>
                    <strong>Legajo</strong><br>
                    {{ $alumno->fichaLegajo?->numero_legajo ?? '—' }}
                </td>
            </tr>

            <tr>
                <td>
                    <strong>Estado</strong><br>
                    {{ $alumno->estado->label() }}
                </td>

                <td colspan="2"></td>
            </tr>
        </table>
    </div>

    <!-- TUTORES -->
    @if($alumno->tutores->isNotEmpty())
    <div class="seccion">
        <div class="seccion-titulo">TUTORES / RESPONSABLES</div>

        <table>
            <tr>
                <th>Parentesco</th>
                <th>Apellido y Nombre</th>
                <th>Contacto</th>
            </tr>

            @foreach($alumno->tutores as $tutor)
            <tr>
                <td>{{ ucfirst($tutor->parentesco) }}</td>
                <td>{{ $tutor->apellido }}, {{ $tutor->nombre }}</td>
                <td>{{ $tutor->telefono ?? $tutor->email ?? '—' }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    @endif

    <!-- HISTORIAL ACADÉMICO -->
    @if($alumno->historialAcademico->isNotEmpty())
    <div class="seccion">
        <div class="seccion-titulo">HISTORIAL ACADÉMICO</div>

        <table>
            <tr>
                <th>Materia</th>
                <th>Año</th>
                <th>Ciclo Lectivo</th>
                <th>Nota Cursada</th>
                <th>Nota Final</th>
                <th>Estado</th>
            </tr>

            @foreach($alumno->historialAcademico->sortBy([['ciclo_lectivo','asc'],['materia.anio_cursado','asc']]) as $h)
            <tr>
                <td>{{ $h->materia?->nombre ?? '—' }}</td>
                <td>{{ $h->materia?->anio_cursado ?? '—' }}°</td>
                <td>{{ $h->ciclo_lectivo }}</td>
                <td>{{ $h->nota_cursada ?? '—' }}</td>
                <td>{{ $h->nota_final ?? '—' }}</td>
                <td>{{ $h->estado->label() }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    @endif

    <div class="footer">
        Documento oficial generado por el Sistema de Gestión Educativa
    </div>

</div>
</body>
</html>
