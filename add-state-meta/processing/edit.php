<?php
include('../../../config.php');


$response = array();

$id = $_POST['page-id'];


try {
    $fetchSeoQuery = "SELECT * FROM `state_seo_details` WHERE `state_seo_id` =:id";
    $stmtSeoQuery = $conn->prepare($fetchSeoQuery);
    $stmtSeoQuery->bindParam(":id", $id);
    $stmtSeoQuery->execute();
    $resultSeo = $stmtSeoQuery->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $th) {
    throw $th;
}


if (isset($_POST['meta-title']) && isset($_POST['meta-desc'])) {

    if (isset($_POST['selectStateName']) || !empty($_POST['selectStateName'])) {
        $stateName = $_POST['selectStateName'];
    } else {
        $stateName = $resultSeo['state_name'];
    }

    if (empty($_POST['meta-title'])) {
        $metaTitle = $resultSeo['meta_title'];
    } else {
        $metaTitle = trim($_POST['meta-title']);
    }


    if (empty($_POST['meta-desc'])) {
        $metaDesc = $resultSeo['meta_desc'];
    } else {
        $metaDesc = trim($_POST['meta-desc']);
    }


    if (empty($_POST['og-details'])) {
        $ogDetails = $resultSeo['og_details'];
    } else {
        $ogDetails = trim($_POST['og-details']);
    }


    if (empty($_POST['banner-img-alt'])) {
        $bannerAltTag = $resultSeo['banner_alt_tag'];
    } else {
        $bannerAltTag = trim($_POST['banner-img-alt']);
    }


    if (empty($_POST['state-content'])) {
        $stateContent = $resultSeo['state_content'];
    } else {
        $stateContent = trim($_POST['state-content']);
    }

    // Getting Local Schema
    if (isset($_POST['state-content'])) {
        $stateContent = $_POST['state-content'];
    } else {
        $stateContent = "";
    }

    // Checking if meta title and desc empty
    if (!empty($metaTitle) && !empty($metaDesc)) {
        // SQL Statements and insertion
        $query = "UPDATE `state_seo_details` SET 
                 `state_name`=:stateName,
                 `meta_title`=:metaTitle,
                 `meta_desc`=:metaDesc,
                 `og_details` =:ogDetails,
                 `banner_alt_tag`=:bannerAltTag,
                 `state_content`=:stateContent
                   WHERE
                `state_seo_details`.`state_seo_id` = :pageId;";


        $stmt = $conn->prepare($query);

        $stmt->bindParam(':stateName', $stateName);
        $stmt->bindParam(':metaTitle', $metaTitle);
        $stmt->bindParam(':metaDesc', $metaDesc);
        $stmt->bindParam(':ogDetails', $ogDetails);
        $stmt->bindParam(':bannerAltTag', $bannerAltTag);
        $stmt->bindParam(':stateContent', $stateContent);
        $stmt->bindParam(':pageId', $id);

        try {
            $stmt->execute();
            $response['status'] = 'success';
            $response['message'] = 'Data updated successfully';
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
