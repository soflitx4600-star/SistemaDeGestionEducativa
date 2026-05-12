"use client";
import React, { useEffect, useState } from 'react';
import Link from 'next/link';
import { motion } from 'motion/react';
import NewsModal from '../components/NewsModal';
import { NEWS, NewsItem } from '../lib/news';

const heroImages = [
  '/fotos-institucion/institucion-frente.png',
  '/fotos-institucion/institucion-interior.png',
  '/fotos-institucion/screen copy.png',
];

export default function Home() {
  const [current, setCurrent] = useState(0);
  const [selected, setSelected] = useState<NewsItem | null>(null);

  useEffect(() => {
    const timer = setInterval(() => {
      setCurrent(prev => (prev + 1) % heroImages.length);
    }, 4000);
    return () => clearInterval(timer);
  }, []);

  return (
    <div className="bg-[#f7fafc] font-['Inter'] text-[#181c1e]">

      {/* Hero Section */}
      <section className="relative min-h-[580px] flex items-center pt-20 overflow-hidden">
        <div className="absolute inset-0 z-0">
          {heroImages.map((src, i) => (
            <img
              key={src}
              alt="Campus"
              src={src}
              className="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000"
              style={{ opacity: i === current ? 1 : 0 }}
            />
          ))}
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
              <Link href="/institucional" className="px-8 py-4 bg-[#fed65b] text-[#002045] font-bold rounded-xl shadow-lg hover:bg-[#735c00] hover:text-white transition-all flex items-center justify-center gap-2">
                Sobre Nosotros
                <span className="material-symbols-outlined">arrow_forward</span>
              </Link>
            </div>
          </div>
        </div>
        {/* Controles carrusel */}
        <div className="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 flex items-center gap-4">
          <button
            onClick={() => setCurrent(prev => (prev - 1 + heroImages.length) % heroImages.length)}
            className="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center hover:bg-white/40 transition"
          >
            <span className="material-symbols-outlined">chevron_left</span>
          </button>
          <div className="flex gap-2">
            {heroImages.map((_, i) => (
              <button
                key={i}
                onClick={() => setCurrent(i)}
                className={`w-2.5 h-2.5 rounded-full transition-all ${
                  i === current ? 'bg-[#fed65b] w-6' : 'bg-white/50'
                }`}
              />
            ))}
          </div>
          <button
            onClick={() => setCurrent(prev => (prev + 1) % heroImages.length)}
            className="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center hover:bg-white/40 transition"
          >
            <span className="material-symbols-outlined">chevron_right</span>
          </button>
        </div>
      </section>

      {/* News & Activities */}
      <section className="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <div className="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
          <div>
            <h2 className="font-['Manrope'] text-3xl md:text-4xl font-bold text-[#002045] mb-2">Novedades y Actividades</h2>
            <p className="text-[#43474e] max-w-md">Manténgase al tanto del día a día en nuestra comunidad educativa.</p>
          </div>
          <Link className="text-[#002045] font-semibold flex items-center gap-1 hover:text-[#735c00] transition-colors" href="/noticias">
            Ver todas las noticias
            <span className="material-symbols-outlined text-sm">open_in_new</span>
          </Link>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          {NEWS.slice(0, 3).map((item, idx) => (
            <motion.article
              key={item.id}
              layoutId={`card-${item.id}`}
              onClick={() => setSelected(item)}
              className={`group bg-white rounded-2xl overflow-hidden shadow-[0_8px_32px_rgba(26,54,93,0.04)] cursor-pointer hover:-translate-y-1 transition-transform${
                idx === 2 ? ' border-l-4 border-[#735c00]' : ''
              }`}
            >
              <motion.div layoutId={`image-${item.id}`} className="aspect-[16/10] overflow-hidden">
                <img
                  alt={item.imageAlt}
                  className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                  src={item.image}
                />
              </motion.div>
              <div className="p-6">
                <div className="flex items-center gap-4 mb-4">
                  <motion.span layoutId={`tag-${item.id}`} className="text-[10px] font-bold uppercase tracking-wider text-[#735c00] px-2 py-1 bg-[#fed65b] rounded">
                    {item.tag}
                  </motion.span>
                  <motion.time layoutId={`date-${item.id}`} className="text-xs text-[#43474e]">{item.date}</motion.time>
                </div>
                <motion.h3 layoutId={`title-${item.id}`} className="font-['Manrope'] text-xl font-bold text-[#002045] mb-3 leading-snug">
                  {item.title}
                </motion.h3>
                <p className="text-sm text-[#43474e] line-clamp-3 mb-6">{item.excerpt}</p>
                <span className="inline-flex items-center text-[#002045] font-bold text-sm gap-2 hover:text-[#735c00] transition">
                  Leer nota <span className="material-symbols-outlined text-base">east</span>
                </span>
              </div>
            </motion.article>
          ))}
        </div>
      </section>

      <NewsModal item={selected} onClose={() => setSelected(null)} />

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

    </div>
  );
}
