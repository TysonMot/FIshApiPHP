<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/DbConnect.php';
include_once '../crud/createDB.php';

$database = new connections();

$db = $database->connectDB();

$Fish = new Fish($db);

$Fish->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';

$res = $Fish->readDB();

if($res->num_rows > 0) {
    $dataRecords = array();
    $dataRecords["AquarStore"] = array();
    while ( $_data = $res->fetch_assoc()){
        extract($_data);
        $dataDetails = array (
            "id" => $id,
            "Species" => $Species,
            "Color" => $Size,
            "No_Fins" => $No_Fins,
            "Created_id" => $Created_id,
            "Created_at" => $Created_at
        );
        array_push($dataRecords["AquarStore"], $dataDetails);
    }
    http_response_code(200);
    echo json_encode($dataRecords);
}else {
    http_response_code(404);
    echo json_encode(array("message" => "We found nothing"));
}

?>