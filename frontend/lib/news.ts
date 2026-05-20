export interface NewsItem {
  id: number;
  tag: string;
  date: string;
  title: string;
  excerpt: string;
  body?: string;
  image: string;
  imageAlt: string;
}

const API_URL = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api';

export async function fetchNews(): Promise<NewsItem[]> {
  try {
    const response = await fetch(`${API_URL}/noticias`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
    });

    if (!response.ok) {
      throw new Error(`Error fetching news: ${response.statusText}`);
    }

    const data = await response.json();
    // Mapear la respuesta del backend al formato esperado del frontend
    return data.data ? data.data.map((item: any) => ({
      id: item.id,
      tag: item.tag || 'General',
      date: item.date || new Date(item.created_at).toLocaleDateString('es-AR', { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric' 
      }),
      title: item.title || item.titulo,
      excerpt: item.excerpt || item.descripcion,
      body: item.body || item.contenido || '',
      image: item.imagen || '',
      imageAlt: item.imageAlt || item.titulo,
    })) : [];
  } catch (error) {
    console.error('Error fetching news:', error);
    return [];
  }
}

export async function createNews(newsData: Omit<NewsItem, 'id' | 'date'>): Promise<NewsItem | null> {
  try {
    const formData = new FormData();
    formData.append('titulo', newsData.title);
    formData.append('descripcion', newsData.excerpt);
    formData.append('contenido', newsData.body || '');
    formData.append('categoria_id', '1'); // Default category
    // Agregar imagen si existe

    const response = await fetch(`${API_URL}/noticias`, {
      method: 'POST',
      body: formData,
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
      },
    });

    if (!response.ok) {
      throw new Error(`Error creating news: ${response.statusText}`);
    }

    const data = await response.json();
    return data as NewsItem;
  } catch (error) {
    console.error('Error creating news:', error);
    return null;
  }
}

export async function updateNews(id: number, newsData: Partial<NewsItem>): Promise<NewsItem | null> {
  try {
    const formData = new FormData();
    if (newsData.title) formData.append('titulo', newsData.title);
    if (newsData.excerpt) formData.append('descripcion', newsData.excerpt);
    if (newsData.body) formData.append('contenido', newsData.body);

    const response = await fetch(`${API_URL}/noticias/${id}`, {
      method: 'PUT',
      body: formData,
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
      },
    });

    if (!response.ok) {
      throw new Error(`Error updating news: ${response.statusText}`);
    }

    const data = await response.json();
    return data as NewsItem;
  } catch (error) {
    console.error('Error updating news:', error);
    return null;
  }
}

export async function deleteNews(id: number): Promise<boolean> {
  try {
    const response = await fetch(`${API_URL}/noticias/${id}`, {
      method: 'DELETE',
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
        'Content-Type': 'application/json',
      },
    });

    if (!response.ok) {
      throw new Error(`Error deleting news: ${response.statusText}`);
    }

    return true;
  } catch (error) {
    console.error('Error deleting news:', error);
    return false;
  }
}

// Mantener compatibilidad con datos locales para desarrollo
export const NEWS: NewsItem[] = [
  {
    id: 1,
    tag: 'Ciencias',
    date: '15 Oct, 2023',
    title: 'Feria de Innovación y Tecnología 2023',
    excerpt: 'Estudiantes de ciclo orientado presentaron proyectos de robótica aplicada a la sustentabilidad urbana.',
    body: 'Estudiantes de ciclo orientado presentaron proyectos de robótica aplicada a la sustentabilidad urbana. Durante tres días, más de 40 equipos expusieron sus desarrollos ante un jurado compuesto por docentes, ingenieros y representantes de empresas tecnológicas de la región. Los proyectos abarcaron desde sistemas de riego inteligente hasta prototipos de clasificación de residuos con visión artificial. La feria contó con la participación de más de 500 visitantes entre familias, alumnos de otras instituciones y autoridades educativas.',
    image: '/fotos-actividades/feria.jpeg',
    imageAlt: 'Feria de ciencias',
  },
  {
    id: 2,
    tag: 'Deportes',
    date: '12 Oct, 2023',
    title: 'Finales Intercolegiales de Atletismo',
    excerpt: 'Nuestros atletas destacaron en las competencias regionales obteniendo el primer puesto en relevos.',
    body: 'Nuestros atletas destacaron en las competencias regionales obteniendo el primer puesto en relevos. El equipo de atletismo de la institución participó en las finales intercolegiales celebradas en el estadio municipal, donde compitieron más de 20 escuelas de la provincia. Además del primer puesto en la prueba de relevos 4×100, se obtuvieron medallas en salto en largo y lanzamiento de bala. El entrenador destacó el esfuerzo y la dedicación del grupo durante todo el año.',
    image: '/fotos-actividades/finales.jpeg',
    imageAlt: 'Deportes',
  },
];

export const TAGS = ['Todos', ...Array.from(new Set(NEWS.map(n => n.tag)))];
