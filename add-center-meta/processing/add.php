<?php

include('../../../config.php');

$response = array();

if (isset($_POST['selectCenterId']) && isset($_POST['meta-title']) && isset($_POST['meta-desc'])) {

    $selectCenterId = trim($_POST['selectCenterId']);
    $metaTitle = trim($_POST['meta-title']);
    $metaDesc = trim($_POST['meta-desc']);

    // Getting OG-Details
    if (isset($_POST['og-details'])) {
        $ogDetails = $_POST['og-details'];
    } else {
        $ogDetails = "";
    }

    // Getting Local Schema
    if (isset($_POST['local-schema'])) {
        $localSchema = $_POST['local-schema'];
    } else {
        $localSchema = "";
    }

    // Checking if meta title and desc empty
    if (!empty($selectCenterId) && !empty($metaTitle) && !empty($metaDesc)) {

        // SQL Statements and insertion
        $query = "INSERT INTO `seo_details`
         ( `page_id`, `meta_title`, `meta_description`, `og_details`, `local_schema_details`) VALUES
         (:selectedCenterId, :metaTitle, :metaDesc, :ogDetails, :localSchema);";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':selectedCenterId', $selectCenterId);
        $stmt->bindParam(':metaTitle', $metaTitle);
        $stmt->bindParam(':metaDesc', $metaDesc);
        $stmt->bindParam(':ogDetails', $ogDetails);
        $stmt->bindParam(':localSchema', $localSchema);

        try {
            $stmt->execute();
            $response['status'] = 'success';
            $response['message'] = 'Data Inserted successfully';
        } catch (PDOException $th) {
            $response['status'] = 'error';
            $response['message'] = $th->getMessage();
        }
    } else {
        $error = "City, Meta Title and Meta Desc are mandatory Please fill them";
        $response['status'] = 'error';
        $response['message'] = $error;
    }
} else {
    $error = "Please fill all the details ";
    $response['status'] = 'error';
    $response['message'] = $error;
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
