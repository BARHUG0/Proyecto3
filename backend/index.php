<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");


require_once 'src/Database/Database.php';             
require_once 'src/Controller/PaintingController.php'; 
require_once 'src/Controller/SaleController.php'; 
require_once 'src/Controller/PaintingExhibitionsController.php'; 
require_once 'src/Controller/ArtistController.php'; 
require_once 'src/Controller/PaintingMaterialsController.php';
require_once 'src/Controller/PaintingProvenanceController.php';

$database = new Database();
$db       = $database->getConnection();

$paintingController = new PaintingController($db);
$saleController = new SaleController($db);
$paintingExhibitionsController = new PaintingExhibitionsController($db);
$artistController = new ArtistController($db);
$paintingMaterialsController = new PaintingMaterialsController($db);
$paintingProvenanceController = new PaintingProvenanceController($db);

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $requestUri == '/paintings') {
    $paintingController->getArtworksReport(); 
} else if (($_SERVER['REQUEST_METHOD'] == 'GET' && $requestUri  == '/sales')) {
    $saleController->getSalesReport();
} else if (($_SERVER['REQUEST_METHOD'] == 'GET' && $requestUri  == '/paintings/exhibitions')) {
    $paintingExhibitionsController->getExhibitionsReport();
} else if (($_SERVER['REQUEST_METHOD'] == 'GET' && $requestUri  == '/artists')) {
    $artistController->getArtistReport();
} else if (($_SERVER['REQUEST_METHOD'] == 'GET' && $requestUri  == '/paintings/materials')) {
    $paintingMaterialsController->getPaintingMaterialsReport();
}else if (($_SERVER['REQUEST_METHOD'] == 'GET' && $requestUri  == '/paintings/conditions')) {
    $paintingController->getConditionReport();
}else if (($_SERVER['REQUEST_METHOD'] == 'GET' && $requestUri  == '/paintings/provenances')) {
    $paintingProvenanceController->getProvenanceReport();
}else {
    echo "Ruta no encontrada.";
}


