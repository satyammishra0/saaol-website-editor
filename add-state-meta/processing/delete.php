<?php

include('../../../config.php');

// Setting the post variable from POST
if (isset($_POST['id'])) {
    $id = $_POST['id'];
} else {
    echo "Some error occured please retry";
    die();
}


try {
    //code...
    $query = "DELETE FROM `state_seo_details` WHERE `state_seo_id` = :id";
    $queryPrep = $conn->prepare($query);
    $queryPrep->bindParam('id', $id);
    $queryPrep->execute();

    if ($queryPrep) {
        echo "Item Deleted successfully";
    }
} catch (PDOException $th) {
    echo $th->getMessage();
}
