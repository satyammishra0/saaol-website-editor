<?php

include('../config.php');



if (isset($_POST['cc_email'])) {
    $cc_email = trim($_POST['cc_email']);
    $validate = filter_var($cc_email, FILTER_VALIDATE_EMAIL);
    if (!$validate) {
        echo "Please enter Valid Email";
        die();
    }
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
}

try {
    $query = "UPDATE `city-card-details` SET `cc_email` = :cc_email WHERE `city-card-details`.`id` = :id;";

    $prepQuery = $conn->prepare($query);
    $prepQuery->bindParam(':id', $id);
    $prepQuery->bindParam(':cc_email', $cc_email);
    $prepQuery->execute();
    echo "CC Email updated successfully";
} catch (PDOException $th) {
    throw $th;
}
