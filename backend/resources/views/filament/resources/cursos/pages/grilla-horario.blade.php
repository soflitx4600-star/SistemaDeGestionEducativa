<x-filament-panels::page>
    @php
        $curso    = $this->getCurso();
        $materias = $this->getMaterias();
        $docentes = $this->getDocentes();
        $dias     = $this::$dias;
        $horas    = $this::$horas;
        $bloques  = $this::$bloques;
        $etiquetas = $this::$etiquetasHora;
    @endphp

    {{-- ═══ ENCABEZADO ═══ --}}
    <div class="gh-card gh-card--header">
        <div class="gh-header-grid">
            <div class="gh-course-info">
                <div class="gh-badge">Colegio Secundario Olga Márquez de Aredez N° 59</div>
                <h2 class="gh-course-title">{{ $curso->anio }}° Año &mdash; División {{ $curso->division }}</h2>
                <div class="gh-course-meta">
                    <span>Turno {{ $curso->turno }}</span>
                    <span>·</span>
                    <span>Ciclo {{ $curso->ciclo_lectivo }}</span>
                    @if($curso->preceptor)
                        <span>·</span>
                        <span>Preceptor/a: {{ $curso->preceptor }}</span>
                    @endif
                    <span>·</span>
                    <span>{{ $this->getAlumnosCount() }} Alumnos</span>
                </div>
            </div>

            <div class="gh-info-area">
                 <div class="gh-leyend-box">
                    <x-heroicon-o-information-circle class="gh-leyend-icon" />
                    <span>Seleccioná la <strong>materia</strong> y el <strong>docente</strong> en cada celda, luego presioná <strong>Guardar</strong>. Para vaciar, dejá ambos en blanco.</span>
                 </div>
            </div>
        </div>
    </div>

    {{-- ═══ PLANILLA GRILLA ═══ --}}
    <div class="gh-card gh-card--table">
        <div class="gh-table-wrapper">
            <table class="gh-table">
                <thead>
                    <tr>
                        <th class="gh-th gh-th--hora">Hora Cátedra</th>
                        @foreach($dias as $dia)
                            <th class="gh-th gh-th--dia">{{ $dia }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($horas as $hora)
                        <tr class="gh-row">
                            <td class="gh-td gh-td--hora">
                                <div class="gh-hora-info">
                                    <div class="gh-hora-num">{{ $hora }}°</div>
                                    <div class="gh-hora-texto">
                                        <div class="gh-hora-nombre">{{ str_replace('° Hora', '', $etiquetas[$hora]) }}</div>
                                        <div class="gh-hora-bloque">{{ $bloques[$hora] }}</div>
                                    </div>
                                </div>
                            </td>

                            @foreach($dias as $dia)
                                @php
                                    $key   = "{$dia}_{$hora}";
                                    $celda = $grilla[$key] ?? ['horario_id' => null, 'materia_id' => null, 'docente_id' => null];
                                    $tieneHorario = ! is_null($celda['horario_id']);
                                @endphp

                                <td class="gh-td gh-td--celda">
                                    <div class="gh-celda-wrapper"
                                        x-data="{
                                            materia_id: {{ $celda['materia_id'] ?? 'null' }},
                                            docente_id: {{ $celda['docente_id'] ?? 'null' }},
                                            guardando: false,
                                            modificado: false,
                                            guardar() {
                                                this.guardando = true;
                                                $wire.guardarCelda(
                                                    '{{ $dia }}',
                                                    {{ $hora }},
                                                    this.materia_id ? parseInt(this.materia_id) : null,
                                                    this.docente_id ? parseInt(this.docente_id) : null
                                                ).finally(() => {
                                                    this.guardando  = false;
                                                    this.modificado = false;
                                                });
                                            }
                                        }"
                                        x-on:change.stop="modificado = true"
                                    >
                                        <div class="gh-celda-status" x-show="materia_id && docente_id && !modificado" x-cloak>
                                            <div class="gh-status-badge">✓ Asignado</div>
                                        </div>

                                        <select x-model="materia_id" class="gh-select">
                                            <option value="">— Materia —</option>
                                            @foreach($materias as $id => $nombre)
                                                <option value="{{ $id }}" @selected($celda['materia_id'] == $id)>{{ $nombre }}</option>
                                            @endforeach
                                        </select>

                                        <select x-model="docente_id" class="gh-select">
                                            <option value="">— Docente —</option>
                                            @foreach($docentes as $id => $nombre)
                                                <option value="{{ $id }}" @selected($celda['docente_id'] == $id)>{{ $nombre }}</option>
                                            @endforeach
                                        </select>

                                        <button type="button" @click="guardar()" :disabled="guardando"
                                            :class="modificado ? 'gh-btn-save gh-btn-save--modificado' : 'gh-btn-cancel gh-btn-cancel--normal'"
                                            class="gh-btn-cell">
                                            <span x-show="!guardando" x-cloak class="gh-flex-center">
                                                <span x-show="modificado" class="gh-flex-center"><x-heroicon-o-bolt class="gh-btn-icon-sm" /> Guardar</span>
                                                <span x-show="!modificado">Guardar</span>
                                            </span>
                                            <span x-show="guardando" x-cloak class="gh-flex-center">
                                                <svg class="gh-spinner-sm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                                </svg>
                                                Guardando...
                                            </span>
                                        </button>
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="gh-footer">
            <span class="gh-footer-text">
                <x-heroicon-o-clock class="gh-icon-sm" /> Última actualización: {{ now()->format('d/m/Y H:i') }}
            </span>
        </div>
    </div>

    {{-- ═══ ESTILOS ═══ --}}
    <style>
        :root {
            --gh-green:         #16a34a;
            --gh-green-light:   #dcfce7;
            --gh-green-border:  #86efac;
            --gh-amber:         #d97706;
            --gh-amber-light:   #fef3c7;
            --gh-amber-border:  #fcd34d;
            --gh-red:           #dc2626;
            --gh-red-light:     #fee2e2;
            --gh-red-border:    #fca5a5;
            --gh-indigo:        #4f46e5;
            --gh-info:          #3b82f6;
            --gh-info-light:    #eff6ff;
            --gh-radius:        12px;
            --gh-shadow:        0 1px 3px rgba(0,0,0,.08), 0 1px 2px rgba(0,0,0,.06);
        }

        .gh-card { background:#fff; border:1px solid #e5e7eb; border-radius:var(--gh-radius);
            box-shadow:var(--gh-shadow); margin-bottom:1.25rem; }
        .gh-card--header { padding:1.5rem; }
        .gh-card--table { padding:0; overflow:hidden; }
        .dark .gh-card { background:#1f2937; border-color:#374151; }

        /* ── Header ── */
        .gh-header-grid { display:grid; grid-template-columns:1fr auto; gap:1.5rem; align-items:flex-start; }
        @media(max-width:768px){ .gh-header-grid { grid-template-columns:1fr; } }
        
        .gh-badge { display:inline-block; padding:.2rem .65rem; background:#eff6ff; color:#1d4ed8;
            border-radius:999px; font-size:.72rem; font-weight:600; text-transform:uppercase;
            letter-spacing:.05em; margin-bottom:.4rem; }
        .dark .gh-badge { background:#1e3a8a; color:#bfdbfe; }
        
        .gh-course-title { font-size:1.35rem; font-weight:700; color:#111827; margin:0 0 .3rem; }
        .dark .gh-course-title { color:#f9fafb; }
        
        .gh-course-meta { font-size:.85rem; color:#6b7280; display:flex; flex-wrap:wrap; gap:0.4rem; align-items:center; }
        .dark .gh-course-meta { color:#9ca3af; }
        
        .gh-info-area { max-width:320px; }
        .gh-leyend-box { display:flex; align-items:flex-start; gap:.5rem; background:var(--gh-info-light); border:1px solid #bfdbfe; border-radius:8px; padding:.75rem; font-size:.8rem; color:#1e40af; line-height:1.4; }
        .dark .gh-leyend-box { background:#172554; border-color:#1e3a8a; color:#93c5fd; }
        .gh-leyend-icon { width:18px; height:18px; flex-shrink:0; margin-top:0.1rem; }

        /* ── Table ── */
        .gh-table-wrapper { overflow-x:auto; }
        .gh-table { width:100%; border-collapse:collapse; font-size:.88rem; }
        
        .gh-th { padding:.8rem .85rem; text-align:center; font-size:.72rem; font-weight:700;
            text-transform:uppercase; letter-spacing:.05em; color:#6b7280;
            border-bottom:2px solid #e5e7eb; white-space:nowrap; background:#f9fafb; }
        .gh-th--hora { text-align:left; width:140px; position:sticky; left:0; z-index:10; background:#f9fafb; border-right:1px solid #e5e7eb; }
        .dark .gh-th { border-color:#374151; color:#9ca3af; background:#111827; }
        .dark .gh-th--hora { background:#111827; border-color:#374151; }
        
        .gh-row { border-bottom:1px solid #f3f4f6; transition:background .12s; }
        .gh-row:hover { background:#fafafa; }
        .dark .gh-row { border-color:#374151; }
        .dark .gh-row:hover { background:#1a2432; }
        
        .gh-td { padding:.65rem .65rem; vertical-align:top; }
        .gh-td--hora { position:sticky; left:0; z-index:10; background:inherit; border-right:1px solid #e5e7eb; vertical-align:middle; }
        .dark .gh-td--hora { border-color:#374151; }
        .gh-td--celda { min-width:180px; }

        /* ── Celdas e Inputs ── */
        .gh-celda-wrapper { display:flex; flex-direction:column; gap:.4rem; position:relative; padding:.4rem; border-radius:8px; border:1px solid transparent; transition:all .2s; }
        .gh-celda-wrapper:hover { border-color:#e5e7eb; background:#f9fafb; }
        .dark .gh-celda-wrapper:hover { border-color:#4b5563; background:#1f2937; }
        
        .gh-celda-status { position:absolute; right:.2rem; top:-.6rem; z-index:5; }
        .gh-status-badge { background:var(--gh-green-light); color:var(--gh-green); border:1px solid var(--gh-green-border); font-size:.65rem; font-weight:700; text-transform:uppercase; padding:.15rem .4rem; border-radius:99px; letter-spacing:.02em; }
        .dark .gh-status-badge { background:rgba(22, 163, 74, 0.2); border-color:rgba(22, 163, 74, 0.4); color:#86efac; }
        
        .gh-hora-info { display:flex; align-items:center; gap:.6rem; }
        .gh-hora-num { display:flex; align-items:center; justify-content:center; width:28px; height:28px; background:#eff6ff; color:#2563eb; font-weight:700; border-radius:6px; font-size:.8rem; }
        .dark .gh-hora-num { background:#1e3a8a; color:#93c5fd; }
        .gh-hora-nombre { font-weight:600; color:#111827; font-size:.85rem; }
        .dark .gh-hora-nombre { color:#f9fafb; }
        .gh-hora-bloque { font-size:.72rem; color:#6b7280; }

        .gh-select { display:block; width:100%; border:1px solid #d1d5db; border-radius:6px;
            padding:.35rem .5rem; font-size:.8rem; color:#111827; background:#fff; cursor:pointer; }
        .dark .gh-select { background:#1f2937; border-color:#4b5563; color:#f9fafb; }
        .gh-select:focus { outline:none; border-color:#f59e0b; box-shadow:0 0 0 3px rgba(245,158,11,.15); }

        .gh-btn-cell { display:flex; align-items:center; justify-content:center; gap:.3rem; width:100%; padding:.4rem; border-radius:6px; font-size:.75rem; font-weight:600; cursor:pointer; transition:all .15s; border:none; }
        .gh-btn-cell:disabled { opacity:.6; cursor:not-allowed; }
        .gh-btn-icon-sm { width:12px; height:12px; }
        .gh-flex-center { display:flex; align-items:center; gap:.3rem; }
        
        .gh-btn-save--modificado { background:var(--gh-amber); color:#fff; box-shadow:0 1px 2px rgba(245,158,11,.3); }
        .gh-btn-save--modificado:hover { background:#d97706; }
        
        .gh-btn-cancel--normal { background:#f3f4f6; color:#374151; border:1px solid #e5e7eb; }
        .gh-btn-cancel--normal:hover { background:#e5e7eb; }
        .dark .gh-btn-cancel--normal { background:#111827; color:#d1d5db; border-color:#4b5563; }
        .dark .gh-btn-cancel--normal:hover { background:#374151; }

        /* ── Footer ── */
        .gh-footer { padding:1rem 1.5rem; border-top:1px solid #e5e7eb; display:flex; justify-content:flex-end; background:#f9fafb; }
        .dark .gh-footer { border-color:#374151; background:#111827; }
        .gh-footer-text { display:flex; align-items:center; gap:.3rem; font-size:.75rem; color:#6b7280; font-weight:500; }
        .gh-icon-sm { width:14px; height:14px; }
        
        /* ── Spinner ── */
        .gh-spinner-sm { width:14px; height:14px; animation:gh-spin 1s linear infinite; }
        @keyframes gh-spin { to { transform:rotate(360deg); } }
    </style>
</x-filament-panels::page>
