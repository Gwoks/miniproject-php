<?php
header("Access-Control-Allow-Methods: POST");

include_once '../model/seller.php';
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$sellers = new Seller($db);

$data = json_decode(file_get_contents("php://input"));

$seller_temp = $sellers->createSeller($data);

if($seller_temp){
    echo json_encode(array("message" => "Berhasil menambah seller"));
} else {
    echo json_encode(array("message" => "Oops terjadi kesalahan"));
}