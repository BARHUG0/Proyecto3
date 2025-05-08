import React, { useEffect, useState } from 'react';
import { getConditions } from '../services/api';
import ReportTable from './ReportTable';

const ConditionsReport = () => {
  const [conditions, setConditions] = useState([]);

  useEffect(() => {
    getConditions().then(res => {
      if (Array.isArray(res.data)) setConditions(res.data);
    }).catch(() => setConditions([]));
  }, []);
  

  const columns = ['title', 'note', 'full_condition_report'];
  return (
    <div>
      <h2>Reporte de Condiciones</h2>
      <ReportTable columns={columns} data={conditions} />
    </div>
  );
};

export default ConditionsReport;
