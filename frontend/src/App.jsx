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
      default: return <p>Selecciona un reporte del menú.</p>;
    }
  };

  return (
    <div style={{ maxWidth: '600px', margin: '2rem auto' }}>
      <h1>Reportes de Galería de Arte</h1>
      <Select
        options={reportOptions}
        placeholder="Selecciona un reporte"
        onChange={setSelected}
        isClearable
      />
      <div style={{ marginTop: '2rem' }}>
        {renderReport()}
      </div>
    </div>
  );
}

export default App;
