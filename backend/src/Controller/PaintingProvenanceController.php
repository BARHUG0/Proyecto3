<?php

require_once __DIR__ . '/../Models/PaintingProvenance.php';

class PaintingProvenanceController
{

    private $paintingProvenanceModel;

    public function __construct($db)
    {
        $this->paintingProvenanceModel = new PaintingProvenance($db);
    }

    // Obtener todas las procedencias de pintura
    public function getPaintingProvenances()
    {
        $provenances = $this->paintingProvenanceModel->getAllProvenances();
        echo json_encode($provenances);
    }

    
    public function getProvenanceReport()
    {
        $provenances = $this->paintingProvenanceModel->getAllPaintingProvenances();
        $report    = [];
        foreach ($provenances as $provenance) {
            $report[] = [
                'title' => $provenance['title'],
                'name'  => $provenance['name'],
                'transfer_owner' => $provenance['transfer_owner'],
                'transfer_date' => $provenance['transfer_date'],
                'description' => $provenance['description'],
            ];
            
        }
        echo json_encode($report);

    }


    // Crear una nueva procedencia de pintura
    public function createPaintingProvenance()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->painting_id, $data->transfer_type_id, $data->transfer_owner, $data->transfer_date)) {
            $this->paintingProvenanceModel->createProvenance($data->painting_id, $data->transfer_type_id, $data->transfer_owner, $data->transfer_date, $data->description);
            echo json_encode(["message" => "Procedencia de pintura creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
