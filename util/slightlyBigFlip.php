<?php

class SlightlyBigFlip
{
    private $secret_key = "HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41";
    private $base_url = "https://nextar.flip.id/disburse";
    private $header = array(
        'Content-Type' => 'application/x-www-form-urlencoded'
    );
    function __construct()
    {
    }

    public function postDisburse($data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->base_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
        curl_setopt($ch, CURLOPT_USERPWD, $this->secret_key . ":");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $responseDisburse = curl_exec($ch);
        curl_close($ch);
        return json_decode($responseDisburse);
    }

    public function getDisburse($id)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->base_url . '/' . $id);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
        curl_setopt($ch, CURLOPT_USERPWD, $this->secret_key . ":");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $responseDisburse = curl_exec($ch);
        curl_close($ch);
        return json_decode($responseDisburse);
    }
}
