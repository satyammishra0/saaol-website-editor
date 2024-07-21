<?php
include('./config.php');
$query = "SELECT * FROM `city-card-details`";
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
            padding: 2%;
        }

        .scroll-container {
            max-width: 100%;
            overflow-x: auto;
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
            overflow: hidden;
            text-overflow: ellipsis;
            width: 400px;
        }

        .break-all {
            word-wrap: break-all;
        }

        .action-th {
            width: 120px;
            /* Adjust width as needed */
        }

        .action-btn {
            padding: 4px 8px;
            margin-right: 4px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <section class="container">

        <div class="flex justify-between items-center p-4 bg-gray-700 rounded shadow-lg" style="border: 1px solid #ddd;">
            <div class="text-white text-2xl font-bold">All Center Pages</div>
            <div>
                <a href="contact-operations/add-contact-details.php" class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">Add Center</a>
            </div>
        </div>

        <div class="min-h-screen flex justify-center bg-gray-800">
            <div class="w-full max-w-4xl scroll-container">
                <div class="w-full max-w-4xl">
                    <table class="table-bordered bg-gray-900 rounded">
                        <thead>
                            <tr>
                                <th class="break-all">Id</th>
                                <th class="break-all">Statename</th>
                                <th class="break-all">Cityname</th>
                                <th class="break-all">Phone No</th>
                                <th class="break-all">Email Address</th>
                                <th class="break-all">CC Email Address</th>
                                <th class="break-all">Actions</th>
                                <th class="break-all">City Address</th>
                                <th class="break-all">Iframe URL</th>
                                <th class="break-all">Iframe Title</th>
                                <th class="break-all">Center URL</th>
                                <th class="break-all">Book Appointment URL</th>
                                <th class="break-all">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($result = $queryPrep->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr class="bg-gray-800">
                                    <td class="break-all"><?= $result['id'] ?></td>
                                    <td class="break-all"><?= $result['state_name'] ?></td>
                                    <td class="break-all"><?= $result['city_name'] ?></td>
                                    <td class="break-all"><?= $result['phone_no'] ?></td>
                                    <td class="break-all"><?= $result['center_email'] ?></td>
                                    <td class="break-all"><?= $result['cc_email'] ?></td>
                                    <td class="action-th break-all">
                                        <a class="action-btn edit-btn bg-blue-500" href="contact-operations/edit-contact-details.php?id=<?= $result['id'] ?>">Edit</a>
                                        <a class="action-btn edit-email-btn bg-blue-100 text-black" id="add-email-btn" onclick="editEmail(' ', <?= $result['id'] ?>)">
                                            <?php
                                            if ($result['center_email'] != "") {
                                                echo "Edit Email";
                                            } else {
                                                echo "Add Email";
                                            }
                                            ?>
                                        </a>
                                        <a class="action-btn edit-email-btn bg-blue-100 text-black" id="add-cc-email-btn" onclick="editCCEmail(' ', <?= $result['id'] ?>)">
                                            <?php
                                            if ($result['cc_email'] != "") {
                                                echo "Edit CC Email";
                                            } else {
                                                echo "Add CC Email";
                                            }
                                            ?>
                                        </a>
                                        <a class="action-btn delete-btn bg-red-500" id="delete-city-btn" onclick="deleteCityData(<?= $result['id'] ?>)">Delete</a>
                                    </td>
                                    <td class="break-all"><?= $result['city_addr'] ?></td>
                                    <td class="break-all"><?= $result['iframe_url'] ?></td>
                                    <td class="break-all"><?= $result['iframe_title'] ?></td>
                                    <td class="break-all"><?= $result['center_url'] ?></td>
                                    <td class="break-all"><?= $result['center_appointment_url'] ?></td>
                                    <td class="break-all"><?= $result['created_at'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Function edit and add email
        function editEmail(email, id) {
            var newEmail = prompt("Enter new email:", email);
            if (newEmail !== null) {
                addEmailDb(newEmail, id);
            }
        }

        function addEmailDb(enteredEmail, id) {
            $.ajax({
                url: './contact-details-processing/insert-email.php',
                method: 'post',
                data: {
                    email: enteredEmail,
                    id: id
                },
                success: function(response) {
                    alert(`${response}`);
                    location.reload();
                },
                error: function(error) {
                    alert(`${error}`);
                }
            })
        }

        // Delete Email using ajax and alert
        function deleteCityData(id) {
            alert("Are you sure want to delete Center");
            deleteCity(id);
        }

        function deleteCity(id) {
            $.ajax({
                url: './contact-details-processing/delete.php',
                method: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    alert(`${response}`);
                    location.reload();
                },
                error: function(error) {
                    alert(`${error}`);
                }
            })
        }

        function editCCEmail(cc_email, id) {
            var newCCEmail = prompt("Enter new email:", cc_email);
            if (newCCEmail !== null) {
                addCCEmail(newCCEmail, id);
            }
        }

        function addCCEmail(newCCEmail, id) {
            $.ajax({
                url: './contact-details-processing/insert-cc.php',
                method: 'post',
                data: {
                    cc_email: newCCEmail,
                    id: id
                },
                success: function(response) {
                    alert(`${response}`);
                    location.reload();
                },
                error: function(error) {
                    alert(`${error}`);
                }
            })
        }
    </script>
</body>

</html>