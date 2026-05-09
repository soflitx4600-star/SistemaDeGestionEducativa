const fs = require('fs');
const files = [
  'e:/Laravel/SistemaDeGestionEducativa/frontend/app/page.tsx', 
  'e:/Laravel/SistemaDeGestionEducativa/frontend/components/Header.tsx', 
  'e:/Laravel/SistemaDeGestionEducativa/frontend/components/Footer.tsx'
];

const colorMap = [
  // Do darkest/longest strings first to prevent partial replacement
  ['bg-surface-container-lowest', 'bg-[#ffffff]'],
  ['bg-surface-container-low', 'bg-[#f1f4f6]'],
  ['bg-surface-container-highest', 'bg-[#e0e3e5]'],
  ['bg-surface-container', 'bg-[#ebeef0]'],
  ['text-on-surface-variant', 'text-[#43474e]'],
  ['text-on-surface', 'text-[#181c1e]'],
  ['bg-surface', 'bg-[#f7fafc]'],
  
  ['text-on-primary-container', 'text-[#86a0cd]'],
  ['bg-primary-container', 'bg-[#1a365d]'],
  ['text-primary-container', 'text-[#1a365d]'],
  ['bg-primary-fixed', 'bg-[#d6e3ff]'],
  ['text-primary-fixed-dim', 'text-[#adc7f7]'],
  ['text-primary', 'text-[#002045]'],
  ['bg-primary', 'bg-[#002045]'],
  ['border-primary', 'border-[#002045]'],
  ['from-primary', 'from-[#002045]'],
  
  ['border-secondary-container', 'border-[#fed65b]'],
  ['text-secondary-container', 'text-[#fed65b]'],
  ['bg-secondary-container', 'bg-[#fed65b]'],
  ['text-secondary', 'text-[#735c00]'],
  ['bg-secondary', 'bg-[#735c00]'],
  ['border-secondary', 'border-[#735c00]'],
  
  ['bg-tertiary-container', 'bg-[#003f25]'],
  ['text-tertiary-fixed', 'text-[#9ff5c1]'],
  
  ['border-outline-variant', 'border-[#c4c6cf]'],
  ['font-headline', 'font-[\'Manrope\']'],
  ['font-body', 'font-[\'Inter\']']
];

files.forEach(file => {
  if (!fs.existsSync(file)) return;
  let content = fs.readFileSync(file, 'utf8');
  for (const [key, value] of colorMap) {
    // Regex matches the exact class word, bounded by spaces, quotes or brackets.
    // Be careful with JS string escaping for backslashes so it compiles to \b or \s
    const regex = new RegExp(`(?<=[\\s"'\\\`])${key}(?=[\\s"'\\\`/])`, 'g');
    content = content.replace(regex, value);
  }
  fs.writeFileSync(file, content);
  console.log('Processed', file);
});
