<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Content</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Add Content for Center ID: <?php echo htmlspecialchars($_GET['id']); ?></h1>
        <form action="save_content.php" method="POST">
            <input type="hidden" name="center_id" value="<?php echo htmlspecialchars($_GET['id']); ?>">

            <!-- Introduction -->
            <div class="mb-4">
                <label for="introduction" class="block text-sm font-medium text-gray-300">Introduction</label>
                <textarea id="introduction" name="introduction" rows="4" class="mt-1 block w-full bg-gray-800 text-white border border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            </div>

            <!-- Treatments Offered -->
            <div class="mb-4">
                <label for="treatments" class="block text-sm font-medium text-gray-300">Treatments Offered</label>
                <textarea id="treatments" name="treatments" rows="4" class="mt-1 block w-full bg-gray-800 text-white border border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            </div>

            <!-- Benefits -->
            <div class="mb-4">
                <label for="benefits" class="block text-sm font-medium text-gray-300">Benefits</label>
                <textarea id="benefits" name="benefits" rows="4" class="mt-1 block w-full bg-gray-800 text-white border border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            </div>

            <!-- Conditions Treated -->
            <div class="mb-4">
                <label for="conditions" class="block text-sm font-medium text-gray-300">Conditions Treated</label>
                <textarea id="conditions" name="conditions" rows="4" class="mt-1 block w-full bg-gray-800 text-white border border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            </div>

            <!-- Additional Information -->
            <div class="mb-4">
                <label for="additional_info" class="block text-sm font-medium text-gray-300">Additional Information</label>
                <textarea id="additional_info" name="additional_info" rows="4" class="mt-1 block w-full bg-gray-800 text-white border border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
            </div>
        </form>
    </div>
</body>

</html>