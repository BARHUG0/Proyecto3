import React, { useEffect, useState } from 'react';
import { getSales } from '../services/api';
import ReportTable from './ReportTable';

const SalesReport = () => {
  const [sales, setSales] = useState([]);
  const [filtered, setFiltered] = useState([]);

  // Filtros
  const [title, setTitle] = useState('');
  const [seller, setSeller] = useState('');
  const [minPrice, setMinPrice] = useState('');
  const [maxPrice, setMaxPrice] = useState('');
  const [startDate, setStartDate] = useState('');
  const [endDate, setEndDate] = useState('');
  const [orderAsc, setOrderAsc] = useState(true);

  useEffect(() => {
    getSales().then(data => {
      setSales(data);
      setFiltered(data);
    }).catch(() => {
      setSales([]);
      setFiltered([]);
    });
  }, []);

  useEffect(() => {
    let result = sales.filter(s => {
      const price = parseFloat(s.sold_price || 0);
      const soldDate = s.sold_date || '';

      return (
        (title === '' || s.painting_title?.toLowerCase().includes(title.toLowerCase())) &&
        (seller === '' || s.seller?.toLowerCase().includes(seller.toLowerCase())) &&
        (minPrice === '' || price >= parseFloat(minPrice)) &&
        (maxPrice === '' || price <= parseFloat(maxPrice)) &&
        (startDate === '' || soldDate >= startDate) &&
        (endDate === '' || soldDate <= endDate)
      );
    });

    result = result.sort((a, b) => {
      if (a.painting_title < b.painting_title) return orderAsc ? -1 : 1;
      if (a.painting_title > b.painting_title) return orderAsc ? 1 : -1;
      return 0;
    });

    setFiltered(result);
  }, [title, seller, minPrice, maxPrice, startDate, endDate, orderAsc, sales]);

  const columns = ['painting_title', 'seller', 'sold_price', 'sold_date', 'beginning_date', 'ending_date'];

  return (
    <div>
      <h2 className="text-xl font-semibold mb-4">Reporte de Ventas</h2>

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
          placeholder="Filtrar por vendedor"
          className="border px-3 py-2 rounded"
          value={seller}
          onChange={e => setSeller(e.target.value)}
        />
        <input
          type="number"
          placeholder="Precio mínimo"
          className="border px-3 py-2 rounded"
          value={minPrice}
          onChange={e => setMinPrice(e.target.value)}
        />
        <input
          type="number"
          placeholder="Precio máximo"
          className="border px-3 py-2 rounded"
          value={maxPrice}
          onChange={e => setMaxPrice(e.target.value)}
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

export default SalesReport;
