<?php

require_once '../src/Models/ConditionNotes.php';

class ConditionNotesController
{

    private $conditionNotesModel;

    public function __construct($db)
    {
        $this->conditionNotesModel = new ConditionNotes($db);
    }

    // Obtener todas las notas de condición
    public function getConditionNotes()
    {
        $notes = $this->conditionNotesModel->getAllNotes();
        echo json_encode($notes);
    }

    // Crear una nueva nota de condición
    public function createConditionNote()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->note)) {
            $this->conditionNotesModel->createNote($data->note);
            echo json_encode(["message" => "Nota de condición creada exitosamente"]);
        } else {
            echo json_encode(["message" => "Faltan datos"]);
        }
    }
}
