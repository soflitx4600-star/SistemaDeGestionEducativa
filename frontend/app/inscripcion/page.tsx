import React from 'react';
import Link from 'next/link';

export default function Inscripcion() {
  return (
    <div className="w-full flex-col flex gap-24 pb-24 bg-[#faf9fd]">
      
      {/* Hero Section */}
      <section className="relative h-[400px] flex items-center justify-center overflow-hidden">
        <div className="absolute inset-0 z-0">
          <img alt="Fachada de la escuela" className="w-full h-full object-cover" src="/fotos-institucion/institucion-frente.png"/>
          <div className="absolute inset-0 bg-[#002045]/60 backdrop-brightness-75"></div>
        </div>
        <div className="relative z-10 max-w-[1200px] mx-auto w-full px-6 flex flex-col justify-end h-full pb-16">
          <span className="text-[#fddd7c] font-bold tracking-[0.2em] uppercase text-sm mb-4">
             Admisiones 2027
          </span>
          <h1 className="font-['Manrope'] text-5xl md:text-7xl font-extrabold text-white tracking-tight">
            Inscripción
          </h1>
        </div>
      </section>

      {/* Content */}
      <main className="max-w-[1200px] mx-auto px-6 w-full -mt-16 relative z-20">
        <div className="bg-white p-10 md:p-16 rounded-3xl shadow-[0_8px_32px_rgba(26,54,93,0.04)] border border-gray-100 flex flex-col gap-12">
           
           <div>
             <h2 className="font-['Manrope'] text-3xl md:text-4xl font-extrabold text-[#002045] tracking-tight">Proceso de Inscripción</h2>
             <div className="w-16 h-1.5 bg-[#fddd7c] mt-4 rounded-full"></div>
           </div>
           
           <div className="grid grid-cols-1 md:grid-cols-2 gap-12 items-stretch">
             
             {/* Documentación Obligatoria */}
             <div className="bg-[#f8f9fc] p-8 rounded-2xl relative overflow-hidden border border-[#e2e8f0]">
               <div className="absolute top-0 left-0 w-1.5 h-full bg-[#002045] rounded-l-2xl"></div>
               <h3 className="font-['Manrope'] text-xl font-bold text-[#002045] mb-6 flex items-center gap-3">
                 <span className="material-symbols-outlined text-[#002045]">check_circle</span>
                 Documentación Obligatoria
               </h3>
               <ul className="space-y-4 font-['Inter'] text-sm text-[#43474e]">
                 {[
                   'Constancia de alumno regular de séptimo grado',
                   'Partida o certificado de nacimiento',
                   'Ficha de salud',
                   'Fotocopia del DNI del estudiante',
                   'Fotocopia del DNI del padre, madre o tutor',
                 ].map((item) => (
                   <li key={item} className="flex items-start gap-3">
                     <span className="material-symbols-outlined text-[#002045] text-base mt-0.5" style={{ fontVariationSettings: "'FILL' 1" }}>check_circle</span>
                     <span className="leading-relaxed">{item}</span>
                   </li>
                 ))}
               </ul>
             </div>

             {/* Documentación Adicional + Asistencia */}
             <div className="flex flex-col gap-6">
               <div className="bg-[#fff9e6] p-8 rounded-2xl relative overflow-hidden border border-[#fed65b]/50">
                 <div className="absolute top-0 left-0 w-1.5 h-full bg-[#735c00] rounded-l-2xl"></div>
                 <h3 className="font-['Manrope'] text-xl font-bold text-[#735c00] mb-2 flex items-center gap-3">
                   <span className="material-symbols-outlined text-[#735c00]">add_task</span>
                   Documentación Adicional
                 </h3>
                 <p className="text-xs text-[#735c00]/70 mb-5">Solo presentar según corresponda al perfil del ingresante.</p>
                 <ul className="space-y-4 font-['Inter'] text-sm text-[#735c00]">
                   {[
                     'Fotocopia del grupo o proyecto pedagógico individual',
                     'Constancia de estudiante abanderado/a',
                     'Partida de nacimiento de hermanos o declaración jurada de filiación',
                   ].map((item) => (
                     <li key={item} className="flex items-start gap-3">
                       <span className="material-symbols-outlined text-[#735c00] text-base mt-0.5">info</span>
                       <span className="leading-relaxed">{item}</span>
                     </li>
                   ))}
                 </ul>
               </div>

               {/* Asistencia */}
               <div className="bg-[#002045] p-8 rounded-2xl relative overflow-hidden group flex-1">
                 <div className="absolute top-0 right-0 w-32 h-32 bg-[#fed65b]/10 rounded-full -mr-10 -mt-10 transition-transform group-hover:scale-150 duration-700"></div>
                 <h4 className="font-['Manrope'] text-lg font-bold text-white mb-2">¿Necesita asistencia?</h4>
                 <p className="text-[#adc7f7] text-sm mb-6 leading-relaxed">
                   Nuestro equipo de secretaría académica está disponible para resolver sus dudas sobre el proceso de ingreso y becas institucionales.
                 </p>
                 <div className="flex flex-wrap gap-3">

                   <Link href="/contactos" className="px-5 py-2.5 bg-[#fed65b] text-[#002045] font-bold text-sm rounded-lg hover:scale-105 transition-transform">
                     Envianos un mensaje
                   </Link>
                   
                 </div>
               </div>
             </div>
             
           </div>
        </div>
      </main>
    </div>
  );
}
