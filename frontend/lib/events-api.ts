import { Evento } from './events';

const API_URL = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api';

export interface EventoApiItem {
  id: number;
  titulo: string;
  descripcion: string;
  body?: string;
  lugar: string;
  fecha_evento: string;
  imagen: string | null;
  color: string;
  text_color: string;
  destacado: boolean;
  activa: boolean;
  dia: number;
  mes: string;
  mesNum: number;
  anio: number;
  date: string;
  title: string;
  desc: string;
  tag: string;
  created_at: string;
}

export async function fetchEventos(): Promise<EventoApiItem[]> {
  try {
    const response = await fetch(`${API_URL}/eventos`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
    });

    if (!response.ok) {
      throw new Error(`Error fetching eventos: ${response.statusText}`);
    }

    const data = await response.json();
    return data.data ? data.data : [];
  } catch (error) {
    console.error('Error fetching eventos:', error);
    return [];
  }
}

export async function fetchEvento(id: number): Promise<EventoApiItem | null> {
  try {
    const response = await fetch(`${API_URL}/eventos/${id}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
    });

    if (!response.ok) {
      throw new Error(`Error fetching evento: ${response.statusText}`);
    }

    return await response.json();
  } catch (error) {
    console.error('Error fetching evento:', error);
    return null;
  }
}

export function mapApiEventoToEvento(item: EventoApiItem): Evento {
  return {
    id: item.id,
    dia: item.dia,
    mes: item.mes,
    mesNum: item.mesNum,
    anio: item.anio,
    titulo: item.titulo,
    desc: item.descripcion,
    body: item.body || item.descripcion,
    lugar: item.lugar,
    color: item.color,
    textColor: item.text_color,
    imagen: item.imagen || undefined,
    destacado: item.destacado,
  };
}

export async function createEvento(formData: FormData): Promise<EventoApiItem | null> {
  try {
    const response = await fetch(`${API_URL}/eventos`, {
      method: 'POST',
      body: formData,
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
      },
    });

    if (!response.ok) {
      throw new Error(`Error creating evento: ${response.statusText}`);
    }

    return await response.json();
  } catch (error) {
    console.error('Error creating evento:', error);
    return null;
  }
}

export async function updateEvento(id: number, formData: FormData): Promise<EventoApiItem | null> {
  // For PUT with FormData in Laravel, we need to use POST with _method=PUT
  formData.append('_method', 'PUT');
  try {
    const response = await fetch(`${API_URL}/eventos/${id}`, {
      method: 'POST',
      body: formData,
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
      },
    });

    if (!response.ok) {
      throw new Error(`Error updating evento: ${response.statusText}`);
    }

    return await response.json();
  } catch (error) {
    console.error('Error updating evento:', error);
    return null;
  }
}

export async function deleteEvento(id: number): Promise<boolean> {
  try {
    const response = await fetch(`${API_URL}/eventos/${id}`, {
      method: 'DELETE',
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
    });

    if (!response.ok) {
      throw new Error(`Error deleting evento: ${response.statusText}`);
    }

    return true;
  } catch (error) {
    console.error('Error deleting evento:', error);
    return false;
  }
}