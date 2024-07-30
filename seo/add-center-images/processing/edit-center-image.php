<?php
include('../../../config.php');

$max_file_size = 800 * 1024;  // Defining Max file size
$unique_id = uniqid();   // Assigning unique id
$response = array();   //Send response to user
$centerName = $_POST['selectCenterId'];  //Extracting selected center id 
$galleryImgNamesArr = array();    //Blank array to store array format of added gallery images

$selectedCenterId = $_POST['selectedCenterId'];

$query = "SELECT * FROM `center_images` WHERE `id` = :selectedCenterId";
$queryPrep = $conn->prepare($query);
$queryPrep->bindParam(":selectedCenterId", $selectedCenterId);
$queryPrep->execute();
$prevResult = $queryPrep->fetch(PDO::FETCH_ASSOC);



if (empty($_FILES['galleryImages']['name'][0])) {
    $galleryImgNames = $prevResult['center_gallery_img'];
} else {
    for ($i = 0; $i < count($_FILES['galleryImages']['name']); $i++) {

        // Ectracting img details
        $gallery_img_name = $_FILES['galleryImages']['name'][$i];
        $gallery_img_tmp_name = $_FILES['galleryImages']['tmp_name'][$i];
        $gallery_img_size = $_FILES['galleryImages']['size'][$i];
        $gallery_img_errors = $_FILES['galleryImages']['error'][$i];

        // Defining destination and unique name
        $gallery_img_destination = "uploads/" . $unique_id . "_gallery_img_" . $gallery_img_name;
        $unique_gallery_img_name = $unique_id . "_gallery_img_" . $gallery_img_name;

        // Check size 
        if ($gallery_img_size > $max_file_size) {
            print_r($gallery_img_size);
            echo "Please choose some small image";
            exit();
        }

        // Check for any error
        if ($gallery_img_errors !== 0) {
            echo "There is some error in images please try another";
            exit();
        }


        // Move files now
        if (move_uploaded_file($gallery_img_tmp_name, $gallery_img_destination)) {
            $galleryImgNamesArr[] = $unique_gallery_img_name;
            $galleryImgNames = implode(",", $galleryImgNamesArr);
        } else {
            echo "Some error occured please retry";
            exit();
        }
    }
}


if (empty($_FILES['reception-img']['name'])) {
    $reception_img = $prevResult['reception_img'];
} else {
    $reception_img_name = $_FILES['reception-img']['name'];
    $reception_img_tmp_name = $_FILES['reception-img']['tmp_name'];
    $reception_img_size = $_FILES['reception-img']['size'];
    $reception_img_errors = $_FILES['reception-img']['error'];


    if ($reception_img_errors == 0) {
        $reception_file_destination = "uploads/" . $unique_id . "_recption_img_" . $reception_img_name;
        $unique_reception_img = $unique_id . "_recption_img_" . $reception_img_name;
        if ($max_file_size > $reception_img_size) {
            $reception_img = $unique_reception_img;
            if (move_uploaded_file($reception_img_tmp_name, $reception_file_destination)) {
                echo "img inserted successfully";
                echo $reception_img;
            } else {
                echo "File can't  be uploaded";
            }
        } else {
            echo "Quite a big image try another";
        }
    } else {
        echo "Error: Reception image field not set.";
    }
}


$sql = "UPDATE `center_images` 
             SET `reception_img` = :reception_img, `center_gallery_img` = :center_gallery_img WHERE
             `id` =:selectedCenterId ";

$stmt = $conn->prepare($sql);

$stmt->bindParam(":reception_img", $reception_img);
$stmt->bindParam(":center_gallery_img", $galleryImgNames);
$stmt->bindParam(":selectedCenterId", $selectedCenterId);


try {
    $stmt->execute();
    echo "DATA Updated successfully";
} catch (PDOException $th) {
    throw $th;
}
