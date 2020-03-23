<?php
class Seller
{

    private $table = "seller";
    public $id;
    public $name;
    public $email;
    public $phone;
    public $active_balance;
    public $bank_code;
    public $account_number;
    private $connection;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    function get_seller($id)
    {
        $sql = "select * from $this->table where id = $id";
        $q = mysqli_query($this->connection, $sql);
        $result = mysqli_fetch_array($q);
        return $result;
    }

    function updateBalance($id, $balance)
    {
        $sql = "UPDATE $this->table SET active_balance=$balance WHERE id = $id";
        if (mysqli_query($this->connection, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    function createSeller($data)
    {
        $this->name = $data->name;
        $this->email = $data->email;
        $this->phone = $data->phone;
        $this->active_balance = $data->active_balance;
        $this->bank_code = $data->bank_code;
        $this->account_number = $data->account_number;

        $sql = "INSERT INTO $this->table (name, email, phone, active_balance,bank_code,account_number) VALUES ('$this->name','$this->email',$this->phone,$this->active_balance,'$this->bank_code','$this->account_number');";
        if (mysqli_query($this->connection, $sql)) {
            return true;
        } else {
            return false;
        }
    }
}
