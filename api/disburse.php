<?php
header("Access-Control-Allow-Methods: POST");

include_once '../model/seller.php';
include_once '../model/transaction.php';
include_once '../config/database.php';
include_once '../util/slightlyBigFlip.php';

$database = new Database();
$db = $database->getConnection();

$sellers = new Seller($db);
$transactions = new Transaction($db);
$flip = new SlightlyBigFlip();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->user_id) && !empty($data->amount)) {
    $seller_temp = $sellers->get_seller($data->user_id);
    if ($seller_temp['active_balance'] < $data->amount) {
        echo json_encode(array("message" => "Saldo anda tidak mencukupi"));
    } else {
        $flip_data['bank_code'] = $seller_temp['bank_code'];
        $flip_data['account_number'] = $seller_temp['account_number'];
        $flip_data['amount'] = $data->amount;
        $flip_data['remark'] = $seller_temp['name'];

        $flip_respose = $flip->postDisburse($flip_data);
        $update_transaction['disburse_id'] = $flip_respose->{'id'};
        $update_transaction['user_id'] = $data->user_id;
        $update_transaction['amount'] =  $data->amount;
        $update_transaction['status'] = $flip_respose->{'status'};
        $update_transaction['remark'] = $flip_respose->{'remark'};
        $update_transaction['fee'] = $flip_respose->{'fee'};

        $transactions_result = $transactions->createNewTransaction($update_transaction);
        $new_balance = $seller_temp['active_balance'] - $data->amount;
        $seller_result = $sellers->updateBalance($data->user_id, $new_balance);

        if ($transactions_result && $seller_result) {
            echo json_encode(array(
                "transaction_number" => $flip_respose->{'id'},
                "status" => $flip_respose->{'status'}
            ));
        } else {
            echo json_encode(array("message" => "Error, transaksi tidak valid"));
        }
    }
}
