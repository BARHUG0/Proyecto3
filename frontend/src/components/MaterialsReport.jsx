import React, { useEffect, useState } from 'react';
import { getMaterials } from '../services/api';
import ReportTable from './ReportTable';

const MaterialsReport = () => {
  const [materials, setMaterials] = useState([]);

  useEffect(() => {
    getMaterials().then(res => {
      if (Array.isArray(res.data)) setMaterials(res.data);
    }).catch(() => setMaterials([]));
  }, []);

  const columns = ['title', 'name'];

  return (
    <div>
      <h2>Reporte de Materiales</h2>
      <ReportTable columns={columns} data={materials} />
    </div>
  );
};

export default MaterialsReport;
