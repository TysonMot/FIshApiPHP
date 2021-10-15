<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/DbConnect.php';
include_once '../crud/createDB.php';

$database = new connections();

$db = $database->connectDB();

$Fish = new Fish($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->Species) && !empty($data->Color) && !empty($data->No_Fins) && 
!empty($data->Created_id) && !empty($data->Created_at)){

    $Fish->Species = $this->Species;
    $Fish->Color = $this->Color;
    $Fish->No_Fins = $this->No_Fins;
    $Fish->Created_id = $this->Created_id;
    $Fish->Created_at = date('Y-m-d H:i:s');


    if($Fish->createDB()){
        http_response_code(201);
        echo json_encode(array("message"=> "AqureStore data created successfully."));
    }else {
        http_response_code(503);
        echo json_encode(array("message"=> "Something wrong happened, please try again later."));
    }
}else {
    http_response_code(400);
    echo json_encode(array("message"=> "Please provide all required data."));
}

?>