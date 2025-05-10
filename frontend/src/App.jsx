import React, { useState } from 'react';
import Select from 'react-select';

import PaintingsReport from './components/PaintingsReport';
import SalesReport from './components/SalesReport';
import ExhibitionsReport from './components/ExhibitionsReport';
import MaterialsReport from './components/MaterialsReport';
import ConditionsReport from './components/ConditionsReport';
import ProvenancesReport from './components/ProvenancesReport';

const reportOptions = [
  { value: 'paintings', label: 'Obras' },
  { value: 'sales', label: 'Ventas' },
  { value: 'exhibitions', label: 'Exhibiciones' },
  { value: 'materials', label: 'Materiales' },
  { value: 'conditions', label: 'Condiciones' },
  { value: 'provenances', label: 'Procedencias' }
];

function App() {
  const [selected, setSelected] = useState(null);

  const renderReport = () => {
    switch (selected?.value) {
      case 'paintings': return <PaintingsReport />;
      case 'sales': return <SalesReport />;
      case 'exhibitions': return <ExhibitionsReport />;
      case 'materials': return <MaterialsReport />;
      case 'conditions': return <ConditionsReport />;
      case 'provenances': return <ProvenancesReport />;
      default: return <p className="text-gray-600 mt-6">Selecciona un reporte del menú.</p>;
    }
  };

  return (
    <div className="min-h-screen bg-gray-50 text-gray-800 px-4 py-8">
      <div className="max-w-6xl mx-auto">
        
        <h1 className="text-3xl font-bold mb-6 text-center">Reportes de Galería de Arte</h1>
        <div className="mb-8">
          <Select
            options={reportOptions}
            placeholder="Selecciona un reporte"
            onChange={setSelected}
            isClearable
            className="text-gray-900"
          />
        </div>
        <div className="bg-white p-6 rounded-lg shadow-md">
          {renderReport()}
        </div>
      </div>
    </div>
  );
}

export default App;
