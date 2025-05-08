<?php

require_once __DIR__ . '/../Models/Painting.php';
require_once __DIR__ . '/../Models/Artist.php';
require_once __DIR__ . '/../Models/SignatureLocation.php';

class PaintingController
{

    private $paintingModel;
    private $artistModel;
    private $signatureLocationModel;

    public function __construct($db)
    {
        $this->paintingModel          = new Painting($db);
        $this->artistModel            = new Artist($db);
        $this->signatureLocationModel = new SignatureLocation($db);
    }

    // Obtener todas las pinturas
    public function getPaintings()
    {
        $paintings = $this->paintingModel->getAllPaintings();
        echo json_encode($paintings);
    }

    // Crear una nueva pintura
    public function createPainting()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->artist_id, $data->signature_location_id, $data->width, $data->height, $data->title, $data->execution_date, $data->description)) {
            $this->paintingModel->createPainting($data->artist_id, $data->signature_location_id, $data->width, $data->height, $data->depth, $data->title, $data->execution_date, $data->description, $data->includes_authenticity_certificate, $data->full_condition_report);
            echo json_encode(["message" => "Pintura creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
    public function getArtworksReport()
    {
        $paintings = $this->paintingModel->getAllPaintings();
        $report    = [];
        foreach ($paintings as $painting) {
            $artist            = $this->getArtistById($painting['artist_id']);
            $signatureLocation = $this->getSignatureLocationById($painting['signature_location_id']);

            $report[] = [
                'title'                             => $painting['title'],
                'artist'                            => $artist['pseudonym'],
                'execution_date'                    => $painting['execution_date'],
                'width'                             => $painting['width'],
                'height'                            => $painting['height'],
                'depth'                             => $painting['depth'],
                'signature_location'                => $signatureLocation['name'],
                'description'                       => $painting['description'],
                'includes_authenticity_certificate' => $painting['includes_authenticity_certificate'] ? 'Yes' : 'No',
                'full_condition_report'             => $painting['full_condition_report'],
                'created_at'                        => $painting['created_at'],
                'updated_at'                        => $painting['updated_at'],
            ];

        }
        echo json_encode($report);

    }

    public function getConditionReport()
    {
        $conditions = $this->paintingModel->getAllPaintingConditions();
        $report     = [];
        foreach ($conditions as $condition) {
            $report[] = [
                'title'                 => $condition['title'],
                'note'                  => $condition['note'],
                'full_condition_report' => $condition['full_condition_report'],
            ];
        }
        echo json_encode($report);
    }
    private function getArtistById($artist_id)
    {
        return $this->artistModel->getArtistById($artist_id);
    }
    private function getSignatureLocationById($signature_location_id)
    {
        return $this->signatureLocationModel->getLocationById($signature_location_id);
    }
}
