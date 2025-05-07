<?php

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

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/paintings') {
    $paintingController->getArtworksReport(); 
} else if (($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/sales')) {
    $saleController->getSalesReport();
} else if (($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/paintings/exhibitions')) {
    $paintingExhibitionsController->getExhibitionsReport();
} else if (($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/artists')) {
    $artistController->getArtistReport();
} else if (($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/paintings/materials')) {
    $paintingMaterialsController->getPaintingMaterialsReport();
}else if (($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/paintings/conditions')) {
    $paintingController->getConditionReport();
}else if (($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/paintings/provenances')) {
    $paintingProvenanceController->getProvenanceReport();
}else {
    echo "Ruta no encontrada.";
}


