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

    <div class="space-y-4">

        {{-- ═══════════════════════════════════════════════════════════════════
             Encabezado institucional del curso
        ══════════════════════════════════════════════════════════════════════ --}}
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="flex flex-wrap items-center justify-between gap-4">
                {{-- Título del colegio --}}
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-primary-600 dark:text-primary-400">
                        Colegio Secundario Olga Márquez de Aredez N° 59
                    </p>
                    <h2 class="mt-1 text-xl font-bold text-gray-900 dark:text-white">
                        {{ $curso->anio }}° Año &mdash; División {{ $curso->division }}
                    </h2>
                </div>

                {{-- Metadatos del curso --}}
                <div class="flex flex-wrap gap-6 text-sm">
                    <div class="flex flex-col">
                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Turno</span>
                        <span class="mt-0.5 inline-flex items-center gap-1 font-medium text-gray-900 dark:text-white">
                            @if($curso->turno === 'Tarde')
                                <x-heroicon-o-moon class="h-4 w-4 text-indigo-500"/>
                            @else
                                <x-heroicon-o-sun class="h-4 w-4 text-amber-500"/>
                            @endif
                            {{ $curso->turno }}
                        </span>
                    </div>

                    <div class="flex flex-col">
                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Ciclo Lectivo</span>
                        <span class="mt-0.5 font-medium text-gray-900 dark:text-white">{{ $curso->ciclo_lectivo }}</span>
                    </div>

                    @if($curso->preceptor)
                    <div class="flex flex-col">
                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Preceptor/a</span>
                        <span class="mt-0.5 font-medium text-gray-900 dark:text-white">{{ $curso->preceptor }}</span>
                    </div>
                    @endif

                    <div class="flex flex-col">
                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Alumnos</span>
                        <span class="mt-0.5 inline-flex items-center gap-1 font-medium text-gray-900 dark:text-white">
                            <x-heroicon-o-user-group class="h-4 w-4 text-success-500"/>
                            {{ $this->getAlumnosCount() }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════════════════════
             Leyenda de uso
        ══════════════════════════════════════════════════════════════════════ --}}
        <div class="flex items-center gap-2 rounded-lg border border-info-200 bg-info-50 px-4 py-2 text-xs text-info-700 dark:border-info-800 dark:bg-info-950 dark:text-info-300">
            <x-heroicon-o-information-circle class="h-4 w-4 flex-shrink-0"/>
            <span>Seleccioná la <strong>materia</strong> y el <strong>docente</strong> en cada celda, luego presioná <strong>Guardar</strong>. Para vaciar una celda, dejá ambos campos en blanco y guardá.</span>
        </div>

        {{-- ═══════════════════════════════════════════════════════════════════
             Grilla de horarios — 7 horas × 5 días
        ══════════════════════════════════════════════════════════════════════ --}}
        <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b-2 border-primary-200 dark:border-primary-800">
                        {{-- Columna de hora --}}
                        <th class="w-28 bg-primary-50 px-3 py-3 text-left font-bold text-primary-700 dark:bg-primary-950 dark:text-primary-300">
                            Hora
                        </th>
                        {{-- Columnas de días --}}
                        @foreach($dias as $dia)
                            <th class="bg-primary-50 px-3 py-3 text-center font-bold text-primary-700 dark:bg-primary-950 dark:text-primary-300">
                                {{ $dia }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($horas as $hora)
                        <tr class="border-b border-gray-100 last:border-0 dark:border-gray-700">

                            {{-- Columna de hora cátedra --}}
                            <td class="bg-gray-50 px-3 py-2 align-middle dark:bg-gray-900">
                                <div class="font-bold text-gray-700 dark:text-gray-200">
                                    {{ $etiquetas[$hora] }}
                                </div>
                                <div class="mt-0.5 text-xs text-gray-400">
                                    {{ $bloques[$hora] }}
                                </div>
                            </td>

                            {{-- Celdas de cada día --}}
                            @foreach($dias as $dia)
                                @php
                                    $key   = "{$dia}_{$hora}";
                                    $celda = $grilla[$key] ?? ['horario_id' => null, 'materia_id' => null, 'docente_id' => null];
                                    $tieneHorario = ! is_null($celda['horario_id']);
                                @endphp

                                <td class="px-2 py-2 align-top transition-colors hover:bg-gray-50 dark:hover:bg-gray-700/50">

                                    {{-- Alpine.js maneja el estado local de cada celda de forma independiente --}}
                                    <div
                                        class="space-y-1.5"
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
                                        {{-- Indicador visual: celda con horario asignado --}}
                                        <div
                                            x-show="materia_id && docente_id && !modificado"
                                            class="mb-1 rounded bg-success-50 px-1.5 py-0.5 text-center text-xs font-medium text-success-700 dark:bg-success-950 dark:text-success-300"
                                        >
                                            ✓ Asignado
                                        </div>

                                        {{-- Select: Materia --}}
                                        <select
                                            x-model="materia_id"
                                            class="w-full rounded-lg border border-gray-300 bg-white px-2 py-1.5 text-xs text-gray-700 shadow-sm transition focus:border-primary-500 focus:ring-1 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"
                                        >
                                            <option value="">— Materia —</option>
                                            @foreach($materias as $id => $nombre)
                                                <option value="{{ $id }}" @selected($celda['materia_id'] == $id)>
                                                    {{ $nombre }}
                                                </option>
                                            @endforeach
                                        </select>

                                        {{-- Select: Docente --}}
                                        <select
                                            x-model="docente_id"
                                            class="w-full rounded-lg border border-gray-300 bg-white px-2 py-1.5 text-xs text-gray-700 shadow-sm transition focus:border-primary-500 focus:ring-1 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"
                                        >
                                            <option value="">— Docente —</option>
                                            @foreach($docentes as $id => $nombre)
                                                <option value="{{ $id }}" @selected($celda['docente_id'] == $id)>
                                                    {{ $nombre }}
                                                </option>
                                            @endforeach
                                        </select>

                                        {{-- Botón Guardar --}}
                                        <button
                                            @click="guardar()"
                                            :disabled="guardando"
                                            :class="modificado
                                                ? 'bg-warning-500 hover:bg-warning-600'
                                                : 'bg-primary-600 hover:bg-primary-700'"
                                            class="w-full rounded-lg px-2 py-1 text-xs font-medium text-white transition disabled:opacity-50"
                                        >
                                            <span x-show="!guardando" x-cloak>
                                                <span x-show="modificado">⚡ Guardar cambios</span>
                                                <span x-show="!modificado">Guardar</span>
                                            </span>
                                            <span x-show="guardando" x-cloak>Guardando...</span>
                                        </button>
                                    </div>

                                </td>
                            @endforeach

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pie de página --}}
        <p class="text-right text-xs text-gray-400 dark:text-gray-500">
            Última actualización: {{ now()->format('d/m/Y H:i') }}
        </p>

    </div>
</x-filament-panels::page>
