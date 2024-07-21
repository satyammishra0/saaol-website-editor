<?php
include('../config.php');



// Setting the post variable from POST
if (isset($_POST['id'])) {
    $id = $_POST['id'];
} else {
    echo "Some error occured please retry";
    die();
}

$query = "DELETE FROM `city-card-details` WHERE `id` = :id";
$queryPrep = $conn->prepare($query);
$queryPrep->bindParam('id', $id);
$queryPrep->execute();


try {
    $query = "DELETE FROM `city-card-details` WHERE `id` = :id";
    $queryPrep = $conn->prepare($query);
    $queryPrep->bindParam('id', $id);
    $queryPrep->execute();

    if ($queryPrep) {
        echo "Item Deleted successfully";
    }
} catch (PDOException $th) {
    echo $th->getMessage();
}
