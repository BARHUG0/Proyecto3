import React, { useEffect, useState } from 'react';
import { getProvenances } from '../services/api';
import ReportTable from './ReportTable';

const ProvenancesReport = () => {
  const [provenances, setProvenances] = useState([]);

  useEffect(() => {
    getProvenances().then(res => {
      if (Array.isArray(res.data)) setProvenances(res.data);
    }).catch(() => setProvenances([]));
  }, []);

  const columns = ['title', 'name', 'transfer_owner', 'transfer_date', 'description'];

  return (
    <div>
      <h2>Reporte de Procedencias</h2>
      <ReportTable columns={columns} data={provenances} />
    </div>
  );
};

export default ProvenancesReport;
