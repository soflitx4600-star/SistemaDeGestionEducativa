"use client";
import React, { useState } from 'react';

export default function PropuestaAcademica() {
  const [openCard, setOpenCard] = useState<number | null>(null);

  const toggleCard = (index: number) => {
    setOpenCard(openCard === index ? null : index);
  };

  return (
    <div className="w-full flex-col flex gap-24 pb-24 bg-[#faf9fd]">
      
      {/* Hero Section */}
      <section className="h-[400px] flex items-center overflow-hidden bg-gradient-to-r from-[#001733] to-[#1a3c66] relative">
        <div className="absolute top-0 right-0 w-1/2 h-full bg-white/5 opacity-50 skew-x-12 transform origin-bottom-right"></div>
        <div className="max-w-[1200px] mx-auto w-full px-6 relative z-10">
          <h1 className="text-5xl md:text-6xl font-extrabold text-white font-['Manrope'] tracking-tight">
            Propuesta Académica
          </h1>
        </div>
      </section>

      {/* Turno Mañana y Tarde */}
      <section className="max-w-[1200px] mx-auto px-6 w-full">
         <div className="flex flex-col md:flex-row justify-between md:items-end gap-6 mb-12">
            <div>
              <p className="text-[11px] font-bold text-[#886e00] tracking-widest uppercase mb-2 flex items-center gap-2">
                 <span className="w-6 h-[2px] bg-[#886e00]"></span> HORARIO DIURNO (MAÑANA Y TARDE)
              </p>
              <h2 className="text-4xl font-extrabold text-[#002045] font-['Manrope'] tracking-tight">Turno Mañana y Tarde</h2>
            </div>
            <div className="border-l-4 border-[#fddd7c] pl-4 max-w-sm">
               <p className="text-sm text-[#43474e] font-['Inter'] italic leading-relaxed">
                 Orientaciones técnicas y científicas enfocadas en la innovación y el desarrollo regional.
               </p>
            </div>
         </div>

         <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            {/* Informatica */}
            <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
               <div className="flex justify-between items-start mb-6">
                  <div className="w-12 h-12 rounded-full bg-[#f2f4f7] flex items-center justify-center text-[#002045]">
                     💻
                  </div>
                  <span className="bg-[#fcf5e3] text-[#735c00] text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full">
                    Bachiller en Informática
                  </span>
               </div>
               
               <h3 className="font-['Manrope'] text-2xl font-bold text-[#002045] mb-4">Informática</h3>
               <p className="text-xs font-bold text-[#002045] tracking-wider mb-2 font-['Inter']">¿QUÉ VOY A APRENDER EN ESTA ORIENTACIÓN?</p>
               <p className="text-sm text-[#43474e] font-['Inter'] leading-relaxed mb-8">
                 A explorar y analizar herramientas informáticas, comprender la industria del software, configurar sistemas, y desarrollar aplicaciones y sitios web para resolver necesidades sociocomunitarias.
               </p>

               <button 
                  onClick={() => toggleCard(1)}
                  className="w-full flex justify-between items-center bg-[#f8f9fc] p-4 rounded-xl text-sm font-bold text-[#002045] font-['Inter'] hover:bg-[#f1f4f8] transition-colors"
               >
                  <span className="flex items-center gap-2">🏛️ Ver Estructura Curricular</span>
                  <span className={`transform transition-transform ${openCard === 1 ? 'rotate-180' : ''}`}>▼</span>
               </button>
               {openCard === 1 && (
                  <div className="p-4 mt-2 text-sm text-gray-500 bg-gray-50 rounded-xl border border-gray-100">
                    Contenido de la estructura curricular en desarrollo...
                  </div>
               )}
            </div>

            {/* Ciencias Naturales */}
            <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
               <div className="flex justify-between items-start mb-6">
                  <div className="w-12 h-12 rounded-full bg-[#f2f4f7] flex items-center justify-center text-[#002045]">
                     🔬
                  </div>
                  <span className="bg-[#f1f4f8] text-[#002045] text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full">
                    Bachiller en Cs. Naturales
                  </span>
               </div>
               
               <h3 className="font-['Manrope'] text-2xl font-bold text-[#002045] mb-4">Ciencias Naturales</h3>
               <p className="text-xs font-bold text-[#002045] tracking-wider mb-2 font-['Inter']">¿QUÉ VOY A APRENDER EN ESTA ORIENTACIÓN?</p>
               <p className="text-sm text-[#43474e] font-['Inter'] leading-relaxed mb-8">
                 A interpretar problemas ambientales y de salud, desarrollar proyectos científicos sustentables y comprender la relación entre ciencia, tecnología y calidad de vida desde una mirada integradora.
               </p>

               <button 
                  onClick={() => toggleCard(2)}
                  className="w-full flex justify-between items-center bg-[#f8f9fc] p-4 rounded-xl text-sm font-bold text-[#002045] font-['Inter'] hover:bg-[#f1f4f8] transition-colors"
               >
                  <span className="flex items-center gap-2">🏛️ Ver Estructura Curricular</span>
                  <span className={`transform transition-transform ${openCard === 2 ? 'rotate-180' : ''}`}>▼</span>
               </button>
               {openCard === 2 && (
                  <div className="p-4 mt-2 text-sm text-gray-500 bg-gray-50 rounded-xl border border-gray-100">
                    Contenido de la estructura curricular en desarrollo...
                  </div>
               )}
            </div>

         </div>
      </section>

      {/* Turno Noche */}
      <section className="max-w-[1200px] mx-auto px-6 w-full">
         <div className="flex flex-col md:flex-row justify-between md:items-end gap-6 mb-12">
            <div>
              <p className="text-[11px] font-bold text-[#002045] tracking-widest uppercase mb-2 flex items-center gap-2">
                 <span className="w-6 h-[2px] bg-[#002045]"></span> HORARIO NOCTURNO
              </p>
              <h2 className="text-4xl font-extrabold text-[#002045] font-['Manrope'] tracking-tight">Turno Noche</h2>
            </div>
            <div className="border-l-4 border-[#002045] pl-4 max-w-sm">
               <p className="text-sm text-[#43474e] font-['Inter'] italic leading-relaxed">
                 Formación para adultos y jóvenes con orientaciones en gestión social y económica.
               </p>
            </div>
         </div>

         <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            {/* Economia */}
            <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
               <div className="flex justify-between items-start mb-6">
                  <div className="w-12 h-12 rounded-full bg-[#f2f4f7] flex items-center justify-center text-[#002045]">
                     📊
                  </div>
                  <span className="bg-[#fcf5e3] text-[#735c00] text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full">
                    Bachiller en Economía
                  </span>
               </div>
               
               <h3 className="font-['Manrope'] text-2xl font-bold text-[#002045] mb-4">Economía y Administración</h3>
               <p className="text-xs font-bold text-[#002045] tracking-wider mb-2 font-['Inter']">¿QUÉ VOY A APRENDER EN ESTA ORIENTACIÓN?</p>
               <p className="text-sm text-[#43474e] font-['Inter'] leading-relaxed mb-8">
                 A gestionar organizaciones, tomar decisiones financieras, elaborar proyectos de emprendedurismo sustentable y utilizar herramientas contables para la economía social y solidaria.
               </p>

               <button 
                  onClick={() => toggleCard(3)}
                  className="w-full flex justify-between items-center bg-[#f8f9fc] p-4 rounded-xl text-sm font-bold text-[#002045] font-['Inter'] hover:bg-[#f1f4f8] transition-colors"
               >
                  <span className="flex items-center gap-2">🏛️ Ver Estructura Curricular</span>
                  <span className={`transform transition-transform ${openCard === 3 ? 'rotate-180' : ''}`}>▼</span>
               </button>
               {openCard === 3 && (
                  <div className="p-4 mt-2 text-sm text-gray-500 bg-gray-50 rounded-xl border border-gray-100">
                    Contenido de la estructura curricular en desarrollo...
                  </div>
               )}
            </div>

            {/* Cs Sociales */}
            <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
               <div className="flex justify-between items-start mb-6">
                  <div className="w-12 h-12 rounded-full bg-[#f2f4f7] flex items-center justify-center text-[#002045]">
                     👥
                  </div>
                  <span className="bg-[#f1f4f8] text-[#002045] text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full">
                    Bachiller en Cs. Sociales
                  </span>
               </div>
               
               <h3 className="font-['Manrope'] text-2xl font-bold text-[#002045] mb-4">Ciencias Sociales y Humanidades</h3>
               <p className="text-xs font-bold text-[#002045] tracking-wider mb-2 font-['Inter']">¿QUÉ VOY A APRENDER EN ESTA ORIENTACIÓN?</p>
               <p className="text-sm text-[#43474e] font-['Inter'] leading-relaxed mb-8">
                 A interpretar problemas sociales contemporáneos, desarrollar compromiso ciudadano, realizar investigaciones comunitarias y analizar críticamente la historia, el Estado y la cultura.
               </p>

               <button 
                  onClick={() => toggleCard(4)}
                  className="w-full flex justify-between items-center bg-[#f8f9fc] p-4 rounded-xl text-sm font-bold text-[#002045] font-['Inter'] hover:bg-[#f1f4f8] transition-colors"
               >
                  <span className="flex items-center gap-2">🏛️ Ver Estructura Curricular</span>
                  <span className={`transform transition-transform ${openCard === 4 ? 'rotate-180' : ''}`}>▼</span>
               </button>
               {openCard === 4 && (
                  <div className="p-4 mt-2 text-sm text-gray-500 bg-gray-50 rounded-xl border border-gray-100">
                    Contenido de la estructura curricular en desarrollo...
                  </div>
               )}
            </div>

         </div>
      </section>

    </div>
  );
}
