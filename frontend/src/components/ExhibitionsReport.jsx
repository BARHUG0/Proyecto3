import React, { useEffect, useState } from 'react';
import { getExhibitions } from '../services/api';
import ReportTable from './ReportTable';
import ButtonExportPDF from './ButtonExportPDF'
import ButtonExportCSV from './ButtonExportCSV';



const ExhibitionsReport = () => {
  const [exhibitions, setExhibitions] = useState([]);
  const [filtered, setFiltered] = useState([]);

  // Filtros
  const [title, setTitle] = useState('');
  const [venue, setVenue] = useState('');
  const [catalog, setCatalog] = useState('');
  const [orderAsc, setOrderAsc] = useState(true);

  useEffect(() => {
    getExhibitions().then(data => {
      setExhibitions(data);
      setFiltered(data);
    }).catch(() => {
      setExhibitions([]);
      setFiltered([]);
    });
  }, []);

  useEffect(() => {
    let result = exhibitions.filter(ex => {
      return (
        (title === '' || ex.painting_title?.toLowerCase().includes(title.toLowerCase())) &&
        (venue === '' || ex.venue?.toLowerCase().includes(venue.toLowerCase())) &&
        (catalog === '' || String(ex.exhibition_catalogue_number)?.toLowerCase().includes(catalog.toLowerCase()))
      );
    });

    result = result.sort((a, b) => {
      if (a.painting_title < b.painting_title) return orderAsc ? -1 : 1;
      if (a.painting_title > b.painting_title) return orderAsc ? 1 : -1;
      return 0;
    });

    setFiltered(result);
  }, [title, venue, catalog, orderAsc, exhibitions]);

  const columns = ['painting_title', 'venue', 'exhibition_beginning', 'exhibition_ending', 'exhibition_catalogue_number'];

  return (
    <div>
      <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h2 className="text-xl font-semibold mb-4">Reporte de Exhibiciones</h2>
        <ButtonExportPDF
          columns={columns}
          data={filtered}
          filename="reporte_exhibiciones.pdf"
          title="Reporte de Exhibiciones"
        />
        <ButtonExportCSV
          columns={columns}
          data={filtered}
          filename="reporte_exhibiciones.csv"
        />
      </div>
      {/* Filtros */}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-6">
        <input
          type="text"
          placeholder="Filtrar por pintura"
          className="border px-3 py-2 rounded"
          value={title}
          onChange={e => setTitle(e.target.value)}
        />
        <input
          type="text"
          placeholder="Filtrar por venue"
          className="border px-3 py-2 rounded"
          value={venue}
          onChange={e => setVenue(e.target.value)}
        />
        <input
          type="text"
          placeholder="Número de catálogo"
          className="border px-3 py-2 rounded"
          value={catalog}
          onChange={e => setCatalog(e.target.value)}
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

export default ExhibitionsReport;
