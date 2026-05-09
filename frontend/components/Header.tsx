"use client";
import React from 'react';
import Link from 'next/link';
import { usePathname } from 'next/navigation';

export default function Header() {
  const pathname = usePathname();

  const navLinks = [
    { label: 'Inicio', href: '/' },
    { label: 'Institucional', href: '/institucional' },
    { label: 'Propuesta Académica', href: '/propuesta-academica' },
    { label: 'Ingreso', href: '/inscripcion' },
    { label: 'Contactos', href: '/contactos' },
  ];

  return (
    <nav className="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md shadow-[0_8px_32px_rgba(26,54,93,0.06)]">
      <div className="flex justify-between items-center px-6 md:px-12 py-4 w-full max-w-full">
        <div className="flex items-center gap-3">
          <div className="w-12 h-12 bg-white rounded-lg flex items-center justify-center overflow-hidden border border-[#c4c6cf]/20 shadow-sm">
            <img src="/logo.png" alt="Logo Olga M. de Aredez" className="w-full h-full object-contain p-1" />
          </div>
          <span className="font-bold text-[#1A365D] font-['Manrope'] tracking-tight">
            Colegio secundario Olga M. de Aredez N° 59
          </span>
        </div>

        <div className="hidden lg:flex items-center gap-8">
          {navLinks.map((link) => {
            const isActive = pathname === link.href || (link.href !== '/' && pathname?.startsWith(link.href));
            return (
              <Link
                key={link.href}
                href={link.href}
                className={`font-['Manrope'] text-sm tracking-wide uppercase font-semibold transition-colors ${
                  isActive
                    ? 'text-[#735C00] border-b-2 border-[#735C00] pb-1'
                    : 'text-[#1A365D] hover:text-[#735C00]'
                }`}
              >
                {link.label}
              </Link>
            );
          })}
        </div>

        <div className="lg:hidden">
          <span className="material-symbols-outlined text-[#002045]">menu</span>
        </div>
      </div>
    </nav>
  );
}
