<?php

    try{
        $db = new PDO('mysql:host=127.0.0.1;charset=utf8;dbname=alexandre', 'root', '');


    }catch(PDOException $ex){
        echo 'Erreur :'. $ex ;
        die();

    }
?>
