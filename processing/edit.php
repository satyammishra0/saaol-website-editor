<?php

include('../config.php');




if (isset($_POST['statename']) && isset($_POST['cityname']) && isset($_POST['cityaddress']) && isset($_POST['phoneno']) && isset($_POST['centeremail']) && isset($_POST['iframeurl']) && isset($_POST['centerurl']) && isset($_POST['appointmenturl'])) {

    $id = trim($_POST['id']);
    $stateName = trim($_POST['statename']);
    $cityName = trim($_POST['cityname']);
    $cityAddress = trim($_POST['cityaddress']);
    $cityPhone = trim($_POST['phoneno']);
    $centerEmail = trim($_POST['centeremail']);
    $centerCCemail = trim($_POST['centerCCemail']);
    $iframeUrl = trim($_POST['iframeurl']);
    $iframeTitle = trim($_POST['iframetitle']);
    $centerUrl = trim($_POST['centerurl']);
    $centerAppoitmentUrl = trim($_POST['appointmenturl']);


    if (!empty($cityName) && !empty($cityAddress) && !empty($cityPhone) && !empty($iframeUrl) && !empty($iframeTitle) && !empty($centerUrl) && !empty($centerAppoitmentUrl)) {

        if (filter_var($centerEmail, FILTER_VALIDATE_EMAIL)) {
            $query = "UPDATE `city-card-details` SET 
            `state_name` = :stateName,
            `city_name` = :cityName,
            `city_addr` = :cityAddress,
            `phone_no` = :cityPhone, 
            `center_email` = :centerEmail,
            `cc_email` = :centerCCemail,
            `iframe_url` = :iframeUrl,
            `iframe_title` = :iframeTitle,
            `center_url` = :centerUrl,  
            `center_appointment_url` = :centerAppointmentUrl   WHERE `id` = :id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':stateName', $stateName);
            $stmt->bindParam(':cityName', $cityName);
            $stmt->bindParam(':cityAddress', $cityAddress);
            $stmt->bindParam(':cityPhone', $cityPhone);
            $stmt->bindParam(':centerEmail', $centerEmail);
            $stmt->bindParam(':centerCCemail', $centerCCemail);
            $stmt->bindParam(':iframeUrl', $iframeUrl);
            $stmt->bindParam(':iframeTitle', $iframeTitle);
            $stmt->bindParam(':centerUrl', $centerUrl);
            $stmt->bindParam(':centerAppointmentUrl', $centerAppoitmentUrl);


            if ($stmt->execute()) {
                $success = "Details Updated Successfully";
                header("location:../city-details.php");
            } else {
                $error = "Some error occured ";
                header("location:../edit-city-details.php?error=$error&id=$id");
            }
        } else {
            $error = "Please enter valid Email";
            header("location:../edit-city-details.php?error=$error&id=$id");
        }
    }

    // If any details are empty
    else {
        $error = "Please fill all the details 1";
        header("location:../edit-city-details.php?error=$error&id=$id");
    }
} else {
    $error = "Please fill all the details 2";
    header("location:../edit-city-details.php?error=$error&id=$id");
}
