<?php

header('Content-Type: application/json');
include('../config.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $center_id = htmlspecialchars($_POST['center_id']);
    $introduction = htmlspecialchars($_POST['introduction']);
    $about = htmlspecialchars($_POST['about']);
    $who_can_benefit = htmlspecialchars($_POST['who_can_benefit']);

    try {
        // Insert data into database
        $stmt = $conn->prepare("INSERT INTO center_content (center_id, introduction, about, who_can_benefit) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$center_id, $introduction, $about, $who_can_benefit])) {
            echo json_encode(['message' => 'Content saved successfully']);
        } else {
            echo json_encode(['message' => 'Failed to save content']);
        }
    } catch (\PDOException $e) {
        echo json_encode(['message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['message' => 'Invalid request method']);
}
