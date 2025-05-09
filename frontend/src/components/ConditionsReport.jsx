import React, { useEffect, useState } from 'react';
import { getConditions } from '../services/api';
import ReportTable from './ReportTable';
import ButtonExportPDF from '../components/buttonExportPDF';

const ConditionsReport = () => {
  const [conditions, setConditions] = useState([]);
  const [filtered, setFiltered] = useState([]);

  // Filtros
  const [title, setTitle] = useState('');
  const [noteKeyword, setNoteKeyword] = useState('');
  const [reportKeyword, setReportKeyword] = useState('');
  const [orderAsc, setOrderAsc] = useState(true);

  useEffect(() => {
    getConditions().then(data => {
      setConditions(data);
      setFiltered(data);
    }).catch(() => {
      setConditions([]);
      setFiltered([]);
    });
  }, []);

  useEffect(() => {
    let result = conditions.filter(c => {
      return (
        (title === '' || c.title?.toLowerCase().includes(title.toLowerCase())) &&
        (noteKeyword === '' || c.note?.toLowerCase().includes(noteKeyword.toLowerCase())) &&
        (reportKeyword === '' || c.full_condition_report?.toLowerCase().includes(reportKeyword.toLowerCase()))
      );
    });

    result = result.sort((a, b) => {
      if (a.title < b.title) return orderAsc ? -1 : 1;
      if (a.title > b.title) return orderAsc ? 1 : -1;
      return 0;
    });

    setFiltered(result);
  }, [title, noteKeyword, reportKeyword, orderAsc, conditions]);

  const columns = ['title', 'note', 'full_condition_report'];

  return (
    <div className="p-4">
      {/* Encabezado y botón */}
      <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h2 className="text-2xl font-bold text-gray-800">Reporte de Condiciones</h2>
        <ButtonExportPDF
          columns={columns}
          data={filtered}
          filename="reporte_condiciones.pdf"
          title="Reporte de Condiciones"
        />
      </div>

      {/* Filtros */}
      <div className="bg-white shadow rounded-lg p-4 mb-6">
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <input
            type="text"
            placeholder="Filtrar por título"
            className="border px-3 py-2 rounded"
            value={title}
            onChange={e => setTitle(e.target.value)}
          />
          <input
            type="text"
            placeholder="Palabra clave en nota"
            className="border px-3 py-2 rounded"
            value={noteKeyword}
            onChange={e => setNoteKeyword(e.target.value)}
          />
          <input
            type="text"
            placeholder="Palabra clave en reporte"
            className="border px-3 py-2 rounded"
            value={reportKeyword}
            onChange={e => setReportKeyword(e.target.value)}
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
      </div>

      {/* Tabla */}
      <ReportTable columns={columns} data={filtered} />
    </div>
  );
};

export default ConditionsReport;
