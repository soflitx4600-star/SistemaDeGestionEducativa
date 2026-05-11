"use client";
import { motion, AnimatePresence } from "motion/react";
import { useEffect } from "react";

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

interface Props {
  item: NewsItem | null;
  onClose: () => void;
}

export default function NewsModal({ item, onClose }: Props) {
  useEffect(() => {
    if (!item) return;
    const onKey = (e: KeyboardEvent) => e.key === "Escape" && onClose();
    window.addEventListener("keydown", onKey);
    return () => window.removeEventListener("keydown", onKey);
  }, [item, onClose]);

  return (
    <AnimatePresence>
      {item && (
        <>
          {/* Backdrop */}
          <motion.div
            key="backdrop"
            className="fixed inset-0 z-40 bg-[#002045]/70 backdrop-blur-sm"
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            onClick={onClose}
          />

          {/* Modal */}
          <div className="fixed inset-0 z-50 flex items-center justify-center p-4">
            <motion.div
              layoutId={`card-${item.id}`}
              className="bg-white rounded-2xl overflow-hidden shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col"
            >
              {/* Image */}
              <motion.div layoutId={`image-${item.id}`} className="relative h-64 flex-shrink-0 overflow-hidden">
                <img src={item.image} alt={item.imageAlt} className="w-full h-full object-cover" />
                <div className="absolute inset-0 bg-gradient-to-t from-[#002045]/60 to-transparent" />
                <button
                  onClick={onClose}
                  className="absolute top-4 right-4 w-9 h-9 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center hover:bg-white/40 transition"
                >
                  <span className="material-symbols-outlined text-xl">close</span>
                </button>
                <motion.span
                  layoutId={`tag-${item.id}`}
                  className="absolute bottom-4 left-4 text-[10px] font-bold uppercase tracking-wider text-[#735c00] px-2 py-1 bg-[#fed65b] rounded"
                >
                  {item.tag}
                </motion.span>
              </motion.div>

              {/* Content */}
              <div className="p-8 overflow-y-auto">
                <motion.time
                  layoutId={`date-${item.id}`}
                  className="text-xs text-[#43474e] block mb-3"
                >
                  {item.date}
                </motion.time>
                <motion.h2
                  layoutId={`title-${item.id}`}
                  className="font-['Manrope'] text-2xl font-bold text-[#002045] mb-4 leading-snug"
                >
                  {item.title}
                </motion.h2>
                <motion.p
                  initial={{ opacity: 0, y: 8 }}
                  animate={{ opacity: 1, y: 0 }}
                  transition={{ delay: 0.15 }}
                  className="text-[#43474e] leading-relaxed"
                >
                  {item.body}
                </motion.p>
              </div>
            </motion.div>
          </div>
        </>
      )}
    </AnimatePresence>
  );
}
