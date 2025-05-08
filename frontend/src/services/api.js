import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8002',
});

// Función genérica para extraer y validar arrays desde la respuesta
const extractArray = (res, name = '') => {
  if (typeof res.data === 'string') {
    try {
      const parsed = JSON.parse(res.data);
      return Array.isArray(parsed) ? parsed : [];
    } catch (e) {
      console.error(`Error al parsear ${name}:`, e);
      return [];
    }
  }

  if (Array.isArray(res.data)) return res.data;
  if (Array.isArray(res.data?.data)) return res.data.data;
  return [];
};

// Endpoints estandarizados con extracción
export const getPaintings = () =>
  api.get('/paintings').then(res => extractArray(res, 'paintings'));

export const getSales = () =>
  api.get('/sales').then(res => extractArray(res, 'sales'));

export const getExhibitions = () =>
  api.get('/paintings/exhibitions').then(res => extractArray(res, 'exhibitions'));

export const getMaterials = () =>
  api.get('/paintings/materials').then(res => extractArray(res, 'materials'));

export const getConditions = () =>
  api.get('/paintings/conditions').then(res => extractArray(res, 'conditions'));

export const getProvenances = () =>
  api.get('/paintings/provenances').then(res => extractArray(res, 'provenances'));
