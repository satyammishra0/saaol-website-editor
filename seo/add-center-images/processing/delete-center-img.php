<?php
include('../../../config.php');
$centerId = $_GET['id'];
$sql = "DELETE FROM `center_images` WHERE `id` =:centerId";

$sqlPrep = $conn->prepare($sql);

$sqlPrep->bindParam(":centerId", $centerId);

try {
    $sqlPrep->execute();
    echo "Row Deleted Successfully";
} catch (PDOException $th) {
    echo "Error: " . $th->getMessage();
}
