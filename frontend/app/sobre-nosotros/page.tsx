import React from 'react';

export default function SobreNosotros() {
  return (
    <div className="w-full flex-col flex gap-24 pb-24 bg-[#faf9fd]">
      
      {/* Hero Section */}
      <section className="relative h-[500px] flex items-center overflow-hidden">
        <div className="absolute inset-0 z-0">
          {/* Usamos un placeholder de Unsplash para la cara abstracta / retrato */}
          <img alt="Sobre Nosotros" className="w-full h-full object-cover object-top" src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=1600" />
          <div className="absolute inset-0 bg-gradient-to-r from-[#001733] via-[#001733]/80 to-transparent"></div>
        </div>
        <div className="relative z-10 max-w-[1400px] mx-auto w-full px-6">
          <h1 className="text-5xl md:text-7xl font-extrabold text-white font-['Manrope'] mb-4">
            Sobre Nosotros
          </h1>
          <div className="w-20 h-1.5 bg-[#fddd7c] rounded-full"></div>
        </div>
      </section>

      {/* Nuestra Historia */}
      <section className="max-w-[1400px] mx-auto px-6">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
          <div className="space-y-6">
            <span className="bg-[#fcf5e3] text-[#735c00] text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full inline-block mb-2">
              Nuestra Trayectoria
            </span>
            <h2 className="text-4xl font-extrabold text-[#002045] font-['Manrope'] tracking-tight">
               Nuestra Historia
            </h2>
            <div className="space-y-6 text-[#43474e] font-['Inter'] text-sm leading-relaxed">
               <p>
                 Fundado en el corazón de la comunidad, el Colegio Secundario N°59 ha sido un faro de conocimiento y valores durante décadas. Nuestra institución nació de la visión de un grupo de educadores comprometidos con la excelencia académica y la formación integral.
               </p>
               <p>
                 A lo largo de los años, hemos evolucionado, integrando tecnología de vanguardia y metodologías pedagógicas modernas, sin perder nunca de vista nuestras raíces y la tradición de rigor intelectual que nos caracteriza.
               </p>
            </div>
          </div>
          
          <div className="relative p-4 bg-[#f1f4f8] rounded-3xl">
            <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&q=80&w=800" alt="Castillo Antiguo" className="w-full rounded-2xl shadow-sm aspect-[4/3] object-cover" />
          </div>
        </div>
      </section>

      {/* Misión y Visión (Cards with cut corners) */}
      <section className="max-w-[1400px] mx-auto px-6">
         <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            {/* Mision */}
            <div className="bg-white p-12 rounded-2xl shadow-sm border-l-4 border-[#002045] relative overflow-hidden">
               <div className="w-12 h-12 bg-[#002045] text-white flex items-center justify-center rounded-lg mb-8">
                  <span className="text-xl">🏳️</span>
               </div>
               <h3 className="font-['Manrope'] text-2xl font-bold text-[#002045] mb-4">Misión</h3>
               <p className="text-[#43474e] font-['Inter'] text-sm leading-relaxed">
                 Proveer una educación secundaria de la más alta calidad, fomentando el pensamiento crítico, la integridad ética y la responsabilidad social. Nos dedicamos a preparar a nuestros estudiantes para los desafíos del mundo globalizado, promoviendo el liderazgo y la excelencia en todas las áreas del saber.
               </p>
               {/* Watermark icon on the right */}
               <div className="absolute -right-8 top-12 text-[#f2f4f7] text-8xl pointer-events-none">
                  🎓
               </div>
            </div>

            {/* Vision */}
            <div className="bg-white p-12 rounded-2xl shadow-sm border-l-4 border-[#886e00] relative overflow-hidden">
               <div className="w-12 h-12 bg-[#fddd7c] text-[#735c00] flex items-center justify-center rounded-lg mb-8">
                  <span className="text-xl">💡</span>
               </div>
               <h3 className="font-['Manrope'] text-2xl font-bold text-[#002045] mb-4">Visión</h3>
               <p className="text-[#43474e] font-['Inter'] text-sm leading-relaxed">
                 Ser reconocidos como la institución educativa líder en la formación de ciudadanos innovadores y comprometidos con el progreso nacional. Aspiramos a ser un modelo de integración entre tradición académica y modernidad tecnológica, impactando positivamente en el futuro de nuestra sociedad.
               </p>
               {/* Watermark icon on the right */}
               <div className="absolute -right-8 top-12 text-[#fcf5e3] text-8xl pointer-events-none">
                  👁️
               </div>
            </div>

         </div>
      </section>

      {/* Equipo Directivo */}
      <section className="max-w-[1400px] mx-auto px-6 text-center">
         <h2 className="text-4xl font-extrabold text-[#002045] font-['Manrope'] tracking-tight mb-4">Nuestro Equipo Directivo</h2>
         <p className="text-[#43474e] font-['Inter'] max-w-xl mx-auto mb-16">
           Liderazgo comprometido con la excelencia educativa y el bienestar de nuestra comunidad académica.
         </p>

         <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-left">
           {[
             { name: "Dr. Alberto Dominguez", role: "DIRECTOR GENERAL", img: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=600" },
             { name: "Mgtr. Elena Vargas", role: "VICEDIRECTORA ACADÉMICA", img: "https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&q=80&w=600" },
             { name: "Lic. Ricardo Moreno", role: "SECRETARIO INSTITUCIONAL", img: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=600" },
             { name: "Prof. Sofia Luna", role: "REGENTE DE ESTUDIOS", img: "https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=600" }
           ].map((person, idx) => (
             <div key={idx} className="group">
               <div className="bg-[#002045] rounded-3xl overflow-hidden aspect-[4/5] w-full mb-6 relative">
                  <img src={person.img} alt={person.name} className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90" />
               </div>
               <div>
                  <h3 className="font-['Manrope'] text-lg font-bold text-[#002045]">{person.name}</h3>
                  <p className="text-[10px] font-bold text-[#886e00] tracking-widest mt-1 uppercase">{person.role}</p>
               </div>
             </div>
           ))}
         </div>
      </section>

    </div>
  );
}
