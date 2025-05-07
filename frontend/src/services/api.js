import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8002',
});

export const getPaintings = () => api.get('/paintings');
export const getSales = () => api.get('/sales');
export const getExhibitions = () => api.get('/paintings/exhibitions');
export const getMaterials = () => api.get('/paintings/materials');
export const getConditions = () => api.get('/paintings/conditions');
export const getProvenances = () => api.get('/paintings/provenances');
