<?php
include '../utils/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $profileID = $_POST['profileID'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $genderID = $_POST['genderID'];
    $departmentCode = $_POST['departmentCode'];

    $query = "UPDATE profiles SET firstName='$firstName', middleName='$middleName', lastName='$lastName', genderID='$genderID', departmentCode='$departmentCode' WHERE profileID='$profileID'";
    
    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => 'Profile updated successfully']);
    } else {
        echo json_encode(['error' => 'Failed to update profile']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

mysqli_close($conn);
?>
