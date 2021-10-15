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

$Aqur = new Aquarium($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->Glass_type) && !empty($data->Size) && !empty($data->Shape) && 
!empty($data->Created_id) && !empty($data->Created_at)){

    $Aqur->Glass_type = $this->Glass_type;
    $Aqur->Size = $this->Size;
    $Aqur->Shape = $this->Shape;
    $Aqur->Created_id = $this->Created_id;
    $Aqur->Created_at = date('Y-m-d H:i:s');


    if($Aqur->createDB()){
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