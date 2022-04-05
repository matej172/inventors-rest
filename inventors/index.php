<?php
require_once "../Inventor.php";

header('Content-Type: application/json; charset=utf-8');

switch ($_SERVER['REQUEST_METHOD']) {
    case "POST":
        header("HTTP/1.1 201 OK");
        $data = json_decode(file_get_contents('php://input'), true);
            //TODO validation
        $inventor = new Inventor();
        $inventor->setName($data['name']);
        $inventor->setSurname($data['surname']);
        $inventor->setDescription($data['description']);
        $inventor->setBirthDate("27.09.1990");
        $inventor->setBirthPlace("Nitra");
        $inventor->save();
        echo json_encode($inventor->toArray());
        break;
    case "DELETE":
        $id = $_GET['id'];
        Inventor::find($id)->destroy();
        header("HTTP/1.1 204 OK");
        break;
    case "GET":
        header("HTTP/1.1 200 OK");
        $id = $_GET['id'];
        if($id){
            echo json_encode(Inventor::find($id)->toArray());
        } else {
            echo json_encode(Inventor::all());
        }
        break;
}

