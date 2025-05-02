<?php

require_once '../src/Models/Country.php';

class CountryController
{

    private $countryModel;

    public function __construct($db)
    {
        $this->countryModel = new Country($db);
    }

    // Obtener todos los países
    public function getCountries()
    {
        $countries = $this->countryModel->getAllCountries();
        echo json_encode($countries);
    }

    // Crear un nuevo país
    public function createCountry()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->name)) {
            $this->countryModel->createCountry($data->name);
            echo json_encode(["message" => "País creado exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
