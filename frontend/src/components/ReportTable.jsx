import React from 'react';


const ReportTable = ({ columns, data }) => {
  if (!Array.isArray(data) || data.length === 0) {
    return <p className="text-gray-500 italic ">No hay datos disponibles.</p>;
  }

  return (
    <div className="overflow-x-auto mt-6 rounded-lg border border-gray-200 shadow-sm">
      <table className="min-w-full divide-y divide-gray-200 bg-white">
        <thead className="bg-gray-100">
          <tr>
            {columns.map(col => (
              <th
                key={col}
                className="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider"
              >
                {col.replace(/_/g, ' ')}
              </th>
            ))}
          </tr>
        </thead>
        <tbody className="divide-y divide-gray-100">
          {data.map((row, index) => (
            <tr
              key={index}
              className="odd:bg-white even:bg-gray-50 hover:bg-blue-50 transition duration-150"
            >
              {columns.map(col => (
                <td key={col} className="px-6 py-3 text-sm text-gray-700">
                  {row[col] ?? '—'}
                </td>
              ))}
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default ReportTable;
