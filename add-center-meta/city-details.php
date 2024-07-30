<?php
include('../../config.php');

$query = "SELECT * FROM `seo_details` 
          LEFT JOIN `city-card-details` ON 
          `seo_details`.`page_id` = `city-card-details`.`id`;";

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
            max-width: 232px !important;
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
    </style>
</head>

<body>
    <section class="container">
        <div class="container mx-auto">
            <div class="flex justify-between items-center p-4 bg-gray-700 rounded shadow-lg" style="border: 1px solid #ddd;">
                <div class="text-white text-2xl font-bold">All New Meta Details</div>
                <div>
                    <a href="add-city-details.php" class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">Add Center</a>
                </div>
            </div>

            <div class="min-h-screen flex bg-gray-800">
                <div class="w-full max-w-4xl ">
                    <div class="w-full max-w-4xl">
                        <table class="table-bordered bg-gray-900 rounded">
                            <thead>
                                <tr>
                                    <th class="break-all">PageID</th>
                                    <th class="break-all">City Name</th>
                                    <th class="break-all">State Name</th>
                                    <th class="break-all">Meta Title</th>
                                    <th class="break-all">Meta Description</th>
                                    <th class="break-all">OG Details</th>
                                    <th class="break-all">Local schema</th>
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
                                        <td class="break-all"><?= $result['state_name'] ?></td>
                                        <td class="break-all"><?= $result['meta_title'] ?></td>
                                        <td class="break-all"><?= $result['meta_description'] ?></td>
                                        <td class="break-all scrollable-content">
                                            <textarea name="" id="" class="bg-gray-800 text-white" cols="30" rows="10" disabled>
                                                  <?= htmlspecialchars($result['og_details']) ?>
                                              </textarea>
                                        </td>
                                        <td class="break-all scrollable-content">
                                            <textarea name="" id="" class="bg-gray-800 text-white" cols="30" rows="10" disabled>
                                                   <?= htmlspecialchars($result['local_schema_details']) ?>
                                            </textarea>

                                        </td>
                                        <td class="action-th break-all">
                                            <a class="action-btn edit-btn bg-blue-500" href="edit-city-details.php?id=<?= $result['seo_id'] ?>&center-id=<?= $result['page_id'] ?>">Edit</a>
                                        </td>
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