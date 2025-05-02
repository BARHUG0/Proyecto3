<?php

require_once '../src/Models/ArtPeriod.php';

class ArtPeriodController
{

    private $artPeriodModel;

    public function __construct($db)
    {
        $this->artPeriodModel = new ArtPeriod($db);
    }

    // Obtener todos los periodos artísticos
    public function getArtPeriods()
    {
        $periods = $this->artPeriodModel->getAllPeriods();
        echo json_encode($periods);
    }

    // Crear un nuevo periodo artístico
    public function createArtPeriod()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->name, $data->description)) {
            $this->artPeriodModel->createPeriod($data->name, $data->description);
            echo json_encode(["message" => "Periodo artístico creado exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
