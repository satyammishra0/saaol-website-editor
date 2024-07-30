<?php
ob_start();
include('../../../config.php');

$max_file_size = 800 * 1024;  // Defining Max file size
$unique_id = uniqid();   // Assigning unique id
$response = array();   //Send response to user
$centerName = $_POST['selectCenterId'];  //Extracting selected center id 
$galleryImgNamesArr = array();    //Blank array to store array format of added gallery images


// Loop through values || check for possible errors || upload in upload directory
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
        header("location:../add-center-page-image.php?error=Please choose some small image");
        //echo "Please choose some small image";
    }

    // Check for any error
    if ($gallery_img_errors !== 0) {
       header("location:../add-center-page-image.php?error=There is some error in images please try another");
        //echo "There is some error in images please try another";
        exit();
    }


    // Move files now
    if (move_uploaded_file($gallery_img_tmp_name, $gallery_img_destination)) {
        $galleryImgNamesArr[] = $unique_gallery_img_name;
        $galleryImgNames = implode(",", $galleryImgNamesArr);
    } else {
       header("location:../add-center-page-image.php?error=Some error occured please retry");
        //echo "Some error occured please retry";
        exit();
    }
}

// Recetption image addition 
$reception_img_name = $_FILES['reception-img']['name'];
$reception_img_tmp_name = $_FILES['reception-img']['tmp_name'];
$reception_img_size = $_FILES['reception-img']['size'];
$reception_img_errors = $_FILES['reception-img']['error'];


if ($reception_img_errors == 0) {
    $reception_file_destination = "uploads/" . $unique_id . "_recption_img_" . $reception_img_name;
    $unique_reception_img = $unique_id . "_recption_img_" . $reception_img_name;
    if ($max_file_size > $reception_img_size) {

        $sql = "INSERT INTO `center_images` 
            (`center_name`, `reception_img`, `center_gallery_img`) VALUES 
            (:center_name, :unique_reception_img, :center_gallery_img);";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":center_name", $centerName);
        $stmt->bindParam(":unique_reception_img", $unique_reception_img);
        $stmt->bindParam(":center_gallery_img", $galleryImgNames);


        try {
            $stmt->execute();
            if (move_uploaded_file($reception_img_tmp_name, $reception_file_destination)) {
                header("location:../add-center-page-image.php?submitted=img inserted successfully");
                } else {
                header("location:../add-center-page-image.php?error=File can't  be uploaded");
                //echo "File can't  be uploaded";
            }
        } catch (PDOException $th) {
            throw $th;
        }
    } else {
         header("location:../add-center-page-image.php?error=Quite a big image try another");
       // echo "Quite a big image try another";
    }
} else {
    header("location:../add-center-page-image.php?error=Reception image field not set");
    //echo "Error: Reception image field not set.";
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
