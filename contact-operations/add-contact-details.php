<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>ADD City Details</title>
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
            margin-bottom: 12px;
            box-sizing: border-box;
            background-color: #444;
            color: #fff;
            border: 1px solid #666;
            border-radius: 4px;
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
    </style>
</head>

<body>

    <div class="container">
        <div class="form-container">
            <h2 class="text-2xl font-bold mb-4 text-center text-blue-500">Add City Details</h2>
            <form action="./contact-details-processing/add.php" method="post">
                <!-- Id field (hidden) -->
                <input type="hidden" name="id" value="">
                <!-- You can replace "1" with the actual ID from your database -->

                <!-- State Name field -->
                <label for="statename" class="form-label">State Name:</label>
                <input type="text" id="statename" name="statename" class="form-input" required>

                <!-- City Name field -->
                <label for="cityname" class="form-label">City Name:</label>
                <input type="text" id="cityname" name="cityname" class="form-input" required>

                <!-- City Address field -->
                <label for="cityaddress" class="form-label">City Address:</label>
                <input type="text" id="cityaddress" name="cityaddress" class="form-input" required>

                <!-- Phone Number field -->
                <label for="phoneno" class="form-label">Phone Number:</label>
                <input type="text" id="phoneno" name="phoneno" class="form-input" required>

                <!-- Iframe URL field -->
                <label for="centeremail" class="form-label">Center Email:</label>
                <input type="text" id="centeremail" name="centeremail" class="form-input" required>

                <!-- Iframe URL field -->
                <label for="centerCCemail" class="form-label">Center CC Email:</label>
                <input type="text" id="centerCCemail" name="centerCCemail" class="form-input">

                <!-- Iframe URL field -->
                <label for="iframeurl" class="form-label">Iframe URL:</label>
                <input type="text" id="iframeurl" name="iframeurl" class="form-input" required>

                <!-- Iframe Title field -->
                <label for="iframetitle" class="form-label">Iframe Title:</label>
                <input type="text" id="iframetitle" name="iframetitle" class="form-input" required>

                <!-- Center URL field -->
                <label for="centerurl" class="form-label">Center URL:</label>
                <input type="text" id="centerurl" name="centerurl" class="form-input" required>

                <!-- Book Appointment URL field -->
                <label for="appointmenturl" class="form-label">Book Appointment URL:</label>
                <input type="text" id="appointmenturl" name="appointmenturl" class="form-input" required>

                <!-- Submit button -->
                <button type="submit" class="form-button">Add Center</button>
            </form>

            <div class="form-error">
                <?php
                if (isset($_GET['error'])) {
                    echo $_GET['error'];
                }
                ?>
            </div>

            <div class="form-success">
                <?php
                if (isset($_GET['success'])) {
                    echo $_GET['success'];
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>