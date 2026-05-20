"use client";
import React, { useEffect, useState } from 'react';
import Link from 'next/link';
import { motion, AnimatePresence } from 'motion/react';
import NewsModal from '../components/NewsModal';
import { NEWS, NewsItem } from '../lib/news';
import { getMonthlyHighlights } from '../lib/events';

const heroImages = [
  '/fotos-institucion/institucion-frente.png',
  '/fotos-institucion/institucion-interior.png',
  '/fotos-institucion/screen copy.png',
];

const galeriaFotos = [
  { src: '/fotos-actividades/acto_bandera.png', alt: 'Acto de Bandera' },
  { src: '/fotos-actividades/campaña.png', alt: 'Campaña Solidaria' },
  { src: '/fotos-actividades/eleccion_reina.png', alt: 'Elección Reina' },
  { src: '/fotos-actividades/feria.jpeg', alt: 'Feria de Ciencias' },
  { src: '/fotos-actividades/futbol.jpeg', alt: 'Torneo de Fútbol' },
  { src: '/fotos-actividades/maestro.jpeg', alt: 'Día del Maestro' },
  { src: '/fotos-actividades/unodemayo.jpeg', alt: '1° de Mayo' },
  { src: '/fotos-actividades/ocho.jpeg', alt: 'Muestra de Arte' },
];

