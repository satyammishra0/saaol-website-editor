<?php

include('../../../config.php');

if (isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $validate = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$validate) {
        echo "Please enter Valid Email";
        die();
    }
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
}

try {
    $query = "UPDATE `city-card-details` SET `center_email` = :email WHERE `city-card-details`.`id` = :id;";

    $prepQuery = $conn->prepare($query);
    $prepQuery->bindParam(':id', $id);
    $prepQuery->bindParam(':email', $email);
    $prepQuery->execute();
    echo "Email updated successfully";
} catch (PDOException $th) {
    throw $th;
}
