<?php

    include("CDatabase.php");
    header('Content-Type: application/json');

    if(!isset($_SESSION)){
        session_start();
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $imageTmp = $_FILES["image"]["tmp_name"];
        $imageData = file_get_contents($imageTmp);


        $classeDB = new CDatabase();
        $classeDB->connessione("areaPersonale");

        $token = $_SESSION["token"];

        $query = "UPDATE utenti SET immagine = ? WHERE token = ?";
        $result = $classeDB->inserisci($query, $imageData, $token);

        if($result){
            echo json_encode(array("status"=>"200"));
        }
        else{
            echo json_encode(array("status"=> "error", "message"=> "errore nel db"));
        }
    }
    else{
        echo json_encode(array("status"=> "error", "message"=> "nessun parametro passato"));
    }