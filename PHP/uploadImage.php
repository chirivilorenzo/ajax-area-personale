<?php

    include("CDatabase.php");
    header('Content-Type: application/json');

    if(!isset($_SESSION)){
        session_start();
    }


    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $imageTmp = $_FILES["image"]["tmp_name"];
        $imageData = file_get_contents($imageTmp);


        // Ridimensiona l'immagine
        //serve abilitare la libreria GD 
        $newWidth = 200; // Larghezza desiderata
        $newHeight = 200; // Altezza desiderata
        list($width, $height) = getimagesize($imageTmp);
        $imageResized = imagecreatetruecolor($newWidth, $newHeight);
        $image = imagecreatefromjpeg($imageTmp);
        imagecopyresampled($imageResized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // Salva l'immagine ridimensionata in un buffer
        ob_start();
        imagejpeg($imageResized);
        $imageData = ob_get_clean();

        // Chiudi l'immagine
        imagedestroy($imageResized);



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