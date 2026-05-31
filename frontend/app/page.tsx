"use client";
import React, { useEffect, useState } from 'react';
import Link from 'next/link';
import { motion, AnimatePresence } from 'motion/react';
import NewsModal from '../components/NewsModal';
import { NewsItem, fetchNews } from '../lib/news';
import { fetchEventos, mapApiEventoToEvento } from '../lib/events-api';
import { Evento } from '../lib/events';

const ofertaCards = [
  {
    img: '/fotos-diseño/Basico.jpg',
    tag: 'Nivel Secundario',
    titulo: 'Ciclo Básico',
    desc: '1° a 3° año con énfasis en pensamiento crítico, lenguaje y ciencias.',
    href: '/propuesta-academica',
  },
  {
    img: '/fotos-diseño/orientado.jpg',
    tag: 'Nivel Secundario',
    titulo: 'Ciclo Orientado',
    desc: 'Especializaciones en Sociales, Naturales y Economía con proyección universitaria.',
    href: '/propuesta-academica',
  },
  {
    img: '/fotos-diseño/arte.jpg',
    tag: 'Actividades',
    titulo: 'Talleres y Arte',
    desc: 'Música, teatro, informática y expresión artística para el desarrollo creativo.',
    href: '/propuesta-academica',
  },
  {
    img: '/fotos-diseño/extracurriculares.png',
    tag: 'Vida Escolar',
    titulo: 'Extracurriculares',
    desc: 'Deportes, voluntariado y clubes estudiantiles para el desarrollo integral.',
    href: '/propuesta-academica',
  },
  {
    img: '/fotos-actividades/acto_bandera.png',
    tag: 'Institucional',
    titulo: 'Vida Institucional',
    desc: 'Actos, ceremonias y tradiciones que forman la identidad de nuestra comunidad.',
    href: '/institucional',
  },
];

