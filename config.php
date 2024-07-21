<?php

define('APPPATH', __DIR__);

// function base_url()
// {
//     return "https://saaol.com/";
// }

// $dbHost = "localhost";
// $dbPass = "CAIZk.}&vW1X";
// $dbUser = "saaolwfghrtsd_appointment_user";
// $dbName = "saaolwfghrtsd_appointment_form";

function base_url()
{
    return "http://localhost/saaol/saaol.com/";
}


$dbHost = "localhost";
$dbPass = "";
$dbUser = "root";
$dbName = "saaol-website";


try {
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    throw $e;
}
