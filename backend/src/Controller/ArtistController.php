<?php

require_once __DIR__ . '/../Models/Artist.php';

class ArtistController
{

    private $artistModel;

    public function __construct($db)
    {
        $this->artistModel = new Artist($db);
    }

    // Obtener todos los artistas
    public function getArtists()
    {
        $artists = $this->artistModel->getAllArtists();
        echo json_encode($artists);
    }

    public function getArtistReport()
    {
        $artists = $this->artistModel->getAllArtists();
        $report  = [];
        foreach ($artists as $artist) {
            $full_name = $artist['first_given_name'] . ' ' . $artist['second_given_name'];
            $report[]  = [
                'full_name'   => $full_name,
                'pseudonym'   => $artist['pseudonym'],
                'description' => $artist['description'],
                'created_at'  => $artist['created_at'],
                'updated_at'  => $artist['updated_at'],
            ];
        }
        echo json_encode($report);
    }

    // Crear un nuevo artista
    public function createArtist()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->persona_id, $data->pseudonym, $data->description)) {
            $this->artistModel->createArtist($data->persona_id, $data->pseudonym, $data->description);
            echo json_encode(["message" => "Artista creado exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
