<?php
include "./config/database.php";

$database = new Database();
$db = $database->migrate();