function OfertaCarousel() {
  const [active, setActive] = useState(0);
  const [prev, setPrev] = useState<number | null>(null);

  const handleTab = (i: number) => {
    if (i === active) return;
    setPrev(active);
    setActive(i);
  };

  return (
    <section className="w-full bg-[#f7fafc] py-24">
      <div className="max-w-6xl mx-auto px-6 md:px-12">

        {/* Header */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.5 }}
          className="mb-14"
        >
          <span className="inline-block px-4 py-1.5 rounded-full bg-[#fed65b]/20 text-[#735c00] font-bold tracking-[0.2em] uppercase text-xs mb-4">
            Formación académica
          </span>
          <h2 className="font-['Manrope'] text-4xl font-extrabold text-[#002045]">Oferta Educativa</h2>
        </motion.div>

        {/* Tabs */}
        <div className="flex gap-0 mb-0 border-b border-[#e4e7ec] relative">
          {ofertaCards.map((card, i) => (
            <button
              key={card.titulo}
              onClick={() => handleTab(i)}
              className={`relative px-6 py-4 text-xs font-bold uppercase tracking-widest font-['Manrope'] transition-colors duration-200 ${
                i === active ? 'text-[#002045]' : 'text-[#43474e]/60 hover:text-[#002045]'
              }`}
            >
              {card.titulo}
              {i === active && (
                <motion.div
                  layoutId="tab-underline"
                  className="absolute bottom-0 left-0 right-0 h-[3px] bg-[#fed65b]"
                  transition={{ type: 'spring', stiffness: 400, damping: 35 }}
                />
              )}
            </button>
          ))}
        </div>

        {/* Content panel */}
        <div className="relative overflow-hidden">
          <AnimatePresence mode="wait">
            <motion.div
              key={active}
              initial={{ opacity: 0, y: 24 }}
              animate={{ opacity: 1, y: 0 }}
              exit={{ opacity: 0, y: -16 }}
              transition={{ duration: 0.4, ease: [0.32, 0.72, 0, 1] }}
              className="grid grid-cols-1 md:grid-cols-2 gap-0 min-h-[440px]"
            >
              {/* Imagen */}
              <div className="relative overflow-hidden group order-2 md:order-1">
                <img
                  src={ofertaCards[active].img}
                  alt={ofertaCards[active].titulo}
                  className="w-full h-full object-cover min-h-[320px] transition-transform duration-700 group-hover:scale-[1.05]"
                />
                <div className="absolute inset-0 bg-gradient-to-r from-[#002045]/20 to-transparent" />
              </div>

              {/* Texto */}
              <div className="bg-[#002045] flex flex-col justify-center px-10 py-12 order-1 md:order-2">
                <motion.span
                  initial={{ opacity: 0, x: 20 }}
                  animate={{ opacity: 1, x: 0 }}
                  transition={{ delay: 0.1 }}
                  className="text-[10px] font-bold uppercase tracking-[0.3em] text-[#fed65b] mb-4"
                >
                  {ofertaCards[active].tag}
                </motion.span>

                <motion.h3
                  initial={{ opacity: 0, x: 20 }}
                  animate={{ opacity: 1, x: 0 }}
                  transition={{ delay: 0.15 }}
                  className="font-['Manrope'] text-3xl md:text-4xl font-extrabold text-white mb-5 leading-tight"
                >
                  {ofertaCards[active].titulo}
                </motion.h3>

                <motion.p
                  initial={{ opacity: 0, x: 20 }}
                  animate={{ opacity: 1, x: 0 }}
                  transition={{ delay: 0.2 }}
                  className="text-white/60 text-sm leading-relaxed mb-8"
                >
                  {ofertaCards[active].desc}
                </motion.p>

                {/* Step number */}
                <motion.div
                  initial={{ opacity: 0 }}
                  animate={{ opacity: 1 }}
                  transition={{ delay: 0.25 }}
                  className="flex items-center gap-4 mb-8"
                >
                  <span className="text-[80px] font-extrabold text-white/5 leading-none select-none font-['Manrope']">
                    {String(active + 1).padStart(2, '0')}
                  </span>
                  <div className="flex flex-col gap-1">
                    {ofertaCards.map((_, i) => (
                      <button
                        key={i}
                        onClick={() => handleTab(i)}
                        className={`h-[3px] rounded-full transition-all duration-300 ${
                          i === active ? 'w-8 bg-[#fed65b]' : 'w-4 bg-white/20 hover:bg-white/40'
                        }`}
                      />
                    ))}
                  </div>
                </motion.div>

                <motion.div
                  initial={{ opacity: 0, y: 10 }}
                  animate={{ opacity: 1, y: 0 }}
                  transition={{ delay: 0.3 }}
                >
                  <Link
                    href={ofertaCards[active].href}
                    className="inline-flex items-center gap-2 bg-[#fed65b] text-[#002045] px-6 py-3 text-xs font-bold uppercase tracking-widest hover:bg-white transition-colors duration-300"
                  >
                    Conocer más
                    <span className="material-symbols-outlined text-sm">arrow_forward</span>
                  </Link>
                </motion.div>
              </div>
            </motion.div>
          </AnimatePresence>
        </div>

        {/* Progress bar */}
        <div className="flex gap-1 mt-1">
          {ofertaCards.map((_, i) => (
            <button
              key={i}
              onClick={() => handleTab(i)}
              className="flex-1 h-1 rounded-none transition-colors duration-300"
              style={{ background: i === active ? '#fed65b' : '#e4e7ec' }}
            />
          ))}
        </div>
      </div>
    </section>
  );
}

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
  const [lightboxOpen, setLightboxOpen] = useState(false);
  const [lightboxImageIndex, setLightboxImageIndex] = useState(0);

  useEffect(() => {
    const timer = setInterval(() => {
      setCurrent(prev => (prev + 1) % heroImages.length);
    }, 4000);
    return () => clearInterval(timer);
  }, []);

  const [newsItems, setNewsItems] = useState<NewsItem[]>([]);
  const [eventosFromApi, setEventosFromApi] = useState<Evento[]>([]);

  useEffect(() => {
    async function loadNews() {
      try {
        const data = await fetchNews();
        setNewsItems(data.slice(0, 5));
      } catch (err) {
        console.error('Error loading news:', err);
      }
    }
    loadNews();
  }, []);

  useEffect(() => {
    async function loadEventos() {
      try {
        const data = await fetchEventos();
        const mapped = data.map(mapApiEventoToEvento);
        setEventosFromApi(mapped);
      } catch (err) {
        console.error('Error loading eventos:', err);
      }
    }
    loadEventos();
  }, []);

  const hasNews = newsItems.length > 0;
  const [featured, ...rest] = hasNews ? newsItems : [{} as NewsItem];
  
  // Generar eventos por mes desde la API
  const eventosPorMes = (() => {
    const ordenados = [...eventosFromApi].sort((a, b) => {
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
  })();

  const [slideDir, setSlideDir] = useState<1 | -1>(1);

  const openLightbox = (index: number) => {
    setLightboxImageIndex(index);
    setLightboxOpen(true);
  };

  const nextLightboxImage = () => {
    setLightboxImageIndex((prev) => (prev + 1) % galeriaFotos.length);
  };

  const prevLightboxImage = () => {
    setLightboxImageIndex((prev) => (prev - 1 + galeriaFotos.length) % galeriaFotos.length);
  };
  return (
    <div className="bg-[#f7fafc] font-['Inter'] text-[#181c1e]">

      {/* Hero Section */}
      <section className="relative min-h-[580px] flex items-center pt-24 overflow-hidden">
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

        {hasNews ? (
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
        ) : (
          <div className="text-center py-16 text-[#43474e]">
            <span className="material-symbols-outlined text-5xl mb-4 block text-[#c4c6cf]">newspaper</span>
            <p className="text-sm">Cargando noticias...</p>
          </div>
        )}
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
                        <span className="font-bold uppercase tracking-tighter opacity-70">{(ev.mes || '').slice(0, 3)}</span>
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
                      type="button"
                      onClick={() => { setGalleryIndex(i); openLightbox(i); }}
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
            onClick={() => setLightboxOpen(false)}
          >
            <motion.div
              key="lightbox-content"
              className="relative w-full max-w-4xl max-h-[90vh] flex items-center justify-center"
              onClick={(e) => e.stopPropagation()}
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
                layoutId={galeriaFotos[lightboxImageIndex].src}
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
      {/* Oferta Educativa — Animated Carousel */}
      <OfertaCarousel />

    </div>
  );
}
