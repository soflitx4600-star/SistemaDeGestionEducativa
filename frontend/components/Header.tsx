"use client";
import React, { useState } from 'react';
import Link from 'next/link';
import { usePathname } from 'next/navigation';

export default function Header() {
  const pathname = usePathname();
  const [menuOpen, setMenuOpen] = useState(false);

  const navLinks = [
    { label: 'Inicio', href: '/' },
    { label: 'Institucional', href: '/institucional' },
    { label: 'Propuesta Académica', href: '/propuesta-academica' },
    { label: 'Ingreso', href: '/inscripcion' },
    { label: 'Contactos', href: '/contactos' },
  ];

  return (
    <>
      <nav className="fixed top-0 w-full z-50 bg-[#002045]/40 backdrop-blur-md">
        <div className="flex items-stretch w-full min-h-[64px] md:min-h-[72px]">

          {/* Bloque blanco del logo */}
          <Link
            href="/"
            className="relative z-10 bg-white flex items-center gap-3 shadow-xl flex-shrink-0
                       px-4 py-3 ml-4
                       md:px-6 md:py-4 md:ml-10
                       lg:px-7 lg:pb-8 lg:ml-16"
            style={{ marginBottom: '-20px' }}
          >
            <img
              src="/logo.png"
              alt="Logo"
              className="object-contain flex-shrink-0 w-10 h-10 md:w-12 md:h-12 lg:w-14 lg:h-14"
            />
            <span className="font-bold text-[#002045] font-['Manrope'] leading-tight tracking-tight hidden sm:block text-xs md:text-sm">
              Colegio Secundario<br />
              <span className="text-[#735c00]">Olga Marquez de Aredez</span> N° 59
            </span>
          </Link>

          {/* Links desktop */}
          <div className="hidden lg:flex items-center justify-end gap-5 px-8 flex-1">
            {navLinks.map((link) => {
              const isActive = pathname === link.href || (link.href !== '/' && pathname?.startsWith(link.href));
              return (
                <Link
                  key={link.href}
                  href={link.href}
                  className={`font-['Manrope'] text-[11px] tracking-widest uppercase font-semibold transition-colors whitespace-nowrap ${
                    isActive
                      ? 'text-[#fed65b] border-b-2 border-[#fed65b] pb-0.5'
                      : 'text-white/90 hover:text-[#fed65b]'
                  }`}
                >
                  {link.label}
                </Link>
              );
            })}
          </div>

          {/* Hamburguesa móvil/tablet */}
          <div className="flex lg:hidden items-center px-4 ml-auto">
            <button
              onClick={() => setMenuOpen(!menuOpen)}
              className="text-white/90 hover:text-[#fed65b] transition-colors p-1"
              aria-label="Menú"
            >
              <span className="material-symbols-outlined text-[28px]">
                {menuOpen ? 'close' : 'menu'}
              </span>
            </button>
          </div>
        </div>
      </nav>

      {/* Menú móvil desplegable */}
      {menuOpen && (
        <div className="fixed top-[64px] md:top-[72px] left-0 w-full z-40 bg-[#002045]/97 backdrop-blur-md shadow-xl lg:hidden">
          <div className="flex flex-col py-2">
            {navLinks.map((link) => {
              const isActive = pathname === link.href || (link.href !== '/' && pathname?.startsWith(link.href));
              return (
                <Link
                  key={link.href}
                  href={link.href}
                  onClick={() => setMenuOpen(false)}
                  className={`px-6 py-4 font-['Manrope'] text-xs tracking-widest uppercase font-semibold transition-colors border-b border-white/5 ${
                    isActive ? 'text-[#fed65b] bg-white/5' : 'text-white/80 hover:text-[#fed65b] hover:bg-white/5'
                  }`}
                >
                  {link.label}
                </Link>
              );
            })}
          </div>
        </div>
      )}
    </>
  );
}