export default function Home() {
  const [current, setCurrent] = useState(0);
  const [selected, setSelected] = useState<NewsItem | null>(null);
  const [galleryIndex, setGalleryIndex] = useState(0);
  const [lightboxOpen, setLightboxOpen] = useState(false); // New state for lightbox
  const [lightboxImageIndex, setLightboxImageIndex] = useState(0); // New state for lightbox image index

  useEffect(() => {
    const timer = setInterval(() => {
      setCurrent(prev => (prev + 1) % heroImages.length);
    }, 4000);
    return () => clearInterval(timer);
  }, []);

  const [featured, ...rest] = NEWS.slice(0, 5);
  const eventosPorMes = getMonthlyHighlights();

  // Function to open lightbox
  const openLightbox = (index: number) => {
    setLightboxImageIndex(index);
    setLightboxOpen(true);
  };

  // Functions for lightbox navigation
  const nextLightboxImage = () => {
    setLightboxImageIndex((prev) => (prev + 1) % galeriaFotos.length);
  };

  const prevLightboxImage = () => {
    setLightboxImageIndex((prev) => (prev - 1 + galeriaFotos.length) % galeriaFotos.length);
  };
  return (
    <div className="bg-[#f7fafc] font-['Inter'] text-[#181c1e]">

      {/* Hero Section */}
      <section className="relative min-h-[580px] flex items-center pt-20 overflow-hidden">
        <div className="absolute inset-0 z-0">
          {heroImages.map((src, i) => (
            <img key={src} alt="Campus" src={src}
              className="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000"
              style={{ opacity: i === current ? 1 : 0 }}
            />
          ))}
          <div className="absolute inset-0 bg-gradient-to-r from-[#002045]/90 to-[#1a365d]/40" />
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
        <div className="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 flex items-center gap-4">
          <button onClick={() => setCurrent(prev => (prev - 1 + heroImages.length) % heroImages.length)}
            className="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center hover:bg-white/40 transition">
            <span className="material-symbols-outlined">chevron_left</span>
          </button>
          <div className="flex gap-2">
            {heroImages.map((_, i) => (
              <button key={i} onClick={() => setCurrent(i)}
                className={`w-2.5 h-2.5 rounded-full transition-all ${i === current ? 'bg-[#fed65b] w-6' : 'bg-white/50'}`} />
            ))}
          </div>
          <button onClick={() => setCurrent(prev => (prev + 1) % heroImages.length)}
            className="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center hover:bg-white/40 transition">
            <span className="material-symbols-outlined">chevron_right</span>
          </button>
        </div>
      </section>

      {/* News Magazine Layout */}
      <section className="py-20 px-6 md:px-12 max-w-7xl mx-auto">
        <div className="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
          <div>
            <h2 className="font-['Manrope'] text-3xl md:text-4xl font-bold text-[#002045] mb-2">Novedades y Actividades</h2>
            <p className="text-[#43474e] max-w-md">Manténgase al tanto del día a día en nuestra comunidad educativa.</p>
          </div>
          <Link className="text-[#002045] font-semibold flex items-center gap-1 hover:text-[#735c00] transition-colors" href="/noticias">
            Ver todas las noticias
            <span className="material-symbols-outlined text-sm">open_in_new</span>
          </Link>
        </div>

        {/* Magazine grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 gap-1">
          {/* Noticia destacada grande */}
          <motion.article
            layoutId={`card-${featured.id}`}
            onClick={() => setSelected(featured)}
            className="relative overflow-hidden cursor-pointer group h-[420px]"
          >
            <motion.img layoutId={`image-${featured.id}`} src={featured.image} alt={featured.imageAlt}
              className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
            <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent" />
            <div className="absolute bottom-0 left-0 p-6">
              <motion.span layoutId={`tag-${featured.id}`} className="inline-block text-[10px] font-bold uppercase tracking-wider text-[#735c00] px-2 py-1 bg-[#fed65b] rounded mb-3">
                {featured.tag}
              </motion.span>
              <motion.h3 layoutId={`title-${featured.id}`} className="font-['Manrope'] text-2xl font-bold text-white leading-snug mb-2">
                {featured.title}
              </motion.h3>
              <div className="flex items-center gap-4">
                <div className="w-8 h-px bg-white/60" />
                <motion.time layoutId={`date-${featured.id}`} className="text-xs text-white/70">{featured.date}</motion.time>
              </div>
            </div>
          </motion.article>

          {/* 4 noticias pequeñas */}
          <div className="grid grid-cols-2 gap-1">
            {rest.map((item) => (
              <motion.article
                key={item.id}
                layoutId={`card-${item.id}`}
                onClick={() => setSelected(item)}
                className="relative overflow-hidden cursor-pointer group h-[208px]"
              >
                <motion.img layoutId={`image-${item.id}`} src={item.image} alt={item.imageAlt}
                  className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent" />
                <div className="absolute bottom-0 left-0 p-4">
                  <motion.span layoutId={`tag-${item.id}`} className="inline-block text-[9px] font-bold uppercase tracking-wider text-[#735c00] px-2 py-0.5 bg-[#fed65b] rounded mb-2">
                    {item.tag}
                  </motion.span>
                  <motion.h3 layoutId={`title-${item.id}`} className="font-['Manrope'] text-sm font-bold text-white leading-snug line-clamp-2">
                    {item.title}
                  </motion.h3>
                  <motion.time layoutId={`date-${item.id}`} className="text-[10px] text-white/60 mt-1 block">{item.date}</motion.time>
                </div>
              </motion.article>
            ))}
          </div>
        </div>
      </section>

      <NewsModal item={selected} onClose={() => setSelected(null)} />

      <section className="py-16 px-6 md:px-12 max-w-7xl mx-auto">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-8">
          <div className="lg:col-span-3">
            <div className="bg-white rounded-2xl p-5 shadow-[0_16px_48px_rgba(0,0,0,0.04)] sticky top-28">
              <div className="flex items-center justify-between mb-4">
                <div>
                  <h3 className="font-['Manrope'] text-lg font-bold text-[#002045]">Agenda Escolar</h3>
                  <p className="text-xs text-[#43474e]">Próximos eventos</p>
                </div>
                <span className="material-symbols-outlined text-[#43474e] text-sm">calendar_today</span>
              </div>
              <div className="space-y-3">
                {eventosPorMes.slice(0, 4).map((ev) => (
                  <Link key={ev.id} href={`/calendario?eventId=${ev.id}`} className="group block">
                    <div className="flex gap-2 p-2 rounded-lg hover:bg-[#ebeef0] transition-colors">
                      <div className={`flex-shrink-0 w-10 h-12 rounded-md flex flex-col items-center justify-center border text-[10px] ${ev.destacado ? 'bg-[#fed65b]/30 text-[#735c00] border-[#fed65b]/50' : 'bg-[#f1f4f6] text-[#002045] border-[#c4c6cf]/10'}`}>
                        <span className="font-bold uppercase tracking-tighter opacity-70">{ev.mes.slice(0, 3)}</span>
                        <span className="font-black text-sm">{String(ev.dia).padStart(2, '0')}</span>
                      </div>
                      <div className="flex-1 min-w-0">
                        <h5 className="font-bold text-[#002045] text-xs group-hover:text-[#735c00] transition-colors line-clamp-1">{ev.titulo}</h5>
                        <p className="text-[10px] text-[#43474e] line-clamp-1">{ev.desc}</p>
                      </div>
                    </div>
                  </Link>
                ))}
              </div>
              <Link href="/calendario" className="w-full mt-4 py-2 rounded-lg border border-[#002045]/10 text-[#002045] font-bold text-xs hover:bg-[#002045] hover:text-white transition-all flex items-center justify-center">
                Ver Calendario
              </Link>
            </div>
          </div>

          <div className="lg:col-span-9">
            <div className="bg-white rounded-2xl shadow-[0_16px_48px_rgba(0,0,0,0.04)] overflow-hidden">
              <div className="px-6 py-6 border-b border-[#e4e7ec]/70 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                  <span className="text-[#735c00] font-bold tracking-[0.2em] uppercase text-xs mb-1 block">Galería de Actividades</span>
                  <h2 className="font-['Manrope'] text-2xl font-bold text-[#002045]">Momentos de nuestra comunidad</h2>
                </div>
                <div className="flex items-center gap-1">
                  <button type="button" onClick={() => setGalleryIndex((galleryIndex - 1 + galeriaFotos.length) % galeriaFotos.length)} className="w-10 h-10 rounded-lg bg-[#f1f4f6] text-[#002045] hover:bg-[#e2e7ef] transition flex items-center justify-center">
                    <span className="material-symbols-outlined text-sm">chevron_left</span>
                  </button>
                  <button type="button" onClick={() => setGalleryIndex((galleryIndex + 1) % galeriaFotos.length)} className="w-10 h-10 rounded-lg bg-[#f1f4f6] text-[#002045] hover:bg-[#e2e7ef] transition flex items-center justify-center">
                    <span className="material-symbols-outlined text-sm">chevron_right</span>
                  </button>
                </div>
              </div>
              <div className="relative h-80 overflow-hidden group">
                <AnimatePresence mode="wait">
                  <motion.img
                    key={galleryIndex}
                    src={galeriaFotos[galleryIndex].src}
                    alt={galeriaFotos[galleryIndex].alt}
                    initial={{ opacity: 0, scale: 1.05 }}
                    animate={{ opacity: 1, scale: 1 }}
                    exit={{ opacity: 0, scale: 0.95 }}
                    transition={{ duration: 0.4 }}
                    className="w-full h-full object-cover"
                  />
                </AnimatePresence>
                <div className="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent" />
                <motion.div className="absolute bottom-0 left-0 p-5 text-white w-full" initial={{ opacity: 0, y: 10 }} animate={{ opacity: 1, y: 0 }} transition={{ delay: 0.2 }}>
                  <p className="text-xs uppercase tracking-[0.2em] text-[#fed65b] mb-1">Actividad destacada</p>
                  <h3 className="font-['Manrope'] text-xl font-bold">{galeriaFotos[galleryIndex].alt}</h3>
                </motion.div>
              </div>
              <div className="px-5 py-4 bg-white">
                <div className="flex gap-2 overflow-x-auto pb-1">
                  {galeriaFotos.map((foto, i) => (
                    <motion.button
                      key={foto.alt}
                      type="button" // Changed to button type
                      onClick={() => { setGalleryIndex(i); openLightbox(i); }} // Set gallery index and open lightbox
                      initial={false}
                      animate={{ scale: i === galleryIndex ? 1.05 : 1, borderColor: i === galleryIndex ? '#fed65b' : '#e4e7ec' }}
                      className="flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden border-2 transition-all"
                    >
                      <img src={foto.src} alt={foto.alt} className="w-full h-full object-cover" />
                    </motion.button>
                  ))}
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Lightbox Modal */}
      <AnimatePresence>
        {lightboxOpen && (
          <motion.div
            key="lightbox-backdrop"
            className="fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4"
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            onClick={() => setLightboxOpen(false)} // Close on backdrop click
          >
            <motion.div
              key="lightbox-content"
              className="relative w-full max-w-4xl max-h-[90vh] flex items-center justify-center"
              onClick={(e) => e.stopPropagation()} // Prevent closing when clicking inside content
            >
              <button
                onClick={() => setLightboxOpen(false)}
                className="absolute top-4 right-4 z-10 w-10 h-10 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center hover:bg-white/40 transition"
              >
                <span className="material-symbols-outlined text-xl">close</span>
              </button>

              <button
                onClick={prevLightboxImage}
                className="absolute left-4 z-10 w-12 h-12 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center hover:bg-white/40 transition"
              >
                <span className="material-symbols-outlined text-2xl">chevron_left</span>
              </button>

              <motion.img
                layoutId={galeriaFotos[lightboxImageIndex].src} // Shared layoutId
                src={galeriaFotos[lightboxImageIndex].src}
                alt={galeriaFotos[lightboxImageIndex].alt}
                className="max-w-full max-h-[80vh] object-contain rounded-lg shadow-lg"
              />

              <button
                onClick={nextLightboxImage}
                className="absolute right-4 z-10 w-12 h-12 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center hover:bg-white/40 transition"
              >
                <span className="material-symbols-outlined text-2xl">chevron_right</span>
              </button>

              <div className="absolute bottom-4 left-1/2 -translate-x-1/2 text-white text-sm bg-black/50 px-3 py-1 rounded-full">
                {lightboxImageIndex + 1} / {galeriaFotos.length} - {galeriaFotos[lightboxImageIndex].alt}
              </div>
            </motion.div>
          </motion.div>
        )}
      </AnimatePresence>
      <section className="py-20 px-6 md:px-12 max-w-7xl mx-auto">
        <motion.div
          initial={{ opacity: 0, y: 24 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true, margin: "-80px" }}
          transition={{ duration: 0.5 }}
          className="text-center mb-14"
        >
          <span className="inline-block px-4 py-1.5 rounded-full bg-[#fed65b]/20 text-[#735c00] font-bold tracking-[0.2em] uppercase text-xs mb-4">
            Formación académica
          </span>
          <h2 className="font-['Manrope'] text-4xl font-extrabold text-[#002045] mb-3">Oferta Educativa</h2>
          <p className="text-[#43474e] max-w-lg mx-auto text-sm leading-relaxed">
            Programas diseñados para potenciar el desarrollo integral de cada estudiante en todas las etapas.
          </p>
        </motion.div>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
          {[
            {
              icon: 'school',
              titulo: 'Ciclo Básico',
              desc: '1° a 3° año con énfasis en pensamiento crítico, lenguaje y ciencias.',
              items: ['Matemática y Ciencias', 'Lengua y Literatura', 'Educación Física y Arte'],
            },
            {
              icon: 'account_balance',
              titulo: 'Ciclo Orientado',
              desc: 'Especializaciones en Sociales, Naturales y Economía con proyección.',
              items: ['Ciencias Sociales', 'Ciencias Naturales', 'Economía'],
            },
            {
              icon: 'palette',
              titulo: 'Talleres',
              desc: 'Actividades prácticas para el desarrollo creativo y socioemocional.',
              items: ['Arte y Música', 'Informática y Robótica', 'Teatro y Expresión'],
            },
            {
              icon: 'sports_soccer',
              titulo: 'Extracurriculares',
              desc: 'Propuestas deportivas, culturales y sociales para la comunidad.',
              items: ['Deportes', 'Voluntariado', 'Clubes Estudiantiles'],
            },
          ].map((card, idx) => (
            <motion.div
              key={card.titulo}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true, margin: "-40px" }}
              transition={{ duration: 0.4, delay: idx * 0.1 }}
              className="group p-8 bg-white rounded-[2.5rem] border border-[#e4e7ec] hover:border-[#fed65b] hover:shadow-[0_32px_64px_-16px_rgba(0,0,0,0.08)] transition-all duration-500 flex flex-col"
            >
              <div className="flex flex-col flex-1">
                <span className="material-symbols-outlined text-4xl text-[#002045] mb-6 group-hover:scale-110 transition-transform duration-500" style={{ fontVariationSettings: "'FILL' 0" }}>
                  {card.icon}
                </span>
                <h4 className="font-['Manrope'] text-lg font-bold text-[#002045] mb-2">{card.titulo}</h4>
                <p className="text-[#43474e] text-sm leading-relaxed mb-5">{card.desc}</p>

                <ul className="space-y-2 mb-8">
                  {card.items.map((item) => (
                    <li key={item} className="flex items-center gap-2 text-xs text-[#43474e]">
                      <span className="w-1 h-1 rounded-full bg-[#fed65b]" />
                      {item}
                    </li>
                  ))}
                </ul>
              </div>

              <Link href="/institucional" className="text-[#002045] font-bold text-xs flex items-center gap-1 group/link hover:text-[#735c00] transition-colors mt-auto">
                Conocer más
                <span className="material-symbols-outlined text-sm group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
              </Link>
            </motion.div>
          ))}
        </div>
      </section>

    </div>
  );
}
