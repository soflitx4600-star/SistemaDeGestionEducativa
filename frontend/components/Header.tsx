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
      {/* Navbar principal */}
      <nav className="fixed top-0 w-full z-50 bg-[#002045]/40 backdrop-blur-md">
        <div className="flex items-stretch w-full min-h-[72px]">

          {/* Bloque blanco del logo — sobresale hacia abajo, separado del borde izquierdo */}
          <Link
            href="/"
            className="relative z-10 bg-white flex items-center gap-4 shadow-xl"
            style={{ minWidth: '300px', marginBottom: '-24px', marginLeft: '64px', paddingBottom: '32px', paddingTop: '16px', paddingLeft: '28px', paddingRight: '32px' }}
          >
            <img src="/logo.png" alt="Logo" className="w-14 h-14 object-contain flex-shrink-0" />
            <span className="font-bold text-[#002045] font-['Manrope'] text-sm leading-tight tracking-tight">
              Colegio Secundario<br />
              <span className="text-[#735c00]">Olga M. de Aredez</span> N° 59
            </span>
          </Link>

          {/* Links de navegación — desktop */}
          <div className="hidden lg:flex items-center justify-end gap-6 px-10 flex-1">
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

          {/* Hamburguesa móvil */}
          <div className="flex lg:hidden items-center px-6">
            <button
              onClick={() => setMenuOpen(!menuOpen)}
              className="text-white/80 hover:text-[#fed65b] transition-colors"
              aria-label="Menú"
            >
              <span className="material-symbols-outlined text-[26px]">menu</span>
            </button>
          </div>
        </div>
      </nav>

      {/* Menú móvil desplegable */}
      {menuOpen && (
        <div className="fixed top-[72px] left-0 w-full z-40 bg-[#002045]/95 backdrop-blur-md shadow-xl lg:hidden">
          <div className="flex flex-col py-4">
            {navLinks.map((link) => {
              const isActive = pathname === link.href || (link.href !== '/' && pathname?.startsWith(link.href));
              return (
                <Link
                  key={link.href}
                  href={link.href}
                  onClick={() => setMenuOpen(false)}
                  className={`px-8 py-3 font-['Manrope'] text-xs tracking-widest uppercase font-semibold transition-colors ${
                    isActive ? 'text-[#fed65b]' : 'text-white/80 hover:text-[#fed65b]'
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
