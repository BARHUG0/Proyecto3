# Configuración de Conexión a Base de Datos en PHP

Este proyecto incluye una clase `Database` (ubicada en `database.example.php`) que facilita la conexión a una 
base de datos PostgreSQL utilizando **PDO (PHP Data Objects)**.

## Estructura

backend/
│
├── database.example.php # Archivo de ejemplo
├── index.php # Sección de rutas
└── ...

## ⚙️ Descripción

La clase `Database` carga los valores de conexión desde las variables de entorno 
(`.env`, `docker-compose`, etc.) y expone un método `getConnection()` para obtener una instancia activa de PDO.

### Variables que debe definir el entorno:

- `DB_HOST`: Dirección del host de la base de datos (ej. `localhost` o `db` si se usa Docker).
- `DB_NAME`: Nombre de la base de datos.
- `DB_USER`: Usuario de la base de datos.
- `DB_PASSWORD`: Contraseña del usuario.

## 🛠️ Configuración

1. Crea un archivo `.env` en la raíz del proyecto (si usas dotenv o Laravel-style).
   
```env
DB_HOST=localhost
DB_NAME=nombre_base_datos
DB_USER=usuario
DB_PASSWORD=contraseña
```

Para probar conexión:
```
php -S localhost:8000 -t backend
```
