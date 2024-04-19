<?php

    header('Content-Type: application/json');
    include("CDatabase.php");

    if(!isset($_SESSION)){
        session_start();
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $classeDB = new CDatabase();
        $classeDB->connessione("areaPersonale");

        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $dataNascita = $_POST["dataNascita"];
        $regione = $_POST["regione"];
        $provincia = $_POST["provincia"];
        $citta = $_POST["citta"];

        $username = $_SESSION["user"];

        //manca la query e prendere tutti i dati passati in post
        $query = "UPDATE utenti SET nome = ?, cognome = ?, dataNascita = ?, regione = ?, provincia = ?, citta = ? WHERE username = ?";

        $result = $classeDB->inserisci($query, $nome, $cognome, $dataNascita, $regione, $provincia, $citta, $username);

        if($result){
            echo json_encode(array("status"=> "200"));
        }
        else{
            echo json_encode(array("status"=> "error", "message"=> "errore nell'inserimento"));
        }
    }
    else{
        echo "401";
    }