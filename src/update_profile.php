<?php
include '../utils/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $profileID = $_POST['profileID'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $genderID = $_POST['genderID'];
    $departmentCode = $_POST['departmentCode'];

    $query = "UPDATE profiles SET firstName=?, middleName=?, lastName=?, genderID=?, departmentCode=? WHERE profileID=?";
    
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("sssisi", $firstName, $middleName, $lastName, $genderID, $departmentCode, $profileID);
        if ($stmt->execute()) {
            echo json_encode(['success' => 'Profile updated successfully']);
        } else {
            echo json_encode(['error' => 'Failed to update profile']);
        }
        $stmt->close();
    } else {
        echo json_encode(['error' => 'Failed to prepare the statement']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

$conn->close();
?>
