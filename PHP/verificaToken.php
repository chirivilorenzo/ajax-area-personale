<?php

    include("CDatabase.php");
    header('Content-Type: application/json');

    if(!isset($_SESSION)){
        session_start();
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $token = $_POST["token"];

        $classeDB = new CDatabase();
        $classeDB->connessione("areaPersonale");

        $query = "SELECT * FROM utenti WHERE token = ?";
        $result = $classeDB->seleziona($query, $token);

        if($result != "errore" && $result != "vuoto"){
            $_SESSION["token"] = $token;
            echo json_encode(array("status"=>"200"));
        }
        else if($result == "vuoto"){
            echo json_encode(array("status"=> "error", "message"=> "token non trovato"));
        }
        else{
            echo json_encode(array("status"=> "error", "message"=> "errore nel db"));
        }
    }
    else{
        echo json_encode(array("status"=> "error", "message"=> "nessun parametro passato"));
    }