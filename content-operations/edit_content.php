<?php
include('../config.php');

$centerId = htmlspecialchars($_GET['id']);

// Fetch content based on the ID
$query = "SELECT * FROM center_content WHERE center_id = :center_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':center_id', $centerId, PDO::PARAM_INT);
$stmt->execute();
$content = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Content</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Edit Content for Center ID: <?php echo htmlspecialchars($centerId); ?></h1>
        <form id="edit-form">
            <input type="hidden" name="center_id" id="center_id" value="<?php echo htmlspecialchars($centerId); ?>">

            <!-- Introduction -->
            <div class="mb-6 flex items-start">
                <div class="w-2/3 mr-4">
                    <label for="introduction" class="block text-sm font-medium text-gray-300 mb-2">Introduction</label>
                    <textarea id="introduction" name="introduction" rows="4" class="block w-full bg-gray-800 text-white border border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?php echo htmlspecialchars($content['introduction']); ?></textarea>
                </div>
                <div class="w-1/3">
                    <img src="../assets/intro-1.png" alt="Introduction" class="rounded-md">
                </div>
            </div>

            <!-- About -->
            <div class="mb-6 flex items-start">
                <div class="w-2/3 mr-4">
                    <label for="about" class="block text-sm font-medium text-gray-300 mb-2">About</label>
                    <textarea id="about" name="about" rows="4" class="block w-full bg-gray-800 text-white border border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?php echo htmlspecialchars($content['about']); ?></textarea>
                </div>
                <div class="w-1/3">
                    <img src="../assets/about-2.png" alt="About" class="rounded-md">
                </div>
            </div>

            <!-- Who Can Benefit -->
            <div class="mb-6 flex items-start">
                <div class="w-2/3 mr-4">
                    <label for="who_can_benefit" class="block text-sm font-medium text-gray-300 mb-2">Who Can Benefit</label>
                    <textarea id="who_can_benefit" name="who_can_benefit" rows="4" class="block w-full bg-gray-800 text-white border border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?php echo htmlspecialchars($content['who_can_benefit']); ?></textarea>
                </div>
                <div class="w-1/3">
                    <img src="../assets/who-benefit-3.png" alt="Who Can Benefit" class="rounded-md">
                </div>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Handle form submission
            $('#edit-form').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '../content-details-processing/edit.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(error) {
                        console.error("Error updating data: ", error);
                    }
                });
            });
        });
    </script>
</body>

</html>