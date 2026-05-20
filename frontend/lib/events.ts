export interface Evento {
  id: number;
  dia: number;
  mes: string;
  mesNum: number;
  anio: number;
  titulo: string;
  desc: string;
  body: string;
  lugar: string;
  color: string;
  textColor: string;
  imagen?: string;
  destacado?: boolean;
}

export const EVENTOS: Evento[] = [
  { id: 1,  dia: 20, mes: 'Marzo',  mesNum: 3, anio: 2026, titulo: 'Inicio de Clases 2026', desc: 'Comienzo del nuevo ciclo lectivo para todos los niveles.', body: 'El ciclo lectivo 2026 comenzará con una jornada de ambientación para los nuevos ingresantes. Los alumnos de años superiores retoman las actividades académicas regulares. Se distribuirán los horarios definitivos y se presentarán los equipos docentes de cada área.', lugar: 'Turno Mañana y Tarde', color: 'bg-[#735c00]', textColor: 'text-white', imagen: '/fotos-institucion/institucion-interior.png', destacado: true },
  { id: 2,  dia: 25, mes: 'Marzo',  mesNum: 3, anio: 2026, titulo: 'Acto de Bienvenida', desc: 'Recepción oficial de los nuevos ingresantes al colegio.', body: 'El acto de bienvenida recibirá a los alumnos de primer año con una ceremonia en el patio central. Participarán autoridades, docentes y el centro de estudiantes. Los nuevos alumnos recibirán su credencial institucional y el reglamento escolar.', lugar: 'Patio Central', color: 'bg-[#002045]', textColor: 'text-white' },
  { id: 3,  dia: 2,  mes: 'Abril',  mesNum: 4, anio: 2026, titulo: 'Acto 2 de Abril', desc: 'Conmemoración del Día del Veterano y de los Caídos en Malvinas.', body: 'La institución realizará un acto cívico en homenaje a los veteranos y caídos en la Guerra de Malvinas. Participarán alumnos de todos los años con lecturas, canciones y reflexiones. Se invitará a veteranos de la provincia a compartir su testimonio con los estudiantes.', lugar: 'Patio Central', color: 'bg-[#1a365d]', textColor: 'text-white', imagen: '/fotos-actividades/acto_bandera.png', destacado: true },
  { id: 4,  dia: 15, mes: 'Abril', mesNum: 4, anio: 2026, titulo: 'Feria de Ciencias', desc: 'Presentación de proyectos científicos de ciclo orientado.', body: 'La Feria de Ciencias 2026 convocará a equipos de alumnos de 4to, 5to y 6to año para presentar proyectos de investigación en áreas de biología, física, química y tecnología. Un jurado especializado seleccionará los mejores trabajos para la instancia provincial.', lugar: 'Laboratorio y Aulas', color: 'bg-[#fed65b]', textColor: 'text-[#002045]', imagen: '/fotos-actividades/feria.jpeg', destacado: true },
  { id: 5,  dia: 25, mes: 'Abril', mesNum: 4, anio: 2026, titulo: 'Reunión de Padres', desc: 'Encuentro informativo sobre el desempeño académico del primer trimestre.', body: 'La reunión de padres del primer trimestre abordará los resultados académicos y el comportamiento general de los alumnos. Los docentes estarán disponibles para consultas individuales. Se informará sobre actividades planificadas para el segundo trimestre.', lugar: 'Aula Magna', color: 'bg-[#735c00]', textColor: 'text-white' },
  { id: 6,  dia: 10, mes: 'Mayo',   mesNum: 5, anio: 2026, titulo: 'Acto 25 de Mayo', desc: 'Celebración del Día de la Patria con acto escolar.', body: 'El acto del 25 de Mayo contará con la participación de todos los cursos. Se realizarán presentaciones artísticas, danzas folklóricas y lecturas alusivas a la Revolución de Mayo. Las familias están invitadas a participar de esta celebración patria.', lugar: 'Patio Central', color: 'bg-[#002045]', textColor: 'text-white', imagen: '/fotos-actividades/unodemayo.jpeg', destacado: true },
  { id: 7,  dia: 20, mes: 'Mayo',   mesNum: 5, anio: 2026, titulo: 'Torneo Deportivo', desc: 'Competencia intercolegial de atletismo y fútbol sala.', body: 'El torneo deportivo intercolegial enfrentará a los mejores equipos del colegio en atletismo, fútbol sala y vóley. Participarán alumnos de ciclo básico y orientado. Los ganadores representarán a la institución en el torneo provincial.', lugar: 'Cancha Principal', color: 'bg-[#fed65b]', textColor: 'text-[#002045]', imagen: '/fotos-actividades/futbol.jpeg' },
  { id: 8,  dia: 5,  mes: 'Junio',  mesNum: 6, anio: 2026, titulo: 'Día del Medio Ambiente', desc: 'Jornada de concientización ambiental con actividades al aire libre.', body: 'En el marco del Día Mundial del Medio Ambiente, el colegio organizará una jornada de plantación de árboles, talleres de reciclaje y charlas sobre sustentabilidad. Los alumnos del taller de ciencias presentarán sus proyectos ambientales.', lugar: 'Patio y Jardín', color: 'bg-[#003f25]', textColor: 'text-white' },
  { id: 9,  dia: 20, mes: 'Junio',  mesNum: 6, anio: 2026, titulo: 'Acto 20 de Junio', desc: 'Homenaje al Día de la Bandera Nacional.', body: 'El acto del Día de la Bandera rendirá homenaje al General Manuel Belgrano. Los alumnos abanderados encabezarán la ceremonia con la escolta oficial. Se realizarán lecturas y canciones patrias en honor a la creación de la bandera argentina.', lugar: 'Patio Central', color: 'bg-[#1a365d]', textColor: 'text-white', imagen: '/fotos-actividades/acto_bandera.png', destacado: true },
  { id: 10, dia: 15, mes: 'Julio',  mesNum: 7, anio: 2026, titulo: 'Muestra Cultural', desc: 'Exposición de trabajos artísticos y proyectos de los alumnos.', body: 'La muestra cultural de mitad de año reunirá obras de arte, fotografías y proyectos tecnológicos realizados por alumnos de todos los años. La exposición estará abierta al público durante dos días con visitas guiadas para familias y colegios invitados.', lugar: 'Galería de Arte Central', color: 'bg-[#735c00]', textColor: 'text-white', imagen: '/fotos-actividades/ocho.jpeg', destacado: true },
];

export function getMonthlyHighlights() {
  const ordenados = [...EVENTOS].sort((a, b) => {
    if (a.anio !== b.anio) return a.anio - b.anio;
    if (a.mesNum !== b.mesNum) return a.mesNum - b.mesNum;
    return a.dia - b.dia;
  });

  const destacados = new Map<string, Evento>();
  ordenados.forEach((evento) => {
    const clave = `${evento.anio}-${String(evento.mesNum).padStart(2, '0')}`;
    if (!destacados.has(clave)) {
      destacados.set(clave, evento);
    }
  });

  return Array.from(destacados.values());
}

export function getEventoById(id: number) {
  return EVENTOS.find((evento) => evento.id === id);
}
