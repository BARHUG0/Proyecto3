import React, { useEffect, useState } from 'react';
import { getPaintings } from '../services/api';
import ReportTable from './ReportTable';

const PaintingsReport = () => {
  const [paintings, setPaintings] = useState([]);
  const [filtered, setFiltered] = useState([]);

  // Filtros
  const [title, setTitle] = useState('');
  const [artist, setArtist] = useState('');
  const [startDate, setStartDate] = useState('');
  const [endDate, setEndDate] = useState('');
  const [orderAsc, setOrderAsc] = useState(true);

  useEffect(() => {
    getPaintings().then(data => {
      setPaintings(data);
      setFiltered(data);
    }).catch(() => {
      setPaintings([]);
      setFiltered([]);
    });
  }, []);

  useEffect(() => {
    let result = paintings.filter(p => {
      return (
        (title === '' || p.title?.toLowerCase().includes(title.toLowerCase())) &&
        (artist === '' || p.artist?.toLowerCase().includes(artist.toLowerCase())) &&
        (startDate === '' || p.execution_date >= startDate) &&
        (endDate === '' || p.execution_date <= endDate)
      );
    });

    result = result.sort((a, b) => {
      if (a.title < b.title) return orderAsc ? -1 : 1;
      if (a.title > b.title) return orderAsc ? 1 : -1;
      return 0;
    });

    setFiltered(result);
  }, [title, artist, startDate, endDate, orderAsc, paintings]);

  const columns = ['title', 'artist', 'execution_date', 'width', 'height', 'signature_location'];

  return (
    <div>
      <h2 className="text-xl font-semibold mb-4">Reporte de Obras</h2>

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
          placeholder="Filtrar por artista"
          className="border px-3 py-2 rounded"
          value={artist}
          onChange={e => setArtist(e.target.value)}
        />
        <input
          type="date"
          placeholder="Desde"
          className="border px-3 py-2 rounded"
          value={startDate}
          onChange={e => setStartDate(e.target.value)}
        />
        <input
          type="date"
          placeholder="Hasta"
          className="border px-3 py-2 rounded"
          value={endDate}
          onChange={e => setEndDate(e.target.value)}
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

export default PaintingsReport;
