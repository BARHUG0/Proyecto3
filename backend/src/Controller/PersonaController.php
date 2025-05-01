<?php

require_once '../src/Models/Persona.php';

class PersonaController
{

    private $personaModel;

    public function __construct($db)
    {
        $this->personaModel = new Persona($db);
    }

    // Obtener todas las personas
    public function getPersons()
    {
        $persons = $this->personaModel->getAllPersons();
        echo json_encode($persons);
    }

    // Crear una nueva persona
    public function createPerson()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->nationality, $data->first_given_name, $data->paternal_last_name, $data->birthdate)) {
            $this->personaModel->createPerson($data->nationality, $data->first_given_name, $data->second_given_name, $data->third_given_name, $data->paternal_last_name, $data->maternal_last_name, $data->birthdate);
            echo json_encode(["message" => "Persona creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
