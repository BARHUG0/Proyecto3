import React, { useEffect, useState } from 'react';
import { getProvenances } from '../services/api';
import ReportTable from './ReportTable';
import ButtonExportPDF from './ButtonExportPDF';
import ButtonExportCSV from './ButtonExportCSV';


const ProvenancesReport = () => {
  const [provenances, setProvenances] = useState([]);
  const [filtered, setFiltered] = useState([]);

  // Filtros
  const [title, setTitle] = useState('');
  const [name, setName] = useState('');
  const [startDate, setStartDate] = useState('');
  const [endDate, setEndDate] = useState('');
  const [descriptionKeyword, setDescriptionKeyword] = useState('');
  const [orderAsc, setOrderAsc] = useState(true);
  

  useEffect(() => {
    getProvenances().then(data => {
      setProvenances(data);
      setFiltered(data);
    }).catch(() => {
      setProvenances([]);
      setFiltered([]);
    });
  }, []);

  useEffect(() => {
    let result = provenances.filter(p => {
      return (
        (title === '' || p.title?.toLowerCase().includes(title.toLowerCase())) &&
        (name === '' || p.name?.toLowerCase().includes(name.toLowerCase()) || p.transfer_owner?.toLowerCase().includes(name.toLowerCase())) &&
        (startDate === '' || p.transfer_date >= startDate) &&
        (endDate === '' || p.transfer_date <= endDate) &&
        (descriptionKeyword === '' || p.description?.toLowerCase().includes(descriptionKeyword.toLowerCase()))
      );
    });

    result = result.sort((a, b) => {
      if (a.title < b.title) return orderAsc ? -1 : 1;
      if (a.title > b.title) return orderAsc ? 1 : -1;
      return 0;
    });

    setFiltered(result);
  }, [title, name, startDate, endDate, descriptionKeyword, orderAsc, provenances]);

  const columns = ['title', 'name', 'transfer_owner', 'transfer_date', 'description'];

  return (
    <div>
      <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">

        <h2 className="text-xl font-semibold mb-4">Reporte de Procedencias</h2>

        <ButtonExportPDF
          columns={columns}
          data={filtered}
          filename="reporte_procedencias.pdf"
          title="Reporte de Procedencias"
        />
        <ButtonExportCSV
          columns={columns}
          data={filtered}
          filename="reporte_procedencias.csv"
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
          placeholder="Filtrar por nombre del dueño"
          className="border px-3 py-2 rounded"
          value={name}
          onChange={e => setName(e.target.value)}
        />
        <input
          type="date"
          className="border px-3 py-2 rounded"
          value={startDate}
          onChange={e => setStartDate(e.target.value)}
        />
        <input
          type="date"
          className="border px-3 py-2 rounded"
          value={endDate}
          onChange={e => setEndDate(e.target.value)}
        />
        <input
          type="text"
          placeholder="Palabra clave en descripción"
          className="border px-3 py-2 rounded"
          value={descriptionKeyword}
          onChange={e => setDescriptionKeyword(e.target.value)}
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

export default ProvenancesReport;
