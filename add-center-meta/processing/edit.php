<?php

include('../../../config.php');

$response = array();

if (isset($_POST['meta-title']) && isset($_POST['meta-desc'])) {

    if (!isset($_POST['current-city-name'])) {
        $selectCenterId = trim($_POST['existing-city']);
    } else {
        $selectCenterId = trim($_POST['current-city-name']);
    }

    $pageId = trim($_POST['page-id']);
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
        $query = "UPDATE `seo_details` SET 
                  `page_id` = :selectCenterId,
                   `meta_title` = :metaTitle, 
                   `meta_description` = :metaDesc,
                   `og_details` = :ogDetails, 
                   `local_schema_details` = :localSchema
                   WHERE
                   `seo_details`.`seo_id` = :pageId;";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':selectCenterId', $selectCenterId);
        $stmt->bindParam(':metaTitle', $metaTitle);
        $stmt->bindParam(':metaDesc', $metaDesc);
        $stmt->bindParam(':ogDetails', $ogDetails);
        $stmt->bindParam(':localSchema', $localSchema);
        $stmt->bindParam(':pageId', $pageId);

        try {
            $stmt->execute();
            $response['status'] = 'success';
            $response['message'] = 'Data inserted successfully';
        } catch (PDOException $th) {
            $response['status'] = 'error';
            $response['message'] = $th->getMessage();
        }
    } else {
        $error = "Meta Title and Meta Desc are mandatory Please fill them";
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
