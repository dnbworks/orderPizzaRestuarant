<?php

header('Access-control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// get the raw posted data

$data = json_decode(file_get_contents("php://input"));


if($data) {
    echo json_encode(
        array('message' => 'Post Created')
    );
    } else {
    echo json_encode(
        array('message' => 'Post Not Created')
    );
}
var_dump($data);