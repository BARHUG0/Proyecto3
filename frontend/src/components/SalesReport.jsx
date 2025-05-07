import React, { useEffect, useState } from 'react';
import { getSales } from '../services/api';
import ReportTable from './ReportTable';

const SalesReport = () => {
  const [sales, setSales] = useState([]);

  useEffect(() => {
    getSales().then(res => {
      if (Array.isArray(res.data)) setSales(res.data);
    }).catch(() => setSales([]));
  }, []);

  const columns = ['painting_title', 'seller', 'sold_price', 'sold_date', 'beginning_date', 'ending_date'];

  return (
    <div>
      <h2>Reporte de Ventas</h2>
      <ReportTable columns={columns} data={sales} />
    </div>
  );
};

export default SalesReport;
