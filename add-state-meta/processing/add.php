<?php

include('../../../config.php');


$response = array();


if (isset($_POST['selectStateName']) && isset($_POST['meta-title']) && isset($_POST['meta-desc'])) {

    $selectStateName = trim($_POST['selectStateName']);
    $bannerAltText = trim($_POST['banner-img-alt']);
    $metaTitle = trim($_POST['meta-title']);
    $metaDesc = trim($_POST['meta-desc']);

    // Getting OG-Details
    if (isset($_POST['og-details'])) {
        $ogDetails = $_POST['og-details'];
    } else {
        $ogDetails = "";
    }

    // Getting Local Schema
    if (isset($_POST['state-content'])) {
        $stateContent = $_POST['state-content'];
    } else {
        $stateContent = "";
    }

    // Checking if meta title and desc empty
    if (!empty($selectStateName) && !empty($metaTitle) && !empty($metaDesc)) {

        // SQL Statements and insertion
        $query = "INSERT INTO `state_seo_details` 
        (`state_name`, `meta_title`, `meta_desc`, `og_details`, `banner_alt_tag`, `state_content`) VALUES
        (:selectStateName, :metaTitle, :metaDesc, :ogDetails, :bannerAltText, :stateContent );";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':selectStateName', $selectStateName);
        $stmt->bindParam(':metaTitle', $metaTitle);
        $stmt->bindParam(':metaDesc', $metaDesc);
        $stmt->bindParam(':ogDetails', $ogDetails);
        $stmt->bindParam(':bannerAltText', $bannerAltText);
        $stmt->bindParam(':stateContent', $stateContent);

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
