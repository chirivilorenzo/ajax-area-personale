<?php

    header('Content-Type: application/json');
    include("CDatabase.php");

    if($_SERVER["REQUEST_METHOD"] === "GET"){

        $classeDB = new CDatabase();
        $classeDB->connessione("comuni_italiani");

        $provincia = $_GET["provincia"];


        $query = "SELECT c.denominazione_ita FROM gi_comuni_cap as c
        JOIN gi_province as p ON c.sigla_provincia = p.sigla_provincia
        WHERE p.denominazione_provincia = ?";

        $result = $classeDB->seleziona($query, $provincia);

        if($result != "errore"){

            $citta = [];
            foreach($result as $elemento){
                $citta[] = $elemento;
            }
        }

        echo json_encode($citta);
    }
    else{
        echo "401";
    }