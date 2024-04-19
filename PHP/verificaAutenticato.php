<?php

    if(!isset($_SESSION)){
        session_start();
    }

    header('Content-Type: application/json');

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(isset($_SESSION["user"])){
            echo json_encode(array("status"=> "200"));
        }
        else{
            echo json_encode(array("status"=> "error", "message"=> "non sei autenticato"));
        }
    }