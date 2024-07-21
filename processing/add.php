<?php

include('../config.php');



if (isset($_POST['statename']) && isset($_POST['cityname']) && isset($_POST['cityaddress']) && isset($_POST['phoneno']) && isset($_POST['centeremail']) && isset($_POST['iframeurl']) && isset($_POST['centerurl']) && isset($_POST['appointmenturl'])) {

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
            $query =
                "
            INSERT INTO `city-card-details` (`state_name`, `city_name`, `city_addr`, `phone_no`, `center_email`, `cc_email` ,`iframe_url`, `iframe_title`, `center_url`, `center_appointment_url`)  VALUES
            (:stateName, :cityName, :cityAddress, :cityPhone,  :centerEmail, :cc_email  , :iframeUrl, :iframeTitle, :centerUrl, :centerAppointmentUrl );
            ";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(':stateName', $stateName);
            $stmt->bindParam(':cityName', $cityName);
            $stmt->bindParam(':cityAddress', $cityAddress);
            $stmt->bindParam(':cityPhone', $cityPhone);
            $stmt->bindParam(':centerEmail', $centerEmail);
            $stmt->bindParam(':cc_email', $centerCCemail);
            $stmt->bindParam(':iframeUrl', $iframeUrl);
            $stmt->bindParam(':iframeTitle', $iframeTitle);
            $stmt->bindParam(':centerUrl', $centerUrl);
            $stmt->bindParam(':centerAppointmentUrl', $centerAppoitmentUrl);


            if ($stmt->execute()) {
                $success = "Details Added Successfully";
                header("location:../city-details.php");
            } else {
                $error = "Some error occured ";
                header("location:../add-city-details.php?error=$error");
            }
        } else {
            $error = "Please enter valid Email";
            header("location:../add-city-details.php?error=$error");
        }
    }

    // If any details are empty
    else {
        $error = "Please fill all the details 1";
        header("location:../add-city-details.php?error=$error");
    }
} else {
    $error = "Please fill all the details 2";
    header("location:../add-city-details.php?error=$error");
}
