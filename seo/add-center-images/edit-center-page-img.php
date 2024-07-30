<?php
include('../../config.php');
// include('./config.php');

$selectedCenterId = $_GET['id'];
$query = "SELECT * FROM `center_images` WHERE `id` = $selectedCenterId;";

$prepQuery = $conn->prepare($query);
$prepQuery->execute();
$result = $prepQuery->fetch(PDO::FETCH_ASSOC);


$gallery_imgs = explode(",", $result['center_gallery_img']);


$stateNameQuery = "SELECT `city_name` FROM `city-card-details` WHERE `id`= :stateID";
$stateNameQueryPrep = $conn->prepare($stateNameQuery);
$stateNameQueryPrep->bindParam(":stateID", $result['center_name']);
$stateNameQueryPrep->execute();

$stateNameRes = $stateNameQueryPrep->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Add City Details</title>
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

        .edit-txt {
            text-decoration: underline;
            cursor: pointer;
            margin-bottom: 2%;

        }

        .edit-txt:hover {
            color: #9a9a9a;
        }

        .edited-reception-image-div {
            display: none;
        }

        .edited-gallery-image-div {
            display: none;
        }

        .existing-gallery-imgs-div>div {
            display: grid;
            grid-gap: 10px;
            grid-template-columns: repeat(3, 1fr);
            margin: 3% 0;
        }

        .existing-gallery-imgs-div>div>img {
            height: 300px;
            width: 100%;
            border: 0.6px solid;
            border-radius: 3px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="form-container">
            <h2 class="text-2xl font-bold mb-4 text-center text-blue-500">Add City Details</h2>
            <form action="./processing/edit-center-image.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="selectedCenterId" value="<?= $selectedCenterId ?>" id="selectedCenterId">
                <label for="select" class="block mb-2">Selected City:</label>
                <div class="input-container relative">

                    <select id="selectCenterId" name="selectCenterId" class="block appearance-none w-full form-input border border-gray-700 text-white py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-gray-700 focus:border-gray-500">
                        <option selected value="<?= $result['center_name']; ?>"> <?= $stateNameRes['city_name']; ?></option>
                    </select>
                    <!-- Dropdown Arrow -->
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M6 8l4 4 4-4z" />
                        </svg>
                    </div>
                </div>

                <!-- Meta Description field -->
                <div class="input-container">
                    <label for="reception-img" class="form-label">Current Reception Image</label>
                    <img id="existing-reception-image" height="300" width="400" src="./processing/uploads/<?= $result['reception_img']; ?>" alt="Current reception image">
                    <a class="edit-txt" id="edit-reception-img-txt">Edit Image</a>
                </div>

                <!-- Meta Description field -->
                <div class="input-container edited-reception-image-div" id="edited-reception-image-div">
                    <label for="reception-img" class="form-label">Select Reception Images</label>
                    <input type="file" id="reception-img" name="reception-img" class="form-input">
                </div>

                <div class="existing-gallery-imgs-div" id="existing-gallery-imgs-div">
                    <label for="Gallery-img" class="form-label">Current Gallery Images</label>
                    <div>
                        <?php
                        foreach ($gallery_imgs as $key => $value) {
                            # code...
                        ?>
                            <img src="./processing/uploads/<?= $value; ?>" alt="Gallery Image">
                        <?php
                        }
                        ?>
                    </div>
                    <a class="edit-txt" id="edit-gallery-img-txt">Edit Gallery Images</a>
                </div>

                <!-- Meta Description field -->
                <div class="input-container edited-gallery-image-div" id="edited-gallery-image-div">
                    <label for="gallery-img" class="form-label">Select Gallery Iamges</label>
                    <input type="file" id="galleryImages[]" name="galleryImages[]" multiple class="form-input">
                    <small class="info">You can accept multiple images here</small>
                </div>

                <div class="loader-container" id="loader-container">
                    <span class="loader"></span>
                </div>


                <!-- Submit button -->
                <button type="submit" class="form-button">Edit Details</button>
            </form>
        </div>
    </div>


    <script src="./processing/assets/edit-center-img.js"></script>
</body>

</html>