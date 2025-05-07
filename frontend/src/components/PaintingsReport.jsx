import React, { useEffect, useState } from 'react';
import { getPaintings } from '../services/api';
import ReportTable from './ReportTable';

const PaintingsReport = () => {
  const [paintings, setPaintings] = useState([]);

  useEffect(() => {
    getPaintings().then(res => {
      if (Array.isArray(res.data)) setPaintings(res.data);
    }).catch(() => setPaintings([]));
  }, []);

  const columns = ['title', 'artist', 'execution_date', 'width', 'height', 'signature_location'];

  return (
    <div>
      <h2>Reporte de Obras</h2>
      <ReportTable columns={columns} data={paintings} />
    </div>
  );
};

export default PaintingsReport;
