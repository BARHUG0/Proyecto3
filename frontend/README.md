# Frontend - Reportes Galería de Arte

Este proyecto es la interfaz gráfica de un sistema de reportes para una galería de arte. Permite visualizar, filtrar y exportar datos sobre obras, ventas, condiciones, materiales, procedencias y exhibiciones.

## 📦 Tecnologías utilizadas

- [React](https://reactjs.org/)
- [Vite](https://vitejs.dev/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Axios](https://axios-http.com/)
- [jsPDF + jspdf-autotable](https://github.com/parallax/jsPDF) (exportar PDF)
- Exportación a CSV con `Blob` y `URL.createObjectURL`

## 🧾 Funcionalidades principales

- Visualización de reportes por categoría:
  - Obras
  - Ventas
  - Condiciones
  - Materiales
  - Procedencias
  - Exhibiciones
- Filtros personalizados por reporte (texto, fechas, precios, etc.)
- Orden ascendente/descendente por campo principal
- Exportación de cada reporte a PDF o CSV, aplicando los filtros activos

## 🚀 Instrucciones para ejecutar el proyecto

1. Clona este repositorio:

```bash
git clone https://github.com/tu-usuario/frontend-galeria-reportes.git
```

2. Entra a la carpeta del proyecto:

```bash
cd frontend-galeria-reportes
```

3. Instala las dependencias:

```bash
npm install
```

4. Ejecuta el servidor de desarrollo:

```bash
npm run dev
```

5. Asegúrate de que el backend esté corriendo en el puerto correcto (por ejemplo, `http://localhost:8002`) o ajusta la URL base en `src/services/api.js`.

```bash
const api = axios.create({
  baseURL: 'http://localhost:8002', // ← cámbialo según tu backend
});

```

## 📁 Estructura del proyecto
```bash

├── public/
├── src/
│ ├── components/
│ │ ├── ReportTable.jsx
│ │ ├── ButtonExportPDF.jsx
│ │ ├── ButtonExportCSV.jsx
│ │ └── [Reportes].jsx
│ ├── services/
│ │ └── api.js
│ ├── utils/
│ │ ├── exportToPDF.js
│ │ └── exportToCSV.js
│ └── App.jsx
├── README.md
├── index.html
└── package.json
```

## 🖼️ Vista previa

Cada sección muestra una tabla con filtros dinámicos y botones para exportar:

- Botón "Exportar a PDF" (rojo)
- Botón "Exportar a CSV" (verde)

Las tablas responden a los filtros aplicados y se actualizan automáticamente.

## 📌 Notas adicionales

- El diseño está optimizado para pantallas pequeñas y grandes usando Tailwind.
- Las rutas del backend pueden ajustarse en `api.js`.
- Si quieres agregar más filtros o reportes, puedes seguir la misma estructura de los componentes existentes.

## 👨‍💻 Autores

Desarrollado por [Esteban Cárcamo], [Hugo Barillas] y [Ernesto Ascencio]