<?php

// Incluir archivos necesarios con las rutas absolutas correctas
require_once 'src/Database/Database.php';             // Ruta corregida a Database.php
require_once 'src/Controller/PaintingController.php'; // Ruta a PaintingController.php

// Crear la conexión a la base de datos
$database = new Database();
$db       = $database->getConnection();

// Crear instancia del controlador de reportes
$reportController = new PaintingController($db);

// Verificar la solicitud y redirigirla al método adecuado del controlador
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/report/artworks') {
    $reportController->getArtworksReport(); // Llamar al método que genera el reporte
} else {
    echo "Ruta no encontrada.";
}
