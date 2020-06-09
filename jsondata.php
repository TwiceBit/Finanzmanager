<?php
require 'Database.php';
/*
$json 
 {
        "type": 'line',
        "data": {

            "labels": [],
            "datasets": [{
                "label": '',
                "fill": False,
                "borderColor": 'rgb(255,0,0)',
                "data": []
            }]
        },
    
        
        "options": {
            
        }
    }*/


$res = Database::getAllTransactions();

$data = [];
$label = [];
$summe = 0.0;
while ($row = $res->fetch_assoc()) {

    if ($row['beschreibung'] == null && $row['betrag'] == null) continue;

    $summe += $row['betrag'];

    array_push($label, $row['beschreibung']);
    array_push($data, $summe);
}


header('Content-Type: application/json');

$json = array(

    "type" => "line",
    "data" => array(

        "labels" => $label,
        "datasets" => array(
            array("label" => "", "fill" => false, "borderColor" => "rgb(255,0,0)", "data" => $data)
        )
    )



);

echo json_encode($json);
