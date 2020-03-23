<?php
header("Access-Control-Allow-Methods: GET");

include_once '../model/transaction.php';
include_once '../config/database.php';
include_once '../util/slightlyBigFlip.php';

$database = new Database();
$db = $database->getConnection();

$transactions = new Transaction($db);
$flip = new SlightlyBigFlip();

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->transaction_number)){
    $flip_respose = $flip->getDisburse($data->transaction_number);
    file_put_contents('php://stderr', print_r($flip_respose, TRUE));
    $update_transaction['receipt'] = $flip_respose->{'receipt'};
    $update_transaction['status'] = $flip_respose->{'status'};
    $update_transaction['time_served'] = $flip_respose->{'time_served'};
    $transactions_result = $transactions->updateTransaction($data->transaction_number,$update_transaction);

    if ($transactions_result) {
        echo json_encode(array(
            "number transaction" => $flip_respose->{'id'},
            "status" => $flip_respose->{'status'},
            "receipt" => $flip_respose->{'receipt'}
        ));
    } else {
        echo json_encode(array("message" => "Error, nomor transaksi tidak ditemukan"));
    }
}