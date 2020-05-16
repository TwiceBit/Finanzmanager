<?php
require 'Database.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $betrag =  $_POST['amount'];
    $beschreibung = $_POST['description'];
    
    Database::addTransaktion($beschreibung, $betrag);

}


header('Location: /');



?>