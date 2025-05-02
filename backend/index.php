<?php

require_once 'src/Database/Database.php';             
require_once 'src/Controller/PaintingController.php'; 
require_once 'src/Controller/SaleController.php'; 
require_once 'src/Controller/PaintingExhibitionsController.php'; 
require_once 'src/Controller/ArtistController.php'; 

$database = new Database();
$db       = $database->getConnection();

$paintingController = new PaintingController($db);
$saleController = new SaleController($db);
$paintingExhibitionsController = new PaintingExhibitionsController($db);
$artistController = new ArtistController($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/artworks') {
    $paintingController->getArtworksReport(); 
} else if (($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/sales')) {
    $saleController->getSalesReport();
} else if (($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/exhibitions')) {
    $paintingExhibitionsController->getExhibitionsReport();
} else if (($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/artists')) {
    $artistController->getArtistReport();
} else {
    echo "Ruta no encontrada.";
}
