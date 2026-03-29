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

        .foto-alumno {
            display: table-cell;
            width: 80px;
            vertical-align: middle;
            text-align: center;
        }
        .foto-alumno img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #184158;
        }
        .foto-alumno .sin-foto {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #184158;
            color: white;
            font-size: 24px;
            line-height: 70px;
            text-align: center;
            display: inline-block;
        }

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

        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-inscripto  { background: #d1fae5; color: #065f46; }
        .badge-preinscripto { background: #fef3c7; color: #92400e; }
        .badge-egresado   { background: #dbeafe; color: #1e40af; }
        .badge-abandono   { background: #fee2e2; color: #991b1b; }
        .badge-suspendido { background: #f3f4f6; color: #374151; }
        .badge-sorteado   { background: #ede9fe; color: #5b21b6; }

        .historial-table { width: 100%; border-collapse: collapse; margin-top: 6px; }
        .historial-table th {
            background: #184158; color: white;
            padding: 5px 8px; font-size: 10px; text-align: left;
        }
        .historial-table td { padding: 5px 8px; font-size: 11px; border-bottom: 1px solid #e5e7eb; }
        .historial-table tr:nth-child(even) td { background: #f9fafb; }

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
            <p>Ficha del Alumno — Sistema de Gestión Educativa</p>
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
                <div class="valor">{{ $alumno->apellido }}, {{ $alumno->nombre }}</div>
            </div>
            <div class="celda" style="text-align:center; vertical-align:middle;">
                @if($alumno->foto)
                    <img src="{{ storage_path('app/public/' . $alumno->foto) }}" style="width:80px;height:80px;border-radius:50%;object-fit:cover;border:2px solid #184158;">
                @else
                    <div style="width:80px;height:80px;border-radius:50%;background:#184158;color:white;font-size:28px;line-height:80px;text-align:center;display:inline-block;">
                        {{ strtoupper(substr($alumno->nombre, 0, 1)) }}
                    </div>
                @endif
            </div>
        </div>
        <div class="fila">
            <div class="celda">
                <div class="label">Estado</div>
                <div class="valor">
                    <span class="badge badge-{{ $alumno->estado->value }}">
                        {{ $alumno->estado->label() }}
                    </span>
                </div>
            </div>
            <div class="celda">
                <div class="label">DNI</div>
                <div class="valor">{{ $alumno->dni }}</div>
            </div>
        </div>
        <div class="fila">
            <div class="celda">
                <div class="label">Fecha de Nacimiento</div>
                <div class="valor">{{ $alumno->fecha_nacimiento->format('d/m/Y') }}</div>
            </div>
            <div class="celda">
                <div class="label">Género</div>
                <div class="valor">{{ ucfirst($alumno->genero) }}</div>
            </div>
        </div>
        <div class="fila">
            <div class="celda">
                <div class="label">Domicilio</div>
                <div class="valor">{{ $alumno->domicilio }}</div>
            </div>
            <div class="celda">
                <div class="label">Teléfono</div>
                <div class="valor">{{ $alumno->telefono ?? '—' }}</div>
            </div>
        </div>
        <div class="fila">
            <div class="celda">
                <div class="label">Email</div>
                <div class="valor">{{ $alumno->email ?? '—' }}</div>
            </div>
            <div class="celda">
                <div class="label">N° Legajo</div>
                <div class="valor">{{ $alumno->fichaLegajo?->numero_legajo ?? '—' }}</div>
            </div>
        </div>
    </div>

    {{-- TUTORES --}}
    @if($alumno->tutores->isNotEmpty())
    <div class="titulo-seccion">TUTORES / RESPONSABLES</div>
    <div class="grid">
        @foreach($alumno->tutores as $tutor)
        <div class="fila">
            <div class="celda">
                <div class="label">{{ ucfirst($tutor->parentesco) }}{{ $tutor->pivot->es_responsable_principal ? ' (Responsable principal)' : '' }}</div>
                <div class="valor">{{ $tutor->apellido }}, {{ $tutor->nombre }}</div>
            </div>
            <div class="celda">
                <div class="label">Contacto</div>
                <div class="valor">{{ $tutor->telefono ?? $tutor->email ?? '—' }}</div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- HISTORIAL ACADÉMICO --}}
    @if($alumno->historialAcademico->isNotEmpty())
    <div class="titulo-seccion">HISTORIAL ACADÉMICO</div>
    <table class="historial-table">
        <thead>
            <tr>
                <th>Materia</th>
                <th>Año</th>
                <th>Ciclo Lectivo</th>
                <th>Nota Cursada</th>
                <th>Nota Final</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>
    @endif

    <div class="footer">
        Documento generado automáticamente por el Sistema de Gestión Educativa &bull; {{ config('app.name') }}
    </div>

</body>
</html>
