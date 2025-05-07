import React from 'react';

const ReportTable = ({ columns, data }) => {
  if (!Array.isArray(data)) return <p>No hay datos disponibles.</p>;

  return (
    <table>
      <thead>
        <tr>{columns.map(col => <th key={col}>{col}</th>)}</tr>
      </thead>
      <tbody>
        {data.map((row, index) => (
          <tr key={index}>
            {columns.map(col => <td key={col}>{row[col]}</td>)}
          </tr>
        ))}
      </tbody>
    </table>
  );
};

export default ReportTable;
