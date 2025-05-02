<?php

require_once '../src/Models/Artist.php';

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
