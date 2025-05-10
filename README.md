# Proyecto 3: Aplicación Web Full-Stack

Este repositorio contiene el código fuente de **Proyecto 3**, una aplicación web full-stack desarrollada con **PHP**, **PostgreSQL**, **React** y **Docker**. A continuación encontrarás información general sobre el proyecto, las tecnologías empleadas y los pasos necesarios para levantar el entorno de desarrollo.

---

## 📋 Resumen del Proyecto

El proyecto incluye un frontend interactivo que simula una plataforma web dedicada a la visualización y generación de reportes relacionados con ventas y subastas de obras de arte, ofreciendo una interfaz moderna y funcional para los usuarios.

---

## 🛠 Tecnologías Empleadas

* **PHP**: Lógica del lado del servidor y API REST.
* **PostgreSQL**: Sistema de gestión de base de datos relacional.
* **React**: Creación de componentes e interacción con la API.
* **Docker & Docker Compose**: Contenerización de servicios y orquestación.

---

## 🚀 Cómo Ejecutar el Proyecto

Sigue estos pasos para clonar y ejecutar la aplicación en tu entorno local:

1. **Clonar el repositorio**

   ```bash
   git clone https://github.com/BARHUG0/Proyecto3
   ```

2. **Ingresar a la carpeta clonada**

   ```bash
   cd Proyecto3
   ```

3. **Configurar variables de entorno**

   * Copia el archivo de ejemplo y renómbralo:

     ```bash
     cp .env.example .env
     ```
   * Edita el archivo `.env` y ajusta las variables según tu configuración (credenciales de PostgreSQL, etc.).

4. **Configurar conexión a la base de datos (backend)**

   * Ingresa a `backend/src/Database`:

     ```bash
     cd backend/src/Database
     ```
   * Copia el archivo de ejemplo y renómbralo:

     ```bash
     cp Database.example.php Database.php
     ```

5. **Levantar los contenedores con Docker Compose**

   * Regresa a la carpeta raíz donde se ubica `docker-compose.yml`:

     ```bash
     cd ../../../
     ```
   * Ejecuta el siguiente comando para construir y levantar los servicios:

     ```bash
     docker compose up --build
     ```

6. **Configurar y ejecutar el frontend**

   * Ingresa a la carpeta del frontend:

     ```bash
     cd frontend
     ```
   * Sigue los pasos indicados en el `README` del frontend (instalar dependencias con `npm install`, etc.)&#x20;

---

## 📂 Estructura del Repositorio

```text
Proyecto3/
├── backend/
│   ├── src/
│   │   ├── Controllers/
│   │   ├── Database/
│   │   ├── Models/
│   │   └── index.php
│   ├── Dockerfile
│   └── composer.json
├── frontend/
│   ├── public/
│   ├── src/
│   ├── package.json
│   └── README.md
├── docker-compose.yml
├── .env.example
└── README.md
```

---

---

> ¡Gracias por tu tiempo!&#x20;
