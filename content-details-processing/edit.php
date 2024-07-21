<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $center_id = htmlspecialchars($_POST['center_id']);
    $introduction = htmlspecialchars($_POST['introduction']);
    $about = htmlspecialchars($_POST['about']);
    $who_can_benefit = htmlspecialchars($_POST['who_can_benefit']);


    try {
        // Update data in database
        $stmt = $conn->prepare("UPDATE center_content SET introduction = ?, about = ?, who_can_benefit = ? WHERE center_id = ?");
        if ($stmt->execute([$introduction, $about, $who_can_benefit, $center_id])) {
            echo json_encode(['message' => 'Content updated successfully']);
        } else {
            echo json_encode(['message' => 'Failed to update content']);
        }
    } catch (\PDOException $e) {
        echo json_encode(['message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['message' => 'Invalid request method']);
}
