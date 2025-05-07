import React, { useEffect, useState } from 'react';
import { getExhibitions } from '../services/api';
import ReportTable from './ReportTable';

const ExhibitionsReport = () => {
  const [exhibitions, setExhibitions] = useState([]);

  useEffect(() => {
    getExhibitions().then(res => {
      if (Array.isArray(res.data)) setExhibitions(res.data);
    }).catch(() => setExhibitions([]));
  }, []);

  const columns = ['painting_title', 'venue', 'exhibition_beginning', 'exhibition_ending', 'exhibition_catalogue_number'];

  return (
    <div>
      <h2>Reporte de Exhibiciones</h2>
      <ReportTable columns={columns} data={exhibitions} />
    </div>
  );
};

export default ExhibitionsReport;
