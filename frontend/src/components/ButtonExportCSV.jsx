import React from 'react';
import { exportTableToCSV } from '../utils/exportToCSV';

const ButtonExportCSV = ({ columns, data, filename = 'reporte.csv' }) => {
  return (
    <button
      onClick={() => exportTableToCSV(columns, data, filename)}
      className="bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded shadow transition"
    >
      Exportar a CSV
    </button>
  );
};

export default ButtonExportCSV;
