"use client";
import React from 'react';

export default function Home() {
  return (
    <div className="bg-[#f7fafc] font-['Inter'] text-[#181c1e]">

      {/* Hero Section */}
      <section className="relative min-h-[921px] flex items-center pt-20 overflow-hidden">
        <div className="absolute inset-0 z-0">
          <img
            alt="Campus exterior"
            className="w-full h-full object-cover"
            src="/fotos-institucion/institucion-frente.png"
          />
          <div className="absolute inset-0 bg-gradient-to-r from-[#002045]/90 to-[#1a365d]/40"></div>
        </div>
        <div className="container mx-auto px-6 md:px-12 relative z-10">
          <div className="max-w-3xl">
            <span className="inline-block px-4 py-1 rounded-full bg-[#fed65b] text-[#735c00] font-semibold text-xs tracking-widest uppercase mb-6">
              Excelencia Académica
            </span>
            <h1 className="font-['Manrope'] text-5xl md:text-7xl font-extrabold text-white leading-tight mb-8 tracking-tight">
              Formando el futuro con <span className="text-[#fed65b]">excelencia</span>
            </h1>
            <p className="text-lg md:text-xl text-white/90 mb-10 max-w-xl leading-relaxed">
              Nuestra institución combina tradición pedagógica con innovación tecnológica para preparar a los líderes del mañana en un entorno bilingüe y colaborativo.
            </p>
            <div className="flex flex-col sm:flex-row gap-4">
              <button className="px-8 py-4 bg-[#fed65b] text-[#002045] font-bold rounded-xl shadow-lg hover:bg-[#735c00] hover:text-white transition-all flex items-center justify-center gap-2">
                Conocer más
                <span className="material-symbols-outlined">arrow_forward</span>
              </button>
              <button className="px-8 py-4 bg-white/10 backdrop-blur-md text-white font-bold rounded-xl border border-white/20 hover:bg-white/20 transition-all">
                Admisiones 2024
              </button>
            </div>
          </div>
        </div>
      </section>

      {/* News & Activities */}
      <section className="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <div className="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
          <div>
            <h2 className="font-['Manrope'] text-3xl md:text-4xl font-bold text-[#002045] mb-2">Novedades y Actividades</h2>
            <p className="text-[#43474e] max-w-md">Manténgase al tanto del día a día en nuestra comunidad educativa.</p>
          </div>
          <a className="text-[#002045] font-semibold flex items-center gap-1 hover:text-[#735c00] transition-colors" href="#">
            Ver todas las noticias
            <span className="material-symbols-outlined text-sm">open_in_new</span>
          </a>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          <article className="group bg-white rounded-2xl overflow-hidden shadow-[0_8px_32px_rgba(26,54,93,0.04)] transition-all hover:-translate-y-1">
            <div className="aspect-[16/10] overflow-hidden">
              <img alt="Feria de ciencias" className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="/fotos-actividades/acto_bandera.png" />
            </div>
            <div className="p-6">
              <div className="flex items-center gap-4 mb-4">
                <span className="text-[10px] font-bold uppercase tracking-wider text-[#735c00] px-2 py-1 bg-[#fed65b] rounded">Ciencias</span>
                <time className="text-xs text-[#43474e]">15 Oct, 2023</time>
              </div>
              <h3 className="font-['Manrope'] text-xl font-bold text-[#002045] mb-3 leading-snug">Feria de Innovación y Tecnología 2023</h3>
              <p className="text-sm text-[#43474e] line-clamp-3 mb-6">Estudiantes de ciclo orientado presentaron proyectos de robótica aplicada a la sustentabilidad urbana.</p>
              <a className="inline-flex items-center text-[#002045] font-bold text-sm gap-2 hover:text-[#735c00] transition" href="#">
                Leer nota <span className="material-symbols-outlined text-base">east</span>
              </a>
            </div>
          </article>

          <article className="group bg-white rounded-2xl overflow-hidden shadow-[0_8px_32px_rgba(26,54,93,0.04)] transition-all hover:-translate-y-1">
            <div className="aspect-[16/10] overflow-hidden">
              <img alt="Deportes" className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="/fotos-actividades/campaña.png" />
            </div>
            <div className="p-6">
              <div className="flex items-center gap-4 mb-4">
                <span className="text-[10px] font-bold uppercase tracking-wider text-[#735c00] px-2 py-1 bg-[#fed65b] rounded">Deportes</span>
                <time className="text-xs text-[#43474e]">12 Oct, 2023</time>
              </div>
              <h3 className="font-['Manrope'] text-xl font-bold text-[#002045] mb-3 leading-snug">Finales Intercolegiales de Atletismo</h3>
              <p className="text-sm text-[#43474e] line-clamp-3 mb-6">Nuestros atletas destacaron en las competencias regionales obteniendo el primer puesto en relevos.</p>
              <a className="inline-flex items-center text-[#002045] font-bold text-sm gap-2 hover:text-[#735c00] transition" href="#">
                Leer nota <span className="material-symbols-outlined text-base">east</span>
              </a>
            </div>
          </article>

          <article className="group bg-white rounded-2xl overflow-hidden shadow-[0_8px_32px_rgba(26,54,93,0.04)] border-l-4 border-[#735c00] transition-all hover:-translate-y-1">
            <div className="aspect-[16/10] overflow-hidden">
              <img alt="Cultura" className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="/fotos-actividades/eleccion_reina.png" />
            </div>
            <div className="p-6">
              <div className="flex items-center gap-4 mb-4">
                <span className="text-[10px] font-bold uppercase tracking-wider text-[#735c00] px-2 py-1 bg-[#fed65b] rounded">Cultura</span>
                <time className="text-xs text-[#43474e]">08 Oct, 2023</time>
              </div>
              <h3 className="font-['Manrope'] text-xl font-bold text-[#002045] mb-3 leading-snug">Nueva Biblioteca Digital Institucional</h3>
              <p className="text-sm text-[#43474e] line-clamp-3 mb-6">Inauguramos el acceso a más de 5.000 títulos académicos para todos nuestros alumnos y familias.</p>
              <a className="inline-flex items-center text-[#002045] font-bold text-sm gap-2 hover:text-[#735c00] transition" href="#">
                Leer nota <span className="material-symbols-outlined text-base">east</span>
              </a>
            </div>
          </article>
        </div>
      </section>

      {/* Educational Levels & Calendar */}
      <section className="py-24 bg-[#f1f4f6]">
        <div className="container mx-auto px-6 md:px-12 max-w-7xl">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <div className="lg:col-span-8">
              <h2 className="font-['Manrope'] text-3xl font-bold text-[#002045] mb-12">Niveles Educativos</h2>
              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div className="bg-white p-8 rounded-2xl shadow-sm border border-[#c4c6cf]/10 group hover:shadow-md transition-shadow">
                  <div className="w-16 h-16 rounded-2xl bg-[#003f25] text-[#9ff5c1] flex items-center justify-center mb-6">
                    <span className="material-symbols-outlined text-4xl" style={{ fontVariationSettings: "'FILL' 1" }}>child_care</span>
                  </div>
                  <h4 className="font-['Manrope'] text-2xl font-bold text-[#002045] mb-4">Ciclo Básico</h4>
                  <p className="text-[#43474e] leading-relaxed mb-6">Enfoque en el desarrollo socio-cognitivo, cimentando las bases del pensamiento crítico y la curiosidad científica.</p>
                  <ul className="space-y-3 mb-8">
                    <li className="flex items-center gap-3 text-sm text-[#181c1e]">
                      <span className="material-symbols-outlined text-[#735c00] text-lg">check_circle</span>
                      Educación Bilingüe Integral
                    </li>
                    <li className="flex items-center gap-3 text-sm text-[#181c1e]">
                      <span className="material-symbols-outlined text-[#735c00] text-lg">check_circle</span>
                      Talleres de Arte y Música
                    </li>
                  </ul>
                  <button className="text-[#002045] font-bold flex items-center gap-2 group-hover:translate-x-1 transition-transform">
                    Explorar programa <span className="material-symbols-outlined text-sm">chevron_right</span>
                  </button>
                </div>

                <div className="bg-white p-8 rounded-2xl shadow-sm border border-[#c4c6cf]/10 group hover:shadow-md transition-shadow">
                  <div className="w-16 h-16 rounded-2xl bg-[#1a365d] text-[#86a0cd] flex items-center justify-center mb-6">
                    <span className="material-symbols-outlined text-4xl" style={{ fontVariationSettings: "'FILL' 1" }}>account_balance</span>
                  </div>
                  <h4 className="font-['Manrope'] text-2xl font-bold text-[#002045] mb-4">Ciclo Orientado</h4>
                  <p className="text-[#43474e] leading-relaxed mb-6">Orientación especializada hacia las ciencias exactas y sociales con fuertes convenios universitarios.</p>
                  <ul className="space-y-3 mb-8">
                    <li className="flex items-center gap-3 text-sm text-[#181c1e]">
                      <span className="material-symbols-outlined text-[#735c00] text-lg">check_circle</span>
                      Pasantías Pre-Profesionales
                    </li>
                    <li className="flex items-center gap-3 text-sm text-[#181c1e]">
                      <span className="material-symbols-outlined text-[#735c00] text-lg">check_circle</span>
                      Certificaciones Internacionales
                    </li>
                  </ul>
                  <button className="text-[#002045] font-bold flex items-center gap-2 group-hover:translate-x-1 transition-transform">
                    Explorar programa <span className="material-symbols-outlined text-sm">chevron_right</span>
                  </button>
                </div>

              </div>
            </div>

            <div className="lg:col-span-4">
              <div className="bg-white rounded-3xl p-8 shadow-[0_16px_48px_rgba(0,0,0,0.04)] sticky top-28">
                <div className="flex items-center justify-between mb-8">
                  <h3 className="font-['Manrope'] text-xl font-bold text-[#002045]">Agenda Escolar</h3>
                  <span className="material-symbols-outlined text-[#43474e]">calendar_today</span>
                </div>
                <div className="space-y-6">
                  <div className="flex gap-4 p-3 rounded-xl hover:bg-[#ebeef0] transition-colors cursor-pointer group">
                    <div className="flex-shrink-0 w-12 h-14 bg-[#f1f4f6] rounded-lg flex flex-col items-center justify-center text-[#002045] border border-[#c4c6cf]/10">
                      <span className="text-xs font-bold uppercase tracking-tighter opacity-70">Nov</span>
                      <span className="text-xl font-black">22</span>
                    </div>
                    <div>
                      <h5 className="font-bold text-[#002045] text-sm group-hover:text-[#735c00] transition-colors">Exámenes Integradores</h5>
                      <p className="text-xs text-[#43474e]">Turno Mañana y Tarde</p>
                    </div>
                  </div>
                  <div className="flex gap-4 p-3 rounded-xl hover:bg-[#ebeef0] transition-colors cursor-pointer group">
                    <div className="flex-shrink-0 w-12 h-14 bg-[#fed65b]/30 rounded-lg flex flex-col items-center justify-center text-[#735c00] border border-[#fed65b]/50">
                      <span className="text-xs font-bold uppercase tracking-tighter opacity-70">Nov</span>
                      <span className="text-xl font-black">28</span>
                    </div>
                    <div>
                      <h5 className="font-bold text-[#002045] text-sm group-hover:text-[#735c00] transition-colors">Acto Cierre de Ciclo</h5>
                      <p className="text-xs text-[#43474e]">Salón de Actos Principal</p>
                    </div>
                  </div>
                  <div className="flex gap-4 p-3 rounded-xl hover:bg-[#ebeef0] transition-colors cursor-pointer group">
                    <div className="flex-shrink-0 w-12 h-14 bg-[#f1f4f6] rounded-lg flex flex-col items-center justify-center text-[#002045] border border-[#c4c6cf]/10">
                      <span className="text-xs font-bold uppercase tracking-tighter opacity-70">Dic</span>
                      <span className="text-xl font-black">05</span>
                    </div>
                    <div>
                      <h5 className="font-bold text-[#002045] text-sm group-hover:text-[#735c00] transition-colors">Muestra de Fin de Año</h5>
                      <p className="text-xs text-[#43474e]">Galería de Arte Central</p>
                    </div>
                  </div>
                </div>
                <button className="w-full mt-10 py-3 rounded-xl border border-[#002045]/10 text-[#002045] font-bold text-sm hover:bg-[#002045] hover:text-white transition-all">
                  Ver Calendario Completo
                </button>
              </div>
            </div>

          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-24 px-6 md:px-12">
        <div className="max-w-7xl mx-auto rounded-[2rem] bg-[#002045] relative overflow-hidden p-12 md:p-20">
          <div className="absolute top-0 right-0 w-1/3 h-full bg-[#1a365d] skew-x-12 translate-x-20 opacity-50"></div>
          <div className="relative z-10 grid grid-cols-1 md:grid-cols-2 items-center gap-12">
            <div>
              <h2 className="font-['Manrope'] text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
                Empiece el camino hacia el éxito académico hoy.
              </h2>
              <p className="text-[#adc7f7] text-lg mb-8 max-w-md">
                Las inscripciones para el ciclo lectivo 2024 ya están abiertas. Solicite una entrevista informativa.
              </p>
              <div className="flex flex-wrap gap-4">
                <button className="bg-[#fed65b] text-[#002045] px-8 py-4 rounded-xl font-bold hover:scale-105 transition-transform">
                  Solicitar Entrevista
                </button>
                <button className="bg-white/10 text-white border border-white/20 px-8 py-4 rounded-xl font-bold backdrop-blur-sm">
                  Descargar Brochure
                </button>
              </div>
            </div>
            <div className="hidden md:block">
              <img
                alt="Estudiantes sonriendo"
                className="rounded-2xl shadow-2xl rotate-3 scale-110"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAdDGYzNtwN5cWFa5X3KTQKuLfhIvqMbHgUbXtqycNobxYs-7OPJ55plVGNtlxmICAR2dPDw6S3kBB5MRF4ayG_-u_xO3mytuEJwBkS3kg4jIECJJoOjrGHCY8mU11Rhxn0ycGLpwolzLwg5IFm-cRx9SBUC1wiQrGeJPM8UlsC4DSdSd08Dq0uUh_a5piiOL5Z0vQzuwBp-bP6f8TKtzL-ZJDm60pb9_5RmqY0q7cs1_cGKZBccUX6EKe1sJKHnWRzkpuKTBkz8wIB"
              />
            </div>
          </div>
        </div>
      </section>

    </div>
  );
}
