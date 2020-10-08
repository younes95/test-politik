<?php

require('../classes/Parser.php');


function listCouncilors($url,$order){

    $parser = new Parser();
    $data = $parser->parseUrl($url);


    if(!$data){
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

function getRandomCouncilors($array)
{
    $keys = array_rand($array,5);
    $listOfCouncilors = [];
    foreach ($keys as $key){
        $listOfCouncilors[] = $array[$key];
    }
    return $listOfCouncilors;
}

$action = $_GET['action'] ? $_GET['action'] : null;
$order = $_GET['order'] ? $_GET['order'] : null;
$random = $_GET['random'];
$format = $_GET['format'] ? $_GET['format'] : null;

if($action == 'list'){
    $url = Parser::REST_API_URL;
    echo json_encode(listCouncilors($url,$order));


}


if($action=='listRestApi'){

    // Select a page randomly
    if($random){
        $pageNumber = rand(Parser::MIN_PAGE,Parser::MAX_PAGE);
    }

    $url = Parser::FILE_URL.'?format='.$format.'&pageNumber='.$pageNumber;

    $listOfCouncilors = listCouncilors($url,$order);

    if($random !== 'null'){
        echo json_encode(getRandomCouncilors($listOfCouncilors));
    }else{
        echo json_encode($listOfCouncilors);
    }

}

