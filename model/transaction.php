<?php
class Transaction
{

    private $table = "transaction";
    public $id;
    public $disburse_id;
    public $user_id;
    public $amount;
    public $status;
    public $receipt;
    public $remark;
    public $time_served;
    public $fee;
    private $connection;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    function createNewTransaction($data)
    {
        $this->disburse_id = $data['disburse_id'];
        $this->user_id = $data['user_id'];
        $this->amount = $data['amount'];
        $this->status = $data['status'];
        $this->remark = $data['remark'];
        $this->fee = $data['fee'];
        $sql = "INSERT INTO $this->table (`disburse_id`,`user_id`,`amount`,`status`,`remark`,`fee`) VALUES ($this->disburse_id,$this->user_id,$this->amount,'$this->status','$this->remark',$this->fee)";
        if (mysqli_query($this->connection, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    function updateTransaction($id, $data)
    {
        $this->status = $data['status'];
        $this->receipt = $data['receipt'];
        $this->time_served = $data['time_served'];
        $sql = "UPDATE $this->table SET status = '$this->status', receipt = '$this->receipt', time_served = '$this->time_served' where disburse_id = $id";
        if (mysqli_query($this->connection, $sql)) {
            return true;
        } else {
            return false;
        }
    }
}
