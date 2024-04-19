<?php

    //error_reporting(0);

    header('Content-Type: application/json');
    include("CDatabase.php");

    if(!isset($_SESSION)){
        session_start();
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $classeDB = new CDatabase();
        $classeDB->connessione("areaPersonale");

        $username = $_SESSION["user"];

        $query = "SELECT * FROM utenti WHERE username = ?";

        $result = $classeDB->seleziona($query, $username);

        if($result != "errore" && $result != "vuoto"){
            echo json_encode(array("status"=> "200","imageData"=> $result[0]["immagine"]));
        }
        else if($result == "vuoto"){
            echo json_encode(array("status"=> "error","message"=>"username non trovato quindi impossibile ottenere il token"));
        }
        else{
            echo json_encode(array("status"=> "error", "message"=> "errore nel prendere le info dal db per il token"));
        }
    }
    else{
        echo "401";
    }