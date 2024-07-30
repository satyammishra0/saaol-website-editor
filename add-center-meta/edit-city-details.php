<?php
include('../../config.php');


$id = $_GET['id'];
$centerId = $_GET['center-id'];
$query = "SELECT * FROM `seo_details` WHERE `seo_id`= :id";
$prepQuery = $conn->prepare($query);
$prepQuery->bindParam(':id', $id);
$prepQuery->execute();

try {
    //code...
    $result = $prepQuery->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $th) {
    throw $th;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Edit City Details</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #1a1a1a;
            color: #ffffff;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 5% 0;
        }

        .form-container {
            width: 700px;
            padding: 20px;
            background-color: #333;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .form-label {
            display: block;
            margin-bottom: 4px;
            color: #fff;
        }

        .form-input {
            width: 100%;
            padding: 8px;
            margin-bottom: 0px;
            box-sizing: border-box;
            background-color: #444;
            color: #fff;
            border: 1px solid #666;
            border-radius: 4px;
        }

        small {
            font-size: 10px;
            color: #ffb6b6;
            margin-bottom: 4%;
        }

        .input-container {
            margin-bottom: 3%;
        }

        .form-error {
            color: #ff5050;
            font-size: 12px;
            margin-top: 4px;
        }

        .form-success {
            color: green;
            font-size: 12px;
            margin-top: 4px;
        }

        .form-button {
            background-color: #3490dc;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .edit-city {
            background-color: #3490dc;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .loader-container {
            width: 100vw;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            place-items: center;
            display: none;
            backdrop-filter: blur(4px);
        }

        .loader {
            width: 100px;
            height: 100px;
            background: linear-gradient(165deg,
                    rgb(1 15 27) 0%,
                    rgb(120 53 53) 40%,
                    rgb(35 75 192) 98%,
                    rgba(10, 10, 10, 1) 100%);
            border-radius: 50%;
            position: relative;
        }

        .loader:before {
            position: absolute;
            content: "";
            width: 100%;
            height: 100%;
            border-radius: 100%;
            border-bottom: 0 solid #ffffff05;
            box-shadow: 0 -10px 20px 20px #ffffff40 inset,
                0 -5px 15px 10px #ffffff50 inset, 0 -2px 5px #ffffff80 inset,
                0 -3px 2px #ffffffbb inset, 0 2px 0px #ffffff, 0 2px 3px #ffffff,
                0 5px 5px #ffffff90, 0 10px 15px #ffffff60, 0 10px 20px 20px #ffffff40;
            filter: blur(3px);
            animation: 2s rotate linear infinite;
        }

        @keyframes rotate {
            100% {
                transform: rotate(360deg)
            }
        }

        #select-city-parent {
            display: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="form-container">
            <h2 class="text-2xl font-bold mb-4 text-center text-blue-500">Edit City Details</h2>
            <form id="editMetaForm">
                <input type="hidden" name="page-id" value="<?= $id ?>">

                <!-- Show current City -->
                <div class="mb-5  rounded-lg  flex justify-between items-center text-white" id="edit-city-parent">
                    <p class="text-lg" id="city-name-text">
                        <?php
                        $currentCentersQuery = "SELECT * FROM `city-card-details` WHERE `id`= :id";
                        $prepCurrentCenterQuery = $conn->prepare($currentCentersQuery);
                        $prepCurrentCenterQuery->bindParam(":id", $centerId);
                        try {
                            //code...
                            $prepCurrentCenterQuery->execute();
                        } catch (PDOException $th) {
                            throw $th;
                        }
                        $currentCenterName = $prepCurrentCenterQuery->fetch(PDO::FETCH_ASSOC);
                        echo $currentCenterName['city_name'];
                        ?>
                    </p>
                    <button type="button" id="edit-city-btn" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Edit City
                    </button>
                </div>

                <input type="hidden" name="existing-city" value="<?= $centerId ?>">

                <!-- Select tag for edit city -->
                <div id="select-city-parent">
                    <label for="select" class="block mb-2">Edit City Details:</label>
                    <div class="input-container relative">
                        <?php
                        $selectCentersQuery = "SELECT * FROM  `city-card-details`";

                        $prepSelectCenterQuery = $conn->prepare($selectCentersQuery);
                        $prepSelectCenterQuery->execute();
                        ?>
                        <select id="selectCenterId" name="current-city-name" class="block appearance-none w-full form-input border border-gray-700 text-white py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-gray-700 focus:border-gray-500">
                            <option disabled selected>Select city </option>
                            <?php

                            while ($centerResult = $prepSelectCenterQuery->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?= $centerResult['id'] ?>"><?= $centerResult['city_name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M6 8l4 4 4-4z" />
                            </svg>
                        </div>
                        <!-- Dropdown Arrow -->
                    </div>
                </div>


                <!-- Meta Title field -->
                <div class="input-container">
                    <label for="meta-title" class="form-label">Meta Title* </label>
                    <input type="text" id="meta-title" name="meta-title" class="form-input" value="<?= $result['meta_title']; ?>">
                    <small>Add Meta title value exactly don't add HTML Element</small>
                </div>

                <!-- Meta Description field -->
                <div class="input-container">
                    <label for="meta-desc" class="form-label">Meta Description*</label>
                    <input type="text" id="meta-desc" name="meta-desc" class="form-input" value="<?= $result['meta_description']; ?>">
                    <small>Add Meta description value exactly don't add HTML Element</small>
                </div>

                <!-- OG Detials field -->
                <div class="input-container">
                    <label for="og-details" class="form-label">OG Details</label>
                    <textarea cols="30" rows="10" type="text" id="og-details" name="og-details" class="form-input"><?= $result['og_details']; ?></textarea>
                    <small>Add all OG details exactly with their HTML Element</small>
                </div>

                <!-- Local Scheme field -->
                <div class="input-container">
                    <label for="local-schema" class="form-label">Local Schema</label>
                    <textarea cols="30" rows="10" type="text" id="local-schema" name="local-schema" class="form-input"><?= $result['local_schema_details']; ?></textarea>
                    <small>Add local Schema with exactly with their HTML Element</small>
                </div>

                <div class="loader-container" id="loader-container">
                    <span class="loader"></span>
                </div>


                <!-- Submit button -->
                <button type="submit" class="form-button">Add Details</button>
            </form>
        </div>
    </div>

    <script src="./processing/assets/edit-details.js"></script>
</body>

</html>