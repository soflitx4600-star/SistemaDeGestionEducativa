<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #1a1a1a; }

        .header {
            display: table;
            width: 100%;
            border-bottom: 3px solid #184158;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .header-logo { display: table-cell; width: 80px; vertical-align: middle; }
        .header-logo img { width: 70px; height: auto; }
        .header-info { display: table-cell; vertical-align: middle; padding-left: 12px; }
        .header-info h1 { font-size: 15px; color: #184158; font-weight: bold; }
        .header-info p { font-size: 10px; color: #555; margin-top: 2px; }
        .header-fecha { display: table-cell; vertical-align: middle; text-align: right; font-size: 10px; color: #777; }

        .titulo-seccion {
            background-color: #184158;
            color: white;
            padding: 5px 10px;
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 10px;
            margin-top: 16px;
        }

        .grid { display: table; width: 100%; }
        .fila { display: table-row; }
        .celda {
            display: table-cell;
            width: 50%;
            padding: 5px 8px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }
        .celda:nth-child(odd) { background-color: #f9fafb; }
        .label { font-size: 9px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; }
        .valor { font-size: 12px; color: #111827; margin-top: 2px; font-weight: 500; }

        .materias-table { width: 100%; border-collapse: collapse; margin-top: 6px; }
        .materias-table th {
            background: #184158; color: white;
            padding: 5px 8px; font-size: 10px; text-align: left;
        }
        .materias-table td { padding: 5px 8px; font-size: 11px; border-bottom: 1px solid #e5e7eb; }
        .materias-table tr:nth-child(even) td { background: #f9fafb; }

        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-titular   { background: #d1fae5; color: #065f46; }
        .badge-suplente  { background: #fef3c7; color: #92400e; }

        .footer {
            margin-top: 30px;
            border-top: 1px solid #e5e7eb;
            padding-top: 8px;
            font-size: 9px;
            color: #9ca3af;
            text-align: center;
        }
    </style>
</head>
<body>

    {{-- ENCABEZADO --}}
    <div class="header">
        <div class="header-logo">
            <img src="{{ public_path('logo_olga_aredez.jpeg') }}">
        </div>
        <div class="header-info">
            <h1>Escuela Secundaria Bachiller</h1>
            <p>Ficha del Docente — Sistema de Gestión Educativa</p>
        </div>
        <div class="header-fecha">
            Generado el {{ now()->format('d/m/Y H:i') }}
        </div>
    </div>

    {{-- DATOS PERSONALES --}}
    <div class="titulo-seccion">DATOS PERSONALES</div>
    <div class="grid">
        <div class="fila">
            <div class="celda">
                <div class="label">Apellido y Nombre</div>
                <div class="valor">{{ $docente->apellido }}, {{ $docente->nombre }}</div>
            </div>
            <div class="celda" style="text-align:center; vertical-align:middle;">
                @if($docente->foto)
                    <img src="{{ storage_path('app/public/' . $docente->foto) }}" style="width:80px;height:80px;border-radius:50%;object-fit:cover;border:2px solid #184158;">
                @else
                    <div style="width:80px;height:80px;border-radius:50%;background:#184158;color:white;font-size:28px;line-height:80px;text-align:center;display:inline-block;">
                        {{ strtoupper(substr($docente->nombre, 0, 1)) }}
                    </div>
                @endif
            </div>
        </div>
        <div class="fila">
            <div class="celda">
                <div class="label">Especialidad</div>
                <div class="valor">{{ $docente->especialidad ?? '—' }}</div>
            </div>
            <div class="celda">
                <div class="label">DNI</div>
                <div class="valor">{{ $docente->dni }}</div>
            </div>
        </div>
        <div class="fila">
            <div class="celda">
                <div class="label">Teléfono</div>
                <div class="valor">{{ $docente->telefono ?? '—' }}</div>
            </div>
            <div class="celda">
                <div class="label">Email</div>
                <div class="valor">{{ $docente->email ?? '—' }}</div>
            </div>
        </div>
        <div class="fila">
            <div class="celda">
                <div class="label">Usuario del sistema</div>
                <div class="valor">{{ $docente->user?->name ?? '—' }}</div>
            </div>
            <div class="celda">
                <div class="label">Fecha de registro</div>
                <div class="valor">{{ $docente->created_at->format('d/m/Y') }}</div>
            </div>
        </div>
    </div>

    {{-- MATERIAS A CARGO --}}
    <div class="titulo-seccion">MATERIAS A CARGO</div>
    @if($docente->materias->isNotEmpty())
    <table class="materias-table">
        <thead>
            <tr>
                <th>Materia</th>
                <th>Año</th>
                <th>Ciclo</th>
                <th>Ciclo Lectivo</th>
                <th>Hs/sem</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
            @foreach($docente->materias->sortBy([['pivot.ciclo_lectivo','desc'],['anio_cursado','asc']]) as $materia)
            <tr>
                <td>{{ $materia->nombre }}</td>
                <td>{{ $materia->anio_cursado }}°</td>
                <td>{{ $materia->ciclo === 'comun' ? 'Básico' : 'Orientado' }}</td>
                <td>{{ $materia->pivot->ciclo_lectivo }}</td>
                <td>{{ $materia->horas_semanales ?? '—' }}</td>
                <td>
                    <span class="badge {{ $materia->pivot->es_titular ? 'badge-titular' : 'badge-suplente' }}">
                        {{ $materia->pivot->es_titular ? 'Titular' : 'Suplente' }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p style="padding: 8px; color: #6b7280; font-size: 11px;">Sin materias asignadas.</p>
    @endif

    <div class="footer">
        Documento generado automáticamente por el Sistema de Gestión Educativa &bull; {{ config('app.name') }}
    </div>

</body>
</html>
