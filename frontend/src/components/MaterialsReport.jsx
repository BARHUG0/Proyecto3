import React, { useEffect, useState } from 'react';
import { getMaterials } from '../services/api';
import ReportTable from './ReportTable';
import ButtonExportPDF from '../components/buttonExportPDF'


const MaterialsReport = () => {
  const [materials, setMaterials] = useState([]);
  const [filtered, setFiltered] = useState([]);

  // Filtros
  const [title, setTitle] = useState('');
  const [material, setMaterial] = useState('');
  const [keyword, setKeyword] = useState('');
  const [orderAsc, setOrderAsc] = useState(true);

  useEffect(() => {
    getMaterials().then(data => {
      setMaterials(data);
      setFiltered(data);
    }).catch(() => {
      setMaterials([]);
      setFiltered([]);
    });
  }, []);

  useEffect(() => {
    let result = materials.filter(m => {
      return (
        (title === '' || m.title?.toLowerCase().includes(title.toLowerCase())) &&
        (material === '' || m.name?.toLowerCase().includes(material.toLowerCase())) &&
        (keyword === '' || (m.name + m.title)?.toLowerCase().includes(keyword.toLowerCase()))
      );
    });

    result = result.sort((a, b) => {
      if (a.title < b.title) return orderAsc ? -1 : 1;
      if (a.title > b.title) return orderAsc ? 1 : -1;
      return 0;
    });

    setFiltered(result);
  }, [title, material, keyword, orderAsc, materials]);

  const columns = ['title', 'name'];

  return (
    <div>
      <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">

        <h2 className="text-xl font-semibold mb-4">Reporte de Materiales</h2>
        <ButtonExportPDF
          columns={columns}
          data={filtered}
          filename="reporte_materiales.pdf"
          title="Reporte de Materiales"
        />
      </div>
      {/* Filtros */}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-6">
        <input
          type="text"
          placeholder="Filtrar por título"
          className="border px-3 py-2 rounded"
          value={title}
          onChange={e => setTitle(e.target.value)}
        />
        <input
          type="text"
          placeholder="Filtrar por material"
          className="border px-3 py-2 rounded"
          value={material}
          onChange={e => setMaterial(e.target.value)}
        />
        <input
          type="text"
          placeholder="Buscar palabra clave"
          className="border px-3 py-2 rounded"
          value={keyword}
          onChange={e => setKeyword(e.target.value)}
        />
        <select
          className="border px-3 py-2 rounded"
          value={orderAsc ? 'asc' : 'desc'}
          onChange={e => setOrderAsc(e.target.value === 'asc')}
        >
          <option value="asc">Orden A-Z</option>
          <option value="desc">Orden Z-A</option>
        </select>
      </div>

      <ReportTable columns={columns} data={filtered} />
    </div>
  );
};

export default MaterialsReport;
