import React from 'react';
import Link from 'next/link';

export default function Footer() {
  return (
    <footer className="bg-[#002045] relative w-full rounded-t-[2.5rem] mt-20">
      <div className="grid grid-cols-1 md:grid-cols-3 gap-12 px-6 md:px-12 py-16 w-full max-w-7xl mx-auto">

        {/* Brand & Info */}
        <div className="space-y-6">
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 bg-white rounded flex items-center justify-center overflow-hidden">
              <img src="/logo.png" alt="Logo Olga M. de Aredez" className="w-full h-full object-contain p-1" />
            </div>
            <span className="text-xl font-black text-[#FED65B] font-['Manrope'] tracking-tighter">
              Colegio secundario Olga M. de Aredez N° 59
            </span>
          </div>
          <p className="text-sm leading-relaxed text-slate-300">
            Comprometidos con la formación integral, humana y académica de niños y jóvenes desde 1985. Líderes en innovación educativa.
          </p>
          <div className="space-y-3">
            <div className="flex items-center gap-3 text-slate-300">
              <span className="material-symbols-outlined text-[#fed65b]">location_on</span>
              <span className="text-xs">Av. Principal 1234, Ciudad Educativa</span>
            </div>
            <div className="flex items-center gap-3 text-slate-300">
              <span className="material-symbols-outlined text-[#fed65b]">call</span>
              <span className="text-xs">+54 011 4567-8900</span>
            </div>
            <div className="flex items-center gap-3 text-slate-300">
              <span className="material-symbols-outlined text-[#fed65b]">mail</span>
              <span className="text-xs">info@colegio.edu.ar</span>
            </div>
          </div>
        </div>

        {/* Social Media & Maps */}
        <div className="space-y-8">
          <h4 className="text-white font-['Manrope'] font-bold uppercase tracking-widest text-sm">Síguenos</h4>
          <div className="grid grid-cols-2 gap-4">
            <Link href="#" className="flex items-center gap-2 text-slate-300 hover:text-white transition-colors group">
              <span className="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center group-hover:bg-[#fed65b] group-hover:text-[#002045] transition-all">
                <span className="material-symbols-outlined text-lg">public</span>
              </span>
              <span className="text-sm font-medium">Instagram</span>
            </Link>
            <Link href="#" className="flex items-center gap-2 text-slate-300 hover:text-white transition-colors group">
              <span className="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center group-hover:bg-[#fed65b] group-hover:text-[#002045] transition-all">
                <span className="material-symbols-outlined text-lg">groups</span>
              </span>
              <span className="text-sm font-medium">Facebook</span>
            </Link>
            <Link href="#" className="flex items-center gap-2 text-slate-300 hover:text-white transition-colors group">
              <span className="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center group-hover:bg-[#fed65b] group-hover:text-[#002045] transition-all">
                <span className="material-symbols-outlined text-lg">play_circle</span>
              </span>
              <span className="text-sm font-medium">YouTube</span>
            </Link>
            <Link href="#" className="flex items-center gap-2 text-slate-300 hover:text-[#FED65B] transition-colors group">
              <span className="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center group-hover:bg-[#fed65b] group-hover:text-[#002045] transition-all">
                <span className="material-symbols-outlined text-lg">map</span>
              </span>
              <span className="text-sm font-medium">Google Maps</span>
            </Link>
          </div>

          {/* Map */}
          <div className="w-full h-32 rounded-xl bg-slate-800 overflow-hidden relative border border-white/5">
            <img
              src="/fotos-institucion/institucion-frente.png"
              alt="Ubicación"
              className="w-full h-full object-cover opacity-50 grayscale"
            />
            <div className="absolute inset-0 flex items-center justify-center">
              <div className="bg-[#fed65b] p-2 rounded-full shadow-lg">
                <span className="material-symbols-outlined text-[#002045]" style={{ fontVariationSettings: "'FILL' 1" }}>location_on</span>
              </div>
            </div>
          </div>
        </div>

        {/* Fast Links */}
        <div className="space-y-6">
          <h4 className="text-white font-['Manrope'] font-bold uppercase tracking-widest text-sm">Páginas</h4>
          <nav className="flex flex-col gap-4">
            <Link href="/" className="text-slate-300 hover:text-white transition-colors text-sm">Inicio</Link>
            <Link href="/institucional" className="text-slate-300 hover:text-white transition-colors text-sm">Institucional</Link>
            <Link href="/propuesta-academica" className="text-slate-300 hover:text-white transition-colors text-sm">Propuesta Académica</Link>
            <Link href="/inscripcion" className="text-slate-300 hover:text-white transition-colors text-sm">Inscripción</Link>
            <Link href="/noticias" className="text-slate-300 hover:text-white transition-colors text-sm">Noticias</Link>
            <Link href="/contactos" className="text-slate-300 hover:text-white transition-colors text-sm">Contactos</Link>
          </nav>
          <div className="pt-6 border-t border-white/10">
            <p className="text-xs text-slate-400">© 2024 Colegio. Todos los derechos reservados.</p>
          </div>
        </div>

      </div>
    </footer>
  );
}
