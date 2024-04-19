<?php

    header('Content-Type: application/json');
    include("CDatabase.php");

    if($_SERVER["REQUEST_METHOD"] === "GET"){

        $classeDB = new CDatabase();
        $classeDB->connessione("comuni_italiani");

        $query = "SELECT * FROM gi_regioni";
        $result = $classeDB->seleziona($query);

        if($result != "errore"){

            $regioni = [];
            foreach($result as $elemento){
                $regioni[] = $elemento;
            }
        }

        echo json_encode($regioni);
    }
    else{
        echo "401";
    }