'use client';
import { useState, useEffect } from 'react';
import { motion, AnimatePresence } from 'motion/react';
import { NewsItem, fetchNews } from '../../lib/news';
import NewsModal from '../../components/NewsModal';

export default function Noticias() {
  const [activeTag, setActiveTag] = useState('Todos');
  const [selected, setSelected] = useState<NewsItem | null>(null);
  const [news, setNews] = useState<NewsItem[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    async function loadNews() {
      try {
        setLoading(true);
        const data = await fetchNews();
        setNews(data);
      } catch (err) {
        setError('Error al cargar las noticias. Intente nuevamente más tarde.');
        console.error(err);
      } finally {
        setLoading(false);
      }
    }
    loadNews();
  }, []);

  const tags = ['Todos', ...Array.from(new Set(news.map(n => n.tag)))];
  const filtered = activeTag === 'Todos' ? news : news.filter(n => n.tag === activeTag);

  return (
    <div className="bg-[#f7fafc] font-['Inter'] text-[#181c1e]">

      {/* Header */}
      <header className="relative h-[400px] flex items-center justify-center overflow-hidden pt-20">
        <div className="absolute inset-0 z-0">
          <img
            src="/fotos-institucion/institucion-frente.png"
            alt="Noticias"
            className="w-full h-full object-cover"
          />
          <div className="absolute inset-0 bg-gradient-to-tr from-[#002045]/90 to-[#1a365d]/40" />
        </div>
        <div className="relative z-10 text-center px-4">
          <span className="text-[#fed65b] font-['Manrope'] font-bold tracking-[0.2em] uppercase text-sm mb-4 block">
            Vida Institucional
          </span>
          <h1 className="text-white font-['Manrope'] font-extrabold text-5xl md:text-6xl tracking-tight">
            Novedades y Actividades
          </h1>
          <p className="text-white/80 mt-4 text-lg max-w-xl mx-auto">
            Manténgase al tanto del día a día en nuestra comunidad educativa.
          </p>
        </div>
      </header>

      {/* Filtros */}
      <div className="sticky top-[72px] z-30 bg-white/90 backdrop-blur-md border-b border-[#e5e9eb]">
        <div className="max-w-7xl mx-auto px-6 md:px-12 py-4 flex gap-2 flex-wrap">
          {tags.map(tag => (
            <button
              key={tag}
              onClick={() => setActiveTag(tag)}
              className={`px-4 py-2 rounded-full text-sm font-bold transition-all ${
                activeTag === tag
                  ? 'bg-[#002045] text-white shadow'
                  : 'bg-[#f1f4f6] text-[#43474e] hover:bg-[#e5e9eb]'
              }`}
            >
              {tag}
            </button>
          ))}
          <span className="ml-auto text-xs text-[#43474e] self-center">
            {loading ? 'Cargando...' : `${filtered.length} ${filtered.length === 1 ? 'noticia' : 'noticias'}`}
          </span>
        </div>
      </div>

      {/* Grid */}
      <main className="max-w-7xl mx-auto px-6 md:px-12 py-16">
        {loading ? (
          <div className="text-center py-24 text-[#43474e]">
            <span className="material-symbols-outlined text-5xl mb-4 block text-[#c4c6cf] animate-pulse">newspaper</span>
            Cargando noticias...
          </div>
        ) : error ? (
          <div className="text-center py-24 text-[#43474e]">
            <span className="material-symbols-outlined text-5xl mb-4 block text-[#c4c6cf]">error</span>
            {error}
          </div>
        ) : (
          <motion.div layout className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <AnimatePresence mode="popLayout">
              {filtered.map((item) => (
                <motion.article
                  key={item.id}
                  layoutId={`card-${item.id}`}
                  initial={{ opacity: 0, scale: 0.96 }}
                  animate={{ opacity: 1, scale: 1 }}
                  exit={{ opacity: 0, scale: 0.96 }}
                  transition={{ duration: 0.2 }}
                  onClick={() => setSelected(item)}
                  className="group bg-white rounded-2xl overflow-hidden shadow-[0_8px_32px_rgba(26,54,93,0.06)] cursor-pointer hover:-translate-y-1 transition-transform"
                >
                  <motion.div layoutId={`image-${item.id}`} className="aspect-[16/10] overflow-hidden">
                    {item.image ? (
                      <img
                        src={item.image}
                        alt={item.imageAlt}
                        className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                      />
                    ) : (
                      <div className="w-full h-full bg-gradient-to-br from-[#002045] to-[#1a365d] flex items-center justify-center">
                        <span className="material-symbols-outlined text-6xl text-white/30">newspaper</span>
                      </div>
                    )}
                  </motion.div>
                  <div className="p-6">
                    <div className="flex items-center gap-4 mb-4">
                      <motion.span
                        layoutId={`tag-${item.id}`}
                        className="text-[10px] font-bold uppercase tracking-wider text-[#735c00] px-2 py-1 bg-[#fed65b] rounded"
                      >
                        {item.tag}
                      </motion.span>
                      <motion.time layoutId={`date-${item.id}`} className="text-xs text-[#43474e]">
                        {item.date}
                      </motion.time>
                    </div>
                    <motion.h3
                      layoutId={`title-${item.id}`}
                      className="font-['Manrope'] text-xl font-bold text-[#002045] mb-3 leading-snug"
                    >
                      {item.title}
                    </motion.h3>
                    <p className="text-sm text-[#43474e] line-clamp-3 mb-6">{item.excerpt}</p>
                    <span className="inline-flex items-center text-[#002045] font-bold text-sm gap-2 hover:text-[#735c00] transition">
                      Leer nota <span className="material-symbols-outlined text-base">east</span>
                    </span>
                  </div>
                </motion.article>
              ))}
            </AnimatePresence>
          </motion.div>
        )}

        {!loading && !error && filtered.length === 0 && (
          <div className="text-center py-24 text-[#43474e]">
            <span className="material-symbols-outlined text-5xl mb-4 block text-[#c4c6cf]">newspaper</span>
            No hay noticias en esta categoría.
          </div>
        )}
      </main>

      <NewsModal item={selected} onClose={() => setSelected(null)} />
    </div>
  );
}