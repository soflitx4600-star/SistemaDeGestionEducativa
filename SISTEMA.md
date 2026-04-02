# Sistema de Gestión Educativa — Documentación Técnica

> Sistema interno para uso exclusivo de **preceptores y directivos**. No tiene inicio de sesión de alumnos ni docentes.
> Panel administrativo construido con **Laravel 11 + Filament v4**.

---

## Tabla de Contenidos

1. [Stack Tecnológico](#1-stack-tecnológico)
2. [Estructura de Base de Datos](#2-estructura-de-base-de-datos)
3. [Relaciones entre Modelos](#3-relaciones-entre-modelos)
4. [Enums del Sistema](#4-enums-del-sistema)
5. [Recursos Filament (Panel)](#5-recursos-filament-panel)
6. [Diagrama de Relaciones](#6-diagrama-de-relaciones)

---

## 1. Stack Tecnológico

| Capa | Tecnología |
|------|-----------|
| Backend | Laravel 11 (PHP) |
| Panel Admin | Filament v4 |
| Base de Datos | MySQL / SQLite (tests) |
| Almacenamiento fotos | Disco `public` (Laravel Storage) |
| Frontend (si aplica) | Next.js (separado) |

---

## 2. Estructura de Base de Datos

### Orden de ejecución de migraciones

```
0001_01_01_000000  create_users_table           ← usuarios del panel (preceptores/directivos)
0001_01_01_000001  create_cache_table
0001_01_01_000002  create_jobs_table
2026_03_28_212853  create_alumnos_table
2026_03_28_212940  create_ficha_legajos_table   ← depende de alumnos
2026_03_28_213049  create_docentes_table
2026_03_28_213236  create_plan_de_estudios_table
2026_03_28_214438  create_materias_table        ← depende de plan_de_estudios
2026_03_28_214513  create_cursos_table          ← depende de plan_de_estudios
2026_03_28_220000  create_tutores_table
2026_03_28_220001  create_alumno_tutor_table    ← pivot alumnos <-> tutores
2026_03_28_220002  create_documentos_legajo_table ← depende de ficha_legajos + users
2026_03_28_220004  create_historial_academico_table ← depende de alumnos + materias + cursos
2026_03_28_220005  create_configuraciones_sistema_table
2026_03_28_220006  create_docente_materia_table ← pivot docentes <-> materias
2026_07_01_000002  create_horarios_table        ← depende de cursos + materias + docentes
```

---

### Detalle de cada tabla

#### `users`
Usuarios del panel (preceptores, directivos). Gestionados por Laravel Breeze / Filament Auth.

| Campo | Tipo | Notas |
|-------|------|-------|
| id | bigint PK | |
| name | string | |
| email | string unique | |
| password | string | |
| timestamps | | |

---

#### `alumnos`
Alumnos del establecimiento. **No tienen acceso al sistema.**

| Campo | Tipo | Notas |
|-------|------|-------|
| id | bigint PK | |
| nombre | string(100) | |
| apellido | string(100) | |
| dni | string(15) unique | |
| cuil | string(20) unique nullable | |
| fecha_nacimiento | date | |
| genero | enum | `masculino`, `femenino`, `otro` |
| domicilio | string(255) | |
| telefono | string(20) nullable | |
| email | string(150) unique nullable | |
| foto | string nullable | path en disco `public/fotos/alumnos` |
| estado | enum | ver `EstadoAlumno` |
| timestamps | | |

---

#### `ficha_legajos`
Una ficha por alumno. Contiene el número de legajo y agrupa sus documentos.

| Campo | Tipo | Notas |
|-------|------|-------|
| id | bigint PK | |
| alumno_id | FK → alumnos | unique (1:1) · cascadeOnDelete |
| numero_legajo | string(30) unique | |
| fecha_apertura | date | |
| observaciones | text nullable | |
| timestamps | | |

---

#### `docentes`
Docentes del establecimiento. **No tienen acceso al sistema.**

| Campo | Tipo | Notas |
|-------|------|-------|
| id | bigint PK | |
| nombre | string(100) | |
| apellido | string(100) | |
| dni | string(15) unique | |
| cuil | string(20) unique nullable | |
| telefono | string(20) nullable | |
| email | string(150) unique nullable | |
| titulo | string(150) nullable | |
| localidad | string(255) nullable | |
| foto | string nullable | path en disco `public/fotos/docentes` |
| timestamps | | |

---

#### `plan_de_estudios`
Planes de estudio (ej: "Técnico en Informática — Res. 12345/22").

| Campo | Tipo | Notas |
|-------|------|-------|
| id | bigint PK | |
| nombre | string(150) | |
| descripcion | text nullable | |
| resolucion_numero | string(50) nullable | |
| ciclo_lectivo_vigencia | year nullable | |
| is_active | boolean | default true |
| timestamps | | |

---

#### `materias`
Materias pertenecientes a un plan de estudios.

| Campo | Tipo | Notas |
|-------|------|-------|
| id | bigint PK | |
| plan_de_estudio_id | FK → plan_de_estudios | cascadeOnDelete |
| nombre | string(150) | |
| ciclo | enum | `comun`, `orientado` |
| anio_cursado | tinyint unsigned | año del plan (1, 2, 3…) |
| horas_semanales | tinyint unsigned nullable | |
| timestamps | | |

---

#### `cursos`
Comisiones anuales (ej: "1° A — Mañana — 2026").

| Campo | Tipo | Notas |
|-------|------|-------|
| id | bigint PK | |
| plan_de_estudio_id | FK → plan_de_estudios | cascadeOnDelete |
| anio | tinyint unsigned | año del cursado (1, 2, 3…) |
| division | string(10) | `A`, `B`, `7ma`, etc. |
| turno | enum | `Mañana`, `Tarde` |
| preceptor | string nullable | nombre del preceptor asignado |
| ciclo_lectivo | year | |
| cupo_maximo | smallint unsigned | default 30 |
| timestamps | | |

> **UNIQUE:** `(anio, division, ciclo_lectivo)`

---

#### `tutores`
Padres / tutores legales de los alumnos.

| Campo | Tipo | Notas |
|-------|------|-------|
| id | bigint PK | |
| nombre | string(100) | |
| apellido | string(100) | |
| dni | string(15) unique | |
| cuil | string(20) unique nullable | |
| parentesco | enum | `padre`, `madre`, `tutor_legal`, `otro` |
| telefono | string(20) nullable | |
| email | string(150) nullable | |
| domicilio | string(255) nullable | |
| timestamps | | |

---

#### `alumno_tutor` *(pivot)*
Relación muchos a muchos entre alumnos y tutores.

| Campo | Tipo | Notas |
|-------|------|-------|
| alumno_id | FK → alumnos | PK compuesta · cascadeOnDelete |
| tutor_id | FK → tutores | PK compuesta · cascadeOnDelete |
| es_responsable_principal | boolean | default false |
| timestamps | | |

---

#### `documentos_legajo`
Documentos adjuntos a una ficha de legajo.

| Campo | Tipo | Notas |
|-------|------|-------|
| id | bigint PK | |
| ficha_legajo_id | FK → ficha_legajos | cascadeOnDelete |
| tipo_documento | enum | ver `TipoDocumento` |
| archivo_path | string(500) nullable | |
| estado | enum | ver `EstadoDocumento` · default `pendiente` |
| fecha_vencimiento | date nullable | solo para Constancia Alumno Regular |
| validado_por | FK → users nullable | nullOnDelete |
| validado_at | timestamp nullable | |
| timestamps | | |

> **UNIQUE:** `(ficha_legajo_id, tipo_documento)`

---

#### `historial_academico`
Registro por alumno × materia × ciclo lectivo.

| Campo | Tipo | Notas |
|-------|------|-------|
| id | bigint PK | |
| alumno_id | FK → alumnos | cascadeOnDelete |
| materia_id | FK → materias | cascadeOnDelete |
| curso_id | FK → cursos | cascadeOnDelete |
| ciclo_lectivo | year | |
| estado | enum | ver `EstadoHistorial` · default `cursando` |
| nota_cursada | decimal(4,2) nullable | |
| nota_final | decimal(4,2) nullable | |
| timestamps | | |

> **UNIQUE:** `(alumno_id, materia_id, ciclo_lectivo)`
> **INDEX:** `(alumno_id, estado)` — para consultas de previas eficientes

---

#### `docente_materia` *(pivot)*
Relación muchos a muchos entre docentes y materias por ciclo lectivo.

| Campo | Tipo | Notas |
|-------|------|-------|
| id | bigint PK | |
| docente_id | FK → docentes | cascadeOnDelete |
| materia_id | FK → materias | cascadeOnDelete |
| ciclo_lectivo | year | |
| es_titular | boolean | default true |
| timestamps | | |

> **UNIQUE:** `(docente_id, materia_id, ciclo_lectivo)`

---

#### `horarios`
Grilla horaria semanal de un curso.

| Campo | Tipo | Notas |
|-------|------|-------|
| id | bigint PK | |
| curso_id | FK → cursos | cascadeOnDelete |
| materia_id | FK → materias | cascadeOnDelete |
| docente_id | FK → docentes | cascadeOnDelete |
| dia_semana | enum | `Lunes`, `Martes`, `Miércoles`, `Jueves`, `Viernes` |
| hora_catedra | tinyint unsigned | 1 a 7 |
| timestamps | | |

> **UNIQUE:** `(curso_id, dia_semana, hora_catedra)` — una celda = una materia

Bloques horarios (turno tarde, 40 min c/u):
`1: 13:30–14:10 · 2: 14:10–14:50 · 3: 14:50–15:30 · 4: 15:30–16:10 · 5: 16:10–16:50 · 6: 16:50–17:30 · 7: 17:30–18:10`

---

#### `configuraciones_sistema`
Parámetros globales configurables desde el panel.

| Campo | Tipo | Notas |
|-------|------|-------|
| id | bigint PK | |
| clave | string(100) unique | |
| valor | string(255) | |
| descripcion | text nullable | |
| timestamps | | |

Valor inicial seeded: `max_previas_permitidas = 2`

---

## 3. Relaciones entre Modelos

### `Alumno`
| Relación | Tipo | Modelo relacionado |
|----------|------|--------------------|
| `fichaLegajo` | hasOne | `FichaLegajo` |
| `tutores` | belongsToMany | `Tutor` (pivot: `alumno_tutor`) |
| `historialAcademico` | hasMany | `HistorialAcademico` |

Accessor: `$alumno->nombre_completo` → `"Apellido, Nombre"`

---

### `FichaLegajo`
| Relación | Tipo | Modelo relacionado |
|----------|------|--------------------|
| `alumno` | belongsTo | `Alumno` |
| `documentos` | hasMany | `DocumentoLegajo` |

Accessor: `$ficha->legajo_completo` → `bool` (todos los documentos validados)

---

### `DocumentoLegajo`
| Relación | Tipo | Modelo relacionado |
|----------|------|--------------------|
| `fichaLegajo` | belongsTo | `FichaLegajo` |
| `validador` | belongsTo | `User` (FK: `validado_por`) |

---

### `Tutor`
| Relación | Tipo | Modelo relacionado |
|----------|------|--------------------|
| `alumnos` | belongsToMany | `Alumno` (pivot: `alumno_tutor`) |

Accessor: `$tutor->nombre_completo`

---

### `PlanDeEstudio`
| Relación | Tipo | Modelo relacionado |
|----------|------|--------------------|
| `materias` | hasMany | `Materia` |
| `cursos` | hasMany | `Curso` |

---

### `Materia`
| Relación | Tipo | Modelo relacionado |
|----------|------|--------------------|
| `planDeEstudio` | belongsTo | `PlanDeEstudio` |
| `historialAcademico` | hasMany | `HistorialAcademico` |
| `docentes` | belongsToMany | `Docente` (pivot: `docente_materia`) |

Scopes: `scopeDelAnio($anio)`, `scopeCicloComun()`, `scopeCicloOrientado()`

---

### `Curso`
| Relación | Tipo | Modelo relacionado |
|----------|------|--------------------|
| `planDeEstudio` | belongsTo | `PlanDeEstudio` |
| `historialAcademico` | hasMany | `HistorialAcademico` |
| `horarios` | hasMany | `Horario` |

Accessor: `$curso->titulo` → `"1° A — Turno Mañana (2026)"`
Accessor: `$curso->alumnos_count` → cantidad de alumnos distintos en el historial del curso

---

### `Docente`
| Relación | Tipo | Modelo relacionado |
|----------|------|--------------------|
| `materias` | belongsToMany | `Materia` (pivot: `docente_materia`) |

Accessor: `$docente->nombre_completo`

---

### `HistorialAcademico`
| Relación | Tipo | Modelo relacionado |
|----------|------|--------------------|
| `alumno` | belongsTo | `Alumno` |
| `materia` | belongsTo | `Materia` |
| `curso` | belongsTo | `Curso` |

Scopes: `scopePrevias()`, `scopeAprobadas()`, `scopeDelAnio($anio)`

---

### `Horario`
| Relación | Tipo | Modelo relacionado |
|----------|------|--------------------|
| `curso` | belongsTo | `Curso` |
| `materia` | belongsTo | `Materia` |
| `docente` | belongsTo | `Docente` |

---

### `ConfiguracionSistema`
Sin relaciones. Acceso estático vía:
```php
ConfiguracionSistema::obtener('max_previas_permitidas', 2);
ConfiguracionSistema::establecer('max_previas_permitidas', '3');
```
Usa cache de 1 hora por clave.

---

## 4. Enums del Sistema

### `EstadoAlumno`
| Valor | Label |
|-------|-------|
| `preinscripto` | Preinscripto |
| `sorteado` | Sorteado |
| `inscripto` | Inscripto |
| `egresado` | Egresado |
| `abandono` | Abandono |
| `suspendido` | Suspendido |

### `EstadoHistorial`
| Valor | Label |
|-------|-------|
| `cursando` | Cursando |
| `aprobada` | Aprobada |
| `desaprobada` | Desaprobada |
| `previa` | Previa |
| `libre` | Libre |

### `EstadoDocumento`
| Valor | Label |
|-------|-------|
| `pendiente` | Pendiente |
| `adjunto` | Adjunto (sin validar) |
| `validado` | Validado |
| `rechazado` | Rechazado |

### `TipoDocumento`
| Valor | Label | ¿Tiene vencimiento? |
|-------|-------|---------------------|
| `dni_alumno` | DNI del Alumno | No |
| `dni_tutor` | DNI del Tutor | No |
| `cuil_alumno` | Constancia de CUIL del Alumno | No |
| `cuil_tutor` | Constancia de CUIL del Tutor | No |
| `constancia_alumno_regular` | Constancia de Alumno Regular | **Sí** |
| `certificado_7mo_grado` | Certificado de 7mo Grado | No |

---

## 5. Recursos Filament (Panel)

### Navegación

| Grupo | Recurso | Navegación Label | Páginas disponibles |
|-------|---------|-----------------|---------------------|
| **Gestión Académica** | `AlumnoResource` | Alumnos | list, create, edit |
| **Gestión Académica** | `CursoResource` | Cursos | list, create, view, edit, grilla-horario |
| **Gestión Académica** | `HistorialAcademicoResource` | Historial Académico | list, create, edit |
| **Gestión de Materias** | `PlanDeEstudioResource` | Planes de Estudio | list, create, view, edit |
| **Gestión de Materias** | `MateriaResource` | Materias | list, create, edit |
| **Personal** | `DocenteResource` | Docentes | list, create, edit |
| **Personal** | `TutorResource` | Tutores | list, create, view, edit |
| *(sin grupo)* | `ConfiguracionSistemaResource` | Configuración | list, create, edit |

### Página especial: Grilla Horaria
`CursoResource` tiene una página personalizada `GrillaHorario` accesible en `/cursos/{record}/horario`.
Permite gestionar la grilla semanal (día × hora cátedra) del curso.

### Estructura de cada Resource
Cada resource sigue la convención:
```
app/Filament/Resources/{Nombre}/
    {Nombre}Resource.php        ← definición principal
    Pages/                      ← List, Create, Edit, View (si aplica)
    Schemas/
        {Nombre}Form.php        ← campos del formulario
        {Nombre}Infolist.php    ← vista detalle (solo en algunos)
    Tables/
        {Nombre}Table.php       ← columnas, filtros, acciones
```

---

## 6. Diagrama de Relaciones

```
users ──────────────────────────────────────────────────────────────┐
                                                                     │ validado_por
plan_de_estudios                                                     │
    ├── materias ──────────────────────────────────────────────┐    │
    │       └── docente_materia (pivot) ←── docentes           │    │
    └── cursos                                                  │    │
            ├── historial_academico ←── alumnos ←──────────────┘    │
            │                                                        │
            └── horarios ←── materias                               │
                         ←── docentes                               │

alumnos                                                             │
    ├── ficha_legajos                                               │
    │       └── documentos_legajo ──────────────────────────────────┘
    ├── alumno_tutor (pivot) ←── tutores
    └── historial_academico

configuraciones_sistema  (standalone, sin FK)
```

---

*Generado el 2 de abril de 2026.*
