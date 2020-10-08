<?php

require('../classes/Parser.php');


function listCouncilors($url,$order){

    $parser = new Parser();
    $data = $parser->parseUrl($url);


    if(!$data){
        echo "Url doesn't exists";
        return false;
    }

    $listOfCouncilors = [];

    foreach($data as $row){
        $councilor = new Councilor();
        $councilor->set($row);
        $listOfCouncilors[] = $councilor;
    }

    if($order == 'lastname'){
        usort($listOfCouncilors, 'compareByLastName');
    }

    if($order == 'firstname'){
        usort($listOfCouncilors, 'compareByFirstName');
    }

    return $listOfCouncilors;
}

function compareByLastName($a, $b) {
    return strcmp($a->lastName, $b->lastName);
}

function compareByFirstName($a, $b) {
    return strcmp($a->firstName, $b->firstName);
}

$action = $_GET['action'] ? $_GET['action'] : null;
$order = $_GET['order'] ? $_GET['order'] : null;

if($action == 'list'){
    $url = "https://politik.ch/dl/councillors.json";
    echo json_encode(listCouncilors($url,$order));
}

