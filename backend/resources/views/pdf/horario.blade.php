<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grilla de Horarios — {{ $curso->anio }}° {{ $curso->division }} — {{ $curso->ciclo_lectivo }}</title>
    <style>
        /* ── Reset & Base ─────────────────────────────────────────────── */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 9.5px;
            color: #1a1a2e;
            background: #ffffff;
        }

        /* ── Encabezado Institucional ─────────────────────────────────── */
        .encabezado {
            border-bottom: 3px solid #1a3a5c;
            padding-bottom: 12px;
            margin-bottom: 14px;
        }

        .encabezado-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .nombre-colegio {
            font-size: 13px;
            font-weight: bold;
            color: #1a3a5c;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .subtitulo-colegio {
            font-size: 9px;
            color: #4a6fa5;
            margin-top: 2px;
        }

        .logo-placeholder {
            width: 50px;
            height: 50px;
            border: 2px solid #1a3a5c;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 7px;
            color: #1a3a5c;
            text-align: center;
            font-weight: bold;
        }

        .titulo-grilla {
            margin-top: 10px;
            background: linear-gradient(135deg, #1a3a5c 0%, #2d6a9f 100%);
            color: white;
            padding: 8px 14px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            letter-spacing: 0.3px;
        }

        /* ── Datos del Curso ──────────────────────────────────────────── */
        .datos-curso {
            display: flex;
            gap: 0;
            margin-top: 10px;
            border: 1px solid #c0d4e8;
            border-radius: 4px;
            overflow: hidden;
        }

        .dato-item {
            flex: 1;
            padding: 5px 10px;
            border-right: 1px solid #c0d4e8;
            background: #f0f6fc;
        }

        .dato-item:last-child {
            border-right: none;
        }

        .dato-label {
            font-size: 7px;
            font-weight: bold;
            color: #4a6fa5;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .dato-valor {
            font-size: 10px;
            font-weight: bold;
            color: #1a3a5c;
            margin-top: 1px;
        }

        /* ── Tabla de Grilla ──────────────────────────────────────────── */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        thead th {
            background-color: #1a3a5c;
            color: #ffffff;
            padding: 7px 5px;
            text-align: center;
            font-size: 9px;
            font-weight: bold;
            border: 1px solid #0d2534;
            letter-spacing: 0.3px;
        }

        thead th.col-hora {
            background-color: #0d2534;
            width: 70px;
            text-align: left;
            padding-left: 8px;
        }

        tbody tr:nth-child(even) td.celda {
            background-color: #f7fafd;
        }

        tbody tr:nth-child(odd) td.celda {
            background-color: #ffffff;
        }

        td {
            border: 1px solid #b8cfe0;
            padding: 5px 4px;
            vertical-align: top;
        }

        td.col-hora {
            background-color: #eaf2fb !important;
            font-weight: bold;
            text-align: left;
            width: 70px;
            padding: 6px 8px;
        }

        .hora-etiqueta {
            font-size: 10px;
            font-weight: bold;
            color: #1a3a5c;
        }

        .hora-bloque {
            font-size: 7.5px;
            font-weight: normal;
            color: #5a7fa0;
            margin-top: 1px;
        }

        td.celda {
            text-align: center;
            min-height: 40px;
            padding: 5px 3px;
        }

        td.celda.vacia {
            background-color: #fafcff !important;
        }

        .materia-nombre {
            font-weight: bold;
            font-size: 9px;
            color: #1a3a5c;
            line-height: 1.3;
        }

        .docente-nombre {
            font-size: 8px;
            color: #4a6fa5;
            margin-top: 2px;
            font-style: italic;
        }

        /* ── Pie de Página ────────────────────────────────────────────── */
        .pie-pagina {
            margin-top: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 8px;
            color: #7a9ab5;
            border-top: 1px solid #c0d4e8;
            padding-top: 6px;
        }

        .firma-preceptor {
            margin-top: 30px;
            text-align: right;
        }

        .firma-linea {
            border-top: 1px solid #1a3a5c;
            width: 200px;
            margin-left: auto;
            padding-top: 4px;
            font-size: 8px;
            color: #1a3a5c;
            text-align: center;
        }
    </style>
</head>
<body>

    {{-- ═══════════════ ENCABEZADO INSTITUCIONAL ═══════════════ --}}
    <div class="encabezado">
        <div class="encabezado-top">
            <div>
                <div class="nombre-colegio">
                    Colegio Secundario Polimodal
                </div>
                <div class="nombre-colegio" style="font-size: 11px; margin-top: 2px;">
                    "Olga Márquez de Aredez" N° 59
                </div>
                <div class="subtitulo-colegio">
                    Ministerio de Educación — Provincia de Jujuy
                </div>
            </div>
            <div class="logo-placeholder">
                N°<br>59
            </div>
        </div>

        <div class="titulo-grilla">
            GRILLA DE HORARIOS — CICLO LECTIVO {{ $curso->ciclo_lectivo }}
        </div>

        <div class="datos-curso">
            <div class="dato-item">
                <div class="dato-label">Año</div>
                <div class="dato-valor">{{ $curso->anio }}°</div>
            </div>
            <div class="dato-item">
                <div class="dato-label">División</div>
                <div class="dato-valor">{{ $curso->division }}</div>
            </div>
            <div class="dato-item">
                <div class="dato-label">Turno</div>
                <div class="dato-valor">{{ $curso->turno }}</div>
            </div>
            @if($curso->preceptor)
            <div class="dato-item" style="flex: 2;">
                <div class="dato-label">Preceptor/a</div>
                <div class="dato-valor">{{ $curso->preceptor }}</div>
            </div>
            @endif
            <div class="dato-item">
                <div class="dato-label">Ciclo Lectivo</div>
                <div class="dato-valor">{{ $curso->ciclo_lectivo }}</div>
            </div>
        </div>
    </div>

    {{-- ═══════════════ TABLA DE HORARIOS ═══════════════ --}}
    <table>
        <thead>
            <tr>
                <th class="col-hora">Hora</th>
                @foreach($dias as $dia)
                    <th>{{ $dia }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($horas as $hora)
                <tr>
                    <td class="col-hora">
                        <div class="hora-etiqueta">
                            @php
                                $etiquetas = [1=>'1ra',2=>'2da',3=>'3ra',4=>'4ta',5=>'5ta',6=>'6ta',7=>'7ma'];
                            @endphp
                            {{ $etiquetas[$hora] ?? $hora.'ra' }}
                        </div>
                        <div class="hora-bloque">{{ $bloques[$hora] }}</div>
                    </td>

                    @foreach($dias as $dia)
                        @php $celda = $grilla[$dia][$hora] ?? null; @endphp
                        <td class="celda {{ $celda ? '' : 'vacia' }}">
                            @if($celda)
                                <div class="materia-nombre">{{ $celda['materia'] }}</div>
                                <div class="docente-nombre">{{ $celda['docente'] }}</div>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ═══════════════ FIRMA PRECEPTOR ═══════════════ --}}
    @if($curso->preceptor)
    <div class="firma-preceptor">
        <div class="firma-linea">
            {{ $curso->preceptor }}<br>
            Preceptor/a
        </div>
    </div>
    @endif

    {{-- ═══════════════ PIE DE PÁGINA ═══════════════ --}}
    <div class="pie-pagina">
        <span>Colegio Secundario "Olga Márquez de Aredez" N° 59</span>
        <span>Generado el {{ now()->format('d/m/Y \a \l\a\s H:i') }}</span>
    </div>

</body>
</html>
