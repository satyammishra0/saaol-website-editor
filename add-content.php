<?php
include('./config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centers Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Centers Panel</h1>
        <div class="mb-4">
            <input id="search" type="text" placeholder="Search by city name..." class="w-full p-2 bg-gray-800 text-white rounded">
        </div>
        <div id="centers" class="space-y-4">
            <?php

            try {

                $stmt = $conn->query('SELECT id, city_name FROM `city-card-details`');
                $centers = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($centers as $center) {
                    echo '
                            <div class="bg-gray-800 p-4 rounded flex justify-between items-center center-item">
                                <span>' . htmlspecialchars($center['city_name']) . ' (ID: ' . htmlspecialchars($center['id']) . ')</span>
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded add-content-btn" data-id="' . htmlspecialchars($center['id']) . '">Add Content</button>
                            </div>
                        ';
                }
            } catch (PDOException $e) {
                echo 'Database error: ' . htmlspecialchars($e->getMessage());
            }
            ?>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.add-content-btn').click(function() {
                const centerId = $(this).data('id');
                window.location.href = `add_content.php?id=${centerId}`;
            });

            $('#search').on('keyup', function() {
                const value = $(this).val().toLowerCase();
                $('.center-item').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>