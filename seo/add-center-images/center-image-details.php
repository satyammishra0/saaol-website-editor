<?php
include('../../config.php');
// include('./config.php');

$query = "SELECT *, center_images.id AS center_image_id FROM `center_images` 
         LEFT JOIN `city-card-details` ON 
          `center_images`.`center_name` = `city-card-details`.`id`; ";

$queryPrep = $conn->prepare($query);
$queryPrep->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>All city details </title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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
            width: 100%;
        }

        .table-bordered {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            white-space: nowrap;
        }

        .table-bordered td {
            overflow: hidden;
            overflow-x: scroll;
        }

        .break-all {
            word-wrap: break-all;
        }

        .action-th {
            width: 120px;
        }

        .action-btn {
            padding: 4px 8px;
            margin-right: 4px;
            border-radius: 4px;
            cursor: pointer;
        }

        .scrollable-content {
            max-height: 100px;
        }

        .scrollable-content pre {
            overflow: auto;
        }


        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-track {
            background: #1a1a1a;
        }

        ::-webkit-scrollbar-thumb {
            background: #4b5563;
            border-radius: 4px;
        }

        .galleryImgDiv {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        .galleryimg {
            height: 100px;
            border: 0.6px solid #eee;
            margin-right: 4px;
            margin-bottom: 4px;
        }
    </style>
</head>

<body>
    <section class="container">
        <div class="container mx-auto">
            <div class="flex justify-between items-center p-4 bg-gray-700 rounded shadow-lg" style="border: 1px solid #ddd;">
                <div class="text-white text-2xl font-bold">All New Meta Details</div>
                <div>
                    <a href="add-center-page-image.php" class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">Add Images</a>
                </div>
            </div>

            <div class="min-h-screen flex bg-gray-800">
                <div class="w-full">
                    <div class="w-full">
                        <table class="table-bordered bg-gray-900 rounded">
                            <thead>
                                <tr>
                                    <th class="break-all">ID</th>
                                    <th class="break-all">City Name</th>
                                    <th class="break-all">Reception Img</th>
                                    <th class="break-all">Gallery Images</th>
                                    <th class="break-all">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($result = $queryPrep->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr class="bg-gray-800">
                                        <td class="break-all"><?= $result['id'] ?></td>
                                        <td class="break-all"><?= $result['city_name'] ?></td>
                                        <td class="break-all">
                                            <img class="galleryimg" src="./processing/uploads/<?= $result['reception_img'] ?>" alt="">
                                        </td>
                                        <td class="break-all galleryImgDiv">
                                            <?php
                                            $galleryImgs = explode(",", $result['center_gallery_img']);
                                            for ($i = 0; $i < count($galleryImgs); $i++) {
                                            ?>
                                                <img class="galleryimg" src="./processing/uploads/<?= $galleryImgs[$i] ?>" alt="">
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="action-th break-all">
                                            <a class="action-btn edit-btn bg-blue-500" href="./edit-center-page-img.php?id=<?= $result['center_image_id'] ?>">Edit</a>
                                            <a class="action-btn edit-btn bg-red-500" href="./processing/delete-center-img.php?id=<?= $result['center_image_id'] ?>">Delete</a>
                                        </td>
                                    </tr>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>