'use client';
import React, { useState } from 'react';

function ContactForm() {
  const [form, setForm] = useState({ nombre_completo: '', correo_electronico: '', telefono: '', asunto: 'Inscripciones', mensaje: '' });
  const [status, setStatus] = useState<'idle' | 'loading' | 'ok' | 'error'>('idle');

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setStatus('loading');
    try {
      const res = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/consultas`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify(form),
      });
      setStatus(res.ok ? 'ok' : 'error');
    } catch {
      setStatus('error');
    }
  };

  return (
    <div className="lg:col-span-7 bg-white p-8 md:p-12 rounded-xl shadow-[0_8px_32px_rgba(26,54,93,0.06)]">
      <div className="mb-8">
        <h2 className="text-3xl font-['Manrope'] font-bold text-[#002045] mb-2">Envíanos un mensaje</h2>
        <p className="text-[#43474e]">Completa el formulario y nos pondremos en contacto a la brevedad.</p>
      </div>

      {status === 'ok' ? (
        <div className="flex flex-col items-center justify-center py-16 gap-4 text-center">
          <div className="w-16 h-16 rounded-full bg-[#003f25] flex items-center justify-center">
            <span className="material-symbols-outlined text-[#9ff5c1] text-3xl" style={{ fontVariationSettings: "'FILL' 1" }}>check_circle</span>
          </div>
          <h3 className="font-['Manrope'] font-bold text-[#002045] text-xl">Mensaje enviado</h3>
          <p className="text-[#43474e] text-sm">Nos pondremos en contacto a la brevedad.</p>
          <button onClick={() => { setStatus('idle'); setForm({ nombre_completo: '', correo_electronico: '', telefono: '', asunto: 'Inscripciones', mensaje: '' }); }} className="mt-2 text-[#1a365d] font-bold text-sm hover:underline">Enviar otro mensaje</button>
        </div>
      ) : (
        <form className="space-y-6" onSubmit={handleSubmit}>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div className="space-y-2">
              <label className="text-xs font-bold text-[#002045] tracking-wider uppercase" htmlFor="nombre_completo">Nombre Completo</label>
              <input
                className="w-full px-5 py-4 bg-[#f1f4f6] border-none rounded-lg focus:ring-2 focus:ring-[#1a365d]/40 transition-all text-[#181c1e] outline-none"
                id="nombre_completo" placeholder="Tu nombre" type="text" required
                value={form.nombre_completo} onChange={e => setForm(f => ({ ...f, nombre_completo: e.target.value }))}
              />
            </div>
            <div className="space-y-2">
              <label className="text-xs font-bold text-[#002045] tracking-wider uppercase" htmlFor="correo_electronico">Correo Electrónico</label>
              <input
                className="w-full px-5 py-4 bg-[#f1f4f6] border-none rounded-lg focus:ring-2 focus:ring-[#1a365d]/40 transition-all text-[#181c1e] outline-none"
                id="correo_electronico" placeholder="email@ejemplo.com" type="email" required
                value={form.correo_electronico} onChange={e => setForm(f => ({ ...f, correo_electronico: e.target.value }))}
              />
            </div>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div className="space-y-2">
              <label className="text-xs font-bold text-[#002045] tracking-wider uppercase" htmlFor="telefono">Teléfono</label>
              <input
                className="w-full px-5 py-4 bg-[#f1f4f6] border-none rounded-lg focus:ring-2 focus:ring-[#1a365d]/40 transition-all text-[#181c1e] outline-none"
                id="telefono" placeholder="+54 388 000-0000" type="tel" required
                value={form.telefono} onChange={e => setForm(f => ({ ...f, telefono: e.target.value }))}
              />
            </div>
            <div className="space-y-2">
              <label className="text-xs font-bold text-[#002045] tracking-wider uppercase" htmlFor="asunto">Asunto</label>
              <select
                className="w-full px-5 py-4 bg-[#f1f4f6] border-none rounded-lg focus:ring-2 focus:ring-[#1a365d]/40 transition-all text-[#181c1e] outline-none"
                id="asunto" value={form.asunto} onChange={e => setForm(f => ({ ...f, asunto: e.target.value }))}
              >
                <option>Inscripciones</option>
                <option>Consultas Generales</option>
                <option>Secretaría Académica</option>
                <option>Soporte Técnico</option>
              </select>
            </div>
          </div>
          <div className="space-y-2">
            <label className="text-xs font-bold text-[#002045] tracking-wider uppercase" htmlFor="message">Mensaje</label>
            <textarea
                className="w-full px-5 py-4 bg-[#f1f4f6] border-none rounded-lg focus:ring-2 focus:ring-[#1a365d]/40 transition-all text-[#181c1e] outline-none resize-none"
                id="message" placeholder="Escribe tu mensaje aquí..." rows={5} required
                value={form.mensaje} onChange={e => setForm(f => ({ ...f, mensaje: e.target.value }))}
              />
          </div>
          {status === 'error' && (
            <p className="text-red-600 text-sm">Ocurrió un error al enviar. Intentá de nuevo.</p>
          )}
          <button
            className="w-full md:w-auto px-10 py-4 bg-[#1a365d] text-white font-['Manrope'] font-bold rounded-lg shadow-lg hover:bg-[#002045] transition-all duration-300 active:scale-95 flex items-center justify-center gap-2 disabled:opacity-60"
            type="submit" disabled={status === 'loading'}
          >
            <span>{status === 'loading' ? 'Enviando...' : 'Enviar Mensaje'}</span>
            <span className="material-symbols-outlined text-sm">{status === 'loading' ? 'hourglass_empty' : 'send'}</span>
          </button>
        </form>
      )}
    </div>
  );
}

export default function Contactos() {
  return (
    <div className="bg-[#f7fafc] font-['Inter'] text-[#181c1e]">

      {/* Hero Header */}
      <header className="relative h-[280px] md:h-[614px] min-h-[280px] flex items-center justify-center overflow-hidden pt-16 md:pt-20">
        <div className="absolute inset-0 z-0">
          <img
            className="w-full h-full object-cover"
            src="/fotos-institucion/institucion-frente.png"
            alt="Fachada del colegio"
          />
          <div className="absolute inset-0 bg-gradient-to-tr from-[#002045]/90 to-[#1a365d]/40"></div>
        </div>
        <div className="relative z-10 text-center px-4">
          <span className="text-[#fed65b] font-['Manrope'] font-bold tracking-[0.2em] uppercase text-xs md:text-sm mb-2 md:mb-4 block">
            Comunicate con nosotros
          </span>
          <h1 className="text-white font-['Manrope'] font-extrabold text-3xl sm:text-5xl md:text-7xl tracking-tight">
            Contactos
          </h1>
        </div>
      </header>

      {/* Main Content */}
      <main className="max-w-7xl mx-auto px-4 md:px-8 py-12 md:py-24">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-16">

          {/* Contact Form */}
          <ContactForm />

          {/* Contact Details */}
          <div className="lg:col-span-5 space-y-8">
            <div className="bg-[#f1f4f6] p-8 rounded-xl border-l-4 border-[#735c00]">
              <h3 className="text-2xl font-['Manrope'] font-bold text-[#002045] mb-6">Información Institucional</h3>
              <div className="space-y-6">
                <div className="flex items-start gap-4">
                  <div className="w-12 h-12 flex items-center justify-center bg-white rounded-lg shadow-sm shrink-0">
                    <span className="material-symbols-outlined text-[#735c00]">location_on</span>
                  </div>
                  <div>
                    <p className="text-xs font-bold text-[#1a365d] uppercase tracking-wider mb-1">Dirección</p>
                    <p className="text-[#181c1e] font-medium leading-relaxed">
                      Alvear Nº 1145, S. S. de Jujuy,<br />Provincia de Jujuy, Argentina
                    </p>
                  </div>
                </div>
                <div className="flex items-start gap-4">
                  <div className="w-12 h-12 flex items-center justify-center bg-white rounded-lg shadow-sm shrink-0">
                    <span className="material-symbols-outlined text-[#735c00]">phone_iphone</span>
                  </div>
                  <div>
                    <p className="text-xs font-bold text-[#1a365d] uppercase tracking-wider mb-1">Teléfono</p>
                    <p className="text-[#181c1e] font-medium leading-relaxed">+54 0388 422-xxxx</p>
                  </div>
                </div>
                <div className="flex items-start gap-4">
                  <div className="w-12 h-12 flex items-center justify-center bg-white rounded-lg shadow-sm shrink-0">
                    <span className="material-symbols-outlined text-[#735c00]">mail</span>
                  </div>
                  <div>
                    <p className="text-xs font-bold text-[#1a365d] uppercase tracking-wider mb-1">Email</p>
                    <p className="text-[#181c1e] font-medium leading-relaxed">contacto@colegio59.edu.ar</p>
                  </div>
                </div>
                <div className="flex items-start gap-4">
                  <div className="w-12 h-12 flex items-center justify-center bg-white rounded-lg shadow-sm shrink-0">
                    <span className="material-symbols-outlined text-[#735c00]">schedule</span>
                  </div>
                  <div>
                    <p className="text-xs font-bold text-[#1a365d] uppercase tracking-wider mb-1">Atención Administrativa</p>
                    <p className="text-[#181c1e] font-medium leading-relaxed">
                      Lunes a Viernes: 08:00 - 12:00<br />Tarde: 14:00 - 18:00
                    </p>
                  </div>
                </div>
              </div>
            </div>

            {/* Admissions Card */}
            <div className="bg-[#1a365d] text-white p-8 rounded-xl relative overflow-hidden group">
              <div className="absolute top-0 right-0 w-32 h-32 bg-[#fed65b]/10 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-150 duration-700"></div>
              <h4 className="text-xl font-['Manrope'] font-bold mb-3">¿Dudas sobre el ingreso?</h4>
              <p className="text-[#86a0cd] text-sm mb-6 leading-relaxed">
                Consulta los requisitos y fechas clave para el ciclo lectivo actual en nuestra sección de inscripciones.
              </p>
              <a
                className="inline-flex items-center gap-2 text-[#fed65b] font-bold hover:underline transition-all"
                href="/inscripcion"
              >
                Ver requisitos de ingreso
                <span className="material-symbols-outlined text-sm">arrow_forward</span>
              </a>
            </div>
          </div>

        </div>
      </main>

      {/* Map Section */}
      <section className="w-full relative">
        <div className="max-w-7xl mx-auto px-8 pb-24">
          <div className="rounded-2xl overflow-hidden shadow-[0_8px_32px_rgba(26,54,93,0.10)] border border-[#e5e9eb]">
            <div className="bg-[#002045] px-8 py-5 flex items-center gap-3">
              <span className="material-symbols-outlined text-[#fed65b]" style={{ fontVariationSettings: "'FILL' 1" }}>location_on</span>
              <div>
                <p className="text-white font-['Manrope'] font-bold text-sm">Colegio Secundario N°59 "Olga Márquez de Aredez"</p>
                <p className="text-[#86a0cd] text-xs">Gral. Alvear 1145, Y4600 San Salvador de Jujuy, Jujuy</p>
              </div>
              <a
                href="https://maps.google.com/?q=Colegio+Secundario+N59+Olga+Marquez+de+Aredez+Gral+Alvear+1145+San+Salvador+de+Jujuy"
                target="_blank"
                rel="noopener noreferrer"
                className="ml-auto text-[#fed65b] text-xs font-bold flex items-center gap-1 hover:underline"
              >
                Abrir en Google Maps
                <span className="material-symbols-outlined text-sm">open_in_new</span>
              </a>
            </div>
            <iframe
              title="Ubicación Colegio Secundario N°59 Olga Aredez"
              src="https://maps.google.com/maps?q=Colegio+Secundario+N%C2%BA59+Olga+Marquez+de+Aredez+Gral.+Alvear+1145+San+Salvador+de+Jujuy&output=embed&z=17"
              width="100%"
              height="480"
              style={{ border: 0, display: 'block' }}
              allowFullScreen
              loading="lazy"
              referrerPolicy="no-referrer-when-downgrade"
            />
          </div>
        </div>
      </section>

    </div>
  );
}
