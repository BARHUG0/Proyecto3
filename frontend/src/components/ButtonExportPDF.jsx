import React from 'react';
import { exportTableToPDF } from '../utils/exportToPDF';

const ButtonExportPDF = ({ columns, data, filename, title }) => {
  return (
    <button
      onClick={() => exportTableToPDF(columns, data, filename, title)}
      className="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded shadow transition"
    >
      Exportar a PDF
    </button>
  );
};

export default ButtonExportPDF;
