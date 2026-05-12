import React from 'react';
import Link from 'next/link';

export default function Institucional() {
  const valores = [
    { icon: 'school', title: 'Excelencia Académica', desc: 'Búsqueda constante del máximo potencial intelectual y rigor en el aprendizaje.' },
    { icon: 'groups', title: 'Compromiso Social', desc: 'Conciencia de la realidad del entorno y participación activa en la comunidad.' },
    { icon: 'lightbulb', title: 'Creatividad', desc: 'Fomento del pensamiento original y resolución de problemas complejos.' },
    { icon: 'emoji_events', title: 'Liderazgo Ético', desc: 'Capacidad de guiar procesos y personas con ética y visión compartida.' },
  ];

  const autoridades = [
    { name: 'Prof. Elena Rodríguez', role: 'Rectora', img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBJInpwpojj2thFUwi9SoQHS7rvll0zzAxYB-yZ6gdTpEFJIOuP8Z0omNL6S2SUSwO38dsRm8Qj1J9BhpTzXqxkfpC1tfc4WFxTBBDwdUd8CniIYorNN3pdYeDmd-qyUhB8lj9qNAfuXRtC49qoJa2HsTnynyWn2BUscXjERkJaHLU4zQOWRTRVkOHcTcszCpkhIn3eZjWpULlZ80SYikl7hCAvFT6FO2X4-qxqTsl-izEkj3KuSWb-YJPJVjCbotb0eKQ0xzq2940' },
    { name: 'Prof. Marcos Sánchez', role: 'Vice-rector', img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBUcykUpjRWnA5m8vNiKMtQNixqXXdF1vBkKAdL0ZluaFA7IbKwgiULtPQb9SCJZY7i6hvau0w0FGVymA5lcZUptcIbxSrwoAeOYd5oL64lYT4fPXWpjaHSfBuUeFZyXc4N4cYa_dkeatCMh-X0RghvczHykYmcDyQHyR5lrTOa230Q5lefFdR-REl_Zo0Fss_gcrJIQZjMpzS5SYJlRX8nuf8WYfvO1nQC2btua1TCnKjo70OlhILPOrDdQqz5njzzKGEuH_P8b2U' },
    { name: 'Lic. Claudia Pardo', role: 'Secretaria', img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuC_au9ZpOegAQCbmHVM2q1bL6jv8tQjYZoQUoCWdj4o2WNZGNSg64ESOPCsNTOebz4TpHXsqGrko47jci48IcahAcylhA78h7k74TaqVSwnExNuDabQEl2R2qFBwvOUKkr3th4YlIJts4aZJhxCvMXVKBlqdsXZuQ0uvAOtkVya6kpC2FHd7oiaZEE0vdkWL0z4M56OZkODIxh0haeqPprz7yDSBJvkQp91oqRl2MOuaCl5QshItJ6ZLPWSgtwyiuqt17-zmoRJVT4' },
  ];

  return (
    <div className="bg-[#f7fafc] font-['Inter'] text-[#181c1e] overflow-x-hidden">
      {/* Hero Section */}
      <section className="relative min-h-[80vh] flex items-center pt-24 overflow-hidden">
        <div className="absolute inset-0 z-0">
          <img className="w-full h-full object-cover" src="/fotos-institucion/institucion-interior.png" alt="Institución" />
          <div className="absolute inset-0 bg-gradient-to-r from-[#002045]/90 to-[#1a365d]/50"></div>
        </div>
        <div className="relative z-10 max-w-7xl mx-auto px-6 md:px-12 w-full text-center">
          <div className="max-w-4xl mx-auto text-white">
            <span className="inline-block px-4 py-1 rounded-full bg-[#fed65b] text-[#735c00] font-semibold text-xs tracking-widest uppercase mb-6">
              Tradición y Excelencia
            </span>
            <h1 className="text-5xl md:text-7xl font-['Manrope'] font-extrabold text-white leading-tight mb-8 tracking-tight">
              Formando líderes con <span className="text-[#fed65b]">valores</span>
            </h1>
            <p className="text-lg md:text-xl text-white/90 mb-10 max-w-2xl mx-auto leading-relaxed">
              El Colegio Secundario N°59 "Olga M. de Aredez" es un espacio de aprendizaje dinámico que integra la tradición académica con la innovación pedagógica.
            </p>
            <div className="flex flex-col sm:flex-row justify-center gap-4">
              <Link href="#nuestros-origenes" className="px-8 py-4 bg-[#fed65b] text-[#002045] font-bold rounded-xl shadow-lg hover:bg-[#735c00] hover:text-white transition-all flex items-center justify-center">
                Ver Institución
              </Link>
              <Link href="/contacto" className="px-8 py-4 bg-white/10 backdrop-blur-md text-white font-bold rounded-xl border border-white/20 hover:bg-white/20 transition-all flex items-center justify-center">
                Solicitar Info
              </Link>
            </div>
          </div>
        </div>
      </section>

      {/* Historia Section with Timeline Layout */}
      <section id="nuestros-origenes" className="py-24 bg-white">
        <div className="max-w-7xl mx-auto px-6 md:px-12">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-16">
            <div className="lg:col-span-5">
              <div className="sticky top-32">
                <h2 className="text-4xl font-['Manrope'] font-extrabold text-[#002045] mb-6 tracking-tight">Nuestros Orígenes y Evolución</h2>
                <p className="text-lg text-[#43474e] mb-8 italic opacity-80">
                  "Un faro de conocimiento que ha iluminado generaciones en San Salvador de Jujuy."
                </p>
                <div className="flex items-center gap-12 border-t border-[#002045]/10 pt-8">
                  <div className="flex flex-col">
                    <span className="text-5xl font-['Manrope'] font-extrabold text-[#002045]">25</span>
                    <span className="text-xs text-[#735c00] uppercase font-bold tracking-widest mt-1">Años</span>
                  </div>
                  <div className="w-px h-12 bg-[#002045]/10"></div>
                  <div className="flex flex-col">
                    <span className="text-5xl font-['Manrope'] font-extrabold text-[#002045]">1.2k</span>
                    <span className="text-xs text-[#735c00] uppercase font-bold tracking-widest mt-1">Egresados</span>
                  </div>
                </div>
              </div>
            </div>
            <div className="lg:col-span-7 space-y-16">
              {/* Timeline Item 1 */}
              <div className="relative pl-12 border-l-2 border-[#fed65b]">
                <div className="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-[#fed65b] border-4 border-white shadow-sm"></div>
                <h3 className="text-2xl font-['Manrope'] font-bold text-[#002045] mb-4">Los Cimientos</h3>
                <div className="relative mb-6 rounded-2xl overflow-hidden shadow-sm">
                  <img className="w-full h-64 object-cover grayscale hover:grayscale-0 transition-all duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDjcezFkuE9qvFGGaVt608AdCc6VkduPGkG1QgCzcQSbrkK8Z7_UY3ETMKD2O1F3vjt0PINaacW5bckj6FPUVOeJcZejEO3Xi4VpMmJMmfn4_p4xgeGniWD6iMWRsNCxzWoVxT7jbECrWA2BdUvgMjFBJXPtXRBktLRagUxaSTcuF4c0Qtk4lMGjES4BCrvn39SxRFQ_mHgi2HBbVyKCjnO0rNaB6M9XKdAyYIYBeSIAdy_oq3CCPhitv0vvrggBgf9j2iaEXnWrhE" alt="Historia cimientos" />
                </div>
                <p className="text-[#43474e] leading-relaxed">
                  Fundado con el firme propósito de democratizar el acceso a una educación secundaria de calidad, el Colegio Olga M. de Aredez comenzó su labor pedagógica en instalaciones que, aunque humildes, estaban llenas de visión y compromiso.
                </p>
              </div>
              {/* Timeline Item 2 */}
              <div className="relative pl-12 border-l-2 border-[#fed65b]">
                <div className="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-[#fed65b] border-4 border-white shadow-sm"></div>
                <h3 className="text-2xl font-['Manrope'] font-bold text-[#002045] mb-4">La Consolidación</h3>
                <p className="text-[#43474e] leading-relaxed mb-6">
                  Desde sus inicios hasta su actual estructura moderna, la institución ha evolucionado para responder a los desafíos globales. El compromiso social sigue siendo el eje central de nuestra identidad, manteniendo vivos los valores que inspiraron nuestra creación.
                </p>
                <div className="bg-[#f7fafc] p-6 rounded-2xl border-l-4 border-[#fed65b]">
                  <p className="text-[#002045] font-semibold italic">
                    "La educación es el arma más poderosa para cambiar el mundo."
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Misión y Visión - Soft Cards Layout */}
      <section className="py-24 bg-[#f1f4f6]">
        <div className="max-w-7xl mx-auto px-6 md:px-12">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div className="p-10 md:p-14 bg-white rounded-[2rem] shadow-[0_8px_32px_rgba(26,54,93,0.04)] group hover:-translate-y-1 transition-transform">
              <div className="w-16 h-16 rounded-2xl bg-[#fed65b]/20 text-[#735c00] flex items-center justify-center mb-8">
                <span className="material-symbols-outlined text-4xl" style={{ fontVariationSettings: "'FILL' 1" }}>history_edu</span>
              </div>
              <h3 className="text-3xl font-['Manrope'] font-extrabold text-[#002045] mb-6">Nuestra Misión</h3>
              <p className="text-[#43474e] leading-relaxed text-lg">
                Brindar una formación integral que potencie las capacidades críticas, creativas y éticas de nuestros estudiantes, preparándolos para su inserción ciudadana y su continuidad en estudios superiores con un alto sentido de responsabilidad social.
              </p>
            </div>
            <div className="p-10 md:p-14 bg-[#002045] rounded-[2rem] shadow-lg group hover:-translate-y-1 transition-transform">
              <div className="w-16 h-16 rounded-2xl bg-white/10 text-[#fed65b] flex items-center justify-center mb-8">
                <span className="material-symbols-outlined text-4xl" style={{ fontVariationSettings: "'FILL' 1" }}>auto_stories</span>
              </div>
              <h3 className="text-3xl font-['Manrope'] font-extrabold text-white mb-6">Nuestra Visión</h3>
              <p className="text-white/90 leading-relaxed text-lg">
                Ser reconocidos como una institución educativa de vanguardia en la región, referente por su calidad académica, su clima de convivencia inclusiva y su capacidad de innovar en procesos de enseñanza que respondan a los cambios sociales y tecnológicos.
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* Valores */}
      <section className="py-24 bg-white">
        <div className="max-w-7xl mx-auto px-6 md:px-12 text-center mb-16">
          <span className="inline-block px-4 py-1 rounded-full bg-[#f1f4f6] text-[#43474e] font-semibold text-xs tracking-widest uppercase mb-4">
            Fundamentos Éticos
          </span>
          <h2 className="text-4xl font-['Manrope'] font-extrabold text-[#002045] tracking-tight">Pilares de Nuestra Educación</h2>
        </div>
        <div className="max-w-7xl mx-auto px-6 md:px-12">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {valores.map((valor) => (
              <div key={valor.title} className="p-8 bg-[#f7fafc] rounded-2xl border border-[#c4c6cf]/20 hover:bg-white hover:shadow-[0_8px_32px_rgba(26,54,93,0.04)] hover:-translate-y-1 transition-all group">
                <div className="w-14 h-14 rounded-xl bg-white shadow-sm flex items-center justify-center text-[#1a365d] mb-6 group-hover:text-[#735c00] transition-colors">
                  <span className="material-symbols-outlined text-3xl" style={{ fontVariationSettings: "'FILL' 1" }}>{valor.icon}</span>
                </div>
                <h4 className="text-xl font-['Manrope'] font-bold text-[#002045] mb-3">{valor.title}</h4>
                <p className="text-[#43474e] text-sm leading-relaxed">{valor.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Autoridades - Portrait Cards */}
      <section className="py-24 bg-[#f1f4f6]">
        <div className="max-w-7xl mx-auto px-6 md:px-12">
          <div className="flex flex-col md:flex-row items-end justify-between mb-16 gap-6">
            <div>
              <h2 className="text-4xl font-['Manrope'] font-extrabold text-[#002045] tracking-tight mb-2">Autoridades Institucionales</h2>
              <p className="text-[#43474e] text-lg">El equipo que lidera nuestra visión educativa diaria.</p>
            </div>
            <Link href="/contacto" className="text-[#002045] font-bold flex items-center gap-1 hover:text-[#735c00] transition-colors">
              Contactar Dirección
              <span className="material-symbols-outlined text-sm">chevron_right</span>
            </Link>
          </div>
          
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {autoridades.map((autoridad) => (
              <div key={autoridad.name} className="group bg-white rounded-[2rem] p-4 shadow-[0_8px_32px_rgba(26,54,93,0.04)] hover:-translate-y-2 transition-transform duration-300">
                <div className="relative overflow-hidden aspect-[4/5] rounded-3xl mb-6 bg-[#f7fafc]">
                  <img className="w-full h-full object-cover filter sepia-[0.2] group-hover:sepia-0 group-hover:scale-105 transition-all duration-700" src={autoridad.img} alt={autoridad.name} />
                </div>
                <div className="text-center pb-4">
                  <h4 className="text-xl font-['Manrope'] font-bold text-[#002045] mb-1">{autoridad.name}</h4>
                  <p className="text-[11px] text-[#735c00] uppercase tracking-widest font-bold bg-[#fed65b]/20 inline-block px-3 py-1 rounded-full">{autoridad.role}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
}
