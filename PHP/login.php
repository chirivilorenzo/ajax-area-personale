<?php

    if(!isset($_SESSION)){
        session_start();
    }

    include("CDatabase.php");
    header('Content-Type: application/json');

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $user = $_POST["user"];
        $psw = $_POST["psw"];

        $classeDB = new CDatabase();
        $classeDB->connessione("areaPersonale");

        $query = "SELECT * FROM utenti WHERE username = ? AND password = ?";
        $result = $classeDB->seleziona($query, $user, $psw);

        if($result != "errore" && $result != "vuoto"){
            $_SESSION["user"] = $user;
            echo json_encode(array("status" => "200"));
        }
        else if($result == "errore"){
            echo json_encode(array("status"=> "300", "message" => "errore nel db"));
        }
        else if($result == "vuoto"){
            echo json_encode(array("status"=> "404", "message"=> "utente non trovato"));    //da togliere e modificare
        }
    }