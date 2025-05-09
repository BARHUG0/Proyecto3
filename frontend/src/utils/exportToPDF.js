import jsPDF from 'jspdf';
import autoTable from 'jspdf-autotable';

export const exportTableToPDF = (columns, data, filename = 'reporte.pdf', title = '') => {
  const doc = new jsPDF();

  if (title) {
    doc.setFontSize(16);
    doc.text(title, 14, 20);
  }

  const tableData = data.map(row =>
    columns.map(col => row[col] ?? '—')
  );

  autoTable(doc, {
    head: [columns.map(col => col.replace(/_/g, ' ').toUpperCase())],
    body: tableData,
    startY: title ? 30 : 10,
    styles: { fontSize: 10 },
  });

  doc.save(filename);
};
