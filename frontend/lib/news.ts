export interface NewsItem {
  id: number;
  tag: string;
  date: string;
  title: string;
  excerpt: string;
  body: string;
  image: string;
  imageAlt: string;
}

export const NEWS: NewsItem[] = [
  {
    id: 1,
    tag: 'Ciencias',
    date: '15 Oct, 2023',
    title: 'Feria de Innovación y Tecnología 2023',
    excerpt: 'Estudiantes de ciclo orientado presentaron proyectos de robótica aplicada a la sustentabilidad urbana.',
    body: 'Estudiantes de ciclo orientado presentaron proyectos de robótica aplicada a la sustentabilidad urbana. Durante tres días, más de 40 equipos expusieron sus desarrollos ante un jurado compuesto por docentes, ingenieros y representantes de empresas tecnológicas de la región. Los proyectos abarcaron desde sistemas de riego inteligente hasta prototipos de clasificación de residuos con visión artificial. La feria contó con la participación de más de 500 visitantes entre familias, alumnos de otras instituciones y autoridades educativas.',
    image: '/fotos-actividades/acto_bandera.png',
    imageAlt: 'Feria de ciencias',
  },
  {
    id: 2,
    tag: 'Deportes',
    date: '12 Oct, 2023',
    title: 'Finales Intercolegiales de Atletismo',
    excerpt: 'Nuestros atletas destacaron en las competencias regionales obteniendo el primer puesto en relevos.',
    body: 'Nuestros atletas destacaron en las competencias regionales obteniendo el primer puesto en relevos. El equipo de atletismo de la institución participó en las finales intercolegiales celebradas en el estadio municipal, donde compitieron más de 20 escuelas de la provincia. Además del primer puesto en la prueba de relevos 4×100, se obtuvieron medallas en salto en largo y lanzamiento de bala. El entrenador destacó el esfuerzo y la dedicación del grupo durante todo el año.',
    image: '/fotos-actividades/campaña.png',
    imageAlt: 'Deportes',
  },
  {
    id: 3,
    tag: 'Cultura',
    date: '08 Oct, 2023',
    title: 'Nueva Biblioteca Digital Institucional',
    excerpt: 'Inauguramos el acceso a más de 5.000 títulos académicos para todos nuestros alumnos y familias.',
    body: 'Inauguramos el acceso a más de 5.000 títulos académicos para todos nuestros alumnos y familias. La nueva plataforma de biblioteca digital permite el acceso remoto a libros de texto, revistas científicas y material audiovisual desde cualquier dispositivo. El proyecto fue desarrollado en colaboración con el Ministerio de Educación y una red de editoriales nacionales. Cada alumno cuenta con credenciales personales y los docentes pueden crear listas de lectura personalizadas por materia y nivel.',
    image: '/fotos-actividades/eleccion_reina.png',
    imageAlt: 'Cultura',
  },
  {
    id: 4,
    tag: 'Comunidad',
    date: '02 Oct, 2023',
    title: 'Campaña Solidaria de Útiles Escolares',
    excerpt: 'Alumnos y familias se unieron para recolectar materiales escolares destinados a comunidades rurales.',
    body: 'Alumnos y familias se unieron para recolectar materiales escolares destinados a comunidades rurales de la provincia. Durante dos semanas, los estudiantes organizaron puntos de recolección en el colegio y en comercios del barrio. Se reunieron más de 800 kits de útiles que fueron distribuidos en escuelas primarias de la Puna jujeña. La iniciativa fue reconocida por el Ministerio de Educación provincial como ejemplo de responsabilidad social estudiantil.',
    image: '/fotos-actividades/acto_bandera.png',
    imageAlt: 'Campaña solidaria',
  },
  {
    id: 5,
    tag: 'Institucional',
    date: '25 Sep, 2023',
    title: 'Acto por el Día del Maestro',
    excerpt: 'La institución homenajeó a sus docentes con un emotivo acto en el salón principal.',
    body: 'La institución homenajeó a sus docentes con un emotivo acto en el salón principal. Alumnos de distintos años prepararon presentaciones artísticas, lecturas y videos en reconocimiento a la labor docente. Las autoridades del colegio entregaron distinciones a los maestros con mayor trayectoria en la institución. El acto contó con la presencia de familias y ex alumnos que se sumaron al homenaje.',
    image: '/fotos-actividades/eleccion_reina.png',
    imageAlt: 'Acto institucional',
  },
  {
    id: 6,
    tag: 'Deportes',
    date: '18 Sep, 2023',
    title: 'Torneo Interno de Fútbol Sala',
    excerpt: 'Se disputó el torneo anual de fútbol sala entre los cursos del ciclo orientado.',
    body: 'Se disputó el torneo anual de fútbol sala entre los cursos del ciclo orientado. Participaron 12 equipos en una jornada de competencia que combinó deporte y compañerismo. El equipo de 5to año B se consagró campeón tras una final disputada contra 6to año A. El evento fue organizado por el departamento de Educación Física con el apoyo del centro de estudiantes.',
    image: '/fotos-actividades/campaña.png',
    imageAlt: 'Torneo de fútbol sala',
  },
  {
    id: 7,
    tag: 'Ciencias',
    date: '10 Sep, 2023',
    title: 'Visita al Observatorio Astronómico de Jujuy',
    excerpt: 'Estudiantes de 4to año realizaron una visita educativa al observatorio provincial.',
    body: 'Estudiantes de 4to año realizaron una visita educativa al observatorio astronómico provincial en el marco de la materia Física. Los alumnos pudieron observar el sistema solar a través de telescopios profesionales y participaron de talleres sobre astrofísica y exploración espacial. La actividad fue coordinada con investigadores del CONICET que brindaron charlas sobre los últimos avances en astronomía argentina.',
    image: '/fotos-actividades/acto_bandera.png',
    imageAlt: 'Visita al observatorio',
  },
  {
    id: 8,
    tag: 'Cultura',
    date: '01 Sep, 2023',
    title: 'Muestra de Arte "Identidad Jujeña"',
    excerpt: 'El taller de artes visuales expuso trabajos inspirados en la cultura y paisajes de Jujuy.',
    body: 'El taller de artes visuales expuso trabajos inspirados en la cultura y paisajes de Jujuy. La muestra reunió más de 60 obras entre pinturas, esculturas y fotografías realizadas por alumnos de todos los años. La exposición estuvo abierta al público durante una semana y recibió más de 300 visitantes. Varios trabajos fueron seleccionados para participar en el concurso provincial de arte estudiantil.',
    image: '/fotos-actividades/eleccion_reina.png',
    imageAlt: 'Muestra de arte',
  },
];

export const TAGS = ['Todos', ...Array.from(new Set(NEWS.map(n => n.tag)))];
