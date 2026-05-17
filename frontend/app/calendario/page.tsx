'use client';
import { useState } from 'react';
import { motion, AnimatePresence } from 'motion/react';

interface Evento {
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

const EVENTOS: Evento[] = [
  { id: 1,  dia: 20, mes: 'Marzo',     mesNum: 3,  anio: 2026, titulo: 'Inicio de Clases 2026', desc: 'Comienzo del nuevo ciclo lectivo para todos los niveles.', body: 'El ciclo lectivo 2026 comenzará con una jornada de ambientación para los nuevos ingresantes. Los alumnos de años superiores retoman las actividades académicas regulares. Se distribuirán los horarios definitivos y se presentarán los equipos docentes de cada área.', lugar: 'Turno Mañana y Tarde', color: 'bg-[#735c00]', textColor: 'text-white', imagen: '/fotos-institucion/institucion-interior.png', destacado: true },
  { id: 2,  dia: 25, mes: 'Marzo',     mesNum: 3,  anio: 2026, titulo: 'Acto de Bienvenida', desc: 'Recepción oficial de los nuevos ingresantes al colegio.', body: 'El acto de bienvenida recibirá a los alumnos de primer año con una ceremonia en el patio central. Participarán autoridades, docentes y el centro de estudiantes. Los nuevos alumnos recibirán su credencial institucional y el reglamento escolar.', lugar: 'Patio Central', color: 'bg-[#002045]', textColor: 'text-white' },
  { id: 3,  dia: 2,  mes: 'Abril',     mesNum: 4,  anio: 2026, titulo: 'Acto 2 de Abril', desc: 'Conmemoración del Día del Veterano y de los Caídos en Malvinas.', body: 'La institución realizará un acto cívico en homenaje a los veteranos y caídos en la Guerra de Malvinas. Participarán alumnos de todos los años con lecturas, canciones y reflexiones. Se invitará a veteranos de la provincia a compartir su testimonio con los estudiantes.', lugar: 'Patio Central', color: 'bg-[#1a365d]', textColor: 'text-white', imagen: '/fotos-actividades/acto_bandera.png', destacado: true },
  { id: 4,  dia: 15, mes: 'Abril',     mesNum: 4,  anio: 2026, titulo: 'Feria de Ciencias', desc: 'Presentación de proyectos científicos de ciclo orientado.', body: 'La Feria de Ciencias 2026 convocará a equipos de alumnos de 4to, 5to y 6to año para presentar proyectos de investigación en áreas de biología, física, química y tecnología. Un jurado especializado seleccionará los mejores trabajos para la instancia provincial.', lugar: 'Laboratorio y Aulas', color: 'bg-[#fed65b]', textColor: 'text-[#002045]', imagen: '/fotos-actividades/feria.jpeg', destacado: true },
  { id: 5,  dia: 25, mes: 'Abril',     mesNum: 4,  anio: 2026, titulo: 'Reunión de Padres', desc: 'Encuentro informativo sobre el desempeño académico del primer trimestre.', body: 'La reunión de padres del primer trimestre abordará los resultados académicos y el comportamiento general de los alumnos. Los docentes estarán disponibles para consultas individuales. Se informará sobre actividades planificadas para el segundo trimestre.', lugar: 'Aula Magna', color: 'bg-[#735c00]', textColor: 'text-white' },
  { id: 6,  dia: 10, mes: 'Mayo',      mesNum: 5,  anio: 2026, titulo: 'Acto 25 de Mayo', desc: 'Celebración del Día de la Patria con acto escolar.', body: 'El acto del 25 de Mayo contará con la participación de todos los cursos. Se realizarán presentaciones artísticas, danzas folklóricas y lecturas alusivas a la Revolución de Mayo. Las familias están invitadas a participar de esta celebración patria.', lugar: 'Patio Central', color: 'bg-[#002045]', textColor: 'text-white', imagen: '/fotos-actividades/unodemayo.jpeg', destacado: true },
  { id: 7,  dia: 20, mes: 'Mayo',      mesNum: 5,  anio: 2026, titulo: 'Torneo Deportivo', desc: 'Competencia intercolegial de atletismo y fútbol sala.', body: 'El torneo deportivo intercolegial enfrentará a los mejores equipos del colegio en atletismo, fútbol sala y vóley. Participarán alumnos de ciclo básico y orientado. Los ganadores representarán a la institución en el torneo provincial.', lugar: 'Cancha Principal', color: 'bg-[#fed65b]', textColor: 'text-[#002045]', imagen: '/fotos-actividades/futbol.jpeg' },
  { id: 8,  dia: 5,  mes: 'Junio',     mesNum: 6,  anio: 2026, titulo: 'Día del Medio Ambiente', desc: 'Jornada de concientización ambiental con actividades al aire libre.', body: 'En el marco del Día Mundial del Medio Ambiente, el colegio organizará una jornada de plantación de árboles, talleres de reciclaje y charlas sobre sustentabilidad. Los alumnos del taller de ciencias presentarán sus proyectos ambientales.', lugar: 'Patio y Jardín', color: 'bg-[#003f25]', textColor: 'text-white' },
  { id: 9,  dia: 20, mes: 'Junio',     mesNum: 6,  anio: 2026, titulo: 'Acto 20 de Junio', desc: 'Homenaje al Día de la Bandera Nacional.', body: 'El acto del Día de la Bandera rendirá homenaje al General Manuel Belgrano. Los alumnos abanderados encabezarán la ceremonia con la escolta oficial. Se realizarán lecturas y canciones patrias en honor a la creación de la bandera argentina.', lugar: 'Patio Central', color: 'bg-[#1a365d]', textColor: 'text-white', imagen: '/fotos-actividades/acto_bandera.png', destacado: true },
  { id: 10, dia: 15, mes: 'Julio',     mesNum: 7,  anio: 2026, titulo: 'Muestra Cultural', desc: 'Exposición de trabajos artísticos y proyectos de los alumnos.', body: 'La muestra cultural de mitad de año reunirá obras de arte, fotografías y proyectos tecnológicos realizados por alumnos de todos los años. La exposición estará abierta al público durante dos días con visitas guiadas para familias y colegios invitados.', lugar: 'Galería de Arte Central', color: 'bg-[#735c00]', textColor: 'text-white', imagen: '/fotos-actividades/ocho.jpeg', destacado: true },
];

const MESES_DISPONIBLES = [...new Set(EVENTOS.map(e => e.mes))];
const ANIOS_DISPONIBLES = [...new Set(EVENTOS.map(e => e.anio))];

function fmtFecha(dia: number, mesNum: number) {
  return `${String(dia).padStart(2, '0')}.${String(mesNum).padStart(2, '0')}`;
}

export default function Calendario() {
  const [busqueda, setBusqueda] = useState('');
  const [mesFiltro, setMesFiltro] = useState('');
  const [anioFiltro, setAnioFiltro] = useState('');
  const [selected, setSelected] = useState<Evento | null>(null);

  const filtrados = EVENTOS.filter(e => {
    const matchBusqueda = e.titulo.toLowerCase().includes(busqueda.toLowerCase());
    const matchMes = mesFiltro ? e.mes === mesFiltro : true;
    const matchAnio = anioFiltro ? e.anio === Number(anioFiltro) : true;
    return matchBusqueda && matchMes && matchAnio;
  });

  const porMes = filtrados.reduce<Record<string, Evento[]>>((acc, e) => {
    const key = `${e.mes} ${e.anio}`;
    if (!acc[key]) acc[key] = [];
    acc[key].push(e);
    return acc;
  }, {});

  return (
    <div className="bg-[#f7fafc] font-['Inter'] min-h-screen">

      {/* Header */}
      <header className="bg-[#002045] pt-24 pb-10 px-6 md:px-12">
        <div className="max-w-7xl mx-auto">
          <div className="flex flex-col md:flex-row md:items-center gap-6 justify-between">
            <div>
              <span className="text-[#fed65b] font-bold tracking-[0.2em] uppercase text-xs mb-2 block">Agenda Institucional</span>
              <h1 className="font-['Manrope'] text-4xl md:text-5xl font-extrabold text-white tracking-tight">
                Calendario de <span className="text-[#fed65b]">Eventos</span>
              </h1>
            </div>
            <div className="flex flex-wrap gap-3 items-center">
              <input
                type="text"
                placeholder="Nombre del evento"
                value={busqueda}
                onChange={e => setBusqueda(e.target.value)}
                className="px-4 py-2.5 rounded-xl bg-white/10 text-white placeholder-white/50 border border-white/20 focus:outline-none focus:ring-2 focus:ring-[#fed65b] text-sm w-52"
              />
              <select value={mesFiltro} onChange={e => setMesFiltro(e.target.value)} className="px-4 py-2.5 rounded-xl bg-white/10 text-white border border-white/20 focus:outline-none focus:ring-2 focus:ring-[#fed65b] text-sm">
                <option value="">Mes</option>
                {MESES_DISPONIBLES.map(m => <option key={m} value={m} className="text-[#002045]">{m}</option>)}
              </select>
              <select value={anioFiltro} onChange={e => setAnioFiltro(e.target.value)} className="px-4 py-2.5 rounded-xl bg-white/10 text-white border border-white/20 focus:outline-none focus:ring-2 focus:ring-[#fed65b] text-sm">
                <option value="">Año</option>
                {ANIOS_DISPONIBLES.map(a => <option key={a} value={a} className="text-[#002045]">{a}</option>)}
              </select>
              <button className="w-10 h-10 rounded-xl bg-[#fed65b] flex items-center justify-center hover:bg-[#735c00] transition">
                <span className="material-symbols-outlined text-[#002045]">search</span>
              </button>
            </div>
          </div>
        </div>
      </header>

      {/* Contenido por mes */}
      <main className="max-w-7xl mx-auto px-6 md:px-12 py-12 space-y-16">
        {Object.entries(porMes).map(([mesAnio, eventos]) => (
          <div key={mesAnio}>
            <h2 className="font-['Manrope'] text-3xl font-extrabold mb-6">
              <span className="text-[#002045]">{mesAnio.split(' ')[0].toUpperCase()}</span>
              <span className="text-[#43474e] ml-2">{mesAnio.split(' ')[1]}</span>
            </h2>
            <div className="grid grid-cols-2 md:grid-cols-4 auto-rows-[220px] gap-1">
              {eventos.map((ev) => (
                <motion.div
                  key={ev.id}
                  layoutId={`ev-${ev.id}`}
                  onClick={() => setSelected(ev)}
                  className={`relative overflow-hidden group cursor-pointer
                    ${ev.destacado ? 'col-span-2 row-span-1' : 'col-span-1 row-span-1'}
                    ${ev.color}`}
                >
                  {ev.imagen && (
                    <>
                      <img src={ev.imagen} alt={ev.titulo} className="absolute inset-0 w-full h-full object-cover opacity-40 group-hover:opacity-55 transition-opacity duration-500" />
                      <div className="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent" />
                    </>
                  )}
                  <div className={`relative z-10 p-6 h-full flex flex-col justify-between ${ev.textColor}`}>
                    <div>
                      <motion.p layoutId={`fecha-${ev.id}`} className="text-3xl font-black font-['Manrope'] leading-none mb-3">
                        {fmtFecha(ev.dia, ev.mesNum)}
                      </motion.p>
                      <motion.p layoutId={`titulo-${ev.id}`} className="font-bold text-base leading-snug mb-1">{ev.titulo}</motion.p>
                      <p className="text-sm opacity-80 leading-snug line-clamp-2">{ev.desc}</p>
                    </div>
                    <div className="flex items-center justify-between mt-4">
                      <button className={`text-xs font-bold px-3 py-1.5 rounded border ${ev.textColor === 'text-white' ? 'border-white/40 hover:bg-white/20' : 'border-[#002045]/30 hover:bg-[#002045]/10'} transition`}>
                        + info
                      </button>
                      <span className="material-symbols-outlined text-xl opacity-60">groups</span>
                    </div>
                  </div>
                </motion.div>
              ))}
            </div>
          </div>
        ))}

        {Object.keys(porMes).length === 0 && (
          <div className="text-center py-24 text-[#43474e]">
            <span className="material-symbols-outlined text-5xl mb-4 block text-[#c4c6cf]">event_busy</span>
            No se encontraron eventos.
          </div>
        )}
      </main>

      {/* Modal shared layout */}
      <AnimatePresence>
        {selected && (
          <>
            <motion.div
              key="backdrop"
              className="fixed inset-0 z-40 bg-[#002045]/70 backdrop-blur-sm"
              initial={{ opacity: 0 }} animate={{ opacity: 1 }} exit={{ opacity: 0 }}
              onClick={() => setSelected(null)}
            />
            <div className="fixed inset-0 z-50 flex items-center justify-center p-4">
              <motion.div
                layoutId={`ev-${selected.id}`}
                className="bg-white rounded-2xl overflow-hidden shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col"
              >
                {/* Imagen o color header */}
                <div className={`relative h-56 flex-shrink-0 ${!selected.imagen ? selected.color : ''}`}>
                  {selected.imagen && (
                    <img src={selected.imagen} alt={selected.titulo} className="w-full h-full object-cover" />
                  )}
                  <div className="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent" />
                  <button onClick={() => setSelected(null)} className="absolute top-4 right-4 w-9 h-9 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center hover:bg-white/40 transition">
                    <span className="material-symbols-outlined text-xl">close</span>
                  </button>
                  <div className="absolute bottom-4 left-6">
                    <motion.p layoutId={`fecha-${selected.id}`} className="text-4xl font-black font-['Manrope'] text-white leading-none">
                      {fmtFecha(selected.dia, selected.mesNum)}
                    </motion.p>
                  </div>
                </div>

                {/* Contenido */}
                <div className="p-8 overflow-y-auto">
                  <div className="flex items-center gap-3 mb-3">
                    <span className="text-[10px] font-bold uppercase tracking-wider text-[#735c00] px-2 py-1 bg-[#fed65b] rounded">{selected.mes} {selected.anio}</span>
                    <span className="text-xs text-[#43474e] flex items-center gap-1">
                      <span className="material-symbols-outlined text-sm">location_on</span>{selected.lugar}
                    </span>
                  </div>
                  <motion.h2 layoutId={`titulo-${selected.id}`} className="font-['Manrope'] text-2xl font-bold text-[#002045] mb-4 leading-snug">
                    {selected.titulo}
                  </motion.h2>
                  <motion.p
                    initial={{ opacity: 0, y: 8 }} animate={{ opacity: 1, y: 0 }} transition={{ delay: 0.15 }}
                    className="text-[#43474e] leading-relaxed"
                  >
                    {selected.body}
                  </motion.p>
                </div>
              </motion.div>
            </div>
          </>
        )}
      </AnimatePresence>
    </div>
  );
}
