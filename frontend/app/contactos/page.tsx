import React from 'react';

export default function Contactos() {
  return (
    <div className="bg-[#f7fafc] font-['Inter'] text-[#181c1e]">

      {/* Hero Header */}
      <header className="relative h-[614px] min-h-[400px] flex items-center justify-center overflow-hidden pt-20">
        <div className="absolute inset-0 z-0">
          <img
            className="w-full h-full object-cover"
            src="/fotos-institucion/institucion-frente.png"
            alt="Fachada del colegio"
          />
          <div className="absolute inset-0 bg-gradient-to-tr from-[#002045]/90 to-[#1a365d]/40"></div>
        </div>
        <div className="relative z-10 text-center px-4">
          <span className="text-[#fed65b] font-['Manrope'] font-bold tracking-[0.2em] uppercase text-sm mb-4 block">
            Comunicate con nosotros
          </span>
          <h1 className="text-white font-['Manrope'] font-extrabold text-5xl md:text-7xl tracking-tight">
            Contactos
          </h1>
        </div>
      </header>

      {/* Main Content */}
      <main className="max-w-7xl mx-auto px-8 py-24">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-16">

          {/* Contact Form */}
          <div className="lg:col-span-7 bg-white p-8 md:p-12 rounded-xl shadow-[0_8px_32px_rgba(26,54,93,0.06)]">
            <div className="mb-8">
              <h2 className="text-3xl font-['Manrope'] font-bold text-[#002045] mb-2">Envíanos un mensaje</h2>
              <p className="text-[#43474e]">Completa el formulario y nos pondremos en contacto a la brevedad.</p>
            </div>
            <form className="space-y-6">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div className="space-y-2">
                  <label className="text-xs font-bold text-[#002045] tracking-wider uppercase" htmlFor="name">
                    Nombre Completo
                  </label>
                  <input
                    className="w-full px-5 py-4 bg-[#f1f4f6] border-none rounded-lg focus:ring-2 focus:ring-[#1a365d]/40 transition-all text-[#181c1e] outline-none"
                    id="name"
                    placeholder="Tu nombre"
                    type="text"
                  />
                </div>
                <div className="space-y-2">
                  <label className="text-xs font-bold text-[#002045] tracking-wider uppercase" htmlFor="email">
                    Correo Electrónico
                  </label>
                  <input
                    className="w-full px-5 py-4 bg-[#f1f4f6] border-none rounded-lg focus:ring-2 focus:ring-[#1a365d]/40 transition-all text-[#181c1e] outline-none"
                    id="email"
                    placeholder="email@ejemplo.com"
                    type="email"
                  />
                </div>
              </div>
              <div className="space-y-2">
                <label className="text-xs font-bold text-[#002045] tracking-wider uppercase" htmlFor="subject">
                  Asunto
                </label>
                <select
                  className="w-full px-5 py-4 bg-[#f1f4f6] border-none rounded-lg focus:ring-2 focus:ring-[#1a365d]/40 transition-all text-[#181c1e] outline-none"
                  id="subject"
                >
                  <option>Inscripciones</option>
                  <option>Consultas Generales</option>
                  <option>Secretaría Académica</option>
                  <option>Soporte Técnico</option>
                </select>
              </div>
              <div className="space-y-2">
                <label className="text-xs font-bold text-[#002045] tracking-wider uppercase" htmlFor="message">
                  Mensaje
                </label>
                <textarea
                  className="w-full px-5 py-4 bg-[#f1f4f6] border-none rounded-lg focus:ring-2 focus:ring-[#1a365d]/40 transition-all text-[#181c1e] outline-none resize-none"
                  id="message"
                  placeholder="Escribe tu mensaje aquí..."
                  rows={5}
                ></textarea>
              </div>
              <button
                className="w-full md:w-auto px-10 py-4 bg-[#1a365d] text-white font-['Manrope'] font-bold rounded-lg shadow-lg hover:bg-[#002045] transition-all duration-300 active:scale-95 flex items-center justify-center gap-2"
                type="submit"
              >
                <span>Enviar Mensaje</span>
                <span className="material-symbols-outlined text-sm">send</span>
              </button>
            </form>
          </div>

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
      <section className="w-full h-[500px] relative overflow-hidden bg-[#e5e9eb]">
        <div className="absolute inset-0 flex items-center justify-center">
          <img
            className="w-full h-full object-cover grayscale opacity-50 contrast-125"
            src="/fotos-institucion/institucion-frente.png"
            alt="Ubicación del colegio"
          />
          <div className="absolute inset-0 bg-[#002045]/20"></div>
          {/* Map Marker Info */}
          <div className="relative z-10 bg-white p-6 rounded-xl shadow-2xl flex items-center gap-4 max-w-sm mx-4">
            <div className="w-12 h-12 rounded-full bg-[#1a365d] flex items-center justify-center text-white shrink-0">
              <span className="material-symbols-outlined" style={{ fontVariationSettings: "'FILL' 1" }}>school</span>
            </div>
            <div>
              <h5 className="font-['Manrope'] font-bold text-[#002045]">Colegio Secundario N°59</h5>
              <p className="text-xs text-[#43474e] font-medium">Alvear 1145, Jujuy</p>
              <a className="text-[#735c00] text-[10px] font-bold uppercase tracking-widest mt-2 block hover:underline" href="#">
                Cómo llegar
              </a>
            </div>
          </div>
        </div>
      </section>

    </div>
  );
}
