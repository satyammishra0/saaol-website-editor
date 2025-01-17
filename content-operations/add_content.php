<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Content</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Add Content for Center ID: <?php echo htmlspecialchars($_GET['id']); ?></h1>
        <form id="contentForm">
            <input type="hidden" name="center_id" value="<?php echo htmlspecialchars($_GET['id']); ?>">

            <!-- Introduction -->
            <div class="mb-6 flex items-start">
                <div class="w-2/3 mr-4">
                    <label for="introduction" class="block text-sm font-medium text-gray-300 mb-2">Introduction</label>
                    <textarea id="introduction" name="introduction" rows="4" class="block w-full bg-gray-800 text-white border border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                </div>
                <div class="w-1/3">
                    <img src="../assets/intro-1.png" alt="Introduction" class="rounded-md">
                </div>
            </div>

            <!-- About -->
            <div class="mb-6 flex items-start">
                <div class="w-2/3 mr-4">
                    <label for="about" class="block text-sm font-medium text-gray-300 mb-2">About</label>
                    <textarea id="about" name="about" rows="4" class="block w-full bg-gray-800 text-white border border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                </div>
                <div class="w-1/3">
                    <img src="../assets/about-2.png" alt="About" class="rounded-md">
                </div>
            </div>

            <!-- Who Can Benefit -->
            <div class="mb-6 flex items-start">
                <div class="w-2/3 mr-4">
                    <label for="who_can_benefit" class="block text-sm font-medium text-gray-300 mb-2">Who Can Benefit</label>
                    <textarea id="who_can_benefit" name="who_can_benefit" rows="4" class="block w-full bg-gray-800 text-white border border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                </div>
                <div class="w-1/3">
                    <img src="../assets/who-benefit-3.png" alt="Who Can Benefit" class="rounded-md">
                </div>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
            </div>
        </form>
        <div id="responseMessage" class="mt-4"></div>
    </div>

    <script>
        $(document).ready(function() {
            $('#contentForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '../content-details-processing/add.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#responseMessage').html('<div class="bg-green-500 text-white p-2 rounded">' + response.message + '</div>');
                    },
                    error: function(xhr, status, error) {
                        $('#responseMessage').html('<div class="bg-red-500 text-white p-2 rounded">An error occurred: ' + xhr.responseText + '</div>');
                    }
                });
            });
        });
    </script>
</body>

</html>