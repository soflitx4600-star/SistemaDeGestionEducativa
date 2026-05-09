import React from 'react';

export default function Institucional() {
  const departments = [
    { icon: 'history_edu', title: 'Ciencias Sociales', desc: 'Equipo de Historia, Geografía y Formación Ética.' },
    { icon: 'calculate', title: 'Exactas y Naturales', desc: 'Equipo de Matemática, Física, Química y Biología.' },
    { icon: 'translate', title: 'Lenguas y Comunicación', desc: 'Equipo de Literatura, Inglés y Comunicación Social.' },
    { icon: 'palette', title: 'Expresión y Tecnología', desc: 'Equipo de Artes, Tecnología y Educación Física.' },
  ];

  const studentCards = [
    { icon: 'star', title: 'Excelencia Académica', desc: 'Fomentamos el rigor intelectual y la curiosidad constante por el saber.' },
    { icon: 'volunteer_activism', title: 'Compromiso Social', desc: 'Impulsamos proyectos que impactan positivamente en nuestra comunidad.' },
    { icon: 'lightbulb', title: 'Creatividad e Innovación', desc: 'Buscamos soluciones originales y exploramos nuevas formas de aprender.' },
    { icon: 'campaign', title: 'Liderazgo', desc: 'Formamos jóvenes capaces de guiar con empatía y determinación.' },
  ];

  const authorities = [
    { name: 'Nombre de la Rectora', role: 'Rectora', img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDr7HCZDr6XcGRKad1vpM45lgvy7-7_HEpiyrBuL1SgQj6rK4gZmA1pmyIBwvzzowNbSSQWcjMZMjzX8ARgdG7N1lr5_WJRbeV-iFca9b9YmBI6OFPGyeK7fyo8bdhU5tymf34wO7Sylkzt5l8_oaIT2Eyy6a1nI1GmLNyGlGT_OlosWpF7sMBK-0zy_GYHcCI4DYyblKNW_zv7hUAbnhxAF8lAwE2lFZTFWZrkFH-fyXjFTCQbspCjGoWBQuTOzk0iM2Nid91AaYQ', offset: false },
    { name: 'Nombre del Vice-rector', role: 'Vice-rector', img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDPvKFd4p-Oi-JW9z2AEhPU5uar0zhj2kK1sYCgu6582BgTPnqJjHZ23_6rgCUSXOg5uIDtf2dApGrAt-DQ_gs_IciS-GFmLOGEOGhXHlWW4BxR8_kNCFujSXw-ijuYD23_vEvIOt1jagl2n3fzm--YbTxB9r1SVGYKAiSe3UREzw_Pxy11_Ory1CepuEJjODgaI1NOKHsRtf0ovj_ozTBfpN_Q5rbMxsIOMOZL2vVuygwouoeBn8afZdotr70xTsQCigik84mvlsw', offset: true },
    { name: 'Nombre de la Secretaria', role: 'Secretaria', img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuClTu1UYAt_74dDCGfjTSHknFo14B-dW8TNywW3KsWGcD5nyv6PJfbMHaEtPuIq3gTpJcHSIBSetIlSxmuP8Iqm3irsKo8EQ5wlssCTkVcO8WgwKucwn6quuP6wGGpPYm95RRY6GWH1d46CkWNk7WXNaL7CTz1B00fch7ryFZmqZ-Y0t4OoHwZRT_8VxOSZCamP35JpTGYaB4-UdMg_LgBd8V04Jna06KBgNRmhUykb0G61a9ZGGUXPqgqhymJOteRZrr5ST6E9hvU', offset: false },
  ];

  return (
    <div className="bg-[#f7fafc] font-['Inter'] text-[#181c1e]">

      {/* Hero */}
      <header className="relative min-h-[500px] flex items-center justify-center overflow-hidden bg-[#1a365d] pt-20">
        <div className="absolute inset-0 z-0">
          <div className="absolute inset-0 bg-gradient-to-b from-[#002045]/80 via-[#002045]/60 to-[#002045]/80 z-10"></div>
          <img
            alt="Institucional Background"
            className="w-full h-full object-cover"
            src="/fotos-institucion/institucion-interior.png"
          />
        </div>
        <div className="relative z-20 max-w-7xl mx-auto px-8 text-center">
          <h1 className="text-5xl md:text-7xl font-['Manrope'] font-extrabold text-white tracking-tight drop-shadow-lg">
            INSTITUCIONAL
          </h1>
        </div>
      </header>

      {/* ¿Quiénes somos? */}
      <section className="px-8 bg-[#f1f4f6] py-12" id="quienes-somos">
        <div className="max-w-7xl mx-auto space-y-8">
          <div className="space-y-4">
            <h2 className="text-4xl font-['Manrope'] font-extrabold text-[#002045] tracking-tight">¿Quiénes somos?</h2>
            <div className="h-1 w-20 bg-[#735c00] rounded-full"></div>
          </div>
          <div className="text-[#43474e] space-y-4 leading-relaxed max-w-4xl">
            <p>
              Próximamente información sobre nuestra historia y misión... Estamos trabajando para brindarte una reseña detallada sobre los orígenes del Colegio Secundario Olga M. de Aredez N° 59 y nuestro compromiso inquebrantable con la educación de calidad.
            </p>
            <p>
              Nuestra institución se erige como un faro de conocimiento y valores, buscando no solo la excelencia académica sino también el desarrollo integral de cada joven que atraviesa nuestras aulas.
            </p>
          </div>
          <div className="flex gap-4 pt-4">
            <div className="p-4 bg-white rounded-xl flex-1 shadow-[0_8px_32px_rgba(26,54,93,0.06)]">
              <span className="block font-['Manrope'] font-bold text-[#002045]">Misión</span>
              <p className="text-sm text-[#43474e] mt-1">Formar ciudadanos críticos y comprometidos.</p>
            </div>
            <div className="p-4 bg-white rounded-xl flex-1 shadow-[0_8px_32px_rgba(26,54,93,0.06)]">
              <span className="block font-['Manrope'] font-bold text-[#002045]">Visión</span>
              <p className="text-sm text-[#43474e] mt-1">Ser referentes en innovación pedagógica.</p>
            </div>
          </div>
        </div>
      </section>

      {/* Nuestros Estudiantes */}
      <section className="py-24 px-8 bg-[#f7fafc]" id="nuestros-estudiantes">
        <div className="max-w-7xl mx-auto text-center space-y-16">
          <div className="space-y-4">
            <h2 className="text-4xl font-['Manrope'] font-extrabold text-[#002045] tracking-tight">Nuestros estudiantes</h2>
            <p className="text-[#43474e] max-w-2xl mx-auto">Cultivamos las habilidades y valores necesarios para el siglo XXI.</p>
          </div>
          <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            {studentCards.map((card) => (
              <div key={card.title} className="bg-white p-8 rounded-2xl shadow-[0_8px_32px_rgba(26,54,93,0.06)] group hover:-translate-y-2 transition-transform duration-300 relative overflow-hidden text-left">
                <div className="absolute top-0 left-0 w-1 h-full bg-[#735c00]"></div>
                <div className="w-14 h-14 rounded-xl bg-[#1a365d] flex items-center justify-center text-white mb-6 group-hover:scale-110 transition-transform">
                  <span className="material-symbols-outlined text-3xl">{card.icon}</span>
                </div>
                <h3 className="text-xl font-['Manrope'] font-bold text-[#002045] mb-3">{card.title}</h3>
                <p className="text-sm text-[#43474e] leading-relaxed">{card.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Autoridades */}
      <section className="py-24 px-8 bg-[#f1f4f6]" id="autoridades">
        <div className="max-w-7xl mx-auto space-y-16">
          <div className="space-y-4">
            <h2 className="text-4xl font-['Manrope'] font-extrabold text-[#002045] tracking-tight">Autoridades</h2>
            <p className="text-[#43474e]">El equipo que lidera nuestra visión institucional.</p>
          </div>
          <div className="grid md:grid-cols-3 gap-12">
            {authorities.map((person) => (
              <div key={person.name} className={`space-y-4 text-center ${person.offset ? 'md:translate-y-12' : ''}`}>
                <div className="aspect-[3/4] rounded-2xl overflow-hidden bg-[#e0e3e5] shadow-[0_8px_32px_rgba(26,54,93,0.06)] group">
                  <img
                    alt={person.role}
                    className="w-full h-full object-cover filter grayscale group-hover:grayscale-0 transition-all duration-500"
                    src={person.img}
                  />
                </div>
                <div>
                  <h4 className="text-xl font-['Manrope'] font-bold text-[#002045]">{person.name}</h4>
                  <p className="text-[#735c00] text-xs font-bold tracking-widest uppercase">{person.role}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Nuestros Docentes */}
      <section className="py-24 px-8 bg-[#f7fafc]" id="nuestros-docentes">
        <div className="max-w-4xl mx-auto space-y-16">
          <div className="text-center space-y-4">
            <h2 className="text-4xl font-['Manrope'] font-extrabold text-[#002045] tracking-tight">Nuestros docentes</h2>
            <div className="h-1 w-20 bg-[#735c00] mx-auto rounded-full"></div>
          </div>
          <div className="space-y-2">
            {departments.map((dept) => (
              <div key={dept.title} className="group p-6 bg-[#f1f4f6] rounded-2xl flex items-center justify-between hover:bg-[#002045] transition-all duration-300 shadow-[0_8px_32px_rgba(26,54,93,0.06)] cursor-pointer">
                <div className="flex items-center gap-6">
                  <div className="text-[#002045] group-hover:text-white">
                    <span className="material-symbols-outlined text-3xl">{dept.icon}</span>
                  </div>
                  <div>
                    <h4 className="font-['Manrope'] font-bold text-lg group-hover:text-white">{dept.title}</h4>
                    <p className="text-sm text-[#43474e] group-hover:text-white/70">{dept.desc}</p>
                  </div>
                </div>
                <span className="material-symbols-outlined text-[#43474e] group-hover:text-white">chevron_right</span>
              </div>
            ))}
          </div>
          <p className="text-center text-[#43474e] text-sm uppercase tracking-widest pt-8">
            Cuerpo docente compuesto por más de 40 profesionales especializados.
          </p>
        </div>
      </section>

    </div>
  );
}
