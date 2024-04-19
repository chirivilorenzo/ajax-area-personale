<?php

    header('Content-Type: application/json');
    include("CDatabase.php");

    if($_SERVER["REQUEST_METHOD"] === "GET"){

        $classeDB = new CDatabase();
        $classeDB->connessione("comuni_italiani");

        $regione = $_GET["regione"];


        $query = "SELECT p.denominazione_provincia FROM gi_province as p JOIN gi_regioni as r ON r.codice_regione = p.codice_regione WHERE r.denominazione_regione = ?";
        $result = $classeDB->seleziona($query, $regione);

        if($result != "errore"){

            $province = [];
            foreach($result as $elemento){
                $province[] = $elemento;
            }
        }

        echo json_encode($province);
    }
    else{
        echo "401";
    